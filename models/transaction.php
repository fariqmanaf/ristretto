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

  static function getProfitChartPerMonth(){
    global $conn;
    $sql = 
    "SELECT 
        t.transaction_date AS transaction_date,
        p.amount AS total_revenue
    FROM 
        transaction t
    JOIN 
        payment p ON t.payment_id = p.payment_id
    WHERE 
        YEAR(t.transaction_date) = YEAR(CURDATE())
    ORDER BY 
        MONTH(t.transaction_date);
    ";
    $result = $conn->query($sql);
    $chartData = [];
    while ($row = $result->fetch_assoc()) {
      $chartData[] = $row;
    }
    return $chartData;
  }
}