<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Services</title>
</head>
<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Services List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Service Name</th>
                            <th>Hourly Rate</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['service_id']; ?></td>
                            <td><?php echo $row['service_name']; ?></td>
                            <td>₱<?php echo number_format($row['hourly_rate'], 2); ?></td>
                            <td>
                                <?php if($row['is_active']) { ?>
                                    <span class="badge bg-success">Active</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="services_edit.php?id=<?php echo $row['service_id']; ?>"
                                   class="btn btn-warning btn-sm">Edit</a>
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