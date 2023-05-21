<?php

$query = "
    SELECT 
        * 
    FROM 
        item_types 
    ORDER BY 
        `order` 
";

if (isset($_GET['page']) && isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    $offset = ($_GET['page'] - 1) * $limit;

    $query .= " LIMIT {$limit} OFFSET {$offset}";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $items = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM item_types");
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
