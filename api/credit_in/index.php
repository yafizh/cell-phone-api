<?php

$query = "
    SELECT 
        c.name credit_name,
        DATE(ci.in_at) in_date,
        TIME(ci.in_at) in_time,
        ci.id,  
        ci.price_buy,  
        ci.amount  
    FROM 
        credit_in ci 
    INNER JOIN 
        credits c 
    ON 
        c.id=ci.credit_id  
    ORDER BY 
        ci.in_at DESC 
";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
