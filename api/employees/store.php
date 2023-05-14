<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();
    
    $query = "INSERT INTO users (username, password, status) VALUES (:username, :password, 'EMPLOYEE')";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->execute();

    $user_id = $conn->lastInsertId();

    $query = "INSERT INTO employees (user_id, name) VALUES (:user_id, :name)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode("Error: " . $e->getMessage());
}
exit;
