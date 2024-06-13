<?php
include_once __DIR__ . '/../app/config/conn.php';

class Rating {

    static function getRating($productId)
    {
        global $conn;
        $sql = "SELECT * FROM rating WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $ratings = [];
        while ($row = $result->fetch_assoc()) {
            $ratings[] = $row;
        }
        return $ratings;
    }

    static function storeRating($comment, $star, $productId, $userId)
    {
        global $conn;
        $sql = "INSERT INTO rating (comment, star, product_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siii", $comment, $star, $productId, $userId);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}