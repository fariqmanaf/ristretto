<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'controllers/main.php';

router::url('', 'get', 'AuthController::index');
router::url('login', 'get', 'AuthController::login');
router::url('login', 'post', 'AuthController::sessionLogin');
router::url('register', 'get', 'AuthController::register');
Router::url('register', 'post', 'AuthController::newRegister');