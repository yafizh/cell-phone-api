<?php

$query = "
    SELECT 
        t.name topup_name,
        DATE(ti.in_at) in_date,
        TIME(ti.in_at) in_time,
        ti.id,  
        ti.price_buy,  
        ti.amount  
    FROM 
        topup_in ti 
    INNER JOIN 
        topups t 
    ON 
        t.id=ti.topup_id  
    ORDER BY 
        ti.in_at DESC 
";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
