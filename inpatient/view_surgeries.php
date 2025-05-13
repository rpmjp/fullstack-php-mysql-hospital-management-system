<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']);
include('../connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Scheduled Surgeries Calendar</title>
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
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
    .main-content-area {
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
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .page-content {
      flex-grow: 1;
      padding: 30px;
      overflow-y: auto;
      background: #ecf0f1;
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
    }
    #calendar {
      max-width: 1000px;
      margin: 0 auto;
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    /* Filter section styles */
    .filter-section {
      max-width: 1000px;
      margin: 0 auto 20px auto;
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .filter-group {
      display: flex;
      flex-direction: column;
    }
    .filter-group label {
      font-weight: bold;
      margin-bottom: 5px;
    }
    .filter-group select {
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    /* Surgery status styles */
    .canceled-surgery {
      text-decoration: line-through !important;
      color: white !important;
      background-color: #e74c3c !important;
      border: 1px solid #c0392b !important;
      opacity: 0.9 !important;
    }
    /* Fix hover effect for canceled surgeries */
    .fc-list-event.canceled-surgery:hover td,
    tr.fc-list-event.canceled-surgery:hover {
      background-color: #c0392b !important;
      color: white !important;
    }
    
    .performed-surgery {
      color: white !important;
      background-color: #2ecc71 !important;
      border: 1px solid #27ae60 !important;
      opacity: 0.9 !important;
    }
    /* Fix hover effect for performed surgeries */
    .fc-list-event.performed-surgery:hover td,
    tr.fc-list-event.performed-surgery:hover {
      background-color: #27ae60 !important;
      color: white !important;
    }
    
    .scheduled-surgery {
      color: white !important;
      background-color: #3498db !important;
      border: 1px solid #2980b9 !important;
    }
    /* Fix hover effect for scheduled surgeries */
    .fc-list-event.scheduled-surgery:hover td,
    tr.fc-list-event.scheduled-surgery:hover {
      background-color: #2980b9 !important;
      color: white !important;
    }
    
    /* Make sure text stays white even on hover in different views */
    .fc-list-event-title a,
    .fc-list-event-time {
      color: inherit !important;
    }
    
    /* Override FullCalendar hover effects */
    .fc-theme-standard .fc-list-day:hover td,
    .fc-theme-standard .fc-list-event:hover td {
      background-color: inherit !important; 
    }
    
    /* Additional hover fix for list items */
    .fc-list-event:hover {
      opacity: 0.95;
    }
    
    /* Legend styles */
    .calendar-legend {
      display: flex;
      justify-content: center;
      margin-bottom: 15px;
      background: white;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
    }
    .legend-item {
      display: flex;
      align-items: center;
      margin: 0 10px;
    }
    .legend-color {
      width: 15px;
      height: 15px;
      margin-right: 5px;
      border-radius: 3px;
    }
    .legend-scheduled {
      background-color: #3498db;
    }
    .legend-performed {
      background-color: #2ecc71;
    }
    .legend-canceled {
      background-color: #e74c3c;
      position: relative;
    }
    .legend-canceled::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 1px;
      background-color: white;
      top: 50%;
    }
    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 15px;
      flex-shrink: 0;
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
    <h2>Scheduled Surgeries Calendar</h2>
    
    <!-- Filter Section -->
    <div class="filter-section">
      <div class="filter-group">
        <label for="physician-filter">Physician:</label>
        <select id="physician-filter">
          <option value="all">All</option>
          <?php
            $sql = "SELECT DISTINCT S.Employment_No, S.Name 
                   FROM STAFF S 
                   JOIN Surgery_Record SR ON S.Employment_No = SR.Surgeon_ID 
                   ORDER BY S.Name";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
              echo "<option value=\"{$row['Employment_No']}\">{$row['Name']}</option>";
            }
          ?>
        </select>
      </div>
      <div class="filter-group">
        <label for="patient-filter">Patient:</label>
        <select id="patient-filter">
          <option value="all">All</option>
          <?php
            $sql = "SELECT DISTINCT P.Patient_No, P.Name 
                   FROM PATIENT P 
                   JOIN Surgery_Record SR ON P.Patient_No = SR.Patient_No 
                   ORDER BY P.Name";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
              echo "<option value=\"{$row['Patient_No']}\">{$row['Name']}</option>";
            }
          ?>
        </select>
      </div>
    </div>
    
    <!-- Legend -->
    <div class="calendar-legend">
      <div class="legend-item">
        <div class="legend-color legend-scheduled"></div>
        <span>Scheduled</span>
      </div>
      <div class="legend-item">
        <div class="legend-color legend-performed"></div>
        <span>Performed</span>
      </div>
      <div class="legend-item">
        <div class="legend-color legend-canceled"></div>
        <span>Canceled</span>
      </div>
    </div>
    
    <!-- Calendar -->
    <div id='calendar'></div>
  </div>
  
  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var physicianFilter = document.getElementById('physician-filter');
    var patientFilter = document.getElementById('patient-filter');
    
    // Initialize calendar with all events
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
      },
      events: [
        <?php
          $sql = "
            SELECT 
              SR.Surgery_Date,
              SR.Patient_No,
              SR.Surgery_Code,
              SR.Start_Time,
              SR.End_Time,
              ST.Name AS SurgeryName,
              P.Name AS PatientName,
              S.Name AS SurgeonName,
              S.Employment_No AS SurgeonID,
              SR.Status
            FROM Surgery_Record SR
            JOIN PATIENT P ON SR.Patient_No = P.Patient_No
            JOIN SURGERY_TYPE ST ON SR.Surgery_Code = ST.Surgery_Code
            JOIN STAFF S ON SR.Surgeon_ID = S.Employment_No
            ORDER BY SR.Surgery_Date DESC
          ";
          $result = $conn->query($sql);
          $events = [];
          while ($row = $result->fetch_assoc()) {
            // Format the title based on status
            $status_prefix = '';
            if ($row['Status'] == 'Canceled') {
              $status_prefix = '[CANCELED] ';
            } elseif ($row['Status'] == 'Performed') {
              $status_prefix = '[COMPLETED] ';
            }
            $title = $status_prefix . htmlspecialchars($row['PatientName'], ENT_QUOTES) . ' - ' . 
                    htmlspecialchars($row['SurgeryName'], ENT_QUOTES) . ' with Dr. ' . 
                    htmlspecialchars($row['SurgeonName'], ENT_QUOTES);
            
            // Ensure we have at least a date for the event
            $start = $row['Surgery_Date'];
            if (!empty($row['Start_Time'])) {
              $start .= 'T' . $row['Start_Time']; 
            } else {
              // Default time for events without specific times (for week view)
              $start .= 'T09:00:00';
            }
            
            // Set end time if available, otherwise default to 1 hour after start
            $end = $row['Surgery_Date'];
            if (!empty($row['End_Time'])) {
              $end .= 'T' . $row['End_Time'];
            } else if (!empty($row['Start_Time'])) {
              // Calculate 1 hour after start time
              $end .= 'T' . date('H:i:s', strtotime($row['Start_Time'] . ' +1 hour'));
            } else {
              // Default duration of 1 hour for events without specific times
              $end .= 'T10:00:00';
            }
            
            $url = "/inpatient/view_surgery_details.php?patient={$row['Patient_No']}&surgery={$row['Surgery_Code']}&date={$row['Surgery_Date']}";
            
            // Determine CSS class based on status
            $className = 'scheduled-surgery'; // Default class
            if ($row['Status'] == 'Canceled') {
              $className = 'canceled-surgery';
            } elseif ($row['Status'] == 'Performed') {
              $className = 'performed-surgery';
            }
            
            // Add event data with proper JSON formatting for JavaScript
            $events[] = json_encode([
              'title' => $title,
              'start' => $start,
              'end' => $end,
              'url' => $url,
              'className' => $className,
              'allDay' => empty($row['Start_Time']), // If no start time, mark as all-day
              'extendedProps' => [
                'surgeonId' => $row['SurgeonID'],
                'patientId' => $row['Patient_No'],
                'status' => $row['Status']
              ]
            ], JSON_UNESCAPED_SLASHES);
          }
          echo implode(",\n", $events);
        ?>
      ],
      // Make sure events show up in all views
      eventDisplay: 'block',
      displayEventTime: true,
      displayEventEnd: true,
      allDaySlot: true,
      // Format times in 24-hour format
      eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        meridiem: false,
        hour12: false
      },
      eventDidMount: function(info) {
        // Add custom hover behavior for list view
        if (info.view.type === 'listWeek') {
          // Get the element
          var el = info.el;
          
          // Make sure all text elements inside this event maintain the right color
          var textElements = el.querySelectorAll('a, td.fc-list-event-time');
          textElements.forEach(function(elem) {
            elem.style.color = 'white';
          });
        }
      }
    });
    
    calendar.render();
    
    // Filter function
    function filterEvents() {
      var selectedPhysician = physicianFilter.value;
      var selectedPatient = patientFilter.value;
      
      // Hide all events first
      var allEvents = calendar.getEvents();
      allEvents.forEach(function(event) {
        var surgeonId = event.extendedProps.surgeonId;
        var patientId = event.extendedProps.patientId;
        
        // Check if this event matches the filters
        var physicianMatch = selectedPhysician === 'all' || surgeonId === selectedPhysician;
        var patientMatch = selectedPatient === 'all' || patientId === selectedPatient;
        
        if (physicianMatch && patientMatch) {
          event.setProp('display', 'block'); // Show event
        } else {
          event.setProp('display', 'none');  // Hide event
        }
      });
    }
    
    // Add event listeners to filters
    physicianFilter.addEventListener('change', filterEvents);
    patientFilter.addEventListener('change', filterEvents);
  });
</script>
</body>
</html>