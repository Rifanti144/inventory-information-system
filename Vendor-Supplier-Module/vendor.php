<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vendor / Supplier</title>

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

<!-- Form -->
<div class="container my-5">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Vendor / Supplier Information</h4>
        </div>

        <div class="card-body p-4">

            <form action="data-vendor.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Vendor Name</label>
                    <input
                        type="text"
                        name="vendor_name"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Office Address</label>
                    <input
                        type="text"
                        name="office_address"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Company Legality</label>

                    <select
                        name="company_legality"
                        class="form-select"
                        required
                    >
                        <option value="">-- Select Legality --</option>
                        <option value="PT">PT</option>
                        <option value="CV">CV</option>
                        <option value="Firma">Firma</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">PIC Name</label>
                    <input
                        type="text"
                        name="pic_name"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">PIC Contact</label>
                    <input
                        type="text"
                        name="pic_contact"
                        class="form-control"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-custom">
                    Save Vendor
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html>