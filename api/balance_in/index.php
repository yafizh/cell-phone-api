<?php

$query = "
    SELECT 
        DATE(in_at) in_date,
        TIME(in_at) in_time,
        price_buy,  
        amount  
    FROM 
        balances   
    ORDER BY 
        in_at DESC 
";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
