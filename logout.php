<?php
session_start();
$username = isset($_SESSION['patient_name']) ? $_SESSION['patient_name'] : "User";

// End the session
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>
    <meta http-equiv="refresh" content="8;url=patient_login.php" /> <!-- Auto redirect -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f8ff;
            text-align: center;
            padding: 100px;
            font-family: 'Segoe UI', sans-serif;
        }
        .logout-box {
            display: inline-block;
            padding: 30px 40px;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        }
        .logout-box h1 {
            font-size: 30px;
            color: #2d89ef;
        }
        .logout-box p {
            font-size: 18px;
            margin-top: 10px;
        }
        .logout-box i {
            font-size: 40px;
            color: #2d89ef;
            margin-bottom: 20px;
        }
        .logout-box button {
            margin-top: 20px;
            background-color: #2d89ef;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .logout-box button:hover {
            background-color: #1b5dab;
        }
    </style>
</head>
<body>
    <div class="logout-box">
        <i class="fas fa-sign-out-alt"></i>
        <h1>Goodbye, <?= htmlspecialchars($username) ?>!</h1>
        <p>You have successfully logged out of the Patient Appointment System.</p>
        <p>Thank you for using our service. See you again soon!</p>
        <button onclick="window.location.href='patient_login.php';"><i class="fas fa-sign-in-alt"></i> Login Again</button>
    </div>
</body>
</html>
