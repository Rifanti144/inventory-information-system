<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $vendor_name = $_POST['vendor_name'];
    $office_address = $_POST['office_address'];
    $company_legality = $_POST['company_legality'];
    $pic_name = $_POST['pic_name'];
    $pic_contact = $_POST['pic_contact'];

    $sql = "INSERT INTO vendors 
            (vendor_name, office_address, company_legality, pic_name, pic_contact)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $vendor_name,
        $office_address,
        $company_legality,
        $pic_name,
        $pic_contact
    ]);

    header("Location: data-vendor.php");
    exit;
}
?>