<?php
$uri = $_SERVER['REQUEST_URI'];

if (strpos($uri, '/patient/') !== false) {
    include($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar_patient.php');
} elseif (strpos($uri, '/inpatient/') !== false) {
    include($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar_inpatient.php');
} elseif (strpos($uri, '/staff/') !== false) {
    include($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar_staff.php');
} else {
    // Optional default/fallback content
    echo "<div class='sidebar'><h2>NMA System</h2><p style='padding:10px;'>No section matched.</p></div>";
}
?>
