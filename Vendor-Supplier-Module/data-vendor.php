<?php

session_start();

if (!isset($_SESSION['vendors'])) {
    $_SESSION['vendors'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $vendor = [
        'vendor_name' => $_POST['vendor_name'],
        'office_address' => $_POST['office_address'],
        'company_legality' => $_POST['company_legality'],
        'pic_name' => $_POST['pic_name'],
        'pic_contact' => $_POST['pic_contact']
    ];

    $_SESSION['vendors'][] = $vendor;

    header("Location: data-vendor.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vendor / Supplier Data</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background-color: #F6EFE6;
        }

        .header {
            background-color: #75563F;
            color: white;
        }

        .card {
            border: none;
            border-radius: 15px;
        }

        .card-header {
            background-color: #D8C2AA;
            color: #4E392B;
            border-radius: 15px 15px 0 0 !important;
        }

        .table thead {
            background-color: #E8D8C6;
            color: #4E392B;
        }

        .btn-custom {
            background-color: #75563F;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #5C4231;
            color: white;
        }
    </style>
</head>

<body>

<!-- Header -->
<div class="header py-4">
    <div class="container">
        <h2 class="mb-1">Inventory Information System</h2>
        <p class="mb-0">Vendor / Supplier Module</p>
    </div>
</div>

<!-- Data Table -->
<div class="container my-5">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Vendor / Supplier Data</h4>
        </div>

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Vendor Name</th>
                            <th>Office Address</th>
                            <th>Company Legality</th>
                            <th>PIC Name</th>
                            <th>PIC Contact</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($_SESSION['vendors'] as $vendor): ?>

                        <tr>
                            <td><?php echo htmlspecialchars($vendor['vendor_name']); ?></td>
                            <td><?php echo htmlspecialchars($vendor['office_address']); ?></td>
                            <td><?php echo htmlspecialchars($vendor['company_legality']); ?></td>
                            <td><?php echo htmlspecialchars($vendor['pic_name']); ?></td>
                            <td><?php echo htmlspecialchars($vendor['pic_contact']); ?></td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <a href="vendor.php" class="btn btn-custom">
                Add Another Vendor
            </a>

        </div>
    </div>

</div>

</body>
</html>