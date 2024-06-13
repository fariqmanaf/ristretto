<?php

include_once 'app/config/static.php';
include_once 'function/main.php';
include_once 'models/user.php';
include_once 'models/product.php';
include_once 'models/transaction.php';

class KaryawanController
{
    static function index()
    {
      if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
        header( 'Location: ' . BASEURL . 'login' );
        exit;
      }
      $token = $_COOKIE[ 'token' ];
      $user = Users::getUserByToken( $token );
      if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
          unset( $_SESSION[ 'user' ] );
          setcookie( 'token', '', time() - 3600, '/' );
          header( 'Location: ' . BASEURL . 'login' );
          exit;
      } else {
        if( $user[ 'role_id' ] == '2' ) {
          $categories = Product::getCategories();
          $products = Product::getAllProduct();
          return view('karyawan/index', [
            'url' => 'dashboard',
            'categories' => $categories,
            'products' => $products
          ]);
        } else {
            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            }
            session_destroy();
            header('Location: home');
            exit();
        }
      }
    }

    static function storeTransaction(){
      if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
        header( 'Location: ' . BASEURL . 'login' );
        exit;
      }
      $token = $_COOKIE[ 'token' ];
      $user = Users::getUserByToken( $token );
      if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
          unset( $_SESSION[ 'user' ] );
          setcookie( 'token', '', time() - 3600, '/' );
          header( 'Location: ' . BASEURL . 'login' );
          exit;
      } else {
        if( $user[ 'role_id' ] == '2' ) {
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try{
              $paymentTypeId = $_POST['payment'];
              $productIds = array_filter($_POST, function ($key) {
                  return strpos($key, 'product_id_') === 0;
              }, ARRAY_FILTER_USE_KEY);
              $productIds = array_map(function ($key) {
                  return substr($key, strlen('product_id_'));
              }, array_keys($productIds));
              $quantities = array_filter($_POST, function ($key) {
                  return $key === 'quantity' || strpos($key, 'quantity_') === 0;
              }, ARRAY_FILTER_USE_KEY);
              $quantities = array_values($quantities);
          
              $totalAmount = array_sum(array_map(function ($productId, $quantity) {
                  $product = Product::getProductById($productId);
                  return $product['price'] * $quantity;
              }, $productIds, $quantities));
          
              $success = Product::storeTransaction($paymentTypeId, $totalAmount, $productIds, $quantities);
              if (!$success) {
                  throw new Exception ('Gagal menyimpan transaksi.');
              }
              setFlashMessage('success', 'Transaksi berhasil disimpan.');
              header('Location: dashboard');

            } catch (Exception $e) {
              setFlashMessage('danger', $e->getMessage());
              error_log($e->getMessage());
              header('Location: dashboard');
            }
          }
        } else {
            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            }
            session_destroy();
            header('Location: home');
            exit();
        }
      }
    }

    static function antrian(){
      if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
        header( 'Location: ' . BASEURL . 'login' );
        exit;
      }
      $token = $_COOKIE[ 'token' ];
      $user = Users::getUserByToken( $token );
      if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
          unset( $_SESSION[ 'user' ] );
          setcookie( 'token', '', time() - 3600, '/' );
          header( 'Location: ' . BASEURL . 'login' );
          exit;
      } else {
        if( $user[ 'role_id' ] == '2' ) {
          $transactions = Transaction::getPendingTransaction();
          return view('karyawan/index', [
            'url' => 'antrian',
            'transaksi' => $transactions
          ]);
        } else {
            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            }
            session_destroy();
            header('Location: home');
            exit();
        }
      }
    }

    static function acceptingTransaction(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try{
          $transactionId = $_POST['transaction_id'];
          Transaction::finishTransaction($transactionId);
            setFlashMessage('success', 'Transaksi berhasil diterima.');
            header('Location: antrian');
        } catch (Exception $e) {
          setFlashMessage('danger', $e->getMessage());
          error_log($e->getMessage());
          header('Location: antrian');
        }
    }
  }

  static function aturProduk(){
    if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
      header( 'Location: ' . BASEURL . 'login' );
      exit;
    }
    $token = $_COOKIE[ 'token' ];
    $user = Users::getUserByToken( $token );
    if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
        unset( $_SESSION[ 'user' ] );
        setcookie( 'token', '', time() - 3600, '/' );
        header( 'Location: ' . BASEURL . 'login' );
        exit;
    } else {
      if( $user[ 'role_id' ] == '2' ) {
        $categories = Product::getCategories();
        $products = Product::getAllProduct();
        return view('karyawan/index', [
          'url' => 'produk',
          'categories' => $categories,
          'products' => $products
        ]);
      } else {
          if (ini_get('session.use_cookies')) {
              $params = session_get_cookie_params();
              setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
          }
          session_destroy();
          header('Location: home');
          exit();
      }
    }
  }

  static function tambahProduk(){
    if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
      header( 'Location: ' . BASEURL . 'login' );
      exit;
    }
    $token = $_COOKIE[ 'token' ];
    $user = Users::getUserByToken( $token );
    if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
        unset( $_SESSION[ 'user' ] );
        setcookie( 'token', '', time() - 3600, '/' );
        header( 'Location: ' . BASEURL . 'login' );
        exit;
    } else {
      if( $user[ 'role_id' ] == '2' ) {
        $categories = Product::getCategories();
        return view('karyawan/index', [
          'url' => 'tambah',
          'categories' => $categories
        ]);
      } else {
          if (ini_get('session.use_cookies')) {
              $params = session_get_cookie_params();
              setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
          }
          session_destroy();
          header('Location: home');
          exit();
      }
    }
  }

  static function storeProduk() {
      if (!isset($_COOKIE['token']) || !isset($_SESSION['user'])) {
          header('Location: ' . BASEURL . 'login');
          exit;
      }
      $token = $_COOKIE['token'];
      $user = Users::getUserByToken($token);
      if (!$user || $user['username'] !== $_SESSION['user']['username']) {
          unset($_SESSION['user']);
          setcookie('token', '', time() - 3600, '/');
          header('Location: ' . BASEURL . 'login');
          exit;
      } else {
          if ($user['role_id'] == '2') {
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  try {
                      $name = $_POST['name'];
                      $price = $_POST['price'];
                      $categoryId = $_POST['category_id'];
                      $photo = $_FILES['photo'];
                      
                      $categoryName = Product::getCategoryNameById($categoryId);
                      $photoName = Product::uploadPhoto($photo, $categoryName);

                      $success = Product::storeProduct($name, $price, $categoryId, $photoName);
                      if (!$success) {
                          throw new Exception('Gagal menyimpan produk.');
                      }
                      setFlashMessage('success', 'Produk berhasil disimpan.');
                      header( 'Location: ' . BASEURL . 'produk' );
                  } catch (Exception $e) {
                      setFlashMessage('danger', $e->getMessage());
                      error_log($e->getMessage());
                      header( 'Location: ' . BASEURL . 'produk' );
                  }
              }
          } else {
              if (ini_get('session.use_cookies')) {
                  $params = session_get_cookie_params();
                  setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
              }
              session_destroy();
              header('Location: home');
              exit();
          }
      }
  }

  static function editProduk(){
    if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
      header( 'Location: ' . BASEURL . 'login' );
      exit;
    }
    $token = $_COOKIE[ 'token' ];
    $id = $_GET['id'];
    $user = Users::getUserByToken( $token );
    if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
        unset( $_SESSION[ 'user' ] );
        setcookie( 'token', '', time() - 3600, '/' );
        header( 'Location: ' . BASEURL . 'login' );
        exit;
    } else {
      if( $user[ 'role_id' ] == '2' ) {
        $categories = Product::getCategories();
        $products = Product::findProduct($id);
        return view('karyawan/index', [
          'url' => 'editProduk',
          'categories' => $categories,
          'products' => $products
        ]);
      } else {
          if (ini_get('session.use_cookies')) {
              $params = session_get_cookie_params();
              setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
          }
          session_destroy();
          header('Location: home');
          exit();
      }
    }
  }

  static function updateProduk(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      try {
          $id = $_POST['id'];
          $name = $_POST['name'];
          $price = $_POST['price'];
          $categoryId = $_POST['category_id'];
          $photo = $_FILES['photo'];
          $best = isset($_POST['best-seller']) ? 1 : 0;

          $categoryName = Product::getCategoryNameById($categoryId);
          $photoName = Product::uploadPhoto($photo, $categoryName);
          $success = Product::updateProduct($id, $name, $price, $categoryId, $photoName, $best);
          if (!$success) {
              throw new Exception('Gagal mengedit produk.');
          }
          setFlashMessage('success', 'Produk berhasil diedit.');
          header('Location: ' . BASEURL . 'produk');
          exit;
      } catch (Exception $e) {
          setFlashMessage('danger', $e->getMessage());
          error_log($e->getMessage());
          header('Location: ' . BASEURL . 'produk');
          exit;
      }
    }
  }

  static function deleteProduct(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      try {
          $id = $_POST['id'];
          $success = Product::deleteProducts($id);
          if (!$success) {
              throw new Exception('Gagal menghapus produk.');
          }
          setFlashMessage('success', 'Produk berhasil dihapus.');
          header('Location: ' . BASEURL . 'produk');
          exit;
      } catch (Exception $e) {
          setFlashMessage('danger', $e->getMessage());
          error_log($e->getMessage());
          header('Location: ' . BASEURL . 'produk');
          exit;
      }
    }
  }
}