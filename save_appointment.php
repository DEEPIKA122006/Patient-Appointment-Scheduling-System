<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "patient_appointment_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data and sanitize
$patient_id = $_SESSION['patient_id'];
$specialty = $conn->real_escape_string($_POST['specialty']);
$doctor = $conn->real_escape_string($_POST['doctor']);
$date = $conn->real_escape_string($_POST['date']);
$time = $conn->real_escape_string($_POST['time']);
$reason = $conn->real_escape_string($_POST['reason']);

// Validate required fields
if (empty($specialty) || empty($doctor) || empty($date) || empty($time)) {
    die("Please fill all required fields.");
}

// Insert into appointments table
$sql = "INSERT INTO appointments (patient_id, specialty, doctor, appointment_date, appointment_time, reason) VALUES 
        ('$patient_id', '$specialty', '$doctor', '$date', '$time', '$reason')";

if ($conn->query($sql) === TRUE) {
    header("Location: appointment_success.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}


$conn->close();
?>
