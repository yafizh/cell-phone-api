<?php

$query = "
    SELECT 
        e.*,
        u.username 
    FROM 
        employees e 
    INNER JOIN 
        users u 
    ON 
        u.id=e.user_id 
";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
