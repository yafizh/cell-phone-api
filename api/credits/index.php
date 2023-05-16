<?php

$stmt = $conn->prepare("SELECT * FROM credits ORDER BY `order`");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
