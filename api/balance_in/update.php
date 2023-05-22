<?php
try {
    $_PUT = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();

    $query = "
        UPDATE balance_in SET 
            price_buy=:price_buy, 
            amount=:amount 
        WHERE 
            id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':price_buy', $_PUT['price_buy']);
    $stmt->bindParam(':amount', $_PUT['amount']);
    $stmt->bindParam(':id', $param);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
