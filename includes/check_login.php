<?php
session_start();

// Support both admin (user_id) and staff (employment_no)
if (
    (!isset($_SESSION['user_id']) && !isset($_SESSION['employment_no'])) ||
    !isset($_SESSION['role'])
) {
    header("Location: /login.php");
    exit();
}

function require_role($allowed_roles) {
    if (!in_array(strtolower($_SESSION['role']), array_map('strtolower', $allowed_roles))) {
        echo "<h3 style='color:red;text-align:center;'>Access Denied: You do not have permission to view this page.</h3>";
        exit();
    }
}
?>
