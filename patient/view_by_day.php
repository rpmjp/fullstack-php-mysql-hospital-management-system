<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_login.php');
require_role(['admin', 'physician', 'surgeon', 'nurse', 'receptionist']);
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Consultations Calendar</title>
  <link rel="stylesheet" href="/styles/style.css">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <style>
    /* Calendar-specific styles that extend the main stylesheet */
    
    /* Filter section styles */
    .filters {
      padding: 15px 20px;
      background-color: #fff;
      display: flex;
      gap: 20px;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      position: relative;
      z-index: 5;
    }

    .filters label {
      font-weight: bold;
      margin-right: 5px;
    }

    .filters select {
      padding: 8px 12px;
      border-radius: 4px;
      border: 1px solid #ccc;
      min-width: 150px;
    }
    
    .calendar-wrapper {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      padding: 15px;
      position: relative;
      z-index: 1;
    }

    #calendar {
      min-height: 700px;
      position: relative;
      z-index: 1;
    }
    
    /* Fixed calendar toolbar styles */
    .fc .fc-toolbar {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
    }
    
    .fc .fc-toolbar-title {
      font-size: 1.5em;
      margin: 0;
    }
    
    /* Fix today button position */
    .fc .fc-toolbar.fc-header-toolbar .fc-toolbar-chunk {
      display: flex;
      align-items: center;
    }
    
    .fc .fc-toolbar.fc-header-toolbar .fc-toolbar-chunk .fc-button {
      margin: 0 3px;
    }
    
    /* Button size adjustments */
    .fc .fc-button {
      height: auto;
      padding: 0.4em 0.65em;
      font-size: 0.9em;
      font-weight: normal;
    }
    
    /* Override form button width to not affect calendar buttons */
    .fc .fc-button {
      width: auto;
    }
    
    /* Responsive calendar toolbar */
    @media (max-width: 768px) {
      .fc .fc-toolbar {
        flex-direction: column;
        gap: 10px;
      }
      
      .fc .fc-toolbar-chunk {
        display: flex;
        justify-content: center;
        width: 100%;
        flex-wrap: wrap;
      }
      
      .filters {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .filters select {
        width: 100%;
      }
    }
    
    /* Fix for the fullcalendar rendering */
    .fc .fc-daygrid-day-frame,
    .fc .fc-timegrid-slot,
    .fc .fc-timegrid-slot-lane {
      z-index: 1; /* Ensure calendar cells are above sidebar */
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
    <h2>Consultations Calendar</h2>
    
    <div class="filters">
      <div class="filter-group">
        <label for="physicianFilter">Physician:</label>
        <select id="physicianFilter"><option value="">All</option></select>
      </div>

      <div class="filter-group">
        <label for="patientFilter">Patient:</label>
        <select id="patientFilter"><option value="">All</option></select>
      </div>
    </div>

    <div class="calendar-wrapper">
      <div id="calendar"></div>
    </div>
  </div>

  <footer>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  </footer>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const physicianFilter = document.getElementById('physicianFilter');
    const patientFilter = document.getElementById('patientFilter');

    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridWeek',
      slotMinTime: '06:00:00',
      slotMaxTime: '22:00:00',
      allDaySlot: false,
      height: 'auto',
      events: {
        url: '/patient/consultations_json.php',
        extraParams: () => ({
          physician: physicianFilter.value,
          patient: patientFilter.value
        }),
        failure: () => alert('There was an error fetching events!')
      },
      eventColor: '#3788d8',
      eventClick: function(info) {
        const event = info.event;
        alert(`Patient: ${event.extendedProps.patient}\nPhysician: ${event.extendedProps.physician}\nNotes: ${event.extendedProps.observation || 'N/A'}`);
      },
      eventDidMount: function(info) {
        const physician = info.event.extendedProps.physician;
        if (physician) {
          const color = stringToColor(physician);
          info.el.style.backgroundColor = color;
        }
      },
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridDay,timeGridWeek,dayGridMonth,listWeek'
      },
      // Format times in 24-hour format
      eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        meridiem: false,
        hour12: false
      },
      // Handle browser window resize
      windowResize: function() {
        calendar.updateSize();
      }
    });

    calendar.render();

    physicianFilter.addEventListener('change', () => calendar.refetchEvents());
    patientFilter.addEventListener('change', () => calendar.refetchEvents());

    function stringToColor(str) {
      let hash = 0;
      for (let i = 0; i < str.length; i++) {
        hash = str.charCodeAt(i) + ((hash << 5) - hash);
      }
      const color = (hash & 0x00FFFFFF).toString(16).padStart(6, '0');
      return '#' + color;
    }

    fetch('/patient/fetch_filters.php')
      .then(res => res.json())
      .then(data => {
        data.physicians.forEach(name => {
          const opt = document.createElement('option');
          opt.value = name;
          opt.textContent = name;
          physicianFilter.appendChild(opt);
        });
        data.patients.forEach(name => {
          const opt = document.createElement('option');
          opt.value = name;
          opt.textContent = name;
          patientFilter.appendChild(opt);
        });
      })
      .catch(error => {
        console.error('Error fetching filter data:', error);
      });
  });
</script>
</body>
</html>