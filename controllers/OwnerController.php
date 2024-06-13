<?php

include_once 'app/config/static.php';
include_once 'function/main.php';
include_once 'models/user.php';
include_once 'models/transaction.php';

class OwnerController
{
    static function index()
    {
        if (empty($_COOKIE['token']) || empty($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'login');
            exit();
        }
        $user = Users::getUserByToken($_COOKIE['token']);
        if (!$user || $user['username'] !== $_SESSION['user']['username']) {
            session_unset();
            setcookie('token', '', time() - 3600, '/');
            header('Location: ' . BASEURL . 'login');
            exit();
        }
        if ($user['role_id'] == '1') {
            $day = date('Y-m-d');
            $month = date('n');
            $year = date('Y');
            $chartData = Transaction::getProfitChart($month, $year);
            var_dump($chartData);
            return view('owner/index', ['url' => 'dashboard']);
        }
        session_unset();
        header('Location: home');
        exit();
    }
}
