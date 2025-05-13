<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Schedule Consultation</title>
  <style>
    * { box-sizing: border-box; }
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
      max-width: 700px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label { display: block; margin-top: 15px; }
    input, select, textarea {
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
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #005fa3;
    }
    .success { color: green; text-align: center; }
    .error { color: red; text-align: center; }
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
    <h2>Schedule Patient Consultation</h2>

    <?php
    if (isset($_SESSION['status']) && isset($_SESSION['msg'])) {
      $statusClass = ($_SESSION['status'] === "success") ? "success" : "error";
      echo "<p class='{$statusClass}'>{$_SESSION['msg']}</p>";
      unset($_SESSION['status'], $_SESSION['msg']);
    }
    ?>

    <form method="POST">
      <label>Patient:</label>
      <select name="patient_id" required>
        <option value="">-- Select Patient --</option>
        <?php
          $res = $conn->query("SELECT Patient_No, Name FROM PATIENT");
          while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['Patient_No']}'>{$row['Patient_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Physician:</label>
      <select name="physician_id" required>
        <option value="">-- Select Physician --</option>
        <?php
          $res = $conn->query("SELECT PHYSICIAN.Employment_No, STAFF.Name FROM PHYSICIAN JOIN STAFF ON PHYSICIAN.Employment_No = STAFF.Employment_No");
          while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['Employment_No']}'>{$row['Employment_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Date:</label>
      <input type="date" name="date" required>

      <label>Time:</label>
      <input type="time" name="time" required>

      <label>Observation (optional):</label>
      <textarea name="observation" rows="3"></textarea>

      <label>Diagnosed Illness (optional):</label>
      <select name="illness_code">
        <option value="">-- Select Illness --</option>
        <?php
          $res = $conn->query("SELECT Illness_Code, Name FROM ILLNESS");
          while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['Illness_Code']}'>{$row['Illness_Code']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Diagnosis Notes:</label>
      <textarea name="diagnosis_notes" rows="2"></textarea>

      <label>Diagnosed Allergy (optional):</label>
      <select name="allergy_code">
        <option value="">-- Select Allergy --</option>
        <?php
          $res = $conn->query("SELECT Allergy_Code, Name FROM ALLERGY");
          while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['Allergy_Code']}'>{$row['Allergy_Code']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Reaction Notes:</label>
      <textarea name="reaction_notes" rows="2"></textarea>

      <button type="submit">Schedule</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $patient = $_POST['patient_id'];
      $physician = $_POST['physician_id'];
      $date = $_POST['date'];
      $time = $_POST['time'];
      $observation = $_POST['observation'];
      $illness_code = $_POST['illness_code'];
      $diagnosis_notes = $_POST['diagnosis_notes'];
      $allergy_code = $_POST['allergy_code'];
      $reaction_notes = $_POST['reaction_notes'];

      $check = $conn->prepare("SELECT * FROM Consultation WHERE Patient_No = ? AND Physician_ID = ? AND Date = ? AND Time = ?");
      $check->bind_param("iiss", $patient, $physician, $date, $time);
      $check->execute();
      $result = $check->get_result();

      if ($result->num_rows > 0) {
        $_SESSION['status'] = "duplicate";
        $_SESSION['msg'] = "Consultation already exists for this patient at that time.";
      } else {
        $stmt = $conn->prepare("INSERT INTO Consultation (Patient_No, Physician_ID, Date, Time, Observation) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $patient, $physician, $date, $time, $observation);

        if ($stmt->execute()) {
          if (!empty($illness_code)) {
            $ill_stmt = $conn->prepare("INSERT INTO Consultation_Illness (Patient_No, Physician_ID, Date, Time, Illness_Code, Diagnosis_Notes) VALUES (?, ?, ?, ?, ?, ?)");
            $ill_stmt->bind_param("iissss", $patient, $physician, $date, $time, $illness_code, $diagnosis_notes);
            $ill_stmt->execute();
            $ill_stmt->close();
          }

          if (!empty($allergy_code)) {
            $all_stmt = $conn->prepare("INSERT INTO Consultation_Allergy (Patient_No, Physician_ID, Date, Time, Allergy_Code, Reaction_Notes) VALUES (?, ?, ?, ?, ?, ?)");
            $all_stmt->bind_param("iissss", $patient, $physician, $date, $time, $allergy_code, $reaction_notes);
            $all_stmt->execute();
            $all_stmt->close();
          }

          $_SESSION['status'] = "success";
          $_SESSION['msg'] = "Consultation scheduled successfully.";
        } else {
          $_SESSION['status'] = "error";
          $_SESSION['msg'] = $stmt->error;
        }
        $stmt->close();
      }
      $check->close();
      $conn->close();

      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    }
    ?>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>
</body>
</html>