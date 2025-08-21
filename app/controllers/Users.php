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

        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = array();

        $users = new User();

        if (count($_POST) > 0) {
            if (isset($_POST['del'])) {
                $query = "UPDATE `users` SET `status`= :status WHERE `username` = :username";
                $users->query($query, [
                    'status' => $_POST['status'],
                    'username' => $_POST['del']
                ]);

                $_SESSION['messsage'] = "User Blocked Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }
            return $this->redirect('users');
        }

        if (isset($_GET['searchuser'])) {
            $search = '%' . $_GET['searchuser'] . '%';
            $query = "SELECT * FROM `users` WHERE (`firstname` LIKE :search OR `lastname` LIKE :search OR `username` LIKE :search) AND shopid =:shopid ORDER BY `id` DESC LIMIT $limit OFFSET $offset";
            $data = $users->query($query, [
                'search' => $search,
                'shopid' => Auth::getShop()->shopid
            ]);
        } else {
            $data = $users->where('shopid', Auth::getShop()->shopid, $limit, $offset, 'DESC');
        }

        $actives = 'users';
        $link = 'userslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('user/index', [
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'pager' => $pager,
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
            if (isset($_POST['resetpass'])) {

                $newPass = $users->resetPassword($_POST['resetpass']);
                if ($newPass) {
                    $_SESSION['messsage'] = "Password Reset Successfully";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['status_headen'] = "Good job!";
                } else {
                    $_SESSION['messsage'] = "Failed to Reset Password";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_headen'] = "Oops!";
                }
            } else {
                $users->update($id, $_POST, 'username');

                $_SESSION['messsage'] = "User Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }

            return $this->redirect('users/edit/' . $id);
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

    function profile()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }
        //this are for breadcrumb
        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Profile', ''];
        $user = new User();
        $errors = array();

        if (count($_FILES) > 0) {
            unset($_POST['img']);
            $allowed[] = "image/jpeg";
            $allowed[] = "image/jpg";
            $allowed[] = "image/png";
            //Uploading certificate
            if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {
                $certificateFolder = "public/profilePics/";
                if (!file_exists($certificateFolder)) mkdir($certificateFolder, 0777, true);

                $certificateFolder = "profilePics/";
                $newFileName = Auth::getUsername() . "_pic.jpg"; // always JPG
                $destination = "public/" . $certificateFolder . $newFileName;

                $processedImage = cropAndResizeToJPG($_FILES['image']['tmp_name'], $destination, 400, 80);

                if ($processedImage) {
                    $_POST['image'] = $certificateFolder . $newFileName;
                    $user->update(Auth::getId(), $_POST);
                }
            }

            $row = $user->where('username', Auth::getUsername())[0];
            Auth::authenticate($row);

            return $this->redirect('users/profile');
            $_SESSION['messsage'] = "Profile Picture Successfully Set";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
        } elseif (count($_POST) > 0) {
            $_POST['password'] = $_POST['newpassword'];
            $_POST['retyppassword'] = $_POST['reppassword'];

            unset($_POST['newpassword']);
            unset($_POST['reppassword']);
            unset($_POST['pass']);

            $newData = $user->checkretypepass($_POST);
            if ($newData != false) {
                $user->update(Auth::getId(), $newData);
                Auth::logout();
                $_SESSION['messsage'] = "Password Successfully Changed";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect('login');
            } else {
                $errors = $user->errors;
            }
        }

        $actives = 'profile';
        $link = 'userslist';
        $hiddenSearch  = '';
        $hiddenSearch = "yep";
        return $this->view('user/profile', [
            'crumbs' => $crumbs,
            'errors' => $errors,
            'link' => $link,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives
        ]);
    }
}
