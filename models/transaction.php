<?php
include_once __DIR__ . '/../app/config/conn.php';

class Transaction{
  static function getPendingTransaction(){
    global $conn;
    $sql = 
    "SELECT 
        t.transaction_id,
        GROUP_CONCAT(p.product_name ORDER BY p.product_name) AS product_names,
        GROUP_CONCAT(td.quantity ORDER BY p.product_name) AS quantities
    FROM 
        transaction t
    JOIN 
        transaction_detail td ON t.transaction_id = td.transaction_id
    JOIN 
        product p ON td.product_id = p.product_id
    WHERE 
        t.is_done = 0
    GROUP BY 
        t.transaction_id
    ORDER BY 
        t.transaction_id;
    ";
    $result = $conn->query($sql);
    $transactions = [];
    while ($row = $result->fetch_assoc()) {
      $transactions[] = $row;
    }
    return $transactions;
  }

  static function finishTransaction($transactionId){
    global $conn;
    $sql = "UPDATE transaction SET is_done = 1 WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $transactionId);
    $stmt->execute();
    $stmt->close();
  }

  static function getProfitChartPerMonth($month, $year){
    global $conn;
    $month = str_pad($month, 2, '0', STR_PAD_LEFT);
    $sql = "
    SELECT 
        DATE(t.transaction_date) AS transaction_date,
        SUM(p.amount) AS total_revenue
    FROM 
        transaction t
    JOIN 
        payment p ON t.payment_id = p.payment_id
    WHERE 
        YEAR(t.transaction_date) = ? AND MONTH(t.transaction_date) = ?
    GROUP BY 
        DATE(t.transaction_date)
    ORDER BY 
        DATE(t.transaction_date);
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month);
    $stmt->execute();
    $result = $stmt->get_result();

    $chartData = [];
    while ($row = $result->fetch_assoc()) {
        $chartData[] = $row;
    }

    $stmt->close();

    return $chartData;
}

    static function getAlldetail(){
        global $conn;
        $sql = 'SELECT product_id, quantity FROM transaction_detail';
        $result = $conn->query($sql);
        $arr = [];
        while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
        }
        return $arr;
    }
}