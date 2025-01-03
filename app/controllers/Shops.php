<?php

/**
 * Shops controller
 */
class Shops extends Controller
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

        $shops = new Shop();

        if(count($_POST) > 0){
            if(isset($_POST['del'])){
                $shops->delete($_POST['del'], 'shopid');

                $_SESSION['messsage'] = "Shop Deleted Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }
        }

        if (isset($_GET['search_box'])) {
            $arr['searchuse'] = '%' . $_GET['search_box'] . '%';
            $query = "SELECT * FROM `shops` WHERE `shopname` LIKE :searchuse OR `location` LIKE :searchuse LIMIT $limit OFFSET $offset";

            $data = $shops->findSearch($query, $arr);
        } else {
            $data = $shops->findAll($limit, $offset, 'DESC');
        }

        $actives = 'shops';
        $link = 'shoplist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('shop/index', [
            'rows1' => $data1,
            'rows' => $data,
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

        $shops = new Shop();

        if (count($_POST) > 0) {
            if ($shops->validate($_POST)) {
                $years = $_POST['years'];
                $date = date_create($_POST['startdate']);
                date_add($date, date_interval_create_from_date_string("$years years"));
                $_POST['enddate'] = date_format($date, "Y-m-d");
                $_POST['shopid'] = generateRandomCode(55);

                $shops->insert($_POST);

                $_SESSION['messsage'] = "Shop Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect('shops');
            } else {
                $_SESSION['messsage'] = "Shop Not Added!";
                $_SESSION['status_code'] = "warning";
                $_SESSION['status_headen'] = "Check Well!";
            }
        }

        $actives = 'shops';
        $link = 'shoplist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('shop/add', [
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

        $shops = new Shop();

        if (count($_POST) > 0) {
            $shops->update($id, $_POST, 'shopid');

            $_SESSION['messsage'] = "Shop Update Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect('shops');
        }

        $data = $shops->where('shopid', $id)[0];

        $actives = 'shops';
        $link = 'shoplist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('shop/edit', [
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }
}
