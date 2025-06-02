<?php
session_start();
if (isset($_SESSION['patient_id'])) {
    header('Location: patient_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Patient Sign Up - Patient Appointment Scheduling System</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<div class="container-center">
    <div class="box login-box">
        <h2><i class="fas fa-user-plus"></i> Patient Sign Up</h2>

        <?php
        if (isset($_SESSION['signup_error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['signup_error'] . '</div>';
            unset($_SESSION['signup_error']);
        }
        ?>

        <form action="patient_signup_process.php" method="post" autocomplete="off">
            <label for="name"><i class="fas fa-user"></i> Full Name</label>
            <input type="text" id="name" name="name" required placeholder="Enter your full name" />

            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email" />

            <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
            <input type="text" id="phone" name="phone" required placeholder="Enter your phone number" />

            <label for="password"><i class="fas fa-lock"></i> Password</label>
            <input type="password" id="password" name="password" required placeholder="Create a password" />

            <button type="submit" class="btn btn-success btn-large btn-block">
                <i class="fas fa-user-plus"></i> Sign Up
            </button>
        </form>

        <p class="center-text">Already have an account? <a href="patient_login.php">Login Here</a></p>
        <p class="center-text"><a href="select_role.php"><i class="fas fa-arrow-left"></i> Back to Role Selection</a></p>
    </div>
</div>
</body>
</html>
