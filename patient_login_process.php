<?php
session_start();
include 'includes/db_connect.php'; // Make sure this file connects to your DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM patients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['patient_id'] = $row['id'];
            header("Location: patient_dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Email not found.";
    }
} else {
    echo "Invalid request.";
}
?>
