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
        $customers = new Customer();
        $customerdebts = new Customerdebt();
        $batchs = new Batch();

        $data1 = array();
        $data = array();
        $cust = array();

        if (count($_POST) > 0) {

            if (isset($_POST['product_ids'])) {
                $temp = array();
                $ordnumnew = 0;
                $ordnumn = "";

                $totalAmount = 0;
                $totalDebt = 0;

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

                if (isset($_POST['customid'])) {
                    $temp = $_POST;

                    unset($_POST['customid']);
                    unset($_POST['credited']);
                    unset($_POST['depositamount']);
                }

                $getordnum = $year . '' . $mount . '' . $day . '' . $zeros . '' . $ordnumnew;

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

                    $totalAmount += $_POST['quantities'][$count] * $prod->selling_price;

                    $sales->insert($salesdata);
                    $products->query("UPDATE `products` SET `quantity` = `quantity`-:quantity WHERE `productid` =:productid AND `shopid` =:shopid", $productdata);

                    // Deduct quantity from the closest batch date for the product using MySQL queries
                    $deduct_quantity = $_POST['quantities'][$count];
                    $productid = $_POST['product_ids'][$count];
                    $shopid = $arr['shopid'];

                    // Deduct from the batch where quantity is greater than or equal to deduct_quantity, ordered by expirydate
                    $batchs->query(
                        "UPDATE batchs
                        SET quantity = quantity - :deduct_quantity
                        WHERE batchcode = (
                            SELECT batchcode FROM batchs
                            WHERE productid = :productid AND shopid = :shopid AND quantity >= :deduct_quantity
                            ORDER BY batchs.expiredate ASC LIMIT 1
                        )",
                        [
                            'productid' => $productid,
                            'shopid' => $shopid,
                            'deduct_quantity' => $deduct_quantity,
                        ]
                    );
                }

                if (isset($temp['customid'])) {
                    if ($temp['credited'] == 'YES') {
                        $totalDebt = $totalAmount - $temp['depositamount'];
                        if ($totalDebt > 0) {
                            $cust = array(
                                'custid' => $temp['customid'],
                                'shopid' => $arr['shopid'],
                                'amount' =>  $totalDebt,
                                'userid' => Auth::getUsername(),
                                'invoicenum' => $getordnum,
                            );

                            $customerdebts->insert($cust);
                        }
                    }
                }

                $_SESSION['messsage'] = "Sales Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                $this->tab_redirect('sales/print/' . $getordnum . '?cust=' . $temp['customid'], 'sales');
            }
        }

        $batchs->query(
            "DELETE FROM batchs WHERE quantity <= 0 AND shopid = :shopid",
            ['shopid' => Auth::getShop()->shopid]
        );

        $data = $products->where_query("SELECT * FROM `products` WHERE `quantity` != 0 AND `shopid`=:shopid", ['shopid' => Auth::getShop()->shopid]);

        $cust = $customers->where_query("SELECT * FROM `customers` WHERE `shopid`=:shopid", ['shopid' => Auth::getShop()->shopid]);

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'sales';
        $link = 'sales';
        $hiddenSearch  = '';
        $this->view('sale/sales', [
            'rowssales' => $sales->calculate_Sales(),
            'productdata' => $data,
            'customers' => $cust,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives
        ]);
    }

    function print($id)
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $sales = new Sale();
        $products = new Product();
        $customers = new Customer();

        $customer = '';

        $shop = Auth::getShop();

        $data = array();
        $data = $sales->where_query("SELECT * FROM `sales` WHERE `shopid`=:shopid AND `ordernumber` =:ordernumber", [
            'shopid' => Auth::getShop()->shopid,
            'ordernumber' => $id,
        ]);

        if (isset($_GET['cust']))
            $customer = $customers->where('custid', $_GET['cust'])[0]->custname ?? null;

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'salesreport';
        $link = 'saleslist';
        $hiddenSearch  = '';
        $this->view('sale/print', [
            'sales' => $data,
            'shop' => $shop,
            'products' => $products,
            'customer' => $customer,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function list()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }
        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $sales = new Sale();
        $data = array();

        // $data = $prods->where_query("SELECT * FROM `products` WHERE `quantity` != 0 AND `shopid`=:shopid", ['shopid'=>Auth::getShop()->shopid]);
        if (Auth::access('Admin')) {
            $data = $sales->where_query("SELECT * FROM `sales` WHERE `shopid`=:shopid ORDER BY id DESC LIMIT $limit OFFSET $offset", [
                'shopid' => Auth::getShop()->shopid,
            ]);
        } else {
            $data = $sales->where_query("SELECT * FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid ORDER BY id DESC LIMIT $limit OFFSET $offset", [
                'shopid' => Auth::getShop()->shopid,
                'userid' => Auth::getUsername(),
            ]);
        }

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'salesreport';
        $link = 'saleslist';
        $hiddenSearch  = '';
        $this->view('sale/list', [
            'salesdata' => $data,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function invoices()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }
        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $sales = new Sale();
        $data = array();

        $arr['shopid'] = Auth::getShop()->shopid;

        // Search by ordernumber (invoice) or datesold (date)
        if (isset($_GET['invoice']) || isset($_GET['datesold'])) {
            $query = "SELECT `ordernumber`, count(ordernumber) AS total_products, sum(`quantity` * `price`) AS total_amount, `datesold`, `userid` FROM `sales` WHERE `shopid`=:shopid";

            if (!empty($_GET['invoice'])) {
                $query .= " AND `ordernumber` LIKE :invoice";
                $arr['invoice'] = '%' . $_GET['invoice'] . '%';
            }
            if (!empty($_GET['datesold'])) {
                $query .= " AND `datesold` = :datesold";
                $arr['datesold'] = $_GET['datesold'];
            }

            $query .= " GROUP BY `ordernumber` ORDER BY id DESC LIMIT $limit OFFSET $offset";
            $data = $sales->where_query($query, $arr);
        } else {
            $data = $sales->where_query("SELECT `ordernumber`, count(ordernumber) AS total_products, sum(`quantity` * `price`) AS total_amount, `datesold`, `userid` FROM `sales` WHERE `shopid`=:shopid  GROUP BY `ordernumber` ORDER BY id DESC LIMIT $limit OFFSET $offset", $arr);
        }

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'salesreport';
        $link = 'saleslist';
        $hiddenSearch  = '';
        $this->view('sale/invoices', [
            'salesdata' => $data,
            'crumbs' => $crumbs,
            'pager' => $pager,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function invoice($id)
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $sales = new Sale();
        $data = array();

        $data = $sales->where_query("SELECT * FROM `sales` WHERE `shopid`=:shopid AND `ordernumber` =:ordernumber", [
            'shopid' => Auth::getShop()->shopid,
            'ordernumber' => $id,
        ]);

        $subdata = $sales->query(
            "SELECT SUM(`quantity` * `price`) AS sub_total FROM `sales` WHERE `shopid`=:shopid AND `ordernumber` =:ordernumber",
            [
                'ordernumber' => $id,
                'shopid' => Auth::getShop()->shopid,
            ]
        )[0];

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'salesreport';
        $link = 'saleslist';
        $hiddenSearch  = '';
        $this->view('sale/invoice', [
            'salesdata' => $data,
            'id' => $id,
            'crumbs' => $crumbs,
            'subdata' => $subdata,
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
        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $sales = new Sale();
        $employees = new User();
        $dates = array();
        $data = array();
        $subdata = array();
        $employeesdata = array();
        $arr = array();

        $arr['shopid'] = Auth::getShop()->shopid;

        $dates = $sales->findAllDistinct('SELECT DISTINCT `datesold` FROM `sales` WHERE `shopid` =:shopid ORDER BY id DESC', $arr);

        // Search by userid, solddate, or both
        if (isset($_GET['userid']) || isset($_GET['solddate'])) {
            $query = "SELECT * FROM `sales` WHERE `shopid`=:shopid";
            $subquery = "SELECT SUM(`quantity` * `price`) AS sub_total FROM `sales` WHERE `shopid`=:shopid";
            $arr = ['shopid' => Auth::getShop()->shopid];

            if (!empty($_GET['userid'])) {
                $query .= " AND `userid` =:userid";
                $subquery .= " AND `userid` =:userid";
                $arr['userid'] = $_GET['userid'];
            }
            if (!empty($_GET['solddate'])) {
                $query .= " AND `datesold` =:datesold";
                $subquery .= " AND `datesold` =:datesold";
                $arr['datesold'] = $_GET['solddate'];
            }

            $query .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";
            $data = $sales->where_query($query, $arr);
            $subdata = $sales->where_query($subquery, $arr)[0];
        } else {
            // Default: show current user's sales
            $data = $sales->where_query(
                "SELECT * FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid ORDER BY id DESC LIMIT $limit OFFSET $offset",
                [
                    'shopid' => Auth::getShop()->shopid,
                    'userid' => Auth::getUsername(),
                ]
            );
            $subdata = $sales->where_query(
                "SELECT SUM(`quantity` * `price`) AS sub_total FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid",
                [
                    'shopid' => Auth::getShop()->shopid,
                    'userid' => Auth::getUsername(),
                ]
            )[0];

            // If admin, show all sales
            if (Auth::access('Admin')) {
                $data = $sales->where_query(
                    "SELECT * FROM `sales` WHERE `shopid`=:shopid ORDER BY id DESC LIMIT $limit OFFSET $offset",
                    ['shopid' => Auth::getShop()->shopid]
                );
                $subdata = $sales->where_query(
                    "SELECT SUM(`quantity` * `price`) AS sub_total FROM `sales` WHERE `shopid`=:shopid",
                    ['shopid' => Auth::getShop()->shopid]
                )[0];
            }

            // If filtering by userid
            if (isset($_GET['userid']) && !empty($_GET['userid'])) {
                $data = $sales->where_query(
                    "SELECT * FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid ORDER BY id DESC LIMIT $limit OFFSET $offset",
                    [
                        'shopid' => Auth::getShop()->shopid,
                        'userid' => $_GET['userid'],
                    ]
                );
                $subdata = $sales->where_query(
                    "SELECT SUM(`quantity` * `price`) AS sub_total FROM `sales` WHERE `userid` =:userid AND `shopid`=:shopid",
                    [
                        'shopid' => Auth::getShop()->shopid,
                        'userid' => $_GET['userid'],
                    ]
                )[0];
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
            'pager' => $pager,
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
