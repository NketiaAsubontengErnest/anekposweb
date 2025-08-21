<?php

/**
 * home controller
 */
class Home extends Controller
{
    function index()
    {
        $shops = new Shop();

        if (count($_POST) > 0) {
            $message = new Message();
            if ($message->validate($_POST)) {
                $_POST['name'] = htmlspecialchars($_POST['name']);
                $_POST['email'] = htmlspecialchars($_POST['email']);
                $_POST['subject'] = htmlspecialchars($_POST['subject']);
                $_POST['message'] = htmlspecialchars($_POST['message']);

                $_POST['name'] = trim($_POST['name']);
                $_POST['email'] = trim($_POST['email']);
                $_POST['subject'] = trim($_POST['subject']);
                $_POST['message'] = trim($_POST['message']);
                $_POST['sentdatetime'] = date('Y-m-d H:i:s');

                $message->insert($_POST);

                $_SESSION['messsage'] = "Message Sent Successfully. We will get back to you soon.";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";


                return $this->redirect('index');
            }
        }

        $shops->query("UPDATE `shops` SET `status`= 1 WHERE `enddate` <= CURRENT_DATE");

        $actives = 'home';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('index', [
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives
        ]);
    }
}
