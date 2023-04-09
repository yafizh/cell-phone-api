<?php

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
