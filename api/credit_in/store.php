<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();

    $query = "
        INSERT INTO credit_in (
            credit_id,
            user_id,
            price_buy,
            amount,
            in_at 
        ) VALUES (
            :credit_id, 
            NULL, 
            :price_buy, 
            :amount,
            '" . Date('Y-m-d H:i:s') . "' 
        )";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':credit_id', $_POST['credit_id']);
    // $stmt->bindParam(':user_id', NULL);
    $stmt->bindParam(':price_buy', $_POST['price_buy']);
    $stmt->bindParam(':amount', $_POST['amount']);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode("Error: " . $e->getMessage());
}
exit;
