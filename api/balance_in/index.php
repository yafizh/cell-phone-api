<?php

$query = "
    SELECT 
        id,
        DATE(in_at) in_date,
        TIME(in_at) in_time,
        price_buy,  
        amount  
    FROM 
        balance_in
    ORDER BY 
        in_at DESC 
";

if (isset($_GET['page']) && isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    $offset = ($_GET['page'] - 1) * $limit;

    $query .= " LIMIT {$limit} OFFSET {$offset}";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $items = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM balance_in");
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
exit;
