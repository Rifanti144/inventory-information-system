<?php

require 'connection.php';

$id = $_GET['id'] ?? null; 

if (!$id) {
    die("Warehouse ID is missing.");
}

$sql = "DELETE FROM warehouses WHERE id = ? ";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: data-warehouse.php");
exit;
?>
