<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']);
include('../connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Patient Medical History</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
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
      flex-grow: 1;
      overflow-y: auto;
      padding: 30px;
    }
    h2, h3 { text-align: center; }
    form {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    select, button {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 25px;
      background: #fff;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
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
    ul {
      margin: 0;
      padding-left: 20px;
    }
    .back-link {
      text-align: center;
      margin: 30px 0;
    }
    .back-link a {
      text-decoration: none;
      color: #0077cc;
    }
    .back-link a:hover {
      text-decoration: underline;
    }
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
    <h2>Patient Medical History</h2>

    <?php
      if (isset($_GET['id']) && !isset($_GET['patient_id'])) {
        $_GET['patient_id'] = $_GET['id'];
      }
    ?>

    <form method="GET">
      <label>Select Patient:</label>
      <select name="patient_id" required>
        <option value="">-- Select Patient --</option>
        <?php
          $res = $conn->query("SELECT Patient_No, Name FROM PATIENT");
          while ($row = $res->fetch_assoc()) {
            $selected = (isset($_GET['patient_id']) && $_GET['patient_id'] == $row['Patient_No']) ? 'selected' : '';
            echo "<option value='{$row['Patient_No']}' $selected>{$row['Patient_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>
      <button type="submit">View History</button>
    </form>

    <?php
    if (isset($_GET['patient_id'])) {
      $patient_id = $_GET['patient_id'];

      $stmt = $conn->prepare("SELECT * FROM PATIENT WHERE Patient_No = ?");
      $stmt->bind_param("i", $patient_id);
      $stmt->execute();
      $patient = $stmt->get_result()->fetch_assoc();
      $stmt->close();

      echo "<h3>History for {$patient['Name']} (Patient No: {$patient['Patient_No']})</h3>";
      echo "<p style='text-align:center;'>Gender: {$patient['Gender']} | DOB: {$patient['DOB']} | Phone: {$patient['Phone']}</p>";

      echo "<h3>Vitals & Lab Metrics</h3>";
      echo "<table><tr><th>HDL</th><th>LDL</th><th>Triglyceride</th><th>Cholesterol Risk</th><th>Blood Type</th></tr>";
      echo "<tr><td>{$patient['HDL']}</td><td>{$patient['LDL']}</td><td>{$patient['Triglyceride']}</td><td>{$patient['Cholesterol_Risk']}</td><td>{$patient['Blood_Type']}</td></tr></table>";

      echo "<h3>Consultations</h3>";
      $stmt = $conn->prepare("SELECT C.Date, C.Time, C.Observation, C.Physician_ID, S.Name AS Physician_Name,
        GROUP_CONCAT(DISTINCT I.Name SEPARATOR ', ') AS Illnesses,
        GROUP_CONCAT(DISTINCT A.Name SEPARATOR ', ') AS Allergies
        FROM Consultation C
        LEFT JOIN PHYSICIAN P ON C.Physician_ID = P.Employment_No
        LEFT JOIN STAFF S ON P.Employment_No = S.Employment_No
        LEFT JOIN Consultation_Illness CI ON CI.Patient_No = C.Patient_No AND CI.Date = C.Date AND CI.Time = C.Time
        LEFT JOIN ILLNESS I ON CI.Illness_Code = I.Illness_Code
        LEFT JOIN Consultation_Allergy CA ON CA.Patient_No = C.Patient_No AND CA.Date = C.Date AND CA.Time = C.Time
        LEFT JOIN ALLERGY A ON CA.Allergy_Code = A.Allergy_Code
        WHERE C.Patient_No = ?
        GROUP BY C.Date, C.Time
        ORDER BY C.Date DESC, C.Time DESC");
      $stmt->bind_param("i", $patient_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $latest_physician = '';
      if ($result->num_rows > 0) {
        echo "<table><tr><th>Date</th><th>Time</th><th>Physician</th><th>Observation</th><th>Illnesses</th><th>Allergies</th></tr>";
        while ($row = $result->fetch_assoc()) {
          if (!$latest_physician) $latest_physician = $row['Physician_ID'];
          echo "<tr><td>{$row['Date']}</td><td>{$row['Time']}</td><td>{$row['Physician_Name']}</td><td>{$row['Observation']}</td><td>{$row['Illnesses']}</td><td>{$row['Allergies']}</td></tr>";
        }
        echo "</table>";
      } else {
        echo "<p>No consultations found.</p>";
      }
      $stmt->close();

      if ($latest_physician) {
        echo "<div style='text-align:center; margin: 20px 0;'>
          <a href='/patient/prescribe_medication.php?patient_id={$patient_id}&physician_id={$latest_physician}' style='padding: 10px 20px; background:#0077cc; color:white; text-decoration:none; border-radius:6px;'>Prescribe Medication</a>
        </div>";
      }

      echo "<h3>Medications Prescribed</h3>";
      $stmt = $conn->prepare("SELECT M.Name, MO.Dosage, MO.Frequency FROM Medication_Order MO JOIN MEDICATION M ON MO.Medication_Code = M.Medication_Code WHERE MO.Patient_No = ?");
      $stmt->bind_param("i", $patient_id);
      $stmt->execute();
      $res = $stmt->get_result();
      if ($res->num_rows > 0) {
        echo "<table><tr><th>Medication</th><th>Dosage</th><th>Frequency</th></tr>";
        while ($row = $res->fetch_assoc()) echo "<tr><td>{$row['Name']}</td><td>{$row['Dosage']}</td><td>{$row['Frequency']}</td></tr>";
        echo "</table>";
      } else echo "<p>No medications prescribed.</p>";
      $stmt->close();

      echo "<h3>Room Assignment</h3>";
      $stmt = $conn->prepare("SELECT R.Room_No, R.Wing, R.Bed_No 
        FROM IN_PATIENT IP 
        JOIN ROOM R ON IP.Room_No = R.Room_No AND IP.Bed_No = R.Bed_No 
        WHERE IP.Patient_No = ?");
      $stmt->bind_param("i", $patient_id);
      $stmt->execute();
      $res = $stmt->get_result();
      if ($res->num_rows > 0) {
        echo "<table><tr><th>Room</th><th>Wing</th><th>Bed</th></tr>";
        while ($row = $res->fetch_assoc()) echo "<tr><td>{$row['Room_No']}</td><td>{$row['Wing']}</td><td>{$row['Bed_No']}</td></tr>";
        echo "</table>";
      } else echo "<p>No room assignment found.</p>";
      $stmt->close();

      echo "<h3>Assigned Nurse</h3>";
      $stmt = $conn->prepare("SELECT S.Employment_No, S.Name FROM Patient_Care PC JOIN STAFF S ON PC.Nurse_ID = S.Employment_No WHERE PC.Patient_No = ?");
      $stmt->bind_param("i", $patient_id);
      $stmt->execute();
      $res = $stmt->get_result();
      if ($res->num_rows > 0) {
        echo "<table><tr><th>Nurse ID</th><th>Name</th></tr>";
        while ($row = $res->fetch_assoc()) echo "<tr><td>{$row['Employment_No']}</td><td>{$row['Name']}</td></tr>";
        echo "</table>";
      } else echo "<p>No nurse assigned.</p>";
      $stmt->close();

      echo "<h3>Surgery Records</h3>";
      $stmt = $conn->prepare("SELECT SR.Surgery_Date, ST.Name AS SurgeryName, ST.Category, ST.Special_Needs, S.Name AS SurgeonName, SR.Outcome, SR.Notes 
        FROM Surgery_Record SR
        JOIN SURGERY_TYPE ST ON SR.Surgery_Code = ST.Surgery_Code
        JOIN STAFF S ON SR.Surgeon_ID = S.Employment_No
        WHERE SR.Patient_No = ?
        ORDER BY SR.Surgery_Date DESC");
      $stmt->bind_param("i", $patient_id);
      $stmt->execute();
      $res = $stmt->get_result();
      if ($res->num_rows > 0) {
        echo "<table><tr><th>Date</th><th>Surgery</th><th>Category</th><th>Special Needs</th><th>Surgeon</th><th>Outcome</th><th>Notes</th></tr>";
        while ($row = $res->fetch_assoc()) {
          echo "<tr><td>{$row['Surgery_Date']}</td><td>{$row['SurgeryName']}</td><td>{$row['Category']}</td><td>{$row['Special_Needs']}</td><td>{$row['SurgeonName']}</td><td>{$row['Outcome']}</td><td>{$row['Notes']}</td></tr>";
        }
        echo "</table>";
      } else echo "<p>No surgeries found.</p>";
      $stmt->close();
    }
    $conn->close();
    ?>

    <div class="back-link">
      <a href="view_patient.php">← Back to Patient List</a>
    </div>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>
</body>
</html>
