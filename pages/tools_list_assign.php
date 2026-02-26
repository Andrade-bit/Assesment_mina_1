<?php
include "../db.php";

$message = "";

// ASSIGN TOOL
if (isset($_POST['assign'])) {
  $booking_id = $_POST['booking_id'];
  $tool_id = $_POST['tool_id'];
  $qty = $_POST['qty_used'];

  $toolRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT quantity_available FROM tools WHERE tool_id=$tool_id"));

  if ($qty > $toolRow['quantity_available']) {
    $message = "<div class='alert alert-danger'>Not enough available tools!</div>";
  } else {
    mysqli_query($conn, "INSERT INTO booking_tools (booking_id, tool_id, qty_used)
      VALUES ($booking_id, $tool_id, $qty)");

    mysqli_query($conn, "UPDATE tools SET quantity_available = quantity_available - $qty WHERE tool_id=$tool_id");

    $message = "<div class='alert alert-success'>Tool assigned successfully!</div>";
  }
}

$tools = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
$bookings = mysqli_query($conn, "SELECT booking_id FROM bookings ORDER BY booking_id DESC");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tools Inventory</title>

<!-- Bootstrap 5 CDN
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

</head>
<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-4">

    <h2 class="mb-4">🛠 Tools / Inventory</h2>

    <?php echo $message; ?>

    <!-- Available Tools Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Available Tools
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($t = mysqli_fetch_assoc($tools)) { ?>
                        <tr>
                            <td><?php echo $t['tool_name']; ?></td>
                            <td><?php echo $t['quantity_total']; ?></td>
                            <td>
                                <span class="badge bg-success">
                                    <?php echo $t['quantity_available']; ?>
                                </span>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Assign Tool Card -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Assign Tool to Booking
        </div>
        <div class="card-body">
            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Booking ID</label>
                    <select name="booking_id" class="form-select" required>
                        <?php while($b = mysqli_fetch_assoc($bookings)) { ?>
                            <option value="<?php echo $b['booking_id']; ?>">
                                #<?php echo $b['booking_id']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tool</label>
                    <select name="tool_id" class="form-select" required>
                        <?php
                        $tools2 = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
                        while($t2 = mysqli_fetch_assoc($tools2)) {
                        ?>
                        <option value="<?php echo $t2['tool_id']; ?>">
                            <?php echo $t2['tool_name']; ?>
                            (Avail: <?php echo $t2['quantity_available']; ?>)
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity Used</label>
                    <input type="number" name="qty_used" class="form-control" min="1" value="1" required>
                </div>

                <button type="submit" name="assign" class="btn btn-success w-100">
                    Assign Tool
                </button>

            </form>
        </div>
    </div>

</div>

</body>
</html>