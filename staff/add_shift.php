<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Assign Shift to Staff</title>
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
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-top: 15px;
    }

    select, input, button {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      box-sizing: border-box;
    }

    button {
      margin-top: 20px;
      background: #0077cc;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 10px;
    }

    button:hover {
      background-color: #005fa3;
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
    <h2>Assign Shift to Staff</h2>

    <form method="POST">
      <label>Select Staff Member:</label>
      <select name="staff_id" required>
        <option value="">-- Select Staff --</option>
        <?php
          $result = $conn->query("SELECT Employment_No, Name FROM STAFF ORDER BY Name");
          while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['Employment_No']}'>{$row['Employment_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Shift Date:</label>
      <input type="date" name="shift_date" required>

      <label>Start Time:</label>
      <input type="time" name="start_time" required>

      <label>End Time:</label>
      <input type="time" name="end_time" required>

      <label>Shift Type:</label>
      <select name="shift_type" required>
        <option value="Morning">Morning</option>
        <option value="Afternoon">Afternoon</option>
        <option value="Evening">Evening</option>
        <option value="Night">Night</option>
      </select>

      <button type="submit">Assign Shift</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $staff_id = $_POST['staff_id'];
      $shift_date = $_POST['shift_date'];
      $start = $_POST['start_time'];
      $end = $_POST['end_time'];
      $type = $_POST['shift_type'];

      $stmt = $conn->prepare("INSERT INTO SHIFT_SCHEDULE (Staff_ID, Shift_Date, Start_Time, End_Time, Shift_Type) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("issss", $staff_id, $shift_date, $start, $end, $type);

      if ($stmt->execute()) {
        echo "<p style='color: green; text-align: center;'>Shift assigned successfully.</p>";
      } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $stmt->error . "</p>";
      }
      $stmt->close();
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
