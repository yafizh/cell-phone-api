<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();

    $query = "
        INSERT INTO item_out (
            item_id,
            user_id,
            price_sell,
            count,
            out_at 
        ) VALUES (
            :item_id, 
            NULL, 
            :price_sell, 
            :count,
            '" . Date('Y-m-d H:i:s') . "' 
        )";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':item_id', $_POST['item_id']);
    // $stmt->bindParam(':user_id', NULL);
    $stmt->bindParam(':price_sell', $_POST['price_sell']);
    $stmt->bindParam(':count', $_POST['count']);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode("Error: " . $e->getMessage());
}
exit;
