<?php
include "../db.php";

$booking_id = $_GET['booking_id'];

$booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id=$booking_id"));

$paidRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
$total_paid = $paidRow['paid'];

$balance = $booking['total_cost'] - $total_paid;
$message = "";

if (isset($_POST['pay'])) {
  $amount = $_POST['amount_paid'];
  $method = $_POST['method'];

  if ($amount <= 0) {
    $message = "<div class='alert alert-danger'>Invalid amount!</div>";
  } else if ($amount > $balance) {
    $message = "<div class='alert alert-danger'>Amount exceeds balance!</div>";
  } else {

    // 1) Insert payment
    mysqli_query($conn, "INSERT INTO payments (booking_id, amount_paid, method)
      VALUES ($booking_id, $amount, '$method')");

    // 2) Recompute total paid
    $paidRow2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
    $total_paid2 = $paidRow2['paid'];

    // 3) Recompute balance
    $new_balance = $booking['total_cost'] - $total_paid2;

    // 4) Update status if fully paid
    if ($new_balance <= 0.009) {
      mysqli_query($conn, "UPDATE bookings SET status='PAID' WHERE booking_id=$booking_id");
    }

    header("Location: bookings_list.php");
    exit;
  }
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Process Payment</title>

<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<?php include "../components/nav.php"; ?>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    💳 Process Payment (Booking #<?php echo $booking_id; ?>)
                </div>

                <div class="card-body">

                    <!-- Booking Summary -->
                    <div class="mb-4">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="border rounded p-3 bg-light">
                                    <small>Total Cost</small>
                                    <h5 class="text-primary">
                                        ₱<?php echo number_format($booking['total_cost'],2); ?>
                                    </h5>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded p-3 bg-light">
                                    <small>Total Paid</small>
                                    <h5 class="text-info">
                                        ₱<?php echo number_format($total_paid,2); ?>
                                    </h5>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded p-3 bg-light">
                                    <small>Balance</small>
                                    <h5 class="text-danger">
                                        ₱<?php echo number_format($balance,2); ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php echo $message; ?>

                    <!-- Payment Form -->
                    <form method="post">

                        <div class="mb-3">
                            <label class="form-label">Amount Paid</label>
                            <input type="number"
                                   name="amount_paid"
                                   step="0.01"
                                   class="form-control"
                                   placeholder="Enter payment amount"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select name="method" class="form-select" required>
                                <option value="CASH">CASH</option>
                                <option value="GCASH">GCASH</option>
                                <option value="CARD">CARD</option>
                            </select>
                        </div>

                        <button type="submit" name="pay" class="btn btn-success w-100">
                            Save Payment
                        </button>

                        <a href="bookings_list.php" class="btn btn-secondary w-100 mt-2">
                            Cancel
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>