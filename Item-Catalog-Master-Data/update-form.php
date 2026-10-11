<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id        = $_POST['id'];
    $item_name = $_POST['item_name'];
    $tech_spec = $_POST['tech_spec'];
    $unit_size = $_POST['unit_size'];
    $category  = $_POST['category'];

    $sql = "UPDATE items
            SET item_name = ?,
                tech_spec = ?,
                unit_size = ?,
                category = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $item_name,
        $tech_spec,
        $unit_size,
        $category,
        $id
    ]);

    header("Location: output-form.php");
    exit;
}

?>