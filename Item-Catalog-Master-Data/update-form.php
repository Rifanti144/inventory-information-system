<?php
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
    $id   = (int)$_POST['id'];
    $name = $_POST['item_name'] ?? "";
    $spec = $_POST['tech_spec'] ?? "";
    $size = $_POST['unit_size'] ?? "";
    $cat  = $_POST['category']  ?? "";

    $stmt = $conn->prepare("UPDATE items SET item_name=?, tech_spec=?, unit_size=?, category=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $spec, $size, $cat, $id);
    $stmt->execute();
}

header("Location: output-form.php");
exit;   