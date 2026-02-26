<!-- index.php -->
<?php 
include "db.php";

$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];

$revRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid), 0) AS s FROM payments"));
$revenue = $revRow['s'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body class="bg-light">

<?php include "nav.php"; ?>

<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Total Clients</h5>
                <h2><?php echo $clients; ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Total Services</h5>
                <h2><?php echo $services; ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Total Bookings</h5>
                <h2><?php echo $bookings; ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Total Revenue</h5>
                <h2>₱<?php echo number_format($revenue, 2); ?></h2>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a class="btn btn-primary" href="/pages/clients_add.php">+ Add Client</a>
    </div>
</div>

</body>
</html>