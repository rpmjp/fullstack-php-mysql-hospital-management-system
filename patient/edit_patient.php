<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');

if (!isset($_GET['id'])) {
  echo "<p style='color:red;'>No patient selected.</p>";
  exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM PATIENT WHERE Patient_No = $id");

if ($result->num_rows !== 1) {
  echo "<p style='color:red;'>Patient not found.</p>";
  exit;
}

$patient = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $phone = $_POST['phone'];
  $blood_type = $_POST['blood_type'];
  $hdl = $_POST['hdl'];
  $ldl = $_POST['ldl'];
  $tri = $_POST['triglyceride'];

  $total_cholesterol = $hdl + $ldl + ($tri / 5);
  $chol_risk = ($hdl > 0) ? $total_cholesterol / $hdl : 0;

  if ($chol_risk < 4) $risk = 'N';
  else if ($chol_risk < 5) $risk = 'L';
  else $risk = 'M';

  $stmt = $conn->prepare("UPDATE PATIENT SET Name=?, Gender=?, DOB=?, Phone=?, Blood_Type=?, HDL=?, LDL=?, Triglyceride=?, Cholesterol_Risk=? WHERE Patient_No=?");
  $stmt->bind_param("sssssiissi", $name, $gender, $dob, $phone, $blood_type, $hdl, $ldl, $tri, $risk, $id);

  if ($stmt->execute()) {
    echo "<p style='color:green; text-align:center;'>Patient updated successfully.</p>";
  } else {
    echo "<p style='color:red; text-align:center;'>Error: {$stmt->error}</p>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Patient</title>
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
    h2 {
      text-align: center;
    }
    form {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 25px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      border-radius: 8px;
    }
    label { display: block; margin-top: 12px; }
    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
    }
    button {
      background: #0077cc;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      margin-top: 20px;
      cursor: pointer;
    }
    button:hover {
      background-color: #005fa3;
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
    <h2>Edit Patient</h2>

    <form method="POST">
      <label>Name:</label>
      <input type="text" name="name" value="<?= $patient['Name'] ?>" required>

      <label>Gender:</label>
      <select name="gender" required>
        <option value="M" <?= $patient['Gender'] == 'M' ? 'selected' : '' ?>>Male</option>
        <option value="F" <?= $patient['Gender'] == 'F' ? 'selected' : '' ?>>Female</option>
      </select>

      <label>Date of Birth:</label>
      <input type="date" name="dob" value="<?= $patient['DOB'] ?>" required>

      <label>Phone:</label>
      <input type="text" name="phone" value="<?= $patient['Phone'] ?>" required>

      <label>Blood Type:</label>
      <input type="text" name="blood_type" value="<?= $patient['Blood_Type'] ?>" required>

      <label>HDL:</label>
      <input type="number" name="hdl" value="<?= $patient['HDL'] ?>" required>

      <label>LDL:</label>
      <input type="number" name="ldl" value="<?= $patient['LDL'] ?>" required>

      <label>Triglyceride:</label>
      <input type="number" name="triglyceride" value="<?= $patient['Triglyceride'] ?>" required>

      <button type="submit">Update Patient</button>
    </form>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

</body>
</html>
