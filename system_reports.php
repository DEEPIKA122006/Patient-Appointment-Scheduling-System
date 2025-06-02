<?php
// system_reports.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
include 'db_connection.php';
$conn = connectDB();

$patients = $conn->query("SELECT COUNT(*) as total FROM patients")->fetch_assoc()['total'];
$doctors = $conn->query("SELECT COUNT(*) as total FROM doctors")->fetch_assoc()['total'];
$appointments = $conn->query("SELECT COUNT(*) as total FROM appointments")->fetch_assoc()['total'];
$cancelled = $conn->query("SELECT COUNT(*) as total FROM appointments WHERE status='Cancelled'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>System Reports</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body { font-family: Arial; background: #fff; }
    .box { max-width: 800px; margin: 40px auto; padding: 30px; background: #e9ecef; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.2); }
    h2 { text-align: center; color: #6c757d; }
    .report { background: white; border-radius: 8px; margin: 20px 0; padding: 20px; font-size: 18px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    .report i { margin-right: 10px; color: #007bff; }
    .back-btn { background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; display: block; margin: 30px auto; width: 250px; text-align: center; }
  </style>
</head>
<body>
<div class="box">
  <h2><i class="fas fa-chart-bar"></i> System Reports</h2>
  <div class="report"><i class="fas fa-users"></i> Total Patients: <strong><?= $patients ?></strong></div>
  <div class="report"><i class="fas fa-user-md"></i> Total Doctors: <strong><?= $doctors ?></strong></div>
  <div class="report"><i class="fas fa-calendar-check"></i> Total Appointments: <strong><?= $appointments ?></strong></div>
  <div class="report"><i class="fas fa-calendar-times"></i> Cancelled Appointments: <strong><?= $cancelled ?></strong></div>
  <a href="admin_dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>
</body>
</html>