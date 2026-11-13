<?php

require 'connection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Item ID is missing.");
}

$sql = "DELETE FROM items WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: output-form.php");
exit;

?>