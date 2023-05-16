<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $query = "INSERT INTO credits (`name`, `balance`, `order`) VALUES (:name, 0, :order)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':order', $_POST['order']);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
