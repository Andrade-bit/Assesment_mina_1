<?php
include "../db.php";

if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];

  // Soft delete (set is_active to 0)
  mysqli_query($conn, "UPDATE services SET is_active=0 WHERE service_id=$delete_id");

  header("Location: services_list.php");
  exit;
}

$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Services</title>

<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-5">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Services</h2>
    <a href="services_add.php" class="btn btn-primary">
      + Add Service
    </a>
  </div>

  <div class="card shadow">
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Hourly Rate</th>
              <th>Status</th>
              <th width="180">Action</th>
            </tr>
          </thead>
          <tbody>

          <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['service_id']; ?></td>

              <td>
                <strong><?php echo $row['service_name']; ?></strong>
              </td>

              <td>
                ₱<?php echo number_format($row['hourly_rate'],2); ?>
              </td>

              <td>
                <?php if ($row['is_active'] == 1) { ?>
                  <span class="badge bg-success">Active</span>
                <?php } else { ?>
                  <span class="badge bg-secondary">Inactive</span>
                <?php } ?>
              </td>

              <td>
                <a href="services_edit.php?id=<?php echo $row['service_id']; ?>" 
                   class="btn btn-sm btn-warning">
                   Edit
                </a>

                <?php if ($row['is_active'] == 1) { ?>
                  <a href="services_list.php?delete_id=<?php echo $row['service_id']; ?>"
                     class="btn btn-sm btn-danger"
                     onclick="return confirm('Deactivate this service?')">
                     Deactivate
                  </a>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>

          </tbody>
        </table>
      </div>

    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>