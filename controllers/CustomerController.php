<?php

include_once 'app/config/static.php';
include_once 'function/main.php';
include_once 'models/user.php';
include_once 'models/product.php';
include_once 'models/rating.php';

class CustomerController
{
    static function index()
    {
      if (empty($_COOKIE['token']) || empty($_SESSION['user'])) {
        header('Location: ' . BASEURL . 'login');
        exit;
    }
    $user = Users::getUserByToken($_COOKIE['token']);
    if (!$user || $user['username'] !== $_SESSION['user']['username']) {
        session_unset();
        setcookie('token', '', time() - 3600, '/');
        header('Location: ' . BASEURL . 'login');
        exit;
    }
    if ($user['role_id'] == '3') {
      $categories = Product::getCategories();
      $products = Product::getAllProduct();
      return view('customer/index', [
        'url' => 'rating',
        'categories' => $categories,
        'products' => $products]);
    }
    session_unset();
    header('Location: home');
    exit;
    }

    static function review()
    {
      if (empty($_COOKIE['token']) || empty($_SESSION['user'])) {
        header('Location: ' . BASEURL . 'login');
        exit;
      }
      $user = Users::getUserByToken($_COOKIE['token']);
      if (!$user || $user['username'] !== $_SESSION['user']['username']) {
          session_unset();
          setcookie('token', '', time() - 3600, '/');
          header('Location: ' . BASEURL . 'login');
          exit;
      }
      if ($user['role_id'] == '3') {
          $productId = $_GET['product'];
          $ratings = Rating::getRating($productId);
          return view('customer/index', [
              'url' => 'review',
              'ratings' => $ratings,
          ]);
      }
      session_unset();
      header('Location: home');
      exit;
    }

    static function storeReview()
    {
      if (empty($_COOKIE['token']) || empty($_SESSION['user'])) {
        header('Location: ' . BASEURL . 'login');
        exit;
      }
      $user = Users::getUserByToken($_COOKIE['token']);
      if (!$user || $user['username'] !== $_SESSION['user']['username']) {
          session_unset();
          setcookie('token', '', time() - 3600, '/');
          header('Location: ' . BASEURL . 'login');
          exit;
      }
      if ($user['role_id'] == '3') {
          $comment = $_POST['comment'];
          $star = $_POST['star'];
          $productId = $_POST['product_id'];
          $userId = $_POST['user_id'];
          $affected = Rating::storeRating($comment, $star, $productId, $userId);
          if ($affected > 0) {
              setFlashMessage('success', 'Review berhasil ditambahkan');
          } else {
              setFlashMessage('danger', 'Review gagal ditambahkan');
          }
          header('Location: ' . BASEURL . 'review?product=' . $productId);
          exit;
      }
      session_unset();
      header('Location: home');
      exit;
    }

    static function sales()
    {
      if (empty($_COOKIE['token']) || empty($_SESSION['user'])) {
        header('Location: ' . BASEURL . 'login');
        exit;
      }
      $user = Users::getUserByToken($_COOKIE['token']);
      if (!$user || $user['username'] !== $_SESSION['user']['username']) {
          session_unset();
          setcookie('token', '', time() - 3600, '/');
          header('Location: ' . BASEURL . 'login');
          exit;
      }
      if ($user['role_id'] == '1') {
          
          return view('owner/index', [
              'url' => 'sales',
              'products' => Product::getAllProductNames(),
              'details' => Transaction::getAlldetail()
          ]);
      }
      session_unset();
      header('Location: home');
      exit;
    }
}