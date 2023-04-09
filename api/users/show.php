<?php
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    $stmt->bindParam(':id', $param);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo json_encode($stmt->fetch());
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
