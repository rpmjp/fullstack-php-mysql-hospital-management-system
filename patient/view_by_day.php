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
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      height: 100vh;
      display: flex;
      overflow: hidden;
    }

    .sidebar {
      width: 250px;
      background-color: #255fb4;
      color: white;
      position: fixed;
      height: 100vh;
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
      background-color: white;
      padding: 10px 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      z-index: 10;
    }

    .filters {
      padding: 10px 20px;
      background-color: #fff;
      display: flex;
      gap: 10px;
      align-items: center;
      flex-wrap: wrap;
    }

    .filters label {
      font-weight: bold;
    }

    .filters select {
      padding: 5px 10px;
    }

    .calendar-wrapper {
      flex-grow: 1;
      overflow-y: auto;
      padding: 10px 20px;
    }

    #calendar {
      min-height: 700px;
    }

    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 15px;
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

  <div class="filters">
    <label for="physicianFilter">Physician:</label>
    <select id="physicianFilter"><option value="">All</option></select>

    <label for="patientFilter">Patient:</label>
    <select id="patientFilter"><option value="">All</option></select>
  </div>

  <div class="calendar-wrapper">
    <div id="calendar"></div>
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
      });
  });
</script>
</body>
</html>
