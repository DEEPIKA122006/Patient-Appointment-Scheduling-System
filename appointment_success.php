<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Booked</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #e0f7fa;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .success-box {
            background: #00bfa5;
            color: white;
            padding: 40px 60px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 100%;
        }
        .success-box i {
            font-size: 60px;
            margin-bottom: 20px;
        }
        .success-box h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        .success-box p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .success-box .btn {
            display: inline-block;
            background: white;
            color: #00bfa5;
            padding: 12px 28px;
            font-size: 16px;
            border-radius: 30px;
            text-decoration: none;
            margin: 10px 15px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .success-box .btn:hover {
            background: #00796b;
            color: white;
        }
    </style>
</head>
<body>

<div class="success-box">
    <i class="fas fa-check-circle"></i>
    <h1>Appointment Booked!</h1>
    <p>Your appointment has been successfully scheduled.</p>
    <a href="view_appointments.php" class="btn">View Appointments</a>
    <a href="patient_dashboard.php" class="btn">Back to Dashboard</a>
</div>

</body>
</html>
