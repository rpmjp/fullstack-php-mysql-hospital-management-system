<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Consultation History</title>
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
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

    .main-content-area {
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
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .page-content {
      flex-grow: 1;
      padding: 30px;
      overflow-y: auto;
    }

    h2 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #0077cc;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 15px;
    }
  </style>
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
    <h2>Consultation History</h2>

    <table>
      <tr>
        <th>Patient Name</th>
        <th>Physician Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Diagnosis</th>
        <th>Observation</th>
      </tr>

      <?php
        $sql = "
          SELECT 
            P.Name AS PatientName,
            S.Name AS PhysicianName,
            C.Date,
            C.Time,
            C.Diagnosis,
            C.Observation
          FROM CONSULTATION C
          JOIN PATIENT P ON C.Patient_No = P.Patient_No
          JOIN PHYSICIAN PH ON C.Physician_ID = PH.Employment_No
          JOIN STAFF S ON PH.Employment_No = S.Employment_No
          ORDER BY C.Date DESC, C.Time DESC
        ";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['PatientName']}</td>
              <td>{$row['PhysicianName']}</td>
              <td>{$row['Date']}</td>
              <td>{$row['Time']}</td>
              <td>{$row['Diagnosis']}</td>
              <td>{$row['Observation']}</td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No consultations found.</td></tr>";
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
