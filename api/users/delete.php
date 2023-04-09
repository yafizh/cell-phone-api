<?php
try {
    $query = "DELETE FROM users WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $param);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
