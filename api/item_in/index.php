<?php

$query = "
    SELECT 
        it.name item_type,   
        i.name item_name,
        DATE(ii.in_at) in_date,
        TIME(ii.in_at) in_time,
        ii.id,  
        ii.price_buy,  
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
    ORDER BY 
        ii.in_at DESC 
";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
