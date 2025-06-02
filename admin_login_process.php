<?php
session_start();
include 'db_connection.php'; // Make sure this connects to your DB

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo "All fields are required.";
    exit;
}

$conn = connectDB();

$stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    
    if (password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_name'] = $admin['name'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "Email not found.";
}
$stmt->close();
$conn->close();
?>

