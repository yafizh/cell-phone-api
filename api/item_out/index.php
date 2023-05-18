<?php

$query = "
    SELECT 
        it.name item_type,   
        i.name item_name,
        DATE(io.out_at) out_date,
        TIME(io.out_at) out_time,
        io.id,  
        io.price_sell,   
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
    ORDER BY 
        io.out_at DESC 
";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
