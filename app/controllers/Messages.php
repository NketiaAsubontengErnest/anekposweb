<?php

/**
 * Messages controller
 */
class Messages extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data = array();
        $arr = array();

        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $messages = new Message();

        if (count($_POST) > 0) {
            if (isset($_POST['del'])) {
                $messages->delete($_POST['del'], 'id');

                $_SESSION['messsage'] = "Message Deleted Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }
        }

        if (isset($_GET['searchmessage'])) {
            $arr['searchuse'] = '%' . $_GET['searchmessage'] . '%';
            $query = "SELECT * FROM `messages` WHERE (`name` LIKE :searchuse OR `email` LIKE :searchuse OR `phone` LIKE :searchuse) AND read_is = 0 LIMIT $limit OFFSET $offset";

            $data = $messages->findSearch($query, $arr);
        } else {
            $data = $messages->findSearch("SELECT * FROM `messages` WHERE read_is = 0 LIMIT $limit OFFSET $offset");
        }

        $actives = 'messages';
        $link = 'messageslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('messages/index', [
            'rows' => $data,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function single($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $message = new Message();
        $data = $message->where('id', $id);

        if (!$data) {
            $_SESSION['messsage'] = "Message Not Found";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_headen'] = "Error!";
            return $this->redirect('messages');
        }

        if (count($_POST) > 0) {
            if (isset($_POST['del'])) {
                $message->delete($_POST['del'], 'id');

                $_SESSION['messsage'] = "Message Deleted Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect('messages');
            }
        }

        $message->update($id, [
            'read_is' => 1,
            'read_datetime' => date('Y-m-d H:i:s')
        ]);

        $actives = 'messages';
        $crumbs  = array();
        $this->view('messages/single', [
            'row' => $data[0],
            'crumbs' => $crumbs,
            'hiddenSearch' => '',
            'link' => 'messageslist',
            'actives' => $actives
        ]);
    }

    function read()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data = array();
        $arr = array();

        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $messages = new Message();

        if (count($_POST) > 0) {
            if (isset($_POST['del'])) {
                $messages->delete($_POST['del'], 'id');

                $_SESSION['messsage'] = "Message Deleted Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect('messages/read');
            }
        }

        if (isset($_GET['searchmessage'])) {
            $arr['searchuse'] = '%' . $_GET['searchmessage'] . '%';
            $query = "SELECT * FROM `messages` WHERE (`name` LIKE :searchuse OR `email` LIKE :searchuse OR `phone` LIKE :searchuse) AND read_is = 1 LIMIT $limit OFFSET $offset";

            $data = $messages->findSearch($query, $arr);
        } else {
            $data = $messages->findSearch("SELECT * FROM `messages` WHERE read_is = 1 LIMIT $limit OFFSET $offset");
        }

        $actives = 'messages';
        $link = 'readmessageslist';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('messages/read', [
            'rows' => $data,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }
}
