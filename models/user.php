<?php
include_once __DIR__ . '/../app/config/conn.php';

class Users
 {
    static function login( $data = [] )
 {
        global $conn;

        $email = $data[ 'email' ];
        $password = $data[ 'password' ];

        $result = $conn->query( "SELECT * FROM user WHERE email = '$email'" );
        if ( $result = $result->fetch_assoc() ) {
                $hashedPassword = $result[ 'password' ];
                $verify = password_verify( $password, $hashedPassword );
                if ( $verify ) {
                    $token = bin2hex( random_Bytes( 32 ) );
                    $current_time = date( 'Y-m-d H:i:s' );
                    $token_expires_at = date( 'Y-m-d H:i:s', strtotime( '+1 hour', strtotime( $current_time ) ) );
                    $user_id = $result[ 'user_id' ];

                    $existingTokenQuery = $conn->query( "SELECT * FROM user_tokens WHERE user_id = '$user_id'" );
                    if ( $existingTokenQuery->num_rows > 0 ) {
                        $conn->query( "UPDATE user_tokens SET token = '$token', expired_at = '$token_expires_at' WHERE user_id = '$user_id'" );
                    } else {
                        $conn->query( "INSERT INTO user_tokens (user_id, token, expired_at, created_at) VALUES ('$user_id', '$token', '$token_expires_at', '$current_time')" );
                    }

                    $result[ 'token' ] = $token;
                    $result[ 'token_expires_at' ] = $token_expires_at;
                    unset( $result[ 'password' ] );
                    return $result;
            } else {
                return false;
            }
        }
    }

    static function getUserByToken( $token )
 {
        global $conn;

        $result = $conn->query( "SELECT u.* FROM users u JOIN user_tokens ut ON u.id = ut.user_id WHERE ut.token = '$token' AND ut.expires_at > NOW()" );
        if ( $result && $result->num_rows > 0 ) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    static function register( $data = [] )
 {
        global $conn;
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $username = $data[ 'username' ];
        $email = $data[ 'email' ];
        $password = $data[ 'password' ];
        $role_id = $data[ 'role_id' ];

        $hashedPassword = password_hash( $password, PASSWORD_DEFAULT );
        $sql = 'INSERT INTO user SET username =?, password =?, email =?, role_id =?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'sssi', $username, $hashedPassword, $email, $role_id );
        $stmt->execute();

        if ( $stmt->affected_rows > 0 ) {
            $last_id = $conn->insert_id;
            return $last_id;
        } else {
            return false;
        }
    }

    public static function findUserByUsernameOrEmail( $username, $email )
  {
        global $conn;
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $username = $conn->real_escape_string( $username );
        $email = $conn->real_escape_string( $email );

        $query = "SELECT username, email FROM user WHERE username = '$username' OR email = '$email' LIMIT 1";
        $result = $conn->query( $query );

        if ( $result->num_rows > 0 ) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    static function getPassword( $username )
  {
        global $conn;
        $sql = 'SELECT password FROM user WHERE username = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 's', $username );
        $stmt->execute();

        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }
    static function isUsernameTaken( $username, $excludeUserId = null ) {
        global $conn;
        $sql = 'SELECT COUNT(*) as count FROM user WHERE username = ?';
        $params = [ $username ];

        if ( $excludeUserId ) {
            $sql .= ' AND id != ?';
            $params[] = $excludeUserId;
        }

        $stmt = $conn->prepare( $sql );
        if ( $stmt === false ) {
            return false;
        }

        $stmt->bind_param( str_repeat( 's', count( $params ) - 1 ) . 'i', ...$params );
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row[ 'count' ] > 0;
    }

    static function isEmailTaken( $email, $excludeUserId = null ) {
        global $conn;
        $sql = 'SELECT COUNT(*) as count FROM user WHERE email = ?';
        $params = [ $email ];

        if ( $excludeUserId ) {
            $sql .= ' AND id != ?';
            $params[] = $excludeUserId;
        }

        $stmt = $conn->prepare( $sql );
        if ( $stmt === false ) {
            return false;
        }

        $stmt->bind_param( str_repeat( 's', count( $params ) - 1 ) . 'i', ...$params );
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row[ 'count' ] > 0;
    }

    static function updateUser( $dataUser ) {
        global $conn;
        $setParts = [];
        $params = [];

        if ( isset( $dataUser[ 'username' ] ) ) {
            $setParts[] = 'username = ?';
            $params[] = $dataUser[ 'username' ];
        }
        if ( isset( $dataUser[ 'email' ] ) ) {
            $setParts[] = 'email = ?';
            $params[] = $dataUser[ 'email' ];
        }

        if ( empty( $setParts ) ) {
            return true;
        }

        $params[] = $dataUser[ 'id' ];

        $sql = 'UPDATE user SET ' . implode( ', ', $setParts ) . ' WHERE id = ?';
        $stmt = $conn->prepare( $sql );

        if ( $stmt === false ) {
            return false;
        }

        $stmt->bind_param( str_repeat( 's', count( $params ) - 1 ) . 'i', ...$params );
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    static function checkPassword( $data = [] ) {
        global $conn;

        $user_id = $data[ 'id' ];
        $password = $data[ 'password' ];
        $result = $conn->query( "SELECT * FROM users WHERE id = '$user_id'" );
        if ( $result = $result->fetch_assoc() ) {
            $hashedPassword = $result[ 'password' ];
            $verify = password_verify( $password, $hashedPassword );
            if ( $verify ) {
                return true;
            } else {
                return false;
            }
        }

    }

    static function getUserById( $id ) {
        global $conn;
        $sql = 'SELECT * FROM users WHERE id = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    static function getUsersData() {
        global $conn;
        $sql = 'SELECT role_id, COUNT(*) AS count FROM user WHERE role_id = 2 OR role_id = 3 GROUP BY role_id';
        $stmt = $conn->prepare( $sql );
        $stmt->execute();
        $result = $stmt->get_result();
        $labels = [];
        $data = [];
        if ( $result->num_rows > 0 ) {
            while ( $row = $result->fetch_assoc() ) {
                $labels[] = $row[ 'role_id' ];
                $data[] = $row[ 'count' ];
            }
        }
        return [ 'labels' => $labels, 'data' => $data ];
    }

    // static function disableUser($id) {
    //     global $conn;
    //     $status = 'inactive';
    //     $sql = 'UPDATE user SET status = ? WHERE id = ?';
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param('si', $status, $id);
    //     $success = $stmt->execute();
    //     $stmt->close();
    //     return true; 
    // }

}
