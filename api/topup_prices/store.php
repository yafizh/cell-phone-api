<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $query = "INSERT INTO topup_prices (`topup_id`, `amount`, `price`, `order`) VALUES (:topup_id, :amount, :price, :order)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':topup_id', $_POST['topup_id']);
    $stmt->bindParam(':amount', $_POST['amount']);
    $stmt->bindParam(':price', $_POST['price']);
    $stmt->bindParam(':order', $_POST['order']);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
