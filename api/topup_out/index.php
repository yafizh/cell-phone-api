<?php

$query = "
    SELECT 
        t.id topup_id,
        t.name topup_name,
        DATE(`to`.out_at) out_date,
        TIME(`to`.out_at) out_time,
        `to`.id,  
        `to`.price_sell,  
        `to`.amount  
    FROM 
        topup_out `to` 
    INNER JOIN 
        topups t 
    ON 
        t.id=`to`.topup_id  
    ORDER BY 
        `to`.out_at DESC 
";

if (isset($_GET['page']) && isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    $offset = ($_GET['page'] - 1) * $limit;

    $query .= " LIMIT {$limit} OFFSET {$offset}";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $topup_outs = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM topup_out");
    $stmt->execute();
    $itemsLength = $stmt->fetchColumn();
} else {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $topup_outs = $stmt->fetchAll();
}

foreach ($topup_outs as $index => $topup_out) {
    $query = "
        SELECT 
            *  
        FROM 
            topup_prices 
        WHERE 
            topup_id=:id 
        ORDER BY 
            `order` 
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $topup_out['topup_id']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $topup_outs[$index]['topup_prices'] = $stmt->fetchAll();
}

if (isset($_GET['page']) && isset($_GET['limit'])) {
    echo json_encode([
        'items' => $topup_outs,
        'itemsLength' => $itemsLength
    ]);
} else {
    echo json_encode($topup_outs);
}
