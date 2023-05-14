<?php

$stmt = $conn->prepare("SELECT * FROM item_types");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
