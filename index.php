<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>NMA Clinic Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/landing-page.css">
</head>
<body>
<div class="main-wrapper">
  <header>
    <div class="top-header">
      <div class="logo-title">
        <a href="/index.php">
          <img src="/assets/images/Newark-medical-associates-logo.png" alt="Newark Medical Associates" class="logo">
        </a>
        <h1></h1>
      </div>
      <nav class="top-nav">
        <a href="/index.php">Home</a>
        <?php if (isset($_SESSION['role'])): ?>
          <a href="/logout.php">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
        <?php else: ?>
          <a href="/login.php">Login</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
  <div class="main-content">
    <h1>Welcome to Newark Medical Associates</h1>
    <div class="container">
      <div class="link-box">
        <a href="patient/create_patient.php">Patient Management</a>
      </div>
      <div class="link-box">
        <a href="inpatient/assign_room.php">In-Patient Management</a>
      </div>
      <div class="link-box">
        <a href="staff/add_staff.php">Staff Management</a>
      </div>
    </div>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
</div>
</body>
</html>