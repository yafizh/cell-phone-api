<?php
try {
    $_PUT = json_decode(file_get_contents("php://input"), true);

    $stmt = $conn->prepare("SELECT * FROM employees WHERE id=:id");
    $stmt->bindParam(':id', $param);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $employee = $stmt->fetch();

    $conn->beginTransaction();

    $query = "UPDATE users SET username=:username, password=:password WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $_PUT['username']);
    $stmt->bindParam(':password', $_PUT['password']);
    $stmt->bindParam(':id', $employee['user_id']);
    $stmt->execute();

    $query = "UPDATE employees SET name=:name WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $_PUT['name']);
    $stmt->bindParam(':id', $employee['id']);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
