<?php

$stmt = $conn->prepare("SELECT balance FROM balances LIMIT 1");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
