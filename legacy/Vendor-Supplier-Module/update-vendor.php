<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $vendor_name = $_POST['vendor_name'];
    $office_address = $_POST['office_address'];
    $company_legality = $_POST['company_legality'];
    $pic_name = $_POST['pic_name'];
    $pic_contact = $_POST['pic_contact'];

    $sql = "UPDATE vendors
            SET vendor_name = ?,
                office_address = ?,
                company_legality = ?,
                pic_name = ?,
                pic_contact = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $vendor_name,
        $office_address,
        $company_legality,
        $pic_name,
        $pic_contact,
        $id
    ]);

    header("Location: data-vendor.php");
    exit;
}

?>