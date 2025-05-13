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
  <link rel="stylesheet" href="/styles/style.css">
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
    <h2>Surgery Type Assignments to Nurses</h2>
    
    <div class="table-wrapper">
      <table class="scrollable-table sticky-header">
        <thead>
          <tr>
            <th>Nurse ID</th>
            <th>Nurse Name</th>
            <th>Surgery Code</th>
            <th>Surgery Name</th>
          </tr>
        </thead>
        <tbody>
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
          if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>
                <td>" . htmlspecialchars($row['Nurse_ID']) . "</td>
                <td>" . htmlspecialchars($row['Nurse_Name']) . "</td>
                <td>" . htmlspecialchars($row['Surgery_Code']) . "</td>
                <td>" . htmlspecialchars($row['Surgery_Name']) . "</td>
              </tr>";
            }
          } else {
            echo "<tr><td colspan='4'>No nurse assignments found.</td></tr>";
          }
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>
</body>
</html>