<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $query = "INSERT INTO credit_prices (`credit_id`, `amount`, `price`, `order`) VALUES (:credit_id, :amount, :price, :order)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':credit_id', $_POST['credit_id']);
    $stmt->bindParam(':amount', $_POST['amount']);
    $stmt->bindParam(':price', $_POST['price']);
    $stmt->bindParam(':order', $_POST['order']);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
