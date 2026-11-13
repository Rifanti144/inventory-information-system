<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $warehouse_name = $_POST['warehouse_name'];
    $aisle_number = $_POST['aisle_number'];
    $rack_code = $_POST['rack_code'];
    $physical_capacity = $_POST['physical_capacity'];

    $sql = "UPDATE warehouses
            SET warehouse_name = ?,
                aisle_number = ?,
                rack_code = ?,
                physical_capacity = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $warehouse_name,
        $aisle_number,
        $rack_code,
        $physical_capacity,
        $id
    ]);

    header("Location: data-warehouse.php");
    exit;
}
?>
