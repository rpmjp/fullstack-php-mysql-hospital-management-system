<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php'); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Assign Nurse to In-Patient</title>
  <link rel="stylesheet" href="/assets/style.css?v=1.4">
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
    <h2>Assign Nurse to In-Patient</h2>

    <form method="POST">
      <label>Select Nurse:</label>
      <select name="nurse_id" required>
        <option value="">-- Select Nurse --</option>
        <?php
          $result = $conn->query("SELECT NURSE.Employment_No, STAFF.Name 
                                  FROM NURSE 
                                  JOIN STAFF ON NURSE.Employment_No = STAFF.Employment_No");
          while ($row = $result->fetch_assoc()) {
              echo "<option value='{$row['Employment_No']}'>{$row['Employment_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Select In-Patient:</label>
      <select name="patient_no" required>
        <option value="">-- Select In-Patient --</option>
        <?php
          $result = $conn->query("SELECT IP.Patient_No, P.Name 
                                  FROM IN_PATIENT IP 
                                  JOIN PATIENT P ON IP.Patient_No = P.Patient_No");
          while ($row = $result->fetch_assoc()) {
              echo "<option value='{$row['Patient_No']}'>{$row['Patient_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <button type="submit">Assign</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nurse = $_POST['nurse_id'];
        $patient = $_POST['patient_no'];

        $check = $conn->prepare("SELECT * FROM Patient_Care WHERE Patient_No = ?");
        $check->bind_param("i", $patient);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows > 0) {
            echo "<div class='msg error'>This patient is already assigned to a nurse.</div>";
        } else {
            $stmt = $conn->prepare("INSERT INTO Patient_Care (Nurse_ID, Patient_No) VALUES (?, ?)");
            $stmt->bind_param("ii", $nurse, $patient);

            if ($stmt->execute()) {
                echo "<div class='msg success'>Nurse assigned successfully!</div>";
            } else {
                echo "<div class='msg error'>Error: {$stmt->error}</div>";
            }
            $stmt->close();
        }
        $check->close();
    }
    $conn->close();
    ?>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

</body>
</html>