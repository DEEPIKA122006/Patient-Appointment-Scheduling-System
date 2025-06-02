<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "patient_appointment_system"; // Change this if your DB name is different

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
