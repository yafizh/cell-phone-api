<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $query = "INSERT INTO users (username, password, status) VALUES (:username, :password, 'ADMIN')";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
