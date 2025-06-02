<?php
session_start();
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $entered_password = $_POST['password'];

    $query = "SELECT * FROM doctors WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $doctor = $result->fetch_assoc();
        $stored_password = $doctor['password'];

        if (password_verify($entered_password, $stored_password)) {
            $_SESSION['doctor_id'] = $doctor['id'];
            $_SESSION['doctor_name'] = $doctor['name'];
            header("Location: doctor_dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password.'); window.location.href = 'doctor_login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Doctor with this email not found.'); window.location.href = 'doctor_login.php';</script>";
        exit();
    }
} else {
    header("Location: doctor_login.php");
    exit();
}
?>
