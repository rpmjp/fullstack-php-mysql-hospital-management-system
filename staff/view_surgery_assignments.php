<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Surgery Type Assignments</title>
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

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      margin-top: 25px;
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
      background-color: #f1f1f1;
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
    <h2>Surgery Type Assignments to Nurses</h2>

    <table>
      <tr>
        <th>Nurse ID</th>
        <th>Nurse Name</th>
        <th>Surgery Code</th>
        <th>Surgery Name</th>
      </tr>

      <?php
      $sql = "
        SELECT 
          SA.Nurse_ID,
          S.Name AS Nurse_Name,
          ST.Surgery_Code,
          ST.Name AS Surgery_Name
        FROM Surgery_Assign SA
        JOIN STAFF S ON SA.Nurse_ID = S.Employment_No
        JOIN SURGERY_TYPE ST ON SA.Surgery_Code = ST.Surgery_Code
        ORDER BY SA.Surgery_Code
      ";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
            <td>{$row['Nurse_ID']}</td>
            <td>{$row['Nurse_Name']}</td>
            <td>{$row['Surgery_Code']}</td>
            <td>{$row['Surgery_Name']}</td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No nurse assignments found.</td></tr>";
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
