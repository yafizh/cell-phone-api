<?php

$query = "
    SELECT 
        i.*,
        it.name item_type   
    FROM 
        items i
    INNER JOIN 
        item_types it 
    ON 
        it.id=i.item_type_id 
    WHERE 
        i.item_type_id=:id 
";

if (isset($_GET['page']) && isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    $offset = ($_GET['page'] - 1) * $limit;

    $query .= " LIMIT {$limit} OFFSET {$offset}";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $_GET['item_type_id']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $items = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM items WHERE item_type_id=:id");
    $stmt->bindParam(':id', $_GET['item_type_id']);
    $stmt->execute();
    $itemsLength = $stmt->fetchColumn();

    echo json_encode([
        'items' => $items,
        'itemsLength' => $itemsLength
    ]);
    exit;
}

$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_GET['item_type_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
exit;
