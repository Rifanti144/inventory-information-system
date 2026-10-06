<?php
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['item_name'] ?? "";
    $spec = $_POST['tech_spec'] ?? "";
    $size = $_POST['unit_size'] ?? "";
    $cat  = $_POST['category']  ?? "";

    $stmt = $conn->prepare("INSERT INTO items (item_name, tech_spec, unit_size, category) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $spec, $size, $cat);
    $stmt->execute();
}

header("Location: output-form.php");
exit;