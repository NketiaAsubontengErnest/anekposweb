<?php

/**
 * home controller
 */
class Home extends Controller
{
    function index()
    {
        $data1 = array();
        $data = array();
        $arr = array();

        $shops = new Shop();
        $prods = new Product();

        if (count($_POST) > 0) {
            show($_POST);
            die;
        }

        $shops->query("UPDATE `shops` SET `status`= 1 WHERE `enddate` <= CURRENT_DATE");

        $data = $prods->findAll();

        $actives = 'home';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('index', [
            'rows1' => $data1,
            'productdata' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives
        ]);
    }
}
