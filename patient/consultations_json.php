<?php
include('../connect.php');

header('Content-Type: application/json');

$events = [];

$physicianFilter = isset($_GET['physician']) ? trim($_GET['physician']) : '';
$patientFilter = isset($_GET['patient']) ? trim($_GET['patient']) : '';

$sql = "
  SELECT 
    C.Date, 
    C.Time,
    P.Name AS PatientName,
    S.Name AS PhysicianName,
    C.Observation
  FROM Consultation C
  JOIN PATIENT P ON C.Patient_No = P.Patient_No
  JOIN PHYSICIAN PH ON C.Physician_ID = PH.Employment_No
  JOIN STAFF S ON PH.Employment_No = S.Employment_No
";

$conditions = [];
$params = [];
$types = '';

if ($physicianFilter !== '') {
    $conditions[] = "S.Name = ?";
    $params[] = $physicianFilter;
    $types .= 's';
}

if ($patientFilter !== '') {
    $conditions[] = "P.Name = ?";
    $params[] = $patientFilter;
    $types .= 's';
}

if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY C.Date, C.Time";

$stmt = $conn->prepare($sql);
if (!empty($types)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $start = $row['Date'] . 'T' . $row['Time'];
    $title = "{$row['PatientName']} with Dr. {$row['PhysicianName']}";
    if (!empty($row['Observation'])) {
        $title .= " – {$row['Observation']}";
    }
    $events[] = [
        'title' => $title,
        'start' => $start,
        'extendedProps' => [
            'patient' => $row['PatientName'],
            'physician' => $row['PhysicianName'],
            'observation' => $row['Observation']
        ]
    ];
}

echo json_encode($events);
$stmt->close();
$conn->close();
