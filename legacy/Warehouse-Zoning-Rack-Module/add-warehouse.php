<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $warehouse_name = $_POST['warehouse_name'];
    $aisle_number = $_POST['aisle_number'];
    $rack_code = $_POST['rack_code'];
    $physical_capacity = $_POST['physical_capacity'];

    $sql = "INSERT INTO warehouses
            (warehouse_name, aisle_number, rack_code, physical_capacity)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $warehouse_name,
        $aisle_number,
        $rack_code,
        $physical_capacity
    ]);

    header("Location: data-warehouse.php");
    exit;
}
?>