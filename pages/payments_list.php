<?php
include "../db.php";

$sql = "
SELECT p.*, b.booking_date, c.full_name
FROM payments p
JOIN bookings b ON p.booking_id = b.booking_id
JOIN clients c ON b.client_id = c.client_id
ORDER BY p.payment_id DESC
";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Payments</title>

<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">💳 Payments</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Booking ID</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($p = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $p['payment_id']; ?></td>

                            <td>
                                <strong><?php echo $p['full_name']; ?></strong>
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    #<?php echo $p['booking_id']; ?>
                                </span>
                            </td>

                            <td class="text-success fw-bold">
                                ₱<?php echo number_format($p['amount_paid'],2); ?>
                            </td>

                            <td>
                                <?php if($p['method'] == "CASH") { ?>
                                    <span class="badge bg-success">CASH</span>
                                <?php } elseif($p['method'] == "GCASH") { ?>
                                    <span class="badge bg-info text-dark">GCASH</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning text-dark">CARD</span>
                                <?php } ?>
                            </td>

                            <td>
                                <?php echo date("M d, Y", strtotime($p['payment_date'])); ?>
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