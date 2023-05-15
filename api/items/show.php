<?php
try {
    $query = "
        SELECT 
            i.*,
            it.id item_type_id 
        FROM 
            items i 
        INNER JOIN 
            item_types it 
        ON 
            it.id=i.item_type_id  
        WHERE 
            i.id=:id
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
