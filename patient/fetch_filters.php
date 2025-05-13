<?php
header('Content-Type: application/json');
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']);
include('../connect.php');

// Fetch physician names
$physicians = [];
$physicianQuery = "
  SELECT S.Name 
  FROM PHYSICIAN P
  JOIN STAFF S ON P.Employment_No = S.Employment_No
";
$physicianResult = $conn->query($physicianQuery);
while ($row = $physicianResult->fetch_assoc()) {
    $physicians[] = $row['Name'];
}

// Fetch patient names
$patients = [];
$patientQuery = "SELECT Name FROM PATIENT";
$patientResult = $conn->query($patientQuery);
while ($row = $patientResult->fetch_assoc()) {
    $patients[] = $row['Name'];
}

echo json_encode([
    'physicians' => $physicians,
    'patients' => $patients
]);

$conn->close();
?>
