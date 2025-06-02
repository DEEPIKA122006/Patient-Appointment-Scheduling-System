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
    <title>Patient Dashboard</title>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Link to your corrected CSS path -->
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h1><i class="fas fa-user-md"></i> Welcome, Patient!</h1>
        <p class="tagline">Manage your appointments and profile easily</p>

        <div class="button-grid">
            <a href="book_appointment.php" class="dashboard-button green">
                <i class="fas fa-calendar-plus"></i><br>Book Appointment
            </a>

            <a href="view_appointments.php" class="dashboard-button blue">
                <i class="fas fa-eye"></i><br>View Appointments
            </a>

            <a href="cancel_appointment.php" class="dashboard-button red">
                <i class="fas fa-calendar-times"></i><br>Cancel Appointment
            </a>

           <a href="update_profile.php" class="dashboard-button purple">
    <i class="fas fa-user-edit"></i><br>Update Profile
</a>


            <a href="logout.php" class="dashboard-button dark">
                <i class="fas fa-sign-out-alt"></i><br>Logout
            </a>
        </div>
    </div>
</body>
</html>
