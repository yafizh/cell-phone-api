<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();
    
    $query = "
        INSERT INTO items (
            item_type_id, 
            name, 
            price_buy,
            price_sell,
            stock,
            description 
        ) VALUES (
            :item_type_id, 
            :name, 
            :price_buy, 
            :price_sell, 
            0, 
            :description
        )";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':item_type_id', $_POST['item_type_id']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':price_buy', $_POST['price_buy']);
    $stmt->bindParam(':price_sell', $_POST['price_sell']);
    $stmt->bindParam(':description', $_POST['description']);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode("Error: " . $e->getMessage());
}
exit;
