<?php
try {
    $_PUT = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();

    $stmt = $conn->prepare("SELECT `balance` FROM balances FOR UPDATE");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $balance = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT `amount` FROM credit_out WHERE id=:id FOR UPDATE");
    $stmt->bindParam(':id', $param);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $old_amount = $stmt->fetchColumn();

    if ($_PUT['amount'] <= ($balance + $old_amount)) {
        $query = "
        UPDATE credit_out SET 
            price_sell=:price_sell, 
            amount=:amount 
        WHERE 
            id=:id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':price_sell', $_PUT['price_sell']);
        $stmt->bindParam(':amount', $_PUT['amount']);
        $stmt->bindParam(':id', $param);
        $stmt->execute();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Saldo Tidak Cukup'
        ]);
    }

    echo json_encode(['success' => true]);
    $conn->commit();
} catch (PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}
exit;
