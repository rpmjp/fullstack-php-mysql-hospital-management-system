<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Patient</title>
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
      background: white;
      padding: 20px;
      border-radius: 8px;
      max-width: 800px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label { display: block; margin-top: 12px; }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
    }
    button {
      margin-top: 20px;
      background-color: #0077cc;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover { background-color: #005fa3; }
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
    <h2>Register New Patient</h2>

    <?php
    if (isset($_SESSION['status'])) {
      echo "<p class='{$_SESSION['status']}'>" . $_SESSION['msg'] . "</p>";
      unset($_SESSION['status'], $_SESSION['msg']);
    }
    ?>

    <form method="POST">
      <label>Name:</label>
      <input type="text" name="name" placeholder="John Doe" required>

      <label>Gender:</label>
      <select name="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="M">Male</option>
        <option value="F">Female</option>
      </select>

      <label>Date of Birth:</label>
      <input type="date" name="dob" required>

      <label>Street:</label>
      <input type="text" name="street" placeholder="123 Main St" required>

      <label>City:</label>
      <input type="text" name="city" placeholder="Newark" required>

      <label>State:</label>
      <input type="text" name="state" maxlength="2" placeholder="NJ" required>

      <label>Zip:</label>
      <input type="text" name="zip" placeholder="07102" required>

      <label>Phone:</label>
      <input type="text" name="phone" placeholder="(123) 456-7890" data-inputmask="'mask': '(999) 999-9999'" required>

      <label>SSN:</label>
      <input type="text" name="ssn" maxlength="11" placeholder="123-45-6789" data-inputmask="'mask': '999-99-9999'" required>

      <label>Blood Type:</label>
      <select name="blood_type" required>
        <option value="">-- Select Blood Type --</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
      </select>

      <label>HDL:</label>
      <input type="number" name="hdl" placeholder="60" min="0" max="150" required>

      <label>LDL:</label>
      <input type="number" name="ldl" placeholder="100" min="0" max="300" required>

      <label>Triglyceride:</label>
      <input type="number" name="triglyceride" placeholder="150" min="0" max="1000" required>

      <label>Primary Care Physician:</label>
      <select name="physician_id" required>
        <option value="">-- Select Physician --</option>
        <?php
          $res = $conn->query("SELECT P.Employment_No, S.Name FROM PHYSICIAN P JOIN STAFF S ON P.Employment_No = S.Employment_No");
          while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['Employment_No']}'>{$row['Name']} (ID: {$row['Employment_No']})</option>";
          }
        ?>
      </select>

      <label>Illness:</label>
      <select name="illness_id" required>
        <option value="">-- Select Illness --</option>
        <?php
          $ill_res = $conn->query("SELECT Illness_Code, Name FROM ILLNESS");
          if ($ill_res && $ill_res->num_rows > 0) {
            while ($row = $ill_res->fetch_assoc()) {
              echo "<option value='{$row['Illness_Code']}'>{$row['Name']}</option>";
            }
          } else {
            echo "<option disabled>No illnesses found</option>";
          }
        ?>
      </select>

      <button type="submit">Create Patient</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hdl = $_POST['hdl'];
        $ldl = $_POST['ldl'];
        $tri = $_POST['triglyceride'];
        $ssn = $_POST['ssn'];
        $physician_id = $_POST['physician_id'];
        $illness_id = $_POST['illness_id'];

        if (!$physician_id || empty($illness_id)) {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Primary care physician and illness are required.";
            header("Location: create_patient.php");
            exit();
        }

        $total_chol = $hdl + $ldl + ($tri / 5);
        $ratio = $hdl ? $total_chol / $hdl : 0;
        $chol_risk = ($ratio < 4) ? 'N' : (($ratio < 5) ? 'L' : 'M');

        $check = $conn->prepare("SELECT Patient_No FROM PATIENT WHERE SSN = ?");
        $check->bind_param("s", $ssn);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $_SESSION['status'] = "duplicate";
            $_SESSION['msg'] = "A patient with this SSN already exists.";
            $check->close();
            header("Location: create_patient.php");
            exit();
        }
        $check->close();

        $stmt = $conn->prepare("INSERT INTO PATIENT 
            (Name, Gender, DOB, Street, City, State, Zip, Phone, SSN, Blood_Type, HDL, LDL, Triglyceride, Cholesterol_Risk)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssssssiiis",
            $_POST['name'], $_POST['gender'], $_POST['dob'],
            $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip'],
            $_POST['phone'], $ssn, $_POST['blood_type'],
            $hdl, $ldl, $tri, $chol_risk
        );

        if ($stmt->execute()) {
            $patient_id = $stmt->insert_id;
            $stmt->close();

            $pc = $conn->prepare("INSERT INTO Primary_Care (Patient_No, Physician_ID) VALUES (?, ?)");
            $pc->bind_param("ii", $patient_id, $physician_id);
            $pc->execute();
            $pc->close();

            $ill = $conn->prepare("INSERT INTO Patient_Illness (Patient_No, Illness_Code) VALUES (?, ?)");
            $ill->bind_param("is", $patient_id, $illness_id);
            $ill->execute();
            $ill->close();

            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "Patient created successfully!";
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = $stmt->error;
        }

        $conn->close();
        header("Location: create_patient.php");
        exit();
    }
    ?>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/bindings/inputmask.binding.min.js"></script>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    Inputmask().mask(document.querySelectorAll("input"));
  });
</script>
</body>
</html>
