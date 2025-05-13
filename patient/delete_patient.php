<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin']); // Only Admins can delete patients
include('../connect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p style='color:red; text-align:center;'>No valid patient ID specified.</p>";
    exit;
}

$id = intval($_GET['id']); // Sanitized patient ID

$tables = [
  "Patient_Care",
  "In_Patient",
  "Surgery_Record",
  "Consultation",
  "Patient_Allergy",
  "Patient_Illness",
  "Medication_Order",
  "Primary_Care"
];

// Attempt to delete dependent records
foreach ($tables as $table) {
    try {
        $stmt = $conn->prepare("DELETE FROM `$table` WHERE Patient_No = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        error_log("Warning: Failed to delete from $table — " . $e->getMessage());
        // Silent fail — continue with other tables
    }
}

// Delete from PATIENT table
try {
    $stmt = $conn->prepare("DELETE FROM PATIENT WHERE Patient_No = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: view_patient.php?deleted=1");
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>Error deleting patient: {$stmt->error}</p>";
        $stmt->close();
    }
} catch (mysqli_sql_exception $e) {
    echo "<p style='color:red; text-align:center;'>Critical error: {$e->getMessage()}</p>";
}

$conn->close();
?>
