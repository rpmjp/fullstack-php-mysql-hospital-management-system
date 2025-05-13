<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']);
include('../connect.php');

$pre_patient_id = $_GET['patient_id'] ?? '';
$pre_physician_id = $_GET['physician_id'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Prescribe Medication</title>
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
      overflow-y: auto;
      padding: 30px;
    }
    h2 { text-align: center; }
    form {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label { display: block; margin-top: 15px; }
    select, input {
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
    .alert {
      margin-top: 15px;
      padding: 10px;
      border-radius: 5px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }
    .error { background: #ffe0e0; color: #b30000; }
    .warning { background: #fff3cd; color: #856404; }
    .success { background: #e6ffea; color: #2f6627; }
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
    <h2>Prescribe Medication to Patient</h2>
    <form method="POST">
      <label>Select Patient:</label>
      <select name="patient_id" required>
        <option value="">-- Select Patient --</option>
        <?php
          $res = $conn->query("SELECT Patient_No, Name FROM PATIENT");
          while ($row = $res->fetch_assoc()) {
            $selected = ($row['Patient_No'] == $pre_patient_id) ? 'selected' : '';
            echo "<option value='{$row['Patient_No']}' $selected>{$row['Patient_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>
      <label>Select Physician:</label>
      <select name="physician_id" required>
        <option value="">-- Select Physician --</option>
        <?php
          $res = $conn->query("SELECT PHYSICIAN.Employment_No, STAFF.Name FROM PHYSICIAN JOIN STAFF ON PHYSICIAN.Employment_No = STAFF.Employment_No");
          while ($row = $res->fetch_assoc()) {
            $selected = ($row['Employment_No'] == $pre_physician_id) ? 'selected' : '';
            echo "<option value='{$row['Employment_No']}' $selected>{$row['Employment_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>
      <label>Select Medication:</label>
      <select name="medication_code" required>
        <option value="">-- Select Medication --</option>
        <?php
          $res = $conn->query("SELECT Medication_Code, Name FROM MEDICATION");
          while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['Medication_Code']}'>{$row['Medication_Code']} - {$row['Name']}</option>";
          }
        ?>
      </select>
      <label>Dosage:</label>
      <select name="dosage" required>
        <option value="">-- Select Dosage --</option>
        <option value="1 tablet">1 tablet</option>
        <option value="2 tablets">2 tablets</option>
        <option value="5 mg">5 mg</option>
        <option value="10 mg">10 mg</option>
        <option value="20 mg">20 mg</option>
        <option value="50 mg">50 mg</option>
        <option value="100 mg">100 mg</option>
        <option value="5 mL">5 mL</option>
        <option value="10 mL">10 mL</option>
      </select>
      <label>Frequency:</label>
      <select name="frequency" required>
        <option value="">-- Select Frequency --</option>
        <option value="Once daily">Once daily</option>
        <option value="Twice daily">Twice daily</option>
        <option value="Three times a day">Three times a day</option>
        <option value="Every 4 hours">Every 4 hours</option>
        <option value="Every 8 hours">Every 8 hours</option>
        <option value="At bedtime">At bedtime</option>
        <option value="As needed">As needed</option>
      </select>
      <button type="submit">Prescribe</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $patient_id = $_POST['patient_id'];
      $physician_id = $_POST['physician_id'];
      $med_code = $_POST['medication_code'];
      $dosage = $_POST['dosage'];
      $frequency = $_POST['frequency'];

      // Get the name of the current medication being prescribed
      $med_name_query = $conn->prepare("SELECT Name FROM MEDICATION WHERE Medication_Code = ?");
      $med_name_query->bind_param("s", $med_code);
      $med_name_query->execute();
      $med_name_result = $med_name_query->get_result();
      $med_name_row = $med_name_result->fetch_assoc();
      $current_med_name = $med_name_row['Name'];

      $check = $conn->prepare("SELECT * FROM Medication_Order WHERE Physician_ID=? AND Patient_No=? AND Medication_Code=?");
      $check->bind_param("iis", $physician_id, $patient_id, $med_code);
      $check->execute();
      $result = $check->get_result();

      if ($result->num_rows > 0) {
        echo "<div class='alert error'>This physician already prescribed this medication to the patient.</div>";
      } else {
        $conflict = false;
        $conflicts = array(); // Store all conflicts, not just the last one
        
        // Prepare statement to get current medications
        $current_meds_stmt = $conn->prepare("SELECT mo.Medication_Code, m.Name 
                                            FROM Medication_Order mo 
                                            JOIN MEDICATION m ON mo.Medication_Code = m.Medication_Code 
                                            WHERE Patient_No = ?");
        $current_meds_stmt->bind_param("i", $patient_id);
        $current_meds_stmt->execute();
        $current_meds = $current_meds_stmt->get_result();
        
        while ($row = $current_meds->fetch_assoc()) {
          $existing = $row['Medication_Code'];
          $existing_name = $row['Name'];
          
          $check_inter = $conn->prepare("SELECT Severity FROM Drug_Interaction 
                                        WHERE (Medication_Code_1 = ? AND Medication_Code_2 = ?) 
                                        OR (Medication_Code_1 = ? AND Medication_Code_2 = ?)");
          $check_inter->bind_param("ssss", $med_code, $existing, $existing, $med_code);
          $check_inter->execute();
          $inter_res = $check_inter->get_result();
          
          while ($int = $inter_res->fetch_assoc()) {
            if ($int['Severity'] == 'S' || $int['Severity'] == 'M') {
              $conflict = true;
              $severity_text = ($int['Severity'] == 'S') ? 'Severe' : 'Moderate';
              $conflicts[] = array(
                'med_name' => $existing_name,
                'severity' => $severity_text
              );
            }
          }
        }

        if ($conflict) {
          echo "<div class='alert warning'><strong>WARNING: Cannot prescribe $current_med_name due to potential drug interactions:</strong><br>";
          foreach ($conflicts as $conflict_detail) {
            echo "- $current_med_name has a {$conflict_detail['severity']} interaction with {$conflict_detail['med_name']}<br>";
          }
          echo "Prescription not added for patient safety.</div>";
        } else {
          $stmt = $conn->prepare("INSERT INTO Medication_Order (Physician_ID, Patient_No, Medication_Code, Dosage, Frequency, Prescription_Date) VALUES (?, ?, ?, ?, ?, CURDATE())");
          $stmt->bind_param("iisss", $physician_id, $patient_id, $med_code, $dosage, $frequency);
          if ($stmt->execute()) {
            echo "<div class='alert success'>Medication prescribed successfully.</div>";
          } else {
            echo "<div class='alert error'>Error: {$stmt->error}</div>";
          }
        }
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