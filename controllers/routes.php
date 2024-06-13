<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'controllers/main.php';

router::url('', 'get', 'AuthController::index');

router::url('login', 'get', 'AuthController::login');
router::url('login', 'post', 'AuthController::sessionLogin');
router::url('register', 'get', 'AuthController::register');
Router::url('register', 'post', 'AuthController::newRegister');
Router::url('logout', 'get', 'AuthController::logout');

Router::url('dashboard', 'get', 'KaryawanController::index');
Router::url('dashboard', 'post', 'KaryawanController::storeTransaction');
Router::url('productFind', 'post', 'KaryawanController::productFind');
Router::url('antrian', 'get', 'KaryawanController::antrian');
Router::url('antrian', 'post', 'KaryawanController::acceptingTransaction');
Router::url('produk', 'get', 'KaryawanController::aturProduk');
Router::url('produk/tambah', 'get', 'KaryawanController::tambahProduk');
Router::url('produk/tambah', 'post', 'KaryawanController::storeProduk');
Router::url('produk/edit', 'get', 'KaryawanController::editProduk');
Router::url('produk/edit', 'post', 'KaryawanController::updateProduk');

Router::url('laporan', 'get', 'OwnerController::index');

Router::url('rating', 'get', 'CustomerController::index');
Router::url('review', 'get', 'CustomerController::review');
Router::url('review', 'post', 'CustomerController::storeReview');