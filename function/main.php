<?php

function view( $page, $data = [] )
 {
    extract( $data );
    include 'resources/views/' . $page . '.php';
}

class Router
 {
    public static $urls = [];

    function __construct()
 {
        $url = implode(
            '/',
            array_filter(
                explode(
                    '/',
                    str_replace(
                        $_ENV[ 'BASEDIR' ],
                        '',
                        parse_url( $_SERVER[ 'REQUEST_URI' ], PHP_URL_PATH )
                    )
                ),
                'strlen'
            )
        );

        if ( !in_array( $url, self::$urls[ 'routes' ] ) ) {
            header( 'Location: ' . BASEURL );
        }

        $call = self::$urls[ $_SERVER[ 'REQUEST_METHOD' ] ][ $url ];
        $call();
    }
    public static function url( $url, $method, $callback )
 {
        if ( $url == '/' ) {
            $url = '';
        }
        self::$urls[ strtoupper( $method ) ][ $url ] = $callback;
        self::$urls[ 'routes' ][] = $url;
        self::$urls[ 'routes' ] = array_unique( self::$urls[ 'routes' ] );
    }
}

function urlpath( $path )
 {
    require_once 'app/config/static.php';
    return BASEURL . $path;
}

function setFlashMessage( $type, $message )
 {
    if ( !isset( $_SESSION[ 'user' ] ) ) {
        $_SESSION[ 'guest_' . $type ] = $message;
    } else {
        $_SESSION[ $type . '_' . $_SESSION[ 'user' ][ 'user_id' ] ] = $message;
    }
}
function displayFlashMessages( $type )
{
    if ( !isset( $_SESSION[ 'user' ] ) ) {
        $messageKey = 'guest_' . $type;
        if ( isset( $_SESSION[ $messageKey ] ) ) {
            echo '<div class="absolute z-10 font-semibold p-4 mb-4 text-sm rounded-lg shadow-md ';
            if ($type == 'success') {
                echo 'bg-green-400 text-green-700';
            } elseif ($type == 'error') {
                echo 'bg-red-400 text-red-700';
            }
            echo '">';
            echo $_SESSION[ $messageKey ];
            echo '<button type="button" class="ml-2 w-24 text-sm font-medium text-white bg-transparent rounded-full hover:bg-gray-200 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-400" onclick="this.parentElement.style.display=\'none\';" aria-label="Close">';
            echo '&times;';
            echo '</button>';
            echo '</div>';
            unset( $_SESSION[ $messageKey ] );
        }
    } else {
        $messageKey = $type . '_' . $_SESSION[ 'user' ][ 'user_id' ];
        if ( isset( $_SESSION[ $messageKey ] ) ) {
            echo '<div class="absolute z-10 p-4 mb-4 font-semibold text-sm rounded-lg shadow-md';
            if ($type == 'success') {
                echo 'bg-green-400 text-green-700';
            } elseif ($type == 'error') {
                echo 'bg-red-400 text-red-700';
            }
            echo '">';
            echo $_SESSION[ $messageKey ];
            echo '<button type="button" class="ml-2 text-sm font-medium text-white bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-400" onclick="this.parentElement.style.display=\'none\';" aria-label="Close">';
            echo '&times;';
            echo '</button>';
            echo '</div>';
            unset( $_SESSION[ $messageKey ] );
        }
    }
}

function compressToWebP( $source, $destination, $quality = 20 ) {
    $info = getimagesize( $source );
    if ( $info[ 'mime' ] == 'image/jpeg' ) {
        $image = imagecreatefromjpeg( $source );
    } elseif ( $info[ 'mime' ] == 'image/png' ) {
        $image = imagecreatefrompng( $source );
    } else {
        return false;
    }
    imagepalettetotruecolor( $image );
    return imagewebp( $image, $destination, $quality );
}

function isCurrentPage( $page )
 {
    return strpos( $_SERVER[ 'REQUEST_URI' ], '/'.$page ) !== false ? 'active' : '';
}

// function checkAuth() {
//     if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
//         header( 'Location: ' . BASEURL . 'login' );
//         exit;
//     }
//     $token = $_COOKIE[ 'token' ];
//     $user = Users::getUserByToken( $token );

//     if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
//         unset( $_SESSION[ 'user' ] );
//         setcookie( 'token', '', time() - 3600, '/' );
//         header( 'Location: ' . BASEURL . 'login' );
//         exit;
//     }
// }

// function encrypt( $variable ) {
//     $key = $_ENV[ 'ENCRYPTION_KEY' ];
//     $iv = $_ENV[ 'ENCRYPTION_IV' ];
//     $encrypted = openssl_encrypt( $variable, 'aes-256-cbc', $key, 0, $iv );
//     return base64_encode( $encrypted );
// }

// function decrypt( $encrypted_variable ) {
//     $key = $_ENV[ 'ENCRYPTION_KEY' ];
//     $iv = $_ENV[ 'ENCRYPTION_IV' ];
//     $decoded = base64_decode( $encrypted_variable );
//     $decrypted = openssl_decrypt( $decoded, 'aes-256-cbc', $key, 0, $iv );
//     return $decrypted;
// }
