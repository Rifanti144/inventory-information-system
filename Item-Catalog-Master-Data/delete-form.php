<?php
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: output-form.php");
exit;