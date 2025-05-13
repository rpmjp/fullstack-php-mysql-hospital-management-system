<?php
session_start();
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Step 1: Check if it's an admin from USERS table
    $stmt = $conn->prepare("SELECT User_ID, Password_Hash, Role FROM USERS WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $password_hash, $role);
        $stmt->fetch();
        if (password_verify($password, $password_hash)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header("Location: /index.php");
            exit();
        } else {
            $error = "Incorrect password for admin.";
        }
        $stmt->close();
    } else {
        // Step 2: Check if the user exists in STAFF
        $stmt = $conn->prepare("SELECT Employment_No, Name FROM STAFF WHERE Name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $staff = $result->fetch_assoc();
            $emp_no = $staff['Employment_No'];

            // Use prepared statements to determine the role
            $role = null;

            $check = $conn->prepare("SELECT 1 FROM PHYSICIAN WHERE Employment_No = ?");
            $check->bind_param("i", $emp_no);
            $check->execute();
            $check->store_result();
            if ($check->num_rows > 0) $role = 'physician';
            $check->close();

            if (!$role) {
                $check = $conn->prepare("SELECT 1 FROM SURGEON WHERE Employment_No = ?");
                $check->bind_param("i", $emp_no);
                $check->execute();
                $check->store_result();
                if ($check->num_rows > 0) $role = 'surgeon';
                $check->close();
            }

            if (!$role) {
                $check = $conn->prepare("SELECT 1 FROM NURSE WHERE Employment_No = ?");
                $check->bind_param("i", $emp_no);
                $check->execute();
                $check->store_result();
                if ($check->num_rows > 0) $role = 'nurse';
                $check->close();
            }

            if (!$role) $role = 'receptionist'; // fallback

            // Verify password matches default group password
            $default_passwords = [
                'physician' => 'physician',
                'surgeon' => 'surgeon',
                'nurse' => 'nurse',
                'receptionist' => 'receptionist'
            ];

            if ($password === $default_passwords[$role]) {
                $_SESSION['employment_no'] = $emp_no;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                header("Location: /index.php");
                exit();
            } else {
                $error = "Incorrect password for $role.";
            }
        } else {
            $error = "User not found.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - NMA Clinic</title>
  <style>
    body {
      background: #f8f9fa;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      width: 300px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #255fb4;
      color: white;
      border: none;
      margin-top: 20px;
    }
    .error { color: red; text-align: center; margin-top: 10px; }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Enter Your Name" required>
      <input type="password" name="password" placeholder="Group Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
