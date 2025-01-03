<?php

/**
 * Users controller
 */
class Users extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data = array();

        $users = new User();

        if (count($_POST) > 0) {
            if (isset($_POST['del'])) {
                $users->delete($_POST['del'], 'username');

                $_SESSION['messsage'] = "User Deleted Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }
            return $this->redirect('users');
        }

        $data = $users->where('shopid', Auth::getShop()->shopid);

        $actives = 'users';
        $link = 'userslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('user/index', [
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

        $data = array();

        $users = new User();

        if (count($_POST) > 0) {
            if ($users->validate($_POST)) {
                $users->insert($_POST);

                $_SESSION['messsage'] = "User Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect('users');
            }
        }

        $actives = 'users';
        $link = 'userslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('user/add', [
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

        $users = new User();

        if (count($_POST) > 0) {
            $users->update($id, $_POST, 'username');

            $_SESSION['messsage'] = "User Updated Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect('users');
        }

        $data = $users->where('username', $id)[0];

        $actives = 'users';
        $link = 'userslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('user/edit', [
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }
}
