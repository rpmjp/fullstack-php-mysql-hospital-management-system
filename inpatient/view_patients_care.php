<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Nurse-Patient Assignments</title>
  <link rel="stylesheet" href="/assets/style.css?v=1.1">
</head>
<body>

<div class="sidebar">
  <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php'); ?>
</div>

<div class="main-content-area">
  <header>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  </header>

  <div class="page-content">

    <h2>Nurse Patient Assignment Overview</h2>
    <table>
      <tr>
        <th>Nurse ID</th>
        <th>Nurse Name</th>
        <th>Assigned Patient ID</th>
        <th>Patient Name</th>
      </tr>
      <?php
      $sql = "
        SELECT 
          PC.Nurse_ID,
          S.Name AS Nurse_Name,
          P.Patient_No,
          P.Name AS Patient_Name
        FROM Patient_Care PC
        JOIN PATIENT P ON PC.Patient_No = P.Patient_No
        JOIN STAFF S ON PC.Nurse_ID = S.Employment_No
        ORDER BY PC.Nurse_ID
      ";

      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                  <td>{$row['Nurse_ID']}</td>
                  <td>{$row['Nurse_Name']}</td>
                  <td>{$row['Patient_No']}</td>
                  <td>{$row['Patient_Name']}</td>
              </tr>";
          }
      } else {
          echo "<tr><td colspan='4'>No nurse-patient assignments found.</td></tr>";
      }
      ?>
    </table>

    <h2>Nurse Workload Summary</h2>
    <table>
      <tr>
        <th>Nurse ID</th>
        <th>Nurse Name</th>
        <th>Number of Patients</th>
        <th>Status</th>
      </tr>
      <?php
      $workload_sql = "
        SELECT 
          PC.Nurse_ID,
          S.Name AS Nurse_Name,
          COUNT(PC.Patient_No) AS Patient_Count
        FROM Patient_Care PC
        JOIN STAFF S ON PC.Nurse_ID = S.Employment_No
        GROUP BY PC.Nurse_ID
      ";

      $res = $conn->query($workload_sql);
      if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
              $count = $row['Patient_Count'];
              $status = $count < 5 ? "<span class='low'>Below Minimum</span>" : "OK";
              echo "<tr>
                  <td>{$row['Nurse_ID']}</td>
                  <td>{$row['Nurse_Name']}</td>
                  <td>$count</td>
                  <td>$status</td>
              </tr>";
          }
      } else {
          echo "<tr><td colspan='4'>No data available.</td></tr>";
      }

      $conn->close();
      ?>
    </table>

  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

</body>
</html>
