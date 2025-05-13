<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Staff</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .sidebar {
      width: 250px;
      background-color: #255fb4;
      color: white;
      padding-top: 20px;
      height: 100vh;
      position: fixed;
      overflow-y: auto;
    }

    .main-wrapper {
      margin-left: 250px;
      width: calc(100% - 250px);
      display: flex;
      flex-direction: column;
      height: 100vh;
    }

    header {
      background: white;
      padding: 10px 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      z-index: 999;
    }

    .main-content {
      padding: 30px;
      overflow-y: auto;
      flex-grow: 1;
    }

    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 15px 20px;
      flex-shrink: 0;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    form {
      max-width: 400px;
      margin: auto;
      background: #fff;
      padding: 20px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      border-radius: 8px;
    }

    select, button {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
    }

    table {
      width: 100%;
      margin-top: 30px;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
    }

    th {
      background: #0077cc;
      color: white;
    }

    tr:hover {
      background: #f1f1f1;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php'); ?>
</div>

<div class="main-wrapper">
  <header>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  </header>

  <div class="main-content">
    <h2>View Staff Members</h2>

    <form method="GET">
      <label for="type">Filter by Staff Type:</label>
      <select name="type" id="type">
        <option value="">-- All Types --</option>
        <option value="PHYSICIAN" <?= ($_GET['type'] ?? '') == 'PHYSICIAN' ? 'selected' : '' ?>>Physician</option>
        <option value="NURSE" <?= ($_GET['type'] ?? '') == 'NURSE' ? 'selected' : '' ?>>Nurse</option>
        <option value="SURGEON" <?= ($_GET['type'] ?? '') == 'SURGEON' ? 'selected' : '' ?>>Surgeon</option>
      </select>
      <button type="submit">View</button>
    </form>

    <?php
    $type = $_GET['type'] ?? '';

    if ($type == 'PHYSICIAN') {
      $sql = "SELECT S.Employment_No, S.Name, S.Gender, P.Specialty, P.Salary
              FROM STAFF S
              JOIN PHYSICIAN P ON S.Employment_No = P.Employment_No";
    } elseif ($type == 'NURSE') {
      $sql = "SELECT S.Employment_No, S.Name, S.Gender, N.Grade, N.Experience, N.Salary
              FROM STAFF S
              JOIN NURSE N ON S.Employment_No = N.Employment_No";
    } elseif ($type == 'SURGEON') {
      $sql = "SELECT S.Employment_No, S.Name, S.Gender, SU.Specialty, SU.Contract_Type, SU.Contract_Length
              FROM STAFF S
              JOIN SURGEON SU ON S.Employment_No = SU.Employment_No";
    } else {
      $sql = "SELECT Employment_No, Name, Gender FROM STAFF";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table><tr>";
      foreach ($result->fetch_fields() as $field) {
        echo "<th>{$field->name}</th>";
      }
      echo "</tr>";

      $result->data_seek(0);
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $val) {
          echo "<td>$val</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "<p style='text-align:center;'>No staff found.</p>";
    }

    $conn->close();
    ?>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

</body>
</html>
