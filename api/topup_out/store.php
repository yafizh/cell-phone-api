<?php

try {
    $_POST = json_decode(file_get_contents("php://input"), true);

    $conn->beginTransaction();

    $stmt = $conn->prepare("SELECT `balance` FROM balances FOR UPDATE");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $balance = $stmt->fetchColumn();

    if ($_POST['amount'] <= $balance) {
        $query = "
        INSERT INTO topup_out (
            topup_id,
            user_id,
            price_sell,
            amount,
            out_at 
        ) VALUES (
            :topup_id, 
            NULL, 
            :price_sell, 
            :amount,
            '" . Date('Y-m-d H:i:s') . "' 
        )";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':topup_id', $_POST['topup_id']);
        // $stmt->bindParam(':user_id', NULL);
        $stmt->bindParam(':price_sell', $_POST['price_sell']);
        $stmt->bindParam(':amount', $_POST['amount']);
        $stmt->execute();
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Saldo Tidak Cukup'
        ]);
    }

    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode("Error: " . $e->getMessage());
}
exit;
