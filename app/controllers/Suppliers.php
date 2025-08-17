<?php

/**
 * suppliers controller
 */
class suppliers extends Controller
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

        $suppliers = new Supplier();

        if (isset($_GET['searchsupplyer'])) {
            $arr['searchuse'] = '%' . $_GET['searchsupplyer'] . '%';
            $query = "SELECT * FROM `suppliers` WHERE `suplname` LIKE :searchuse OR `suplphone` LIKE :searchuse LIMIT $limit OFFSET $offset";

            $data = $suppliers->findSearch($query, $arr);
        } else {
            $data = $suppliers->findAll($limit, $offset, 'DESC');
        }

        $actives = 'suppliers';
        $link = 'supplierslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('suppliers/index', [
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

        $suppliers = new Supplier();

        if (count($_POST) > 0) {
            if ($suppliers->validate($_POST)) {
                $_POST['shopid'] = Auth::getShop()->shopid;
                $_POST['suplid'] = generateRandomCode(55);

                $suppliers->insert($_POST);

                $_SESSION['messsage'] = "Supplyer Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect('suppliers');
            } else {
                $_SESSION['messsage'] = "Shop Not Added!";
                $_SESSION['status_code'] = "warning";
                $_SESSION['status_headen'] = "Check Well!";
            }
        }

        $actives = 'suppliers';
        $link = 'suppliersadd';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('suppliers/add', [
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
        $suppliers = new Supplier();

        if (count($_POST) > 0) {
            $suppliers->update($id, $_POST, 'suplid');

            $_SESSION['messsage'] = "Supplyer Update Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect('suppliers');
        }

        $data = $suppliers->where('suplid', $id)[0];

        $actives = 'suppliers';
        $link = 'supplierslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('suppliers/edit', [
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
        $supldebts = new Supplierdebt();
        $suppliers = new Supplier();

        if (count($_POST) > 0) {
            $_POST['userid'] = Auth::getUsername();
            $_POST['shopid'] = Auth::getShop()->shopid;
            $supldebts->insert($_POST);

            $_SESSION['messsage'] = "Debt Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect('suppliers/debts');
        }

        $data = $suppliers->where('shopid', Auth::getShop()->shopid);

        $debtdats = $supldebts->where_query("SELECT DISTINCT suplid, SUM(amount) AS amount FROM `supplierdebts` WHERE `shopid` =:shopid LIMIT {$limit} OFFSET {$offset}", ['shopid' => Auth::getShop()->shopid]);

        // show($debtdats);
        // die;

        $actives = 'suppliers';
        $link = 'suppliersdebts';
        $hiddenSearch  = '';
        $crumbs  = array();

        $this->view('suppliers/debts', [
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
        $custdebts = new Supplierdebt();
        $suppliers = new Supplier();

        $data = $custdebts->where('suplid', $id, $limit, $offset, "DESC");
        $datacust = $suppliers->where('suplid', $id)[0];

        $actives = 'suppliers';
        $link = 'suppliersdebts';
        $hiddenSearch  = '';
        $crumbs  = array();

        $this->view('suppliers/alldebts', [
            'rows' => $data,
            'row' => $datacust,
            'crumbs' => $crumbs,
            'pager' => $pager,
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

        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = array();
        $suppliers = new Supplier();
        $suplypay = new Suplypaydebt();

        $data = $suppliers->where_query('SELECT * FROM `suppliers` WHERE `suplid` =:suplid AND `shopid` =:shopid', [
            'suplid' => $_GET['suplid'],
            'shopid' => Auth::getShop()->shopid,
        ])[0];

        $datapay = $suplypay->where_query("SELECT * FROM `suplypaydebts` WHERE `suplid` =:suplid AND `suplid` =:suplid ORDER BY date DESC LIMIT $limit OFFSET $offset", [
            'suplid' => $_GET['suplid'],
            'shopid' => Auth::getShop()->shopid,
        ]);

        if (count($_POST) > 0) {
            $_POST['userid'] = Auth::getUsername();
            $_POST['shopid'] = Auth::getShop()->shopid;
            $_POST['suplid'] = $_GET['suplid'];

            $suplypay->insert($_POST);

            $_SESSION['messsage'] = "Payment Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("suppliers/paydebt/$id?invoice=" . $_GET['invoice'] . "&suplid=" . $_GET['suplid']);
        }

        $actives = 'suppliers';
        $link = 'suppliersdebts';
        $hiddenSearch  = '';
        $crumbs  = array();

        $this->view('suppliers/paydebt', [
            'row' => $data,
            'rows' => $datapay,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }
}
