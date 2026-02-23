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
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "nav.php"; ?>
<!-- <div class="navbar">
    <div class="logo">My System</div>

    <div class="nav-links">
        <a href="/assessment_beginner/index.php">Dashboard</a>
        <a href="/assessment_beginner/pages/clients_list.php">Clients</a>
        <a href="/assessment_beginner/pages/services_list.php">Services</a>
        <a href="/assessment_beginner/pages/bookings_list.php">Bookings</a>
        <a href="/assessment_beginner/pages/tools_list_assign.php">Tools</a>
        <a href="/assessment_beginner/pages/payments_list.php">Payments</a>
    </div>
</div> -->

<h1>Dashboard</h1>

<div class="dashboard">
    <div class="card">Total Clients: <?php echo $clients; ?></div>
    <div class="card">Total Services: <?php echo $services; ?></div>
    <div class="card">Total Bookings: <?php echo $bookings; ?></div>
    <div class="card">Total Revenue: <?php echo number_format($revenue, 2); ?></div>
<!-- <?php include "nav.php"; ?> -->
    <div class="links">
        <a class="add-btn" href="pages/clients_add.php">+ Add Client</a>
        <a href="pages/bookings_add.php">Create Booking</a>
    </div>
</div>

</body>
</html>
