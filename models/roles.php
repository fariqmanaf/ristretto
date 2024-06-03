<?php
include_once __DIR__ . '/../app/config/conn.php';

class Roles{
    static function getRoleNameById($roleId)
    {
        global $conn;
        $sql = "SELECT name FROM roles WHERE role_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $roleId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $roleName = $row['role'];
        $stmt->close();
        return $roleName;
    }
}
