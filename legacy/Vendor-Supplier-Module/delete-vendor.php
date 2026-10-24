<?php

require 'connection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Vendor ID is missing.");
}

$sql = "DELETE FROM vendors WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: data-vendor.php");
exit;

?>