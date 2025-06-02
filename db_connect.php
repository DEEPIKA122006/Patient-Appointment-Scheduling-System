<?php
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "patient_appointment_system"; // Make sure this matches your DB name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("❌ Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>

