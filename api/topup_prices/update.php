<?php
try {
    $_PUT = json_decode(file_get_contents("php://input"), true);

    $query = "UPDATE topup_prices SET `amount`=:amount, `price`=:price, `order`=:order WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':amount', $_PUT['amount']);
    $stmt->bindParam(':price', $_PUT['price']);
    $stmt->bindParam(':order', $_PUT['order']);
    $stmt->bindParam(':id', $param);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
