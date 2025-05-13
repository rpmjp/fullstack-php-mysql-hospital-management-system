<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');

if (isset($_GET['patient']) && isset($_GET['physician']) && isset($_GET['date']) && isset($_GET['time'])) {
    $patient = $_GET['patient'];
    $physician = $_GET['physician'];
    $date = $_GET['date'];
    $time = $_GET['time'];

    $stmt = $conn->prepare("SELECT * FROM CONSULTATION WHERE Patient_No = ? AND Physician_ID = ? AND Date = ? AND Time = ?");
    $stmt->bind_param("iiss", $patient, $physician, $date, $time);
    $stmt->execute();
    $result = $stmt->get_result();
    $consult = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Consultation</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
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
      flex-shrink: 0;
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .page-content {
      padding: 30px;
      overflow-y: auto;
      flex-grow: 1;
    }
    h2 { text-align: center; }
    form {
      background: #fff;
      max-width: 600px;
      margin: auto;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label { display: block; margin-top: 15px; }
    input, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
    }
    button {
      margin-top: 20px;
      padding: 10px 20px;
      background: #0077cc;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover { background-color: #005fa3; }
    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 15px;
      flex-shrink: 0;
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
    <h2>Edit Consultation</h2>

    <form method="POST">
      <input type="hidden" name="patient" value="<?= $patient ?>">
      <input type="hidden" name="physician" value="<?= $physician ?>">
      <input type="hidden" name="date" value="<?= $date ?>">
      <input type="hidden" name="time" value="<?= $time ?>">

      <label>Diagnosis:</label>
      <textarea name="diagnosis" rows="3"><?= $consult['Diagnosis'] ?? '' ?></textarea>

      <label>Observation:</label>
      <textarea name="observation" rows="3"><?= $consult['Observation'] ?? '' ?></textarea>

      <button type="submit" name="update">Update Consultation</button>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $diagnosis = $_POST['diagnosis'];
        $observation = $_POST['observation'];

        $update = $conn->prepare("UPDATE CONSULTATION SET Diagnosis = ?, Observation = ? WHERE Patient_No = ? AND Physician_ID = ? AND Date = ? AND Time = ?");
        $update->bind_param("ssiiss", $diagnosis, $observation, $patient, $physician, $date, $time);

        if ($update->execute()) {
            echo "<p style='color: green; text-align:center;'>Consultation updated successfully.</p>";
        } else {
            echo "<p style='color: red; text-align:center;'>Error: {$update->error}</p>";
        }
        $conn->close();
    }
    ?>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>
</body>
</html>
