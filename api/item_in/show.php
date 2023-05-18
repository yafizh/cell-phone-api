<?php
try {
    $query = "
    SELECT 
        it.name item_type,   
        i.name item_name,
        DATE(ii.in_at) in_date,
        TIME(ii.in_at) in_time,
        ii.count  
    FROM 
        item_in ii 
    INNER JOIN 
        items i 
    ON 
        i.id=ii.item_id  
    INNER JOIN 
        item_types it 
    ON 
        it.id=i.item_type_id 
    WHERE 
        ii.id=:id
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
