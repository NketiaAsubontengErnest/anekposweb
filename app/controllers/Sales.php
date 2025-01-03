<?php

/**
 * Sales controller
 */
class Sales extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $sales = new Sale();
        $products = new Product();

        $data1 = array();
        $data = array();
        $cust = array();

        if (count($_POST) > 0) {

            if (isset($_POST['product_ids'])) {
                $ordnumnew = 0;
                $ordnumn = "";

                $arr['datesold'] = date("Y-m-d");
                $arr['shopid'] = Auth::getShop()->shopid;

                $query = 'SELECT ordernumber FROM `sales` WHERE `shopid` = :shopid AND `datesold` =:datesold ORDER BY id DESC LIMIT 1 ';
                $ordnum = $sales->query($query, $arr);

                $year = date("Y");
                $mount = date("m");
                $day = date("d");

                $getordnum = '';
                $zeros = '';
                if ($ordnum) {
                    $ordnumn = $ordnum[0]->ordernumber;
                    $ordnumnew = substr($ordnumn, -4);
                }
                $ordnumnew += 1;

                if ($ordnumnew > 9999) {
                    $zeros = '';
                } elseif ($ordnumnew > 999) {
                    $zeros = '0';
                } elseif ($ordnumnew > 99) {
                    $zeros = '00';
                } elseif ($ordnumnew > 9) {
                    $zeros = '000';
                } else {
                    $zeros = '0000';
                }

                $getordnum = $year . '' . $mount . '' . $day . '' . $zeros . '' . $ordnumnew;

                if (isset($_POST['customid'])) {
                    $cust = array(
                        'customid' => $_POST['customid'],
                        'credited' => $_POST['credited'],
                        'depositamount' => $_POST['depositamount'],
                        'ordernumber' => $getordnum,
                    );
                    unset($_POST['customid']);
                    unset($_POST['credited']);
                    unset($_POST['depositamount']);
                }

                for ($count = 0; $count < count($_POST['product_ids']); $count++) {
                    $prod = $products->where('productid', $_POST['product_ids'][$count])[0];

                    $salesdata = array(
                        'productid' => $_POST['product_ids'][$count],
                        'shopid' => $arr['shopid'],
                        'ordernumber' => $getordnum,
                        'quantity' => $_POST['quantities'][$count],
                        'userid' => Auth::getUsername(),
                        'price' => $prod->selling_price,
                        'profit' => $prod->selling_price - $prod->cost_price,
                        'hide' => $prod->hide,
                    );

                    $productdata = array(
                        'productid' => $_POST['product_ids'][$count],
                        'shopid' => $arr['shopid'],
                        'quantity' => $_POST['quantities'][$count],
                    );

                    $sales->insert($salesdata);
                    $products->query("UPDATE `products` SET `quantity` = `quantity`-:quantity WHERE `productid` =:productid AND `shopid` =:shopid", $productdata);
                }

                $_SESSION['messsage'] = "Sales Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                $this->redirect('sales');
            }
        }
        $prods = new Product();
        $customers = new Customer();

        $data1 = $sales->calculate_Sales(date('Y-m-d'));

        $data = $prods->where_query("SELECT * FROM `products` WHERE `quantity` != 0 AND `shopid`=:shopid", ['shopid' => Auth::getShop()->shopid]);

        $cust = $customers->where_query("SELECT * FROM `customers` WHERE `shopid`=:shopid", ['shopid' => Auth::getShop()->shopid]);

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'sales';
        $link = 'sales';
        $hiddenSearch  = '';
        $this->view('sale/sales', [
            'rowssales' => $data1,
            'productdata' => $data,
            'customers' => $cust,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives
        ]);
    }

    function list()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $sales = new Sale();
        $data = array();

        // $data = $prods->where_query("SELECT * FROM `products` WHERE `quantity` != 0 AND `shopid`=:shopid", ['shopid'=>Auth::getShop()->shopid]);
        $data = $sales->where_query("SELECT * FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid", [
            'shopid' => Auth::getShop()->shopid,
            'userid' => Auth::getUsername(),
        ]);

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'salesreport';
        $link = 'saleslist';
        $hiddenSearch  = '';
        $this->view('sale/list', [
            'salesdata' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function daily()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $sales = new Sale();
        $employees = new User();
        $dates = array();
        $data = array();
        $subdata = array();
        $employeesdata = array();
        $arr = array();

        $arr['shopid'] = Auth::getShop()->shopid;
        if (isset($_GET['userid'])) {
            $arr['userid'] = $_GET['userid'];
            $dates = $sales->findAllDistinct('SELECT DISTINCT `datesold` FROM `sales` WHERE `userid` =:userid AND `shopid` =:shopid', $arr);
        }

        if (isset($_GET['userid']) && isset($_GET['solddate'])) {
            $arr['datesold'] = $_GET['solddate'];
            $data = $sales->where_query("SELECT * FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid AND `datesold` =:datesold", $arr);
            $subdata = $sales->where_query("SELECT SUM(`quantity` * `price`) AS sub_total FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid AND `datesold` =:datesold", $arr)[0];
        } else {
            $data = $sales->where_query("SELECT * FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid", [
                'shopid' => Auth::getShop()->shopid,
                'userid' => Auth::getUsername(),
            ]);
            $subdata = $sales->where_query("SELECT SUM(`quantity` * `price`) AS sub_total FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid", [
                'shopid' => Auth::getShop()->shopid,
                'userid' => Auth::getUsername(),
            ])[0];

            if(isset($_GET['userid'])){
                $data = $sales->where_query("SELECT * FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid", [
                    'shopid' => Auth::getShop()->shopid,
                    'userid' => $_GET['userid'],
                ]);
                $subdata = $sales->where_query("SELECT SUM(`quantity` * `price`) AS sub_total FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid", [
                    'shopid' => Auth::getShop()->shopid,
                    'userid' => $_GET['userid'],
                ])[0];
            }
        }

        $employeesdata = $employees->where('shopid', Auth::getShop()->shopid);

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'salesreport';
        $link = 'daily';
        $hiddenSearch  = '';
        $this->view('sale/daily', [
            'salesdata' => $data,
            'subtotal' => $subdata,
            'dates' => $dates,
            'employees' => $employeesdata,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function purchases()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $sales = new Sale();
        $data = array();
        $arr = array();

        if (isset($_GET['startdate'])) {
            $arr['shopid'] = Auth::getShop()->shopid;
            $arr['startdate'] = $_GET['startdate'];
            $data = $sales->where_query("SELECT p.pro_name AS product_name, SUM(s.quantity) AS total_prod_quantity, s.price AS prod_unit_price, SUM(s.quantity * s.price) AS total_prod_amount FROM sales s JOIN products p ON s.productid = p.productid WHERE s.shopid =:shopid AND s.datesold =:startdate GROUP BY s.productid, s.price, p.pro_name;", $arr);
        }

        if (isset($_GET['startdate']) && isset($_GET['enddate'])) {
            $arr['enddate'] = $_GET['enddate'];
            $data = $sales->where_query("SELECT p.pro_name AS product_name, SUM(s.quantity) AS total_prod_quantity, s.price AS prod_unit_price, SUM(s.quantity * s.price) AS total_prod_amount FROM sales s JOIN products p ON s.productid = p.productid WHERE s.shopid =:shopid AND s.datesold BETWEEN :startdate AND :enddate GROUP BY s.productid, s.price, p.pro_name;", $arr);
        } else {
            $data = $sales->where_query("SELECT p.pro_name AS product_name, SUM(s.quantity) AS total_prod_quantity, s.price AS prod_unit_price, SUM(s.quantity * s.price) AS total_prod_amount FROM sales s JOIN products p ON s.productid = p.productid WHERE s.shopid =:shopid GROUP BY s.productid, s.price, p.pro_name;", [
                'shopid' => Auth::getShop()->shopid,
            ]);
        }

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'salesreport';
        $link = 'purchases';
        $hiddenSearch  = '';
        $this->view('sale/purchases', [
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function profit()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $sales = new Sale();
        $data = array();
        $arr = array();

        if (isset($_GET['startdate'])) {
            $arr['shopid'] = Auth::getShop()->shopid;
            $arr['startdate'] = $_GET['startdate'];
            $data = $sales->where_query("SELECT p.pro_name AS product_name, SUM(s.quantity) AS total_prod_quantity, s.price AS prod_unit_price, SUM(s.quantity * s.price) AS total_prod_amount FROM sales s JOIN products p ON s.productid = p.productid WHERE s.shopid =:shopid AND s.datesold =:startdate GROUP BY s.productid, s.price, p.pro_name;", $arr);
        }

        if (isset($_GET['startdate']) && isset($_GET['enddate'])) {
            $arr['enddate'] = $_GET['enddate'];
            $data = $sales->where_query("SELECT p.pro_name AS product_name, SUM(s.quantity) AS total_prod_quantity, s.price AS prod_unit_price, SUM(s.quantity * s.price) AS total_prod_amount FROM sales s JOIN products p ON s.productid = p.productid WHERE s.shopid =:shopid AND s.datesold BETWEEN :startdate AND :enddate GROUP BY s.productid, s.price, p.pro_name;", $arr);
        } else {
            $data = $sales->where_query("SELECT p.pro_name AS product_name, SUM(s.quantity) AS total_prod_quantity, s.price AS prod_unit_price, SUM(s.quantity * s.price) AS total_prod_amount FROM sales s JOIN products p ON s.productid = p.productid WHERE s.shopid =:shopid GROUP BY s.productid, s.price, p.pro_name;", [
                'shopid' => Auth::getShop()->shopid,
            ]);
        }

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'salesreport';
        $link = 'purchases';
        $hiddenSearch  = '';
        $this->view('sale/profit', [
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }
}
