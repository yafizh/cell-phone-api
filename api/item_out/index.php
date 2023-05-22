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

if (isset($_GET['page']) && isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    $offset = ($_GET['page'] - 1) * $limit;

    $query .= " LIMIT {$limit} OFFSET {$offset}";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $items = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM item_out");
    $stmt->execute();
    $itemsLength = $stmt->fetchColumn();

    echo json_encode([
        'items' => $items,
        'itemsLength' => $itemsLength
    ]);
    exit;
}

$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
