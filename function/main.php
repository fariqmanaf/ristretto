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

function displayFlashMessages($type)
{
    $isGuest = !isset($_SESSION['user']);
    $messageKey = $isGuest ? 'guest_' . $type : $type . '_' . $_SESSION['user']['user_id'];
    
    if (isset($_SESSION[$messageKey])) {
        $bgClass = $type == 'success' ? 'bg-green-500 text-white' : ($type == 'error' ? 'bg-red-500 text-white' : '');

        echo '<div class="absolute z-10 p-4 mb-4 text-md rounded-lg shadow-md ' . $bgClass . '">';
        echo $_SESSION[$messageKey];
        echo '<button type="button" class="ml-2 p-1 text-xs md:text-sm font-medium text-white bg-transparent rounded-full hover:bg-gray-200 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-400" onclick="this.parentElement.style.display=\'none\';" aria-label="Close">';
        echo '&times;';
        echo '</button>';
        echo '</div>';

        unset($_SESSION[$messageKey]);
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