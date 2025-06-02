<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Control Panel – Appointment System</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: #f0f0f5;
      font-family: 'Segoe UI', sans-serif;
    }
    .dashboard-container {
      max-width: 900px;
      margin: 40px auto;
      padding: 30px;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      text-align: center;
    }
    h1 {
      color: #333;
      margin-bottom: 30px;
      font-size: 28px;
    }
    .dashboard-buttons {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
      margin-top: 20px;
    }
    .dashboard-buttons a {
      display: block;
      padding: 20px;
      background: #f7f9fc;
      border: 2px solid #ccc;
      border-radius: 15px;
      font-size: 20px;
      color: #333;
      text-decoration: none;
      transition: 0.3s;
    }
    .dashboard-buttons a i {
      font-size: 28px;
      margin-bottom: 10px;
      color: #007BFF;
    }
    .dashboard-buttons a:hover {
      background-color: #e9f0ff;
      transform: translateY(-5px);
      box-shadow: 0 0 10px rgba(0,123,255,0.3);
    }
    .logout {
      margin-top: 30px;
    }
    .logout a {
      padding: 10px 20px;
      background: #dc3545;
      color: white;
      border: none;
      border-radius: 10px;
      text-decoration: none;
      font-size: 16px;
    }
    .logout a:hover {
      background: #c82333;
    }
  </style>
</head>
<body>

  <div class="dashboard-container">
    <h1><i class="fas fa-user-shield"></i> Welcome, Admin</h1>

    <div class="dashboard-buttons">
      <a href="manage_patients.php">
        <i class="fas fa-users"></i><br>
        Manage Patients
      </a>
      <a href="manage_doctors.php">
        <i class="fas fa-user-md"></i><br>
        Manage Doctors
      </a>
      <a href="view_appointments_admin.php">
        <i class="fas fa-calendar-check"></i><br>
        View Appointments
      </a>
      <a href="system_reports.php">
        <i class="fas fa-chart-bar"></i><br>
        System Reports
      </a>
    </div>

    <div class="logout">
      <a href="admin_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>

</body>
</html>
