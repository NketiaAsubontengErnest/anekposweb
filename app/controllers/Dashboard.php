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

        $data = array();
        $arr = [];


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
