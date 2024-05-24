<?php
include('config.php');
session_start();

$un = $_SESSION['username'];
if (!$un) {
    header("Location: login1.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .footer button {
            background-color: #575757;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="#user-management-section">User Management</a></li>
            <li><a href="http://localhost/RURU/booking.php">Booking</a></li>
            <li><a href="#reports-section">Reports</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div id="user-management-section" class="content-section">
            <h2>User Management</h2>
            <p>Manage users here.</p>
        </div>
        <div id="reports-section" class="content-section">
            <h2>Reports</h2>
            <p>View reports here.</p>
        </div>
    </div>
    <div class="footer">
        Logged in as <span id="username"><?php echo htmlspecialchars($un); ?></span>
        <button onclick="logout()">Logout</button>
        <button onclick="changePassword()">Change Password</button>
    </div>

    <script>
        function logout() {
            window.location.href = "logout.php"; // replace with your link
        }

        function changePassword() {
            window.location.href = "own_changepassword.php"; // replace with your link
        }
    </script>
    <script src="script2.js"></script>
</body>
</html>
