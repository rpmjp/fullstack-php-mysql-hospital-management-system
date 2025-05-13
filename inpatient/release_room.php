<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']);
include('../connect.php');

// Initialize
$nursing_unit = $_GET['nursing_unit'] ?? '';
$room_no = $_GET['room_no'] ?? '';
$bed_no = $_GET['bed_no'] ?? '';
$patient_no = '';
$patient_name = '';

// Try to get patient details for pre-fill
if ($nursing_unit && $room_no && $bed_no) {
  $stmt = $conn->prepare("SELECT IP.Patient_No, P.Name 
                          FROM IN_PATIENT IP
                          JOIN PATIENT P ON IP.Patient_No = P.Patient_No
                          WHERE IP.Nursing_Unit = ? AND IP.Room_No = ? AND IP.Bed_No = ?");
  $stmt->bind_param("iis", $nursing_unit, $room_no, $bed_no);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    $patient_no = $row['Patient_No'];
    $patient_name = $row['Name'];
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Release In-Patient Room</title>
  <link rel="stylesheet" href="/assets/style.css?v=1.1">
  <style>
    /* Page-specific styles not in the main stylesheet */
    button {
      background: #c0392b; /* Red color for release button */
      color: white;
    }
    button:hover {
      background-color: #a93226;
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
    <h2>Release Room from In-Patient</h2>

    <form method="POST">
      <label>Patient Name:</label>
      <input type="text" value="<?= htmlspecialchars($patient_name) ?>" disabled>

      <input type="hidden" name="patient_no" value="<?= htmlspecialchars($patient_no) ?>">

      <label>Nursing Unit:</label>
      <input type="number" name="nursing_unit" value="<?= htmlspecialchars($nursing_unit) ?>" required>

      <label>Room Number:</label>
      <input type="number" name="room_no" value="<?= htmlspecialchars($room_no) ?>" required>

      <label>Bed (A or B):</label>
      <select name="bed_no" required>
        <option value="A" <?= $bed_no === 'A' ? 'selected' : '' ?>>A</option>
        <option value="B" <?= $bed_no === 'B' ? 'selected' : '' ?>>B</option>
      </select>

      <button type="submit">Release Room</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient = $_POST['patient_no'];
        $unit = $_POST['nursing_unit'];
        $room = $_POST['room_no'];
        $bed = $_POST['bed_no'];

        $stmt = $conn->prepare("DELETE FROM IN_PATIENT WHERE Patient_No=? AND Nursing_Unit=? AND Room_No=? AND Bed_No=?");
        $stmt->bind_param("iiis", $patient, $unit, $room, $bed);

        if ($stmt->execute()) {
            echo $stmt->affected_rows > 0
                ? "<div class='msg success'>Room released successfully.</div>"
                : "<div class='msg error'>No matching record found.</div>";
        } else {
            echo "<div class='msg error'>Error: {$stmt->error}</div>";
        }
        $stmt->close();
    }
    ?>

    <h3>Occupied Rooms</h3>
    <table>
      <tr>
        <th>Patient Name</th>
        <th>Nursing Unit</th>
        <th>Room No</th>
        <th>Bed</th>
        <th>Action</th>
      </tr>
      <?php
        $res = $conn->query("SELECT IP.Patient_No, P.Name, IP.Nursing_Unit, IP.Room_No, IP.Bed_No 
                             FROM IN_PATIENT IP
                             JOIN PATIENT P ON IP.Patient_No = P.Patient_No
                             ORDER BY IP.Nursing_Unit, IP.Room_No, IP.Bed_No");
        if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            $link = "release_room.php?nursing_unit={$row['Nursing_Unit']}&room_no={$row['Room_No']}&bed_no={$row['Bed_No']}";
            echo "<tr onclick=\"window.location.href='$link'\" title='Click to populate form'>
                    <td>{$row['Name']}</td>
                    <td>{$row['Nursing_Unit']}</td>
                    <td>{$row['Room_No']}</td>
                    <td>{$row['Bed_No']}</td>
                    <td><a href='$link'>Select</a></td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No occupied rooms found.</td></tr>";
        }
        $conn->close();
      ?>
    </table>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

</body>
</html>