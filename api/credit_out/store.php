<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();

    $query = "
        INSERT INTO credit_out (
            credit_id,
            user_id,
            price_sell,
            amount,
            out_at 
        ) VALUES (
            :credit_id, 
            NULL, 
            :price_sell, 
            :amount,
            '" . Date('Y-m-d H:i:s') . "' 
        )";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':credit_id', $_POST['credit_id']);
    // $stmt->bindParam(':user_id', NULL);
    $stmt->bindParam(':price_sell', $_POST['price_sell']);
    $stmt->bindParam(':amount', $_POST['amount']);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode("Error: " . $e->getMessage());
}
exit;
