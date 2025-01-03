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

        if (count($_POST) > 0) {
            show($_POST);
            die;
        }
        $prods = new Product();

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
