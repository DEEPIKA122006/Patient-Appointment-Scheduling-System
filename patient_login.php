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
<title>Patient Login - Patient Appointment Scheduling System</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<div class="container-center">
    <div class="box login-box">
        <h2><i class="fas fa-user-injured"></i> Patient Login</h2>
        <?php
        if (isset($_SESSION['login_error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['login_error'] . '</div>';
            unset($_SESSION['login_error']);
        }
        if (isset($_SESSION['signup_success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['signup_success'] . '</div>';
            unset($_SESSION['signup_success']);
        }
        ?>
        <form action="patient_login_process.php" method="post" autocomplete="off">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email" />

            <label for="password"><i class="fas fa-lock"></i> Password</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password" />

            <button type="submit" class="btn btn-primary btn-large btn-block">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <p class="center-text">Don't have an account? <a href="patient_signup.php">Sign Up Here</a></p>
        <p class="center-text"><a href="select_role.php"><i class="fas fa-arrow-left"></i> Back to Role Selection</a></p>
    </div>
</div>
</body>
</html>
