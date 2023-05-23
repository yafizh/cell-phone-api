<?php

$query = "
    SELECT 
        c.id credit_id,
        c.name credit_name,
        DATE(co.out_at) out_date,
        TIME(co.out_at) out_time,
        co.id,  
        co.price_sell,  
        co.amount  
    FROM 
        credit_out co 
    INNER JOIN 
        credits c 
    ON 
        c.id=co.credit_id  
    ORDER BY 
        co.out_at DESC 
";

if (isset($_GET['page']) && isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    $offset = ($_GET['page'] - 1) * $limit;

    $query .= " LIMIT {$limit} OFFSET {$offset}";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $credit_outs = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM credit_out");
    $stmt->execute();
    $itemsLength = $stmt->fetchColumn();
} else {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $credit_outs = $stmt->fetchAll();
}

foreach ($credit_outs as $index => $credit_out) {
    $query = "
        SELECT 
            *  
        FROM 
            credit_prices 
        WHERE 
            credit_id=:id 
        ORDER BY 
            `order` 
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $credit_out['credit_id']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $credit_outs[$index]['credit_prices'] = $stmt->fetchAll();
}

if (isset($_GET['page']) && isset($_GET['limit'])) {
    echo json_encode([
        'items' => $credit_outs,
        'itemsLength' => $itemsLength
    ]);
} else {
    echo json_encode($credit_outs);
}
