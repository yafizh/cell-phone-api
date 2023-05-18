<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();

    $query = "
        INSERT INTO item_in (
            item_id,
            user_id,
            price_buy,
            count,
            in_at 
        ) VALUES (
            :item_id, 
            NULL, 
            :price_buy, 
            :count,
            '" . Date('Y-m-d H:i:s') . "' 
        )";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':item_id', $_POST['item_id']);
    // $stmt->bindParam(':user_id', NULL);
    $stmt->bindParam(':price_buy', $_POST['price_buy']);
    $stmt->bindParam(':count', $_POST['count']);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode("Error: " . $e->getMessage());
}
exit;
