<?php

$stmt = $conn->prepare("SELECT * FROM users WHERE status = 'ADMIN'");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
