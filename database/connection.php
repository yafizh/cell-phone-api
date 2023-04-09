<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbnname = "db_cell_phone";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbnname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
