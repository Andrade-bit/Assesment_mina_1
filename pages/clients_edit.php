<?php
include "../db.php";
$message = "";

$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM clients WHERE client_id='$id'"));

if (isset($_POST['save'])) {
    $full_name = $_POST['full_name'];
    $email     = $_POST['email'];
    $phone     = $_POST['phone'];
    $address   = $_POST['address'];

    if ($full_name == "" || $email == "") {
        $message = "Name and Email are required!";
    } else {
        $sql = "UPDATE clients SET full_name='$full_name', email='$email',
                phone='$phone', address='$address' WHERE client_id='$id'";
        mysqli_query($conn, $sql);
        header("Location: clients_list.php");
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Client</title>
</head>
<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Edit Client</h4>
                </div>
                <div class="card-body">

                    <?php if ($message != "") { ?>
                        <div class="alert alert-danger"><?php echo $message; ?></div>
                    <?php } ?>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="full_name" class="form-control"
                                   value="<?php echo $row['full_name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control"
                                   value="<?php echo $row['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="<?php echo $row['phone']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control"
                                   value="<?php echo $row['address']; ?>">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" name="save" class="btn btn-primary w-100">
                                Update Client
                            </button>
                            <a href="clients_list.php" class="btn btn-secondary w-100">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>