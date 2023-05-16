<?php

$query = "
    SELECT 
        *  
    FROM 
        credit_prices 
    WHERE 
        credit_id=:id 
    ORDER BY 
        `order` 
";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_GET['credit_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
