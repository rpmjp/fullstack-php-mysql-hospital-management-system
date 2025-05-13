<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']);
include('../connect.php'); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>View All Patients</title>
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
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
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #0077cc;
      color: white;
    }

    tr:hover {
      background-color: #f9f9f9;
      cursor: pointer;
    }

    .actions a {
      margin-right: 8px;
      text-decoration: none;
      color: #0077cc;
      font-weight: bold;
    }

    .actions a:hover {
      text-decoration: underline;
    }

    .btn-delete { color: #cc0000; }
    .btn-history { color: #28a745; }

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
    <h2>Registered Patients</h2>

    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>DOB</th>
        <th>Phone</th>
        <th>Blood Type</th>
        <th>HDL</th>
        <th>LDL</th>
        <th>Triglyceride</th>
        <th>Cholesterol Risk</th>
        <th>Actions</th>
      </tr>

      <?php
        $sql = "SELECT * FROM PATIENT ORDER BY Patient_No DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $id = $row['Patient_No'];
            echo "<tr onclick=\"if(event.target.tagName !== 'A') window.location.href='history.php?id={$id}'\">
              <td>{$id}</td>
              <td>{$row['Name']}</td>
              <td>{$row['Gender']}</td>
              <td>{$row['DOB']}</td>
              <td>{$row['Phone']}</td>
              <td>{$row['Blood_Type']}</td>
              <td>{$row['HDL']}</td>
              <td>{$row['LDL']}</td>
              <td>{$row['Triglyceride']}</td>
              <td>{$row['Cholesterol_Risk']}</td>
              <td class='actions'>
                <a href='edit_patient.php?id={$id}'>Edit</a>
                <a class='btn-delete' href='delete_patient.php?id={$id}' onclick=\"return confirm('Are you sure you want to delete this patient?');\">Delete</a>
              </td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='11'>No patients found.</td></tr>";
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
