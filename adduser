<?php
include('connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Page Layout</title>
    <link rel="stylesheet" href="../form/form.css">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;

            /* Prevent scrolling on body */
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 200px;
            background: #de1f26;
            ;
            color: #fff;
            padding: 20px;
            flex-shrink: 0;
            /* Prevent sidebar from shrinking */
            overflow-y: auto;
            /* Enable vertical scrolling for sidebar if needed */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin-top: 0;
        }

        .sidebar ul li {
            margin-top: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            font-size: 25px;
        }

        .sidebar ul li a {
            color: #FFf;
            text-decoration: none;
        }

        .sidebar ul li a:hover {
            color: #FFA500;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            /* Enable vertical scrolling for content if needed */
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background: #de1f26;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .footer button {
            background-color: #FFD700;
            color: #333;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            margin-right: 10px;
        }

        .footer button:hover {
            background-color: #FFA500;
        }

        .clicked-link {
            display: none;
            /* Hide the div by default */
            background-color: #f0f0f0;
            padding: 10px;
            margin-top: 10px;
        }

        .sidebar ul li a:target+.clicked-link {
            display: block;
            /* Show the div when the corresponding anchor is targeted */
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<?php
$un = $_SESSION['un'];
$role_id = $_SESSION['role_id'];
if (!$un) {
    header("Location:login.php");
}

?>

<body>
    <div class="container">
        <div class="sidebar">
            <h2>Blood Bank Management </h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="donor_registeration.php">Blood doner registeration</a></li>
                <li><a href="registeration.php">Patient registeration</a></li>
                <li><a href="stock_blood.php">Blood Stock</a></li>

                <?php if ($role_id ==  '1') {
                    echo "  <li><a href='add_user.php'>Add User</a></li>";
                    echo "<li><a href='change_password.php'>Change Password</a></li>";
                    echo "<li><a href='user_list.php'>List of Users</a></li>";
                }
                ?>
                <!-- Add more menu items if needed -->
            </ul>
        </div>
        <div class="content">
            <h1>User Registration</h1>
            <form action="" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <!-- <label for="email">Email:</label>
                <input type="text" id="email" name="email" required> -->

                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="1">Admin</option>
                    <option value="3">User</option>
                </select>

                <input type="submit" value="Register">
            </form>
        </div>
    </div>
    <div class="footer">
        Logged in as <span id="username"><?php echo $un ?></span>
        <button onclick="logout()">Logout</button>
        <button onclick="changePassword()">Change Password</button>
    </div>

    
    <script>
        function logout() {
            window.location.href = "logout.php"; // replace with your link
        }

        function changePassword() {
            window.location.href = "own_changepassword.php";
        }
    </script>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];
    $role_id=$_POST['role'];

    // SQL injection prevention: Convert special characters to HTML entities
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $cpassword = htmlspecialchars($cpassword);

    if ($password === $cpassword) {
        // Here you can proceed with your registration or update logic
        $sql = "INSERT INTO users (username, password,  role_id)
                VALUES ('$username', '$password', ' $role_id')";
    
        // Execute the SQL query
        if ($conn->query($sql) === TRUE) {

            echo "<script>alert('Sucess'); </script> ";
            exit;
        } else {
            echo "<script>alert('Error inserting record:'); </script> ";
        }
    } else {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    }

    // SQL query to insert form data into users table

    // Close the connection
    $conn->close();
} 
?>
