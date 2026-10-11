<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $item_name = $_POST['item_name'];
    $tech_spec = $_POST['tech_spec'];
    $unit_size = $_POST['unit_size'];
    $category  = $_POST['category'];

    $sql = "INSERT INTO items
            (item_name, tech_spec, unit_size, category)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $item_name,
        $tech_spec,
        $unit_size,
        $category
    ]);

    header("Location: output-form.php");
    exit;
}
?>