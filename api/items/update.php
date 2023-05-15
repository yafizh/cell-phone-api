<?php
try {
    $_PUT = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();

    $query = "
        UPDATE items SET 
            item_type_id=:item_type_id, 
            name=:name, 
            price_buy=:price_buy, 
            price_sell=:price_sell, 
            description=:description 
        WHERE 
            id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':item_type_id', $_PUT['item_type_id']);
    $stmt->bindParam(':name', $_PUT['name']);
    $stmt->bindParam(':price_buy', $_PUT['price_buy']);
    $stmt->bindParam(':price_sell', $_PUT['price_sell']);
    $stmt->bindParam(':description', $_PUT['description']);
    $stmt->bindParam(':id', $param);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
