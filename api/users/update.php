<?php
try {
    $_PUT = json_decode(file_get_contents("php://input"), true);

    $query = "UPDATE users SET username=:username WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $_PUT['username']);
    $stmt->bindParam(':id', $param);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
