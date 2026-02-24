<?php
include "../db.php";
$message = "";

if (isset($_POST['save'])) {
    $full_name = $_POST['full_name'];
    $email     = $_POST['email'];
    $phone     = $_POST['phone'];
    $address   = $_POST['address'];

    if ($full_name == "" || $email == "") {
        $message = "Name and Email are required!";
    } else {
        $sql = "INSERT INTO clients (full_name, email, phone, address)
                VALUES ('$full_name', '$email', '$phone', '$address')";
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
    <title>Add Client</title>
</head>
<body class="bg-light">

<?php include "../nav.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Add Client</h4>
                </div>
                <div class="card-body">

                    <?php if ($message != "") { ?>
                        <div class="alert alert-danger"><?php echo $message; ?></div>
                    <?php } ?>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="full_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <button type="submit" name="save" class="btn btn-primary w-100">
                            Save Client
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>