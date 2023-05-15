<?php

$query = "
    SELECT 
        *  
    FROM 
        items 
    WHERE 
        item_type_id=:id 
";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_GET['item_type_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
