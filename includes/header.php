<?php session_start(); ?>
<div class="top-header">
  <div class="logo-title">
    <a href="/index.php">
      <img src="/assets/images/Newark-medical-associates-logo.png" alt="Newark Medical Associates" class="logo">
    </a>
    <h1></h1>
  </div>

  <nav class="top-nav">
    <?php if (basename($_SERVER['PHP_SELF']) == 'index.php'): ?>
      <!-- Home Page: show Home + Login/Logout -->
      <a href="/index.php">Home</a>
      <?php if (isset($_SESSION['role'])): ?>
        <a href="/logout.php">Logout</a>
      <?php else: ?>
        <a href="/login.php">Login</a>
      <?php endif; ?>
    <?php else: ?>
      <!-- Inner Pages: show full navigation -->
      <a href="/patient/view_patient.php">View Patients</a>
      <a href="/inpatient/view_rooms.php">In-Patient</a>
      <a href="/staff/view_staff.php">Staff</a>
      <a href="/logout.php">Logout</a>
    <?php endif; ?>
  </nav>
</div>

<style>
.top-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: white;
  padding: 10px 20px;
  border-bottom: 1px solid #ccc;
  height: 80px;
}

.logo-title {
  display: flex;
  align-items: center;
  gap: 15px;
}

.logo {
  height: 50px;
  width: auto;
}

.top-nav a {
  margin-left: 20px;
  text-decoration: none;
  color: #255fb4;
  font-weight: bold;
}
</style>
