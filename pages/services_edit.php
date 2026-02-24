<?php
include "../db.php";
$message = "";

$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM services WHERE service_id='$id'"));

if (isset($_POST['save'])) {
    $service_name = $_POST['service_name'];
    $hourly_rate  = $_POST['hourly_rate'];
    $is_active    = isset($_POST['is_active']) ? 1 : 0;

    if ($service_name == "") {
        $message = "Service name is required!";
    } else {
        $sql = "UPDATE services SET service_name='$service_name',
                hourly_rate='$hourly_rate', is_active='$is_active'
                WHERE service_id='$id'";
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
    <title>Edit Service</title>
</head>
<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Edit Service</h4>
                </div>
                <div class="card-body">

                    <?php if ($message != "") { ?>
                        <div class="alert alert-danger"><?php echo $message; ?></div>
                    <?php } ?>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Service Name *</label>
                            <input type="text" name="service_name" class="form-control"
                                   value="<?php echo $row['service_name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hourly Rate</label>
                            <input type="number" step="0.01" name="hourly_rate" class="form-control"
                                   value="<?php echo $row['hourly_rate']; ?>">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input"
                                   <?php if($row['is_active']) echo 'checked'; ?>>
                            <label class="form-check-label">Active</label>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" name="save" class="btn btn-primary w-100">
                                Update Service
                            </button>
                            <a href="services_list.php" class="btn btn-secondary w-100">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>