<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>View Consultations by Physician</title>
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

    h2 { text-align: center; }

    form {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    label { display: block; margin-top: 15px; }

    select, input[type=date] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
    }

    button {
      margin-top: 20px;
      background: #0077cc;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
    }

    button:hover {
      background-color: #005fa3;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #0077cc;
      color: white;
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
    <h2>Consultations by Physician</h2>

    <form method="GET">
      <label>Select Physician:</label>
      <select name="physician_id" required>
        <option value="">-- Select Physician --</option>
        <?php
          $result = $conn->query("SELECT PHYSICIAN.Employment_No, STAFF.Name FROM PHYSICIAN JOIN STAFF ON PHYSICIAN.Employment_No = STAFF.Employment_No");
          while ($row = $result->fetch_assoc()) {
            $selected = isset($_GET['physician_id']) && $_GET['physician_id'] == $row['Employment_No'] ? 'selected' : '';
            echo "<option value='{$row['Employment_No']}' $selected>{$row['Employment_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Optional: Select Date</label>
      <input type="date" name="date" value="<?php echo $_GET['date'] ?? ''; ?>">

      <button type="submit">View</button>
    </form>

    <?php
    if (isset($_GET['physician_id'])) {
      $physician_id = $_GET['physician_id'];
      $date = $_GET['date'] ?? '';

      $sql = "
        SELECT P.Name AS PatientName, C.Date, C.Time, C.Diagnosis, C.Observation
        FROM CONSULTATION C
        JOIN PATIENT P ON C.Patient_No = P.Patient_No
        WHERE C.Physician_ID = ?";

      if ($date) {
        $sql .= " AND C.Date = ? ORDER BY C.Time";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $physician_id, $date);
      } else {
        $sql .= " ORDER BY C.Date DESC, C.Time DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $physician_id);
      }

      $stmt->execute();
      $result = $stmt->get_result();

      echo "<table>
        <tr><th>Patient</th><th>Date</th><th>Time</th><th>Diagnosis</th><th>Observation</th></tr>";

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
            <td>{$row['PatientName']}</td>
            <td>{$row['Date']}</td>
            <td>{$row['Time']}</td>
            <td>{$row['Diagnosis']}</td>
            <td>{$row['Observation']}</td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='5'>No consultations found for this physician.</td></tr>";
      }
      echo "</table>";
    }
    ?>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

</body>
</html>
