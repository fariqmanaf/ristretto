<?php

include_once 'app/config/static.php';
include_once 'function/main.php';
include_once 'models/user.php';

class AuthController{
  static function index(){
    view('auth/index', [ 'url' => 'landing']);
  }

  static function login(){
    view('auth/index', [ 'url' => 'login']);
  }

  static function register(){
    view('auth/index', [ 'url' => 'register']);
  }

  static function newRegister(){

    $post = array_map( 'htmlspecialchars', $_POST );
    $requiredFields = ['username', 'password', 'email', 'role_id'];
    foreach ($requiredFields as $field) {
        if (empty(trim($post[$field]))) {
            http_response_code(400);
            echo json_encode(['message' => 'Harap isi semua kolom yang diperlukan!']);
            exit();
        }
    }

    if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['message' => 'Email tidak valid!']);
        exit();
    }

    try {
        $existingUser = Users::findUserByUsernameOrEmail( $post[ 'username' ], $post[ 'email' ] );

        if ( $existingUser ) {
            if ( $existingUser[ 'username' ] === $post[ 'username' ] ) {
                throw new Exception( 'Username already taken' );
            }

            if ( $existingUser[ 'email' ] === $post[ 'email' ] ) {
                throw new Exception( 'Email already in use' );
            }
        }

        Users::register( [
            'username' => $post[ 'username' ],
            'password' => $post[ 'password' ],
            'email' => $post[ 'email' ],
            'role_id' => $post[ 'role_id' ]
        ] );

        exit();
    } catch ( Exception $e ) {
        http_response_code( 400 );

        if ( $e->getMessage() === 'Username already taken' ) {
            echo json_encode( [ 'message' => 'Username sudah digunakan. Silahkan gunakan username lainnya!' ] );
        } elseif ( $e->getMessage() === 'Email already in use' ) {
            echo json_encode( [ 'message' => 'Email sudah digunakan. Silahkan gunakan Email lainnya!' ] );
        } else {
            echo json_encode( [ 'message' => 'Terjadi kesalahan, mohon coba lagi.' ] );
        }
        exit();
    }
  }

  static function sessionLogin(){
    $post = array_map( 'htmlspecialchars', $_POST );
    if (empty(trim($post['email'])) || empty(trim($post['password']))) {
        setFlashMessage('danger', 'Harap isi email dan password!');
        header('Location: login?failed=true');
        exit();
    } else {
        $user = Users::login( [
            'email' => $post[ 'email' ],
            'password' => $post[ 'password' ]
        ] );

        if ( $user ) {
          if ( $user[ 'role_id' ] == '1' ) {
              $_SESSION[ 'user' ] = $user;
              setcookie( 'token', $user[ 'token' ], strtotime( $user[ 'token_expires_at' ] ), '/', '', false, true );
              setFlashMessage( 'success', 'Login Berhasil, Selamat Datang!' );
              header( 'Location: register' );
              exit();
          } elseif ( $user[ 'role_id' ] == '2' ) {
              $_SESSION[ 'user' ] = $user;
              setcookie( 'token', $user[ 'token' ], strtotime( $user[ 'token_expires_at' ] ), '/', '', false, true );
              setFlashMessage( 'success', 'Login Berhasil, Selamat Datang!' );
              header( 'Location: dashboard' );
              exit();
          } elseif ( $user[ 'role_id' ] == '3' ) {
              $_SESSION[ 'user' ] = $user;
              setcookie( 'token', $user[ 'token' ], strtotime( $user[ 'token_expires_at' ] ), '/', '', false, true );
              setFlashMessage( 'success', 'Login Berhasil, Selamat Datang!' );
              header( 'Location: dashboard' );
              exit();
          }
        } else {
            setFlashMessage( 'error', 'Username atau Password salah, silahkan coba lagi!' );
            header( 'Location: login?failed=true' );
        }
    }
  }
}