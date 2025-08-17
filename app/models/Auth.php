<?php

/**
 * Authentication class
 */
class Auth
{
    public static function authenticate($row)
    {
        $_SESSION['ANEKPOSUSER'] = $row;
    }

    public static function logout()
    {
        if (isset($_SESSION['ANEKPOSUSER'])) {
            if (isset($_SESSION['seasondata'])) {
                unset($_SESSION['seasondata']);
            }
            unset($_SESSION['ANEKPOSUSER']);
            session_unset();
            session_destroy();
        }
    }

    public static function logged_in()
    {
        if (isset($_SESSION['ANEKPOSUSER'])) {
            return true;
        }
        return false;
    }
    public static function user()
    {
        if (isset($_SESSION['ANEKPOSUSER'])) {
            return $_SESSION['ANEKPOSUSER']->firstname;
        }
        return false;
    }

    public static function get_image()
    {
        if (isset($_SESSION['ANEKPOSUSER'])) {
            return $_SESSION['ANEKPOSUSER']->imagelink;
        }
        return false;
    }

    public static function comparepass()
    {
        //$user = password_hash($_SESSION['ANEKPOSUSER']->username, PASSWORD_DEFAULT);
        if (password_verify($_SESSION['ANEKPOSUSER']->username, $_SESSION['ANEKPOSUSER']->password)) {
            return true;
        }
        return false;
    }

    public static function __callStatic($method, $params)
    {
        $prop = strtolower(str_replace("get", "", $method));
        if (isset($_SESSION['ANEKPOSUSER']->$prop)) {
            return $_SESSION['ANEKPOSUSER']->$prop;
        }
        return "Unknown";
    }

    public static function access($rank = 'Sales')
    {
        if (!isset($_SESSION['ANEKPOSUSER'])) {
            return false;
        }
        $logged_in_rank = $_SESSION['ANEKPOSUSER']->rank; //the rank for current user
        $RANK['developer']      = ['developer', 'Super Admin', 'Admin', 'Sales'];
        $RANK['Super Admin']    = ['Super Admin', 'Admin', 'Sales'];
        $RANK['Admin']          = ['Admin', 'Sales'];
        $RANK['Sales']          = ['Sales'];

        if (!isset($RANK[$logged_in_rank])) {
            return false;
        }

        if (in_array($rank, $RANK[$logged_in_rank])) {
            return true;
        }
        return false;
    }
}
