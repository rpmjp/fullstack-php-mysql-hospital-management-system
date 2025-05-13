<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Staff Member</title>
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
    form {
      background: #fff;
      padding: 25px;
      width: 100%;
      max-width: 900px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 { text-align: center; color: #333; }
    label { display: block; margin-top: 15px; }
    input, select {
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
    .conditional { display: none; }
  </style>

  <!-- Inputmask CDN -->
  <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/bindings/inputmask.binding.min.js"></script>
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
    <h2>Add Staff Member</h2>

    <?php
    if (isset($_SESSION['status'])) {
      if ($_SESSION['status'] == "duplicate") {
        echo "<p style='color:red; text-align:center;'>A staff member with this SSN already exists.</p>";
      } elseif ($_SESSION['status'] == "success") {
        echo "<p style='color:green; text-align:center;'>Staff member added successfully. ID: {$_SESSION['emp_id']}</p>";
      } elseif ($_SESSION['status'] == "sub_error" || $_SESSION['status'] == "main_error") {
        echo "<p style='color:red; text-align:center;'>Error: {$_SESSION['msg']}</p>";
      }
      session_unset();
    }
    ?>

    <form method="POST">
      <label>Name:</label>
      <input type="text" name="name" required>

      <label>Gender:</label>
      <select name="gender" required>
        <option value="">-- Select --</option>
        <option value="M">Male</option>
        <option value="F">Female</option>
      </select>

      <label>Phone:</label>
      <input type="text" name="phone" placeholder="(123) 456-7890" required data-inputmask="'mask': '(999) 999-9999'">

      <label>SSN:</label>
      <input type="text" name="ssn" placeholder="123-45-6789" required data-inputmask="'mask': '999-99-9999'">

      <label>Address:</label>
      <input type="text" name="street" placeholder="Street" required>
      <input type="text" name="city" placeholder="City" required>
      <input type="text" name="state" placeholder="State" required>
      <input type="text" name="zip" placeholder="Zip" required>

      <label>Job Type:</label>
      <select name="type" id="type" onchange="showFields()" required>
        <option value="">-- Select Type --</option>
        <option value="Physician">Physician</option>
        <option value="Surgeon">Surgeon</option>
        <option value="Nurse">Nurse</option>
      </select>

      <div class="conditional physician">
        <label>Salary:</label>
        <input type="text" name="salary_physician" placeholder="$85,000.00" data-inputmask="'alias': 'currency', 'prefix': '$', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2">
        <label>Specialty:</label>
        <input type="text" name="specialty_physician">
      </div>

      <div class="conditional surgeon">
        <label>Specialty:</label>
        <input type="text" name="specialty_surgeon">
        <label>Contract Type:</label>
        <input type="text" name="contract_type">
        <label>Contract Length (years):</label>
        <input type="number" name="contract_length" min="1" max="30">
      </div>

      <div class="conditional nurse">
        <label>Salary:</label>
        <input type="text" name="salary_nurse" placeholder="$55,000.00" data-inputmask="'alias': 'currency', 'prefix': '$', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2">
        <label>Grade:</label>
        <input type="text" name="grade">
        <label>Experience (years):</label>
        <input type="number" name="experience" min="0" max="50">
      </div>

      <button type="submit">Add Staff</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      function clean_money($value) {
        return floatval(preg_replace('/[^\d.]/', '', $value));
      }

      $name = $_POST['name'];
      $gender = $_POST['gender'];
      $phone = $_POST['phone'];
      $ssn = $_POST['ssn'];
      $street = $_POST['street'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $zip = $_POST['zip'];
      $type = $_POST['type'];

      $check = $conn->prepare("SELECT Employment_No FROM STAFF WHERE SSN = ?");
      $check->bind_param("s", $ssn);
      $check->execute();
      $check->store_result();
      if ($check->num_rows > 0) {
        $_SESSION['status'] = "duplicate";
        header("Location: add_staff.php");
        exit();
      }
      $check->close();

      $stmt = $conn->prepare("INSERT INTO STAFF (Name, Gender, Street, City, State, Zip, Phone, SSN) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssssss", $name, $gender, $street, $city, $state, $zip, $phone, $ssn);

      if ($stmt->execute()) {
        $emp_no = $stmt->insert_id;

        if ($type == "Physician") {
          $salary = clean_money($_POST['salary_physician']);
          $specialty = $_POST['specialty_physician'];
          $sub_stmt = $conn->prepare("INSERT INTO PHYSICIAN (Employment_No, Salary, Specialty) VALUES (?, ?, ?)");
          $sub_stmt->bind_param("ids", $emp_no, $salary, $specialty);
        } elseif ($type == "Surgeon") {
          $specialty = $_POST['specialty_surgeon'];
          $contract_type = $_POST['contract_type'];
          $contract_length = $_POST['contract_length'];
          $sub_stmt = $conn->prepare("INSERT INTO SURGEON (Employment_No, Specialty, Contract_Type, Contract_Length) VALUES (?, ?, ?, ?)");
          $sub_stmt->bind_param("issi", $emp_no, $specialty, $contract_type, $contract_length);
        } elseif ($type == "Nurse") {
          $salary = clean_money($_POST['salary_nurse']);
          $grade = $_POST['grade'];
          $experience = $_POST['experience'];
          $sub_stmt = $conn->prepare("INSERT INTO NURSE (Employment_No, Salary, Grade, Experience) VALUES (?, ?, ?, ?)");
          $sub_stmt->bind_param("idss", $emp_no, $salary, $grade, $experience);
        }

        if ($sub_stmt->execute()) {
          $_SESSION['status'] = "success";
          $_SESSION['emp_id'] = $emp_no;
        } else {
          $_SESSION['status'] = "sub_error";
          $_SESSION['msg'] = $sub_stmt->error;
        }
      } else {
        $_SESSION['status'] = "main_error";
        $_SESSION['msg'] = $stmt->error;
      }

      header("Location: add_staff.php");
      exit();
    }
    ?>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

<script>
  function showFields() {
    const type = document.getElementById("type").value;
    document.querySelectorAll(".conditional").forEach(e => e.style.display = "none");
    if (type) {
      const shown = document.querySelectorAll("." + type.toLowerCase());
      shown.forEach(e => e.style.display = "block");
      Inputmask().mask(shown.querySelectorAll("input"));
    }
  }

  window.addEventListener('DOMContentLoaded', () => {
    Inputmask().mask(document.querySelectorAll("input"));
  });
</script>

</body>
</html>
