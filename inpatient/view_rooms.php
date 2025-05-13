<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']);
include('../connect.php'); 

// Explicitly set timezone to match your system
date_default_timezone_set('America/New_York'); // Change to your timezone

// Get current date and time
$current_date = date('Y-m-d');
$current_time = date('H:i:s');
$current_datetime = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Rooms</title>
  <link rel="stylesheet" href="/assets/style.css?v=1.2">
  <script>
    function handleRoomClick(nursingUnit, roomNo, bedNo, status, patientNo, surgeryInfo) {
      if (status === 'Occupied') {
        if (confirm('This bed is currently occupied.\nWould you like to release the patient from this bed?')) {
          const url = `/inpatient/release_room.php?` + new URLSearchParams({
            nursing_unit: nursingUnit,
            room_no: roomNo,
            bed_no: bedNo,
            patient_no: patientNo
          }).toString();
          window.location.href = url;
        }
      } else if (status === 'Surgery') {
        if (surgeryInfo) {
          alert('This room is reserved for surgery:\n' + surgeryInfo);
        } else {
          alert('This room is currently reserved for a scheduled surgery and cannot be assigned or released.');
        }
      } else {
        const url = `/inpatient/assign_room.php?` + new URLSearchParams({
          nursing_unit: nursingUnit,
          room_no: roomNo,
          bed_no: bedNo
        }).toString();
        window.location.href = url;
      }
    }
  </script>
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
    <h2>Clinic Room Directory</h2>
    
    <!-- Current time display -->
    <div class="current-time">
      Current time: <?php echo $current_datetime; ?>
    </div>
    
    <!-- Reservation note -->
    <div class="reservation-note">
      Rooms are automatically reserved 24 hours before scheduled surgeries
    </div>
    
    <!-- Legend -->
    <div class="room-legend">
      <div class="legend-item">
        <span class="legend-label legend-available">Available</span>
      </div>
      <div class="legend-item">
        <span class="legend-label legend-occupied">Occupied</span>
      </div>
      <div class="legend-item">
        <span class="legend-label legend-surgery">Surgery</span>
      </div>
    </div>
    
    <table>
      <tr>
        <th>Nursing Unit</th>
        <th>Room No</th>
        <th>Bed No</th>
        <th>Wing</th>
        <th>Status</th>
      </tr>
      <?php
        // Create a query that doesn't rely on MySQL time functions for comparison
        $sql = "
          SELECT 
            R.Nursing_Unit,
            R.Room_No,
            R.Bed_No,
            R.Wing,
            IP.Patient_No,
            SR.Surgery_Date,
            SR.Start_Time,
            SR.End_Time,
            SR.Surgery_Code,
            ST.Name AS SurgeryName,
            P.Name AS PatientName,
            CASE 
              WHEN IP.Patient_No IS NOT NULL THEN 'Occupied'
              ELSE 'Available'
            END AS InitialStatus
          FROM ROOM R
          LEFT JOIN IN_PATIENT IP
            ON R.Nursing_Unit = IP.Nursing_Unit 
            AND R.Room_No = IP.Room_No 
            AND R.Bed_No = IP.Bed_No
          LEFT JOIN (
            SELECT *
            FROM Surgery_Record
            WHERE Status != 'Canceled'
          ) SR
            ON R.Room_No = SR.Room_No
            AND R.Bed_No = SR.Bed_No
            AND R.Nursing_Unit = SR.Nursing_Unit
          LEFT JOIN SURGERY_TYPE ST
            ON SR.Surgery_Code = ST.Surgery_Code
          LEFT JOIN PATIENT P
            ON SR.Patient_No = P.Patient_No
          ORDER BY R.Nursing_Unit, R.Room_No, R.Bed_No
        ";

        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Get base status
            $status = $row['InitialStatus'];
            $status_class = 'available';
            
            // Check surgery status using PHP rather than MySQL
            if ($status === 'Available' && $row['Surgery_Date'] && $row['Start_Time'] && $row['End_Time']) {
              // Get surgery date/times
              $surgery_datetime_start = strtotime($row['Surgery_Date'] . ' ' . $row['Start_Time']);
              $surgery_datetime_end = strtotime($row['Surgery_Date'] . ' ' . $row['End_Time']);
              $current_timestamp = strtotime($current_datetime);
              
              // Surgery is currently in progress
              if ($current_timestamp >= $surgery_datetime_start && $current_timestamp <= $surgery_datetime_end) {
                $status = 'Surgery';
                $status_class = 'surgery';
              }
              // Surgery is scheduled to start within 24 hours (1 day)
              else if ($surgery_datetime_start > $current_timestamp && 
                      ($surgery_datetime_start - $current_timestamp) <= 86400) { // 24 hours = 86400 seconds
                $status = 'Surgery';
                $status_class = 'surgery';
              }
              // Surgery just ended within the last 30 minutes (cleanup time)
              else if ($current_timestamp > $surgery_datetime_end && 
                      ($current_timestamp - $surgery_datetime_end) <= 1800) { // 30 minutes = 1800 seconds
                $status = 'Surgery';
                $status_class = 'surgery';
              }
            }
            
            if ($status === 'Occupied') {
              $status_class = 'occupied';
            }
            
            // Format surgery info for the alert
            $surgeryInfo = '';
            if ($row['Surgery_Date'] && $row['SurgeryName'] && $row['PatientName']) {
              $surgeryDate = date('M d, Y', strtotime($row['Surgery_Date']));
              $startTime = $row['Start_Time'] ? date('H:i', strtotime($row['Start_Time'])) : 'N/A';
              $endTime = $row['End_Time'] ? date('H:i', strtotime($row['End_Time'])) : 'N/A';
              
              // Calculate time until surgery
              $hours_until_surgery = round(($surgery_datetime_start - $current_timestamp) / 3600, 1);
              $timeNotice = '';
              
              if ($current_timestamp >= $surgery_datetime_start && $current_timestamp <= $surgery_datetime_end) {
                $timeNotice = "\nSurgery is currently in progress";
              } else if ($surgery_datetime_start > $current_timestamp) {
                $timeNotice = "\nSurgery starts in approximately " . $hours_until_surgery . " hours";
              }
              
              $surgeryInfo = "Patient: {$row['PatientName']}\n".
                           "Surgery: {$row['SurgeryName']}\n".
                           "Date: $surgeryDate\n".
                           "Time: $startTime - $endTime" . 
                           $timeNotice;
            }
            
            $surgeryInfoJson = htmlspecialchars(json_encode($surgeryInfo));
            
            echo "<tr onclick=\"handleRoomClick('{$row['Nursing_Unit']}', '{$row['Room_No']}', '{$row['Bed_No']}', '$status', '{$row['Patient_No']}', $surgeryInfoJson)\">
              <td>{$row['Nursing_Unit']}</td>
              <td>{$row['Room_No']}</td>
              <td>{$row['Bed_No']}</td>
              <td>{$row['Wing']}</td>
              <td class='$status_class'>$status</td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No rooms found.</td></tr>";
          if ($result === false) {
            echo "<!-- SQL Error: " . $conn->error . " -->";
          }
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