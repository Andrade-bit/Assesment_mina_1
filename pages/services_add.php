<?php 
include "../db.php";  

$message = "";  

if (isset($_POST['save'])) {

  $service_name = $_POST['service_name'];
  $description = $_POST['description'];
  $hourly_rate = $_POST['hourly_rate'];
  $is_active = $_POST['is_active'];

  // simple validation
  if ($service_name == "" || $hourly_rate == "") {
    $message = "Service name and hourly rate are required!";
  } else if (!is_numeric($hourly_rate) || $hourly_rate <= 0) {
    $message = "Hourly rate must be a number greater than 0.";
  } else {

    $sql = "INSERT INTO services (service_name, description, hourly_rate, is_active)
            VALUES ('$service_name', '$description', '$hourly_rate', '$is_active')";

    mysqli_query($conn, $sql);

    header("Location: services_list.php");
    exit;
  }
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Service</title>

<!-- Bootstrap 5 CDN -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

</head>
<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-5">

  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Add New Service</h4>
        </div>

        <div class="card-body">

          <!-- Error Message -->
          <?php if ($message != "") { ?>
            <div class="alert alert-danger">
              <?php echo $message; ?>
            </div>
          <?php } ?>

          <form method="post">

            <div class="mb-3">
              <label class="form-label">Service Name *</label>
              <input type="text" name="service_name" class="form-control" placeholder="Enter service name">
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" rows="4" class="form-control" placeholder="Enter service description"></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Hourly Rate (₱) *</label>
              <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="number" step="0.01" name="hourly_rate" class="form-control" placeholder="0.00">
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label">Active Status</label>
              <select name="is_active" class="form-select">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>

            <div class="d-grid">
              <button type="submit" name="save" class="btn btn-success">
                Save Service
              </button>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>