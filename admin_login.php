<?php
// admin_login.php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Patient Appointment System</title>
    <style>
        body {
            background-color: #f2f9ff;
            font-family: Arial, sans-serif;
        }
        .login-box {
            width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #90caf9;
            text-align: center;
        }
        .login-box h2 {
            margin-bottom: 20px;
            color: #1565c0;
        }
        .login-box input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #bbb;
            border-radius: 5px;
        }
        .login-box button {
            padding: 10px 20px;
            background-color: #1976d2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-box button:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>

<?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
    <div style="text-align:center; margin: 20px auto; padding: 20px; max-width: 600px; background-color: #e0f7fa; border: 2px solid #00acc1; border-radius: 10px; color: #006064; font-size: 18px;">
        <h2>👋 Goodbye, Admin!</h2>
        <p>You have successfully logged out of the Admin Control Panel.</p>
        <p>Thank you for keeping the system running smoothly. See you again soon!</p>
    </div>
<?php endif; ?>

<div class="login-box">
    <h2>Admin Login</h2>
    <form action="admin_login_process.php" method="post">
        <input type="email" name="email" placeholder="Admin Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
<p class="center-text"><a href="select_role.php"><i class="fas fa-arrow-left"></i> Back to Role Selection</a></p>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
