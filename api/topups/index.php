<?php

$stmt = $conn->prepare("SELECT * FROM topups WHERE `balance_id`=:balance_id ORDER BY `order`");
$stmt->bindParam(':balance_id', $_GET['balance_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());
