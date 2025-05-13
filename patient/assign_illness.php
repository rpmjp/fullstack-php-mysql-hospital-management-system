<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Assign Illness to Patient</title>
  <style>
    body { margin: 0; font-family: Arial, sans-serif; background: #f0f2f5; }
    .container { max-width: 600px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { text-align: center; }
    label { display: block; margin-top: 15px; }
    select, button { width: 100%; padding: 10px; margin-top: 5px; }
    .success { color: green; text-align: center; }
    .error { color: red; text-align: center; }
  </style>
</head>
<body>

<div class="container">
  <h2>Assign Illness to Patient</h2>

  <form method="POST">
    <label>Select Patient:</label>
    <select name="patient_id" required>
      <option value="">-- Select Patient --</option>
      <?php
      $res = $conn->query("SELECT Patient_No, Name FROM PATIENT");
      while ($row = $res->fetch_assoc()) {
        echo "<option value='{$row['Patient_No']}'>{$row['Patient_No']} - {$row['Name']}</option>";
      }
      ?>
    </select>

    <label>Select Illness:</label>
    <select name="illness_code" required>
      <option value="">-- Select Illness --</option>
      <?php
      $res = $conn->query("SELECT Illness_Code, Description FROM ILLNESS");
      while ($row = $res->fetch_assoc()) {
        echo "<option value='{$row['Illness_Code']}'>{$row['Illness_Code']} - {$row['Description']}</option>";
      }
      ?>
    </select>

    <button type="submit">Assign Illness</button>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $illness_code = $_POST['illness_code'];

    // Prevent duplicates
    $check = $conn->prepare("SELECT * FROM PATIENT_ILLNESS WHERE Patient_No = ? AND Illness_Code = ?");
    $check->bind_param("is", $patient_id, $illness_code);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      echo "<p class='error'>This illness is already assigned to the patient.</p>";
    } else {
      $stmt = $conn->prepare("INSERT INTO PATIENT_ILLNESS (Patient_No, Illness_Code) VALUES (?, ?)");
      $stmt->bind_param("is", $patient_id, $illness_code);
      if ($stmt->execute()) {
        echo "<p class='success'>Illness assigned successfully.</p>";
      } else {
        echo "<p class='error'>Error: {$stmt->error}</p>";
      }
    }

    $check->close();
  }

  $conn->close();
  ?>
</div>

</body>
</html>
