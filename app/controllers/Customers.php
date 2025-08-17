<?php

/**
 * Customers controller
 */
class Customers extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data1 = array();
        $data = array();
        $arr = array();

        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $customers = new Customer();

        if (count($_POST) > 0) {
            if (isset($_POST['del'])) {
                $customers->delete($_POST['del'], 'custid');

                $_SESSION['messsage'] = "Customer Deleted Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }
        }

        if (isset($_GET['searchcustomer'])) {
            $arr['searchuse'] = '%' . $_GET['searchcustomer'] . '%';
            $query = "SELECT * FROM `customers` WHERE `custname` LIKE :searchuse OR `custphone` LIKE :searchuse LIMIT $limit OFFSET $offset";

            $data = $customers->findSearch($query, $arr);
        } else {
            $data = $customers->findAll($limit, $offset, 'DESC');
        }

        $actives = 'customers';
        $link = 'customerslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('customers/index', [
            'rows1' => $data1,
            'rows' => $data,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data1 = array();
        $data = array();

        $customers = new Customer();

        if (count($_POST) > 0) {
            if ($customers->validate($_POST)) {
                $_POST['shopid'] = Auth::getShop()->shopid;
                $_POST['custid'] = generateRandomCode(55);

                $customers->insert($_POST);

                $_SESSION['messsage'] = "Customer Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect('customers');
            } else {
                $_SESSION['messsage'] = "Shop Not Added!";
                $_SESSION['status_code'] = "warning";
                $_SESSION['status_headen'] = "Check Well!";
            }
        }

        $actives = 'customers';
        $link = 'customersadd';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('customers/add', [
            'rows1' => $data1,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function edit($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data = array();
        $customers = new Customer();

        if (count($_POST) > 0) {
            $customers->update($id, $_POST, 'custid');

            $_SESSION['messsage'] = "Customer Update Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect('customers');
        }

        $data = $customers->where('custid', $id)[0];

        $actives = 'customers';
        $link = 'customerslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('customers/edit', [
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function debts()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = array();
        $custdebts = new Customerdebt();
        $customers = new Customer();

        if (count($_POST) > 0) {
            $_POST['userid'] = Auth::getUsername();
            $_POST['shopid'] = Auth::getShop()->shopid;
            $custdebts->insert($_POST);

            $_SESSION['messsage'] = "Debt Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect('customers/debts');
        }

        $debtdats = $custdebts->where_query("SELECT DISTINCT custid, SUM(amount) AS amount FROM `customerdebts` WHERE `shopid` =:shopid LIMIT {$limit} OFFSET {$offset}", ['shopid' => Auth::getShop()->shopid]);
        $data = $customers->where('shopid', Auth::getShop()->shopid);

        $actives = 'customers';
        $link = 'customersdebts';
        $hiddenSearch  = '';
        $crumbs  = array();

        $this->view('customers/debts', [
            'rows' => $data,
            'rowsdebt' => $debtdats,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function alldebts($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = array();
        $custdebts = new Customerdebt();
        $customers = new Customer();

        $data = $custdebts->where('custid', $id, $limit, $offset, "DESC");
        $datacust = $customers->where('custid', $id)[0];



        $actives = 'customers';
        $link = 'customersdebts';
        $hiddenSearch  = '';
        $crumbs  = array();

        $this->view('customers/alldebts', [
            'rows' => $data,
            'row' => $datacust,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function paydebt($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = array();
        $customers = new Customer();
        $custpay = new Custpaydebt();

        $data = $customers->where_query('SELECT * FROM `customers` WHERE `custid` =:custid AND `shopid` =:shopid', [
            'custid' => $_GET['custid'],
            'shopid' => Auth::getShop()->shopid,
        ])[0];

        $datapay = $custpay->where_query('SELECT * FROM `custpaydebts` WHERE `shopid` =:shopid AND `custid` =:custid', [
            'custid' => $_GET['custid'],
            'shopid' => Auth::getShop()->shopid,
        ]);

        if (count($_POST) > 0) {
            $_POST['userid'] = Auth::getUsername();
            $_POST['shopid'] = Auth::getShop()->shopid;
            $_POST['custid'] = $_GET['custid'];
            $custpay->insert($_POST);

            $_SESSION['messsage'] = "Payment Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("customers/paydebt/$id?invoice=" . $_GET['invoice'] . "&custid=" . $_GET['custid']);
        }

        $actives = 'customers';
        $link = 'customersdebts';
        $hiddenSearch  = '';
        $crumbs  = array();

        $this->view('customers/paydebt', [
            'row' => $data,
            'rows' => $datapay,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }
}
