<?php
try {
    $query = "
    SELECT 
        i.name credit_name,
        DATE(ci.in_at) in_date,
        TIME(ci.in_at) in_time,
        ci.count  
    FROM 
        credit_in ci 
    INNER JOIN 
        credits i 
    ON 
        i.id=ci.credit_id  
    WHERE 
        ci.id=:id
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $param);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo json_encode($stmt->fetch());
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
