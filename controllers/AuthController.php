<?php

include_once 'app/config/static.php';
include_once 'function/main.php';
include_once 'models/user.php';

class AuthController
{
    static function index()
    {
        $role_id = isset($_SESSION['user']) ? $_SESSION['user']['role_id'] : 0;
        view('auth/index', ['url' => 'landing', 'role_id' => $role_id]);
    }

    static function login()
    {
        if(isset($_SESSION['user'])) {
            header('Location: home');
            exit();
        }
        view('auth/index', ['url' => 'login']);
    }

    static function register()
    {
        view('auth/index', ['url' => 'register']);
    }

    static function newRegister()
    {
        $post = array_map('htmlspecialchars', $_POST);
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
            $existingUser = Users::findUserByUsernameOrEmail($post['username'], $post['email']);

            if ($existingUser) {
                if ($existingUser['username'] === $post['username']) {
                    throw new Exception('Username already taken');
                }

                if ($existingUser['email'] === $post['email']) {
                    throw new Exception('Email already in use');
                }
            }

            Users::register([
                'username' => $post['username'],
                'password' => $post['password'],
                'email' => $post['email'],
                'role_id' => $post['role_id'],
            ]);

            exit();
        } catch (Exception $e) {
            http_response_code(400);

            if ($e->getMessage() === 'Username already taken') {
                echo json_encode(['message' => 'Username sudah digunakan. Silahkan gunakan username lainnya!']);
            } elseif ($e->getMessage() === 'Email already in use') {
                echo json_encode(['message' => 'Email sudah digunakan. Silahkan gunakan Email lainnya!']);
            } else {
                echo json_encode(['message' => 'Terjadi kesalahan, mohon coba lagi.']);
            }
            exit();
        }
    }

    static function sessionLogin()
    {
        $post = array_map('htmlspecialchars', $_POST);
        if (empty(trim($post['email'])) || empty(trim($post['password']))) {
            setFlashMessage('danger', 'Harap isi email dan password!');
            header('Location: login?failed=true');
            exit();
        } else {
            $user = Users::login([
                'email' => $post['email'],
                'password' => $post['password'],
            ]);

            if ($user) {
                if ($user['role_id'] == '1') {
                    $_SESSION['user'] = $user;
                    setcookie('token', $user['token'], strtotime($user['token_expires_at']), '/', '', false, true);
                    setFlashMessage('success', 'Login Berhasil, Selamat Datang!');
                    header('Location: laporan');
                    exit();
                } elseif ($user['role_id'] == '2') {
                    $_SESSION['user'] = $user;
                    setcookie('token', $user['token'], strtotime($user['token_expires_at']), '/', '', false, true);
                    setFlashMessage('success', 'Login Berhasil, Selamat Datang!');
                    header('Location: dashboard');
                    exit();
                } elseif ($user['role_id'] == '3') {
                    $_SESSION['user'] = $user;
                    setcookie('token', $user['token'], strtotime($user['token_expires_at']), '/', '', false, true);
                    setFlashMessage('success', 'Login Berhasil, Selamat Datang!');
                    header('Location: rating');
                    exit();
                }
            } else {
                setFlashMessage('error', 'Username atau Password salah, silahkan coba lagi!');
                header('Location: login?failed=true');
            }
        }
    }

    static function logout()
    {
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();

        header('Location: home');
        exit();
    }
}
