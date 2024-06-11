<?php
include_once __DIR__ . '/../app/config/conn.php';

class Product {
    static function getAllProduct() {
      global $conn;
      $sql = "SELECT * FROM product ORDER BY category_id ASC";
      $result = $conn->query($sql);
      $products = [];
      while ($row = $result->fetch_assoc()) {
        $products[] = $row;
      }
      return $products;
    }

    static function getCategories() {
      global $conn;
      $sql = "SELECT * FROM category ORDER BY category_id ASC";
      $result = $conn->query($sql);
      $categories = [];
      while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
      }
      return $categories;
    }

    static function getCategoryNameById($categoryId) {
      global $conn;
      $sql = "SELECT category_name FROM category WHERE category_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $categoryId);
      $stmt->execute();
      $result = $stmt->get_result();
      $category = $result->fetch_assoc();
      return $category['category_name'];
  }

    static function storeTransaction($paymentTypeId, $totalAmount, $productIds, $quantities)
  {
      global $conn;
      $conn->begin_transaction();

      try {
          $sqlPayment = "INSERT INTO payment (payment_type_id, amount) VALUES (?, ?)";
          $stmtPayment = $conn->prepare($sqlPayment);
          $stmtPayment->bind_param("id", $paymentTypeId, $totalAmount);
          $stmtPayment->execute();
          $paymentId = $conn->insert_id;

          $transactionDate = date('Y-m-d H:i:s');
          $sqlTransaction = "INSERT INTO transaction (transaction_date, payment_id, is_done) VALUES (?, ?, 0)";
          $stmtTransaction = $conn->prepare($sqlTransaction);
          $stmtTransaction->bind_param("si", $transactionDate, $paymentId);
          $stmtTransaction->execute();
          $transactionId = $conn->insert_id;

          $sqlTransactionDetail = "INSERT INTO transaction_detail (transaction_id, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)";
          $stmtTransactionDetail = $conn->prepare($sqlTransactionDetail);

          for ($i = 0; $i < count($productIds); $i++) {
              $productId = $productIds[$i];
              $quantity = $quantities[$i];
              $product = self::getProductById($productId);
              $subtotal = $product['price'] * $quantity;

              $stmtTransactionDetail->bind_param("iiid", $transactionId, $productId, $quantity, $subtotal);
              $stmtTransactionDetail->execute();
          }
          $conn->commit();
          return true;
      } catch (Exception $e) {
          $conn->rollback();
          throw new Exception($e->getMessage());
          return false;
      }
  }

  static function getProductById($productId)
  {
      global $conn;
      $sql = "SELECT * FROM product WHERE product_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $productId);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_assoc();
  }

  static function storeProduct($name, $price, $categoryId, $photo)
  {
      global $conn;
      $sql = "INSERT INTO product (product_name, price, category_id, photo) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sdis", $name, $price, $categoryId, $photo);
      $stmt->execute();
      return $stmt->affected_rows;
  }

  static function uploadPhoto($photo, $categoryName) {
      $baseDir = 'assets/product/';
      $targetDir = $baseDir . strtolower($categoryName) . "/";

      if (!is_dir($targetDir)) {
          mkdir($targetDir, 0777, true);
      }

      $imageFileType = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
      $fileName = strtolower(str_replace(" ", "-", pathinfo($photo['name'], PATHINFO_FILENAME))) . "." . $imageFileType;
      $targetFile = $targetDir . $fileName;

      if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
          return strtolower($categoryName) . "/" . $fileName;
      } else {
          throw new Exception('Gagal mengunggah foto.');
      }
  }

  static function findProduct($id){
    global $conn;
    $sql = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  static function updateProduct($id, $name, $price, $categoryId, $photo, $isBestSeller)
  {
      global $conn;
      $sql = "UPDATE product SET product_name = ?, price = ?, category_id = ?, photo = ?, is_best_seller = ? WHERE product_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sdisii", $name, $price, $categoryId, $photo, $isBestSeller, $id);
      $stmt->execute();
      return $stmt->affected_rows;
  }  
}