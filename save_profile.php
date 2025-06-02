<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "patient_appointment_system");

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$password = $_POST['password'];

// If password field is empty, don't update it
if (empty($password)) {
    $query = "UPDATE patients SET name='$name', email='$email', mobile='$mobile', dob='$dob', address='$address' WHERE id=$id";
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE patients SET name='$name', email='$email', mobile='$mobile', dob='$dob', address='$address', password='$hashed_password' WHERE id=$id";
}

if ($conn->query($query) === TRUE) {
    echo "<script>alert('Profile updated successfully!'); window.location.href='patient_dashboard.php';</script>";
} else {
    echo "Error: " . $conn->error;
}
?>
