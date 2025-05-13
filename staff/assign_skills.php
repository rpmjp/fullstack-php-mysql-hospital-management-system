<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Assign Surgery Skills to Nurse</title>
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
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-top: 15px;
    }

    select, button {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
    }

    button {
      background: #0077cc;
      color: white;
      border: none;
      margin-top: 20px;
      border-radius: 5px;
    }

    button:hover {
      background-color: #005fa3;
    }

    .success {
      color: green;
      text-align: center;
      margin-top: 20px;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 20px;
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
    <h2>Assign Surgery Skills to Nurse</h2>

    <form method="POST">
      <label>Select Nurse:</label>
      <select name="nurse_id" required>
        <option value="">-- Select Nurse --</option>
        <?php
          $res = $conn->query("SELECT NURSE.Employment_No, STAFF.Name FROM NURSE JOIN STAFF ON NURSE.Employment_No = STAFF.Employment_No");
          while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['Employment_No']}'>{$row['Employment_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Select Skill(s):</label>
      <select name="skills[]" multiple size="6" required>
        <?php
          $res = $conn->query("SELECT Skill_Code, Description FROM SURGERY_SKILL ORDER BY Description");
          while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['Skill_Code']}'>{$row['Skill_Code']} - {$row['Description']}</option>";
          }
        ?>
      </select>

      <button type="submit">Assign Skills</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nurse_id = $_POST['nurse_id'];
      $skills = $_POST['skills'];

      $success = 0;
      $errors = 0;

      foreach ($skills as $skill_code) {
        $stmt = $conn->prepare("INSERT IGNORE INTO Skill_Certified (Nurse_ID, Skill_Code) VALUES (?, ?)");
        $stmt->bind_param("is", $nurse_id, $skill_code);
        if ($stmt->execute()) {
          $success++;
        } else {
          $errors++;
        }
      }

      if ($success > 0) {
        echo "<p class='success'>Assigned $success skill(s) successfully.</p>";
      }
      if ($errors > 0) {
        echo "<p class='error'>$errors skill(s) could not be assigned (possible duplicates).</p>";
      }
    }
    ?>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

</body>
</html>
