<?php
try {
    $query = "
    SELECT 
        it.name item_type,   
        i.name item_name,
        DATE(io.in_at) in_date,
        TIME(io.in_at) in_time,
        io.count  
    FROM 
        item_out io 
    INNER JOIN 
        items i 
    ON 
        i.id=io.item_id  
    INNER JOIN 
        item_types it 
    ON 
        it.id=i.item_type_id 
    WHERE 
        io.id=:id
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
