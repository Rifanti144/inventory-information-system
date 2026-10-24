<?php

require 'connection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Warehouse ID is missing.");
}

$sql = "SELECT * FROM warehouses WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

$warehouseData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$warehouseData) {
    die("Warehouse not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Warehouse</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&family=Protest+Strike&display=swap" rel="stylesheet">

<style>

:root {
    --navy-bg: #010736;
    --navy-panel: #0D1C42;
    --navy-accent: #22396F;
    --cream: #FCF1D0;
    --lime: #DEFF69;
    --white: #FFFFFF;
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    background: var(--navy-bg);
    font-family: 'Bakbak One', sans-serif;
}

.topbar {
    background: var(--cream);
    min-height: 109px;
    display: flex;
    align-items: center;
    padding: 14px 48px;
}

.logo {
    display: flex;
    align-items: center;
    gap: 14px;
}

.logo-caption {
    font-family: 'Protest Strike', sans-serif;
    font-size: 24px;
    line-height: 1.3;
    color: var(--navy-accent);
}

.content {
    max-width: 900px;
    margin: 0 auto;
    padding: 70px 24px;
}

.form-card {
    background: var(--navy-panel);
    border-radius: 45px;
    padding: 45px;
}

.form-card h1 {
    color: var(--cream);
    font-family: 'Protest Strike', sans-serif;
    font-weight: 400;
    margin-top: 0;
    margin-bottom: 35px;
}

.field {
    margin-bottom: 25px;
}

.field label {
    display: block;
    color: var(--cream);
    font-size: 18px;
    margin-bottom: 10px;
}

.field input {
    width: 100%;
    border: none;
    border-radius: 20px;
    padding: 17px 22px;
    font-family: 'Bakbak One', sans-serif;
    font-size: 18px;
}

.field input:focus {
    outline: 3px solid var(--lime);
}

.actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.btn-update,
.btn-cancel {
    border: none;
    border-radius: 20px;
    padding: 15px 30px;
    font-family: 'Bakbak One', sans-serif;
    font-size: 18px;
    text-decoration: none;
    cursor: pointer;
}

.btn-update {
    background: var(--lime);
    color: var(--navy-bg);
}

.btn-cancel {
    background: var(--cream);
    color: var(--navy-bg);
}

</style>

</head>

<body>

<header class="topbar">

    <div class="logo">

        <div class="logo-caption">
            Inventory<br>
            Information Systems
        </div>

    </div>

</header>


<main class="content">

    <div class="form-card">

        <h1>Edit Warehouse</h1>

        <form action="update-warehouse.php" method="POST">

            <input
                type="hidden"
                name="id"
                value="<?php echo $id; ?>"
            >

            <div class="field">

                <label for="warehouse_name">
                    Warehouse Name
                </label>

                <input
                    type="text"
                    id="warehouse_name"
                    name="warehouse_name"
                    value="<?php echo htmlspecialchars($warehouseData['warehouse_name']); ?>"
                    required
                >

            </div>


            <div class="field">

                <label for="aisle_number">
                    Aisle Number
                </label>

                <input
                    type="text"
                    id="aisle_number"
                    name="aisle_number"
                    value="<?php echo htmlspecialchars($warehouseData['aisle_number']); ?>"
                    required
                >

            </div>


            <div class="field">

                <label for="rack_code">
                    Rack Code
                </label>

                <input
                    type="text"
                    id="rack_code"
                    name="rack_code"
                    value="<?php echo htmlspecialchars($warehouseData['rack_code']); ?>"
                    required
                >

            </div>


            <div class="field">

                <label for="physical_capacity">
                    Physical Capacity
                </label>

                <input
                    type="text"
                    id="physical_capacity"
                    name="physical_capacity"
                    value="<?php echo htmlspecialchars($warehouseData['physical_capacity']); ?>"
                    required
                >

            </div>


            <div class="actions">

                <button
                    type="submit"
                    class="btn-update"
                >
                    UPDATE
                </button>

                <a
                    href="data-warehouse.php"
                    class="btn-cancel"
                >
                    CANCEL
                </a>

            </div>

        </form>

    </div>

</main>

</body>
</html>