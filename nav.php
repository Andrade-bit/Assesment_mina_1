<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/index.php">My System</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- LEFT SIDE -->
      <ul class="navbar-nav me-auto">

        <li class="nav-item">
          <a class="nav-link <?php if($current_page=='index.php') echo 'active'; ?>"
             href="/index.php">Dashboard</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if(in_array($current_page, ['clients_list.php','clients_add.php','clients_edit.php'])) echo 'active'; ?>"
             href="/pages/clients_list.php">Clients</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if(in_array($current_page, ['services_list.php','services_edit.php'])) echo 'active'; ?>"
             href="/pages/services_list.php">Services</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if(in_array($current_page, ['bookings_create.php','bookings_add.php','bookings_edit.php'])) echo 'active'; ?>"
             href="/pages/bookings_create.php">Bookings</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if(in_array($current_page, ['tools_list_assign.php','tools_add.php','tools_edit.php'])) echo 'active'; ?>"
             href="/pages/tools_list_assign.php">Tools</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link <?php if(in_array($current_page, ['payments_list.php','payment_list.php'])) echo 'active'; ?>"
             href="/pages/payments_list.php">Payments</a>
        </li>
        
      </ul>

    
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['username'])): ?>
          <li class="nav-item text-bold">
            <a class="nav-link fw-bold text-white" href="/logout.php">Logout</a>
          </li>
        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>