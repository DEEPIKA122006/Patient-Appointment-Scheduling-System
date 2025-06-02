<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Select Your Role - Patient Appointment Scheduling System</title>
    <link rel="stylesheet" href="css/style.css" />
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <div class="container-center">
        <div class="box role-selection-box">
            <h2><i class="fas fa-user-tag"></i> Select Your Role</h2>
            <div class="role-buttons">
                <a href="patient_login.php" class="btn btn-primary btn-large role-btn">
                    <i class="fas fa-user-injured"></i> Patient
                </a>
                <a href="doctor_login.php" class="btn btn-success btn-large role-btn">
                    <i class="fas fa-user-md"></i> Doctor
                </a>
                <a href="admin_login.php" class="btn btn-danger btn-large role-btn">
                    <i class="fas fa-tools"></i> Admin
                </a>
            </div>
        </div>
    </div>
</body>
</html>
