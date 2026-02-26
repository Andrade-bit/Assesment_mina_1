<?php
include "../db.php";

$sql = "
SELECT b.*, c.full_name AS client_name, s.service_name
FROM bookings b
JOIN clients c ON b.client_id = c.client_id
JOIN services s ON b.service_id = s.service_id
ORDER BY b.booking_id DESC
";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bookings</title>

</head>

<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-4">

<div class="card shadow-sm">

<div class="card-header bg-white d-flex justify-content-between align-items-center">
<h2 class="mb-0">Bookings</h2>

<a href="bookings_create.php" class="btn btn-primary btn-sm">
+ Create Booking
</a>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-light">
<tr>
<th>ID</th>
<th>Client</th>
<th>Service</th>
<th>Date</th>
<th>Hours</th>
<th>Total</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php while($b = mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?php echo $b['booking_id']; ?></td>
<td><?php echo $b['client_name']; ?></td>
<td><?php echo $b['service_name']; ?></td>
<td><?php echo $b['booking_date']; ?></td>
<td><?php echo $b['hours']; ?></td>

<td>
<strong>₱<?php echo number_format($b['total_cost'],2); ?></strong>
</td>

<td>
<span class="badge bg-warning text-dark">
<?php echo $b['status']; ?>
</span>
</td>

<td>
<a href="payment_process.php?booking_id=<?php echo $b['booking_id']; ?>"
class="btn btn-success btn-sm">
Process Payment
</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>
</div>
</div>

</div>

</body>
</html>