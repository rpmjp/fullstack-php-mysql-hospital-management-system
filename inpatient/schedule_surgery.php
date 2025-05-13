<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php'); 

// Initialize variables for form values persistence in case of error
$formData = [
  'patient_no' => '',
  'surgery_code' => '',
  'surgeon_id' => '',
  'surgery_date' => '',
  'start_time' => '',
  'end_time' => '',
  'room_no' => '',
  'bed_no' => '',
  'notes' => ''
];

// For storing error and success messages
$errorMsg = '';
$successMsg = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $formData = [
    'patient_no' => $_POST['patient_no'] ?? '',
    'surgery_code' => $_POST['surgery_code'] ?? '',
    'surgeon_id' => $_POST['surgeon_id'] ?? '',
    'surgery_date' => $_POST['surgery_date'] ?? '',
    'start_time' => $_POST['start_time'] ?? '',
    'end_time' => $_POST['end_time'] ?? '',
    'room_no' => $_POST['room_no'] ?? '',
    'bed_no' => $_POST['bed_no'] ?? '',
    'notes' => $_POST['notes'] ?? ''
  ];
  
  // Get nursing unit from room number
  $nursing_unit = isset($_POST['room_no']) && !empty($_POST['room_no']) ? 
                  substr($_POST['room_no'], 0, 1) : '';

  // Validate required fields
  $requiredFields = ['patient_no', 'surgery_code', 'surgeon_id', 'surgery_date', 
                    'start_time', 'end_time', 'room_no', 'bed_no'];
  $allFieldsPresent = true;
  
  foreach ($requiredFields as $field) {
    if (empty($formData[$field])) {
      $allFieldsPresent = false;
      break;
    }
  }

  if (!$allFieldsPresent) {
    $errorMsg = "All fields except notes are required. Please fill out all required fields.";
  } else {
    // All fields are present, attempt to insert
    $stmt = $conn->prepare("
      INSERT INTO Surgery_Record 
        (Patient_No, Surgery_Code, Surgery_Date, Surgeon_ID, Notes, Room_No, Bed_No, Nursing_Unit, Start_Time, End_Time, Status) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Scheduled')
    ");
    
    if (!$stmt) {
      $errorMsg = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    } else {
      $stmt->bind_param("issisisiss", 
        $formData['patient_no'], 
        $formData['surgery_code'], 
        $formData['surgery_date'], 
        $formData['surgeon_id'], 
        $formData['notes'], 
        $formData['room_no'], 
        $formData['bed_no'], 
        $nursing_unit, 
        $formData['start_time'], 
        $formData['end_time']
      );

      if ($stmt->execute()) {
        $successMsg = "Surgery scheduled successfully!";
        // Clear form data on success
        $formData = array_fill_keys(array_keys($formData), '');
      } else {
        $errorMsg = "Error: " . $stmt->error;
      }
      $stmt->close();
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Schedule Surgery</title>
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
      margin-bottom: 30px;
    }
    form {
      background: #fff;
      padding: 25px;
      max-width: 650px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    select, input, textarea, button {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    button {
      background: #27ae60;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 20px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s;
    }
    button:hover {
      background-color: #1e8449;
    }
    .msg {
      text-align: center;
      font-weight: bold;
      margin: 20px 0;
      padding: 10px;
      border-radius: 5px;
    }
    .success { 
      color: #155724; 
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
    }
    .error { 
      color: #721c24;
      background-color: #f8d7da;
      border: 1px solid #f5c6cb;
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
    <h2>Schedule a Surgery</h2>
    
    <?php if (!empty($errorMsg)): ?>
      <div class="msg error"><?= $errorMsg ?></div>
    <?php endif; ?>
    
    <?php if (!empty($successMsg)): ?>
      <div class="msg success"><?= $successMsg ?></div>
    <?php endif; ?>
    
    <form method="POST">
      <label>Patient:</label>
      <select name="patient_no" required>
        <option value="">-- Select Patient --</option>
        <?php
          $res = $conn->query("SELECT Patient_No, Name FROM PATIENT ORDER BY Name");
          while ($row = $res->fetch_assoc()) {
            $selected = ($formData['patient_no'] == $row['Patient_No']) ? 'selected' : '';
            echo "<option value='{$row['Patient_No']}' $selected>{$row['Patient_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Surgery Type:</label>
      <select name="surgery_code" required>
        <option value="">-- Select Surgery Type --</option>
        <?php
          $res = $conn->query("SELECT Surgery_Code, Name FROM SURGERY_TYPE ORDER BY Name");
          while ($row = $res->fetch_assoc()) {
            $selected = ($formData['surgery_code'] == $row['Surgery_Code']) ? 'selected' : '';
            echo "<option value='{$row['Surgery_Code']}' $selected>{$row['Surgery_Code']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Surgeon:</label>
      <select name="surgeon_id" required>
        <option value="">-- Select Surgeon --</option>
        <?php
          $res = $conn->query("SELECT SURGEON.Employment_No, STAFF.Name 
                               FROM SURGEON 
                               JOIN STAFF ON SURGEON.Employment_No = STAFF.Employment_No
                               ORDER BY STAFF.Name");
          while ($row = $res->fetch_assoc()) {
            $selected = ($formData['surgeon_id'] == $row['Employment_No']) ? 'selected' : '';
            echo "<option value='{$row['Employment_No']}' $selected>{$row['Employment_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Surgery Date:</label>
      <input type="date" name="surgery_date" value="<?= htmlspecialchars($formData['surgery_date']) ?>" required>

      <label>Start Time:</label>
      <input type="time" name="start_time" value="<?= htmlspecialchars($formData['start_time']) ?>" required>

      <label>End Time:</label>
      <input type="time" name="end_time" value="<?= htmlspecialchars($formData['end_time']) ?>" required>

      <label>Room Number:</label>
      <select id="room_no" name="room_no" required onchange="updateNursingUnit()">
        <option value="">-- Select Room --</option>
        <?php
          $res = $conn->query("SELECT DISTINCT Room_No FROM ROOM ORDER BY Room_No");
          while ($row = $res->fetch_assoc()) {
            $selected = ($formData['room_no'] == $row['Room_No']) ? 'selected' : '';
            echo "<option value='{$row['Room_No']}' $selected>{$row['Room_No']}</option>";
          }
        ?>
      </select>

      <label>Bed:</label>
      <select name="bed_no" required>
        <option value="">-- Select Bed --</option>
        <option value="A" <?= ($formData['bed_no'] == 'A') ? 'selected' : '' ?>>A</option>
        <option value="B" <?= ($formData['bed_no'] == 'B') ? 'selected' : '' ?>>B</option>
      </select>

      <input type="hidden" name="nursing_unit" id="nursing_unit">

      <label>Notes (optional):</label>
      <textarea name="notes" rows="4"><?= htmlspecialchars($formData['notes']) ?></textarea>

      <button type="submit">Schedule Surgery</button>
    </form>
  </div>
  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>
<script>
function updateNursingUnit() {
  const room = document.getElementById("room_no").value;
  document.getElementById("nursing_unit").value = room.charAt(0);
}

// Call once on page load to ensure the nursing unit is set if room is pre-selected
document.addEventListener('DOMContentLoaded', function() {
  updateNursingUnit();
});
</script>
</body>
</html>