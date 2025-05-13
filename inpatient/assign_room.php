<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']);
include('../connect.php');

// Get room info from URL if available
$nursing_unit = isset($_GET['nursing_unit']) ? intval($_GET['nursing_unit']) : '';
$room_no = isset($_GET['room_no']) ? intval($_GET['room_no']) : '';
$bed_no = isset($_GET['bed_no']) ? $_GET['bed_no'] : '';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Assign Room to Patient</title>
  <link rel="stylesheet" href="/assets/style.css?v=1.0">
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
    <h2>Assign Room to In-Patient</h2>

    <form method="POST">
      <label>Patient:</label>
      <select name="patient_no" required>
        <option value="">-- Select Patient --</option>
        <?php
          $result = $conn->query("SELECT Patient_No, Name FROM PATIENT");
          while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['Patient_No']}'>{$row['Patient_No']} - {$row['Name']}</option>";
          }
        ?>
      </select>

      <label>Nursing Unit:</label>
      <input type="number" name="nursing_unit" value="<?= htmlspecialchars($nursing_unit) ?>" required>

      <label>Room Number:</label>
      <input type="number" name="room_no" value="<?= htmlspecialchars($room_no) ?>" required>

      <label>Bed (A or B):</label>
      <select name="bed_no" required>
        <option value="">-- Select Bed --</option>
        <option value="A" <?= $bed_no == 'A' ? 'selected' : '' ?>>A</option>
        <option value="B" <?= $bed_no == 'B' ? 'selected' : '' ?>>B</option>
      </select>

      <label>Admission Date:</label>
      <input type="date" name="admission_date" required>

      <button type="submit">Assign Room</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient = $_POST['patient_no'];
        $unit = $_POST['nursing_unit'];
        $room = $_POST['room_no'];
        $bed = $_POST['bed_no'];
        $date = $_POST['admission_date'];

        $check = $conn->prepare("SELECT * FROM IN_PATIENT WHERE Nursing_Unit=? AND Room_No=? AND Bed_No=?");
        $check->bind_param("iis", $unit, $room, $bed);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows > 0) {
            echo "<div class='msg error'>That bed is already occupied. Choose another.</div>";
        } else {
            $stmt = $conn->prepare("INSERT INTO IN_PATIENT (Patient_No, Nursing_Unit, Room_No, Bed_No, Admission_Date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiss", $patient, $unit, $room, $bed, $date);

            if ($stmt->execute()) {
                echo "<div class='msg success'>Room assigned successfully!</div>";
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
