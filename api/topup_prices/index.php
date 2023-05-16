<?php

$query = "
    SELECT 
        *  
    FROM 
        topup_prices 
    WHERE 
        topup_id=:id 
    ORDER BY 
        `order` 
";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_GET['topup_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
