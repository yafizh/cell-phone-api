<?php
try {
    $stmt = $conn->prepare("SELECT * FROM employees WHERE id=:id");
    $stmt->bindParam(':id', $param);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $employee = $stmt->fetch();

    $conn->beginTransaction();

    $query = "DELETE FROM employees WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $employee['id']);
    $stmt->execute();

    $query = "DELETE FROM users WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $employee['user_id']);
    $stmt->execute();

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode("Error: " . $e->getMessage());
}
exit;
