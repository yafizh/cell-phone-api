<?php
try {
    $_PUT = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();

    $query = "
        UPDATE item_out SET 
            price_sell=:price_sell, 
            count=:count 
        WHERE 
            id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':price_sell', $_PUT['price_sell']);
    $stmt->bindParam(':count', $_PUT['count']);
    $stmt->bindParam(':id', $param);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
