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

    <div class="table-wrapper">
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
        echo '<table class="scrollable-table sticky-header">';
        echo "<thead><tr>";
        
        // Get column names for headers
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
          echo "<th>" . htmlspecialchars($field->name) . "</th>";
        }
        
        echo "</tr></thead><tbody>";

        // Reset result pointer
        $result->data_seek(0);
        
        // Output data rows
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          foreach ($row as $val) {
            echo "<td>" . htmlspecialchars($val) . "</td>";
          }
          echo "</tr>";
        }
        
        echo "</tbody></table>";
      } else {
        echo "<p>No staff found.</p>";
      }

      $conn->close();
      ?>
    </div>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

</body>
</html>