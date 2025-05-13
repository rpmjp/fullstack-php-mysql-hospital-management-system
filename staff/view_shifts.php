<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']); // All staff roles
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Shift Schedules</title>
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
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
      margin-bottom: 20px;
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
    
    /* Calendar container */
    #calendar {
      max-width: 1000px;
      margin: 0 auto;
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    
    /* Shift type styles */
    .shift-morning {
      color: white !important;
      background-color: #3498db !important;
      border: 1px solid #2980b9 !important;
    }
    .shift-afternoon {
      color: white !important;
      background-color: #9b59b6 !important;
      border: 1px solid #8e44ad !important;
    }
    .shift-night {
      color: white !important;
      background-color: #34495e !important;
      border: 1px solid #2c3e50 !important;
    }
    .shift-oncall {
      color: white !important;
      background-color: #e67e22 !important;
      border: 1px solid #d35400 !important;
    }
    .shift-regular {
      color: white !important;
      background-color: #16a085 !important;
      border: 1px solid #1abc9c !important;
    }
    
    /* Fix hover effects in list view */
    .fc-list-event.shift-morning:hover td,
    tr.fc-list-event.shift-morning:hover {
      background-color: #2980b9 !important;
      color: white !important;
    }
    .fc-list-event.shift-afternoon:hover td,
    tr.fc-list-event.shift-afternoon:hover {
      background-color: #8e44ad !important;
      color: white !important;
    }
    .fc-list-event.shift-night:hover td,
    tr.fc-list-event.shift-night:hover {
      background-color: #2c3e50 !important;
      color: white !important;
    }
    .fc-list-event.shift-oncall:hover td,
    tr.fc-list-event.shift-oncall:hover {
      background-color: #d35400 !important;
      color: white !important;
    }
    .fc-list-event.shift-regular:hover td,
    tr.fc-list-event.shift-regular:hover {
      background-color: #1abc9c !important;
      color: white !important;
    }
    
    /* Make sure text stays white even on hover in different views */
    .fc-list-event-title a,
    .fc-list-event-time {
      color: inherit !important;
    }
    
    /* Legend styles */
    .calendar-legend {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 15px;
      background: white;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }
    .legend-item {
      display: flex;
      align-items: center;
      margin: 5px 10px;
    }
    .legend-color {
      width: 15px;
      height: 15px;
      margin-right: 5px;
      border-radius: 3px;
    }
    .legend-morning { background-color: #3498db; }
    .legend-afternoon { background-color: #9b59b6; }
    .legend-night { background-color: #34495e; }
    .legend-oncall { background-color: #e67e22; }
    .legend-regular { background-color: #16a085; }
    
    /* Table view for reference (can be toggled) */
    .table-container {
      max-width: 1000px;
      margin: 30px auto 0;
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      display: none; /* Hidden by default */
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
    }
    th {
      background-color: #0077cc;
      color: white;
    }
    tr:hover {
      background-color: #f9f9f9;
    }
    .view-toggle {
      text-align: center;
      margin-bottom: 20px;
    }
    .view-toggle button {
      padding: 8px 15px;
      background-color: #0077cc;
      border: none;
      color: white;
      border-radius: 4px;
      cursor: pointer;
      margin: 0 5px;
    }
    .view-toggle button:hover {
      background-color: #005fa3;
    }
    .view-toggle button.active {
      background-color: #2ecc71;
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
    <h2>Staff Shift Schedules</h2>
    
    <!-- View toggle buttons -->
    <div class="view-toggle">
      <button id="calendar-view-btn" class="active">Calendar View</button>
      <button id="table-view-btn">Table View</button>
    </div>
    
    <!-- Calendar view section -->
    <div id="calendar-view">
      <!-- Filter Section -->
      <div class="filter-section">
        <div class="filter-group">
          <label for="staff-type-filter">Staff Type:</label>
          <select id="staff-type-filter">
            <option value="all">All Staff Types</option>
            <option value="surgeon">Surgeons</option>
            <option value="physician">Physicians</option>
            <option value="nurse">Nurses</option>
          </select>
        </div>
        <div class="filter-group">
          <label for="staff-name-filter">Staff Name:</label>
          <select id="staff-name-filter">
            <option value="all">All Staff</option>
            <?php
              $sql = "SELECT DISTINCT S.Employment_No, S.Name 
                     FROM STAFF S 
                     JOIN SHIFT_SCHEDULE SS ON S.Employment_No = SS.Staff_ID 
                     ORDER BY S.Name";
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {
                echo "<option value=\"{$row['Employment_No']}\">{$row['Name']}</option>";
              }
            ?>
          </select>
        </div>
      </div>
      
      <!-- Legend -->
      <div class="calendar-legend">
        <div class="legend-item">
          <div class="legend-color legend-morning"></div>
          <span>Morning</span>
        </div>
        <div class="legend-item">
          <div class="legend-color legend-afternoon"></div>
          <span>Afternoon</span>
        </div>
        <div class="legend-item">
          <div class="legend-color legend-night"></div>
          <span>Night</span>
        </div>
        <div class="legend-item">
          <div class="legend-color legend-oncall"></div>
          <span>On-Call</span>
        </div>
        <div class="legend-item">
          <div class="legend-color legend-regular"></div>
          <span>Regular</span>
        </div>
      </div>
      
      <!-- Calendar -->
      <div id="calendar"></div>
    </div>
    
    <!-- Table view section -->
    <div id="table-view" class="table-container">
      <table>
        <tr>
          <th>Staff ID</th>
          <th>Name</th>
          <th>Staff Type</th>
          <th>Date</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Shift Type</th>
        </tr>
        <?php
          // We'll populate this dynamically with JavaScript using the same data as the calendar
        ?>
      </table>
    </div>
  </div>
  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    var calendarEl = document.getElementById('calendar');
    var staffTypeFilter = document.getElementById('staff-type-filter');
    var staffNameFilter = document.getElementById('staff-name-filter');
    var calendarViewBtn = document.getElementById('calendar-view-btn');
    var tableViewBtn = document.getElementById('table-view-btn');
    var calendarView = document.getElementById('calendar-view');
    var tableView = document.getElementById('table-view');
    var tableBody = document.querySelector('#table-view table');
    
    // Toggle between calendar and table views
    calendarViewBtn.addEventListener('click', function() {
      calendarView.style.display = 'block';
      tableView.style.display = 'none';
      calendarViewBtn.classList.add('active');
      tableViewBtn.classList.remove('active');
    });
    
    tableViewBtn.addEventListener('click', function() {
      calendarView.style.display = 'none';
      tableView.style.display = 'block';
      calendarViewBtn.classList.remove('active');
      tableViewBtn.classList.add('active');
    });
    
    // Define all shift data
    var allShifts = [
      <?php
        // First get all staff with their types
        $staffTypes = [];
        $sql = "SELECT Employment_No, 
                CASE 
                  WHEN Employment_No IN (SELECT Employment_No FROM SURGEON) THEN 'surgeon'
                  WHEN Employment_No IN (SELECT Employment_No FROM PHYSICIAN) THEN 'physician'
                  WHEN Employment_No IN (SELECT Employment_No FROM NURSE) THEN 'nurse'
                  ELSE 'other'
                END as StaffType
                FROM STAFF";
        
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
          $staffTypes[$row['Employment_No']] = $row['StaffType'];
        }
        
        // Now get all shifts
        $sql = "
          SELECT SS.Staff_ID, S.Name, SS.Shift_Date, SS.Start_Time, SS.End_Time, SS.Shift_Type
          FROM SHIFT_SCHEDULE SS
          JOIN STAFF S ON SS.Staff_ID = S.Employment_No
          ORDER BY SS.Shift_Date, SS.Start_Time
        ";
        $result = $conn->query($sql);
        $shifts = [];
        
        while ($row = $result->fetch_assoc()) {
          // Determine the staff type
          $staffType = $staffTypes[$row['Staff_ID']] ?? 'other';
          
          // Format title for the event
          $title = htmlspecialchars($row['Name'], ENT_QUOTES) . ' - ' . 
                  htmlspecialchars($row['Shift_Type'], ENT_QUOTES);
          
          // Format times
          $start = $row['Shift_Date'];
          if (!empty($row['Start_Time'])) {
            $start .= 'T' . $row['Start_Time']; 
          } else {
            $start .= 'T09:00:00'; // Default time if not specified
          }
          
          $end = $row['Shift_Date'];
          if (!empty($row['End_Time'])) {
            $end .= 'T' . $row['End_Time'];
          } else if (!empty($row['Start_Time'])) {
            // Calculate 8 hours after start time for standard shift
            $end .= 'T' . date('H:i:s', strtotime($row['Start_Time'] . ' +8 hours'));
          } else {
            $end .= 'T17:00:00'; // Default 8-hour shift
          }
          
          // Determine class based on shift type
          $shiftClass = 'shift-regular'; // Default
          $shiftType = strtolower($row['Shift_Type']);
          
          if (strpos($shiftType, 'morning') !== false) {
            $shiftClass = 'shift-morning';
          } else if (strpos($shiftType, 'afternoon') !== false) {
            $shiftClass = 'shift-afternoon';
          } else if (strpos($shiftType, 'night') !== false) {
            $shiftClass = 'shift-night';
          } else if (strpos($shiftType, 'call') !== false || strpos($shiftType, 'on call') !== false) {
            $shiftClass = 'shift-oncall';
          }
          
          // Create event object
          $shifts[] = json_encode([
            'title' => $title,
            'start' => $start,
            'end' => $end,
            'className' => $shiftClass,
            'extendedProps' => [
              'staffId' => $row['Staff_ID'],
              'staffName' => $row['Name'],
              'staffType' => $staffType,
              'shiftDate' => $row['Shift_Date'],
              'startTime' => $row['Start_Time'],
              'endTime' => $row['End_Time'],
              'shiftType' => $row['Shift_Type']
            ]
          ], JSON_UNESCAPED_SLASHES);
        }
        echo implode(",\n", $shifts);
      ?>
    ];
    
    // Initialize calendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
      },
      events: allShifts,
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
          // Make sure all text elements inside this event maintain the right color
          var textElements = info.el.querySelectorAll('a, td.fc-list-event-time');
          textElements.forEach(function(elem) {
            elem.style.color = 'white';
          });
        }
        
        // Add tooltip with staff details
        info.el.title = info.event.extendedProps.staffName + " - " + 
                       info.event.extendedProps.shiftType + " (" + 
                       info.event.extendedProps.startTime + " - " + 
                       info.event.extendedProps.endTime + ")";
      }
    });
    
    calendar.render();
    
    // Initialize the table view with all shifts
    function populateTable(shifts) {
      // Clear existing rows except header
      while (tableBody.rows.length > 1) {
        tableBody.deleteRow(1);
      }
      
      // Add rows for each shift
      shifts.forEach(function(shiftData) {
        var shift = typeof shiftData === 'string' ? JSON.parse(shiftData) : shiftData;
        var props = shift.extendedProps;
        
        var row = tableBody.insertRow();
        row.insertCell().textContent = props.staffId;
        row.insertCell().textContent = props.staffName;
        row.insertCell().textContent = props.staffType.charAt(0).toUpperCase() + props.staffType.slice(1);
        row.insertCell().textContent = props.shiftDate;
        row.insertCell().textContent = props.startTime;
        row.insertCell().textContent = props.endTime;
        row.insertCell().textContent = props.shiftType;
      });
    }
    
    // Initial table population
    populateTable(allShifts);
    
    // Filter function for both views
    function filterShifts() {
      var selectedStaffType = staffTypeFilter.value;
      var selectedStaffName = staffNameFilter.value;
      
      // Filter for calendar view
      var allEvents = calendar.getEvents();
      allEvents.forEach(function(event) {
        var staffType = event.extendedProps.staffType;
        var staffId = event.extendedProps.staffId;
        
        // Check if this event matches the filters
        var typeMatch = selectedStaffType === 'all' || staffType === selectedStaffType;
        var nameMatch = selectedStaffName === 'all' || staffId === selectedStaffName;
        
        if (typeMatch && nameMatch) {
          event.setProp('display', 'block'); // Show event
        } else {
          event.setProp('display', 'none');  // Hide event
        }
      });
      
      // Filter for table view
      var filteredShifts = allShifts.filter(function(shiftData) {
        var shift = typeof shiftData === 'string' ? JSON.parse(shiftData) : shiftData;
        var props = shift.extendedProps;
        
        var typeMatch = selectedStaffType === 'all' || props.staffType === selectedStaffType;
        var nameMatch = selectedStaffName === 'all' || props.staffId === selectedStaffName;
        
        return typeMatch && nameMatch;
      });
      
      populateTable(filteredShifts);
    }
    
    // Add event listeners to filters
    staffTypeFilter.addEventListener('change', filterShifts);
    staffNameFilter.addEventListener('change', filterShifts);
  });
</script>
</body>
</html>