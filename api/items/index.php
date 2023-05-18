<?php

$query = "
    SELECT 
        i.*,
        it.name item_type   
    FROM 
        items i
    INNER JOIN 
        item_types it 
    ON 
        it.id=i.item_type_id 
    WHERE 
        i.item_type_id=:id 
";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_GET['item_type_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
