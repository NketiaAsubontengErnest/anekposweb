<?php

/**
 * Dashboard controller
 */
class Dashboard extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $shops = new Shop();
        $sales = new Sale();
        $users = new User();
        $products = new Product();
        $categories = new Category();
        $salesData = [];

        $data = [
            'totalVisitors' => 0,
            'totalCustomers' => 0,
            'totalSales' => 0,
            'totalProducts' => 0,
            'totalRevenue' => 0,
            'salesWeeklyGraph' => [],
            'salesMonthlyGraph' => [],
            'totalShops' => 0,
            'totalUsers' => 0,
            'totalCategories' => 0,
            'totalPendingOrders' => 0,
            'totalCompletedOrders' => 0,
            'totalCancelledOrders' => 0,
            'totalActiveShops' => 0,
        ];

        $arr = [];

        $shops->query("UPDATE `shops` SET `status`= 1 WHERE `enddate` <= :current", [
            'current' => date('Y-m-d')
        ]);

        if (Auth::access('developer')) {
            $data['totalShops'] = $shops->selectCount()[0]->numbers;
            $data['totalExpireShops'] = $shops->selectCountWhere('status', 1)[0]->numbers;
        } else {

            $data['totalVisitors'] = $sales->query("SELECT COUNT(`ordernumber`) AS totalVisitors FROM `sales` WHERE `datesold` =:datesold AND `shopid` =:shopid GROUP BY `ordernumber`", [
                'datesold' => date('Y-m-d'),
                'shopid' => Auth::getShopid()
            ]);

            if (empty($data['totalVisitors'])) {
                $data['totalVisitors'] = 0;
            } else {
                $data['totalVisitors'] = count($data['totalVisitors']);
            }

            $data['totalCustomers'] = $sales->query("SELECT COUNT(*) AS totalCustomers FROM `customers` WHERE `shopid` =:shopid", [
                'shopid' => Auth::getShopid()
            ]);

            if (empty($data['totalCustomers'])) {
                $data['totalCustomers'] = 0;
            } else {
                $data['totalCustomers'] = $data['totalCustomers'][0]->totalCustomers ?: 0;
            }

            $data['totalProducts'] = $products->query("SELECT COUNT(*) AS totalProducts FROM `products` WHERE `shopid` =:shopid", [
                'shopid' => Auth::getShopid()
            ])[0]->totalProducts ?: 0;

            // Get start and end dates for current week (Monday to Sunday)
            $monday = date('Y-m-d', strtotime('monday this week'));
            $sunday = date('Y-m-d', strtotime('sunday this week'));

            $data['totalRevenue'] = $sales->query(
                "SELECT SUM(`quantity` * `price`) AS totalRevenue FROM `sales` WHERE `datesold` BETWEEN :monday AND :sunday AND `shopid` = :shopid",
                [
                    'monday' => $monday,
                    'sunday' => $sunday,
                    'shopid' => Auth::getShopid()
                ]
            );

            if (empty($data['totalRevenue'])) {
                $data['totalRevenue'] = 0;
            } else {
                $data['totalRevenue'] = $data['totalRevenue'][0]->totalRevenue ?: 0;
            }

            // Prepare sales data for graph (e.g., sales per day for current week, with Mon, Tue, ...)
            $weekDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $salesGraph = array_fill_keys($weekDays, 0);

            $salesData = $sales->query(
                "SELECT DATE(`datesold`) AS date, SUM(`quantity` * `price`) AS total 
                 FROM `sales` 
                 WHERE `datesold` BETWEEN :monday AND :sunday AND `shopid` = :shopid 
                 GROUP BY DATE(`datesold`) 
                 ORDER BY DATE(`datesold`)",
                [
                    'monday' => $monday,
                    'sunday' => $sunday,
                    'shopid' => Auth::getShopid()
                ]
            );

            // Map dates to day names
            if ($salesData) {
                foreach ($salesData as $row) {
                    $dayName = date('D', strtotime($row->date));
                    if (in_array($dayName, $weekDays)) {
                        $salesGraph[$dayName] = $row->total ?: 0;
                    }
                }
                $data['salesWeeklyGraph'] = $salesGraph;
            }

            // Prepare sales data for monthly graph
            $currentMonth = date('Y-m');
            $salesMonthlyGraph = [];
            $monthlySalesData = $sales->query(
                "SELECT DATE_FORMAT(`datesold`, '%Y-%m') AS month, SUM(`quantity` * `price`) AS total 
                 FROM `sales` 
                 WHERE DATE_FORMAT(`datesold`, '%Y-%m') = :currentMonth AND `shopid` = :shopid 
                 GROUP BY DATE_FORMAT(`datesold`, '%Y-%m')",
                [
                    'currentMonth' => $currentMonth,
                    'shopid' => Auth::getShopid()
                ]
            );
            foreach ($monthlySalesData as $row) {
                $salesMonthlyGraph[$row->month] = $row->total ?: 0;
            }
            $data['salesMonthlyGraph'] = $salesMonthlyGraph;

            if (Auth::access('Admin') || Auth::access('manager')) {
                $data['totalSales'] = $sales->query("SELECT SUM(`quantity` * `price`) AS totalSales FROM `sales` WHERE `datesold` =:datesold AND `shopid` =:shopid", [
                    'datesold' => date('Y-m-d'),
                    'shopid' => Auth::getShopid()
                ])[0]->totalSales ?: 0;
            } else {
                $data['totalSales'] = $sales->query("SELECT SUM(`quantity` * `price`) AS totalSales FROM `sales` WHERE `datesold` =:datesold AND `shopid` =:shopid AND `userid` =:userid ", [
                    'datesold' => date('Y-m-d'),
                    'userid' => Auth::getUsername(),
                    'shopid' => Auth::getShopid()
                ])[0]->totalSales ?: 0;
            }
        }

        // if (count($_POST) > 0 && isset($_POST['season'])) {
        //     $_SESSION['seasondata'] = $data['season'] = $season->where('id', $_POST['season'])[0];
        // }        

        // if (!isset($_SESSION['seasondata'])) {
        //     $arr['seasonid'] = isset($ss[0]->id) ? $ss[0]->id : ''; 
        //     $_SESSION['seasondata'] = $ss[0];            
        //     $data['season'] = $ss[0];     
        // } else {
        //     $arr['seasonid'] = $_SESSION['seasondata']->id;
        //     $data['season'] = $_SESSION['seasondata'];           
        // }

        $msg = " Logged in successfully";
        $crumbs[] = ['Dashboard', ''];
        $actives = 'dashboard';
        $hiddenSearch = "yeap";
        return $this->view('dashboard', [
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'msg' => $msg
        ]);
    }
}
