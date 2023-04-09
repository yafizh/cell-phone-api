<?php
try {
    $query = "
        SELECT 
            e.*,
            u.username,
            u.password
        FROM 
            employees e 
        INNER JOIN 
            users u 
        ON 
            u.id=e.user_id 
        WHERE 
            e.id=:id
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $param);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo json_encode($stmt->fetch());
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
