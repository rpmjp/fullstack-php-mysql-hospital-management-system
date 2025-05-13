<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon']);
include('../connect.php');

// Validate and retrieve parameters
if (!isset($_GET['patient'], $_GET['surgery'], $_GET['date'])) {
  die("Missing required parameters.");
}

$patient = intval($_GET['patient']);
$surgery_code = $_GET['surgery'];
$surgery_date = $_GET['date'];

// Fetch surgery record
$stmt = $conn->prepare("SELECT SR.*, P.Name AS PatientName, ST.Name AS SurgeryName, S.Name AS SurgeonName
                        FROM Surgery_Record SR
                        JOIN PATIENT P ON SR.Patient_No = P.Patient_No
                        JOIN SURGERY_TYPE ST ON SR.Surgery_Code = ST.Surgery_Code
                        JOIN STAFF S ON SR.Surgeon_ID = S.Employment_No
                        WHERE SR.Patient_No = ? AND SR.Surgery_Code = ? AND SR.Surgery_Date = ?");
$stmt->bind_param("iss", $patient, $surgery_code, $surgery_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("Surgery record not found.");
}

$surgery = $result->fetch_assoc();
$stmt->close();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['mark_performed'])) {
    $outcome = trim($_POST['outcome']);
    if ($outcome === '') {
      $error = "Outcome is required to mark as performed.";
    } else {
      $update = $conn->prepare("UPDATE Surgery_Record SET Outcome = ?, Status = 'Performed' WHERE Patient_No = ? AND Surgery_Code = ? AND Surgery_Date = ?");
      $update->bind_param("siss", $outcome, $patient, $surgery_code, $surgery_date);
      if ($update->execute()) {
        // Updated redirect URL
        header("Location: https://robertjeanpierre.com/inpatient/view_surgeries.php?updated=1");
        exit;
      } else {
        $error = "Error updating record: " . $conn->error;
      }
      $update->close();
    }
  }
  if (isset($_POST['cancel_surgery'])) {
    // Changed to UPDATE instead of DELETE to mark as Canceled
    $update = $conn->prepare("UPDATE Surgery_Record SET Status = 'Canceled', Outcome = 'Surgery canceled' WHERE Patient_No = ? AND Surgery_Code = ? AND Surgery_Date = ?");
    $update->bind_param("iss", $patient, $surgery_code, $surgery_date);
    if ($update->execute()) {
      // Updated redirect URL
      header("Location: https://robertjeanpierre.com/inpatient/view_surgeries.php?canceled=1");
      exit;
    } else {
      $error = "Error canceling surgery: " . $conn->error;
    }
    $update->close();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Surgery Details</title>
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
    <h2>Surgery Details</h2>

    <div class="surgery-container">
      <table>
        <tr><td><label>Patient:</label></td><td><?= htmlspecialchars($surgery['PatientName']) ?></td></tr>
        <tr><td><label>Surgery Type:</label></td><td><?= htmlspecialchars($surgery['SurgeryName']) ?></td></tr>
        <tr><td><label>Surgeon:</label></td><td><?= htmlspecialchars($surgery['SurgeonName']) ?></td></tr>
        <tr><td><label>Date:</label></td><td><?= $surgery['Surgery_Date'] ?></td></tr>
        <tr><td><label>Start Time:</label></td><td><?= $surgery['Start_Time'] !== null ? $surgery['Start_Time'] : '—' ?></td></tr>
        <tr><td><label>End Time:</label></td><td><?= $surgery['End_Time'] !== null ? $surgery['End_Time'] : '—' ?></td></tr>
        <tr><td><label>Room:</label></td><td><?= $surgery['Room_No'] ?>, Unit <?= $surgery['Nursing_Unit'] ?>, Bed <?= $surgery['Bed_No'] ?></td></tr>
        <tr><td><label>Outcome:</label></td><td><?= !empty($surgery['Outcome']) ? htmlspecialchars($surgery['Outcome']) : '—' ?></td></tr>
        <tr><td><label>Notes:</label></td><td><?= !empty($surgery['Notes']) ? nl2br(htmlspecialchars($surgery['Notes'])) : '—' ?></td></tr>
        <tr>
          <td><label>Status:</label></td>
          <td>
            <?php if($surgery['Status'] == 'Scheduled'): ?>
              <span class="status-scheduled">⏳ Scheduled</span>
            <?php elseif($surgery['Status'] == 'Performed'): ?>
              <span class="status-performed">✅ Performed</span>
            <?php elseif($surgery['Status'] == 'Canceled'): ?>
              <span class="status-canceled">❌ Canceled</span>
            <?php endif; ?>
          </td>
        </tr>
      </table>

      <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
      <?php endif; ?>
      
      <?php if (isset($_GET['marked'])): ?>
        <div class="success">Surgery has been marked as performed.</div>
      <?php endif; ?>

      <?php if ($surgery['Status'] == 'Scheduled'): ?>
        <form method="POST">
          <label>Enter Outcome:</label>
          <input type="text" name="outcome" placeholder="e.g., Successful with no complications">
          <div>
            <button type="submit" name="mark_performed">Mark as Performed</button>
            <button type="submit" name="cancel_surgery" class="danger" onclick="return confirm('Are you sure you want to cancel this surgery? This action cannot be undone.')">Cancel Surgery</button>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

</body>
</html>