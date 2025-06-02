<?php
session_start();
require 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM patients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['signup_error'] = "Email already registered. Please login.";
        header('Location: patient_signup.php');
        exit;
    } else {
        // Insert new patient
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO patients (name, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);
        if ($stmt->execute()) {
            $_SESSION['signup_success'] = "Registration successful! Please login.";
            header('Location: patient_login.php');
            exit;
        } else {
            $_SESSION['signup_error'] = "Error during registration. Please try again.";
            header('Location: patient_signup.php');
            exit;
        }
    }
} else {
    $_SESSION['signup_error'] = "Invalid request method.";
    header('Location: patient_signup.php');
    exit;
}
