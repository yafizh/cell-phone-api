<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $query = "INSERT INTO topups (`balance_id`, `name`, `order`) VALUES (:balance_id, :name, :order)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':balance_id', $_POST['balance_id']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':order', $_POST['order']);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
