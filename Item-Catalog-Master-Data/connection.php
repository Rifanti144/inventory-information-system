<?php
$conn = new mysqli("127.0.0.1", "root", "", "item_catalog_master_data", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");