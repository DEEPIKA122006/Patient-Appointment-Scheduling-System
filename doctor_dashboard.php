<?php
session_start();
if (!isset($_SESSION['doctor_name'])) {
    header("Location: doctor_login.php");
    exit();
}
$doctor_name = $_SESSION['doctor_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            text-align: center;
        }
        .container {
            max-width: 1000px;
            margin: 40px auto;
        }
        .header {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .sub-header {
            font-size: 24px;
            margin-bottom: 30px;
        }
        .dashboard-btn {
            display: inline-block;
            width: 250px;
            padding: 20px;
            margin: 15px;
            background-color: #ffffff;
            color: #0072ff;
            border-radius: 16px;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        .dashboard-btn:hover {
            background-color: #0072ff;
            color: white;
        }
        .dashboard-btn i {
            margin-right: 12px;
        }
        .bottom-links {
            margin-top: 40px;
        }
        .bottom-links a {
            color: #fff;
            text-decoration: underline;
            font-size: 18px;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 40px;
            padding: 14px 30px;
            background-color: #ff4444;
            color: white;
            font-size: 18px;
            border-radius: 30px;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">👨‍⚕️ Welcome Dr. <?php echo htmlspecialchars($doctor_name); ?></div>
        <div class="sub-header">Choose an action:</div>

        <a href="doctor_view_appointments.php" class="dashboard-btn"><i class="fas fa-calendar-check"></i> View Appointments</a>
        <a href="doctor_update_availability.php" class="dashboard-btn"><i class="fas fa-user-clock"></i> Update Availability</a>
        <a href="doctor_patient_info.php" class="dashboard-btn"><i class="fas fa-users"></i> Patient Info</a>
        <a href="logout.php" class="dashboard-btn logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>

        <div class="bottom-links">
            <a href="select_role.php"><i class="fas fa-arrow-left"></i> Back to Role Selection</a>
        </div>
    </div>
</body>
</html>

