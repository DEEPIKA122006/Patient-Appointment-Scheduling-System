<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header('Location: patient_login.php');
    exit;
}

include 'includes/db_connect.php';

// Fetch form data
$patient_id = $_SESSION['patient_id'];
$doctor_id = $_POST['doctor_id'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];
$reason = $_POST['reason'] ?? '';

// Insert into database
$sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, reason)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisss", $patient_id, $doctor_id, $appointment_date, $appointment_time, $reason);

if ($stmt->execute()) {
    // Fetch patient & doctor email for email notification
    $patient_email = '';
    $doctor_email = '';
    $patient_name = '';
    $doctor_name = '';

    // Get patient info
    $res = $conn->query("SELECT name, email FROM patients WHERE id = $patient_id");
    if ($row = $res->fetch_assoc()) {
        $patient_email = $row['email'];
        $patient_name = $row['name'];
    }

    // Get doctor info
    $res2 = $conn->query("SELECT name, email FROM doctors WHERE id = $doctor_id");
    if ($row2 = $res2->fetch_assoc()) {
        $doctor_email = $row2['email'];
        $doctor_name = $row2['name'];
    }

    // Email notification using PHPMailer
    require 'includes/PHPMailer/PHPMailer.php';
    require 'includes/PHPMailer/SMTP.php';
    require 'includes/PHPMailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'deepika.cs23@krct.ac.in'; // ✅ Your Gmail
        $mail->Password = 'abcdefghijklmnop'; // ✅ App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Appointment System');
        $mail->addAddress($patient_email, $patient_name); // Patient
        $mail->addAddress($doctor_email, $doctor_name);   // Doctor

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Appointment Booked';
        $mail->Body = "
            <h3>Appointment Details</h3>
            <p><strong>Patient:</strong> $patient_name</p>
            <p><strong>Doctor:</strong> $doctor_name</p>
            <p><strong>Date:</strong> $appointment_date</p>
            <p><strong>Time:</strong> $appointment_time</p>
            <p><strong>Reason:</strong> $reason</p>
        ";

        $mail->send();
        $_SESSION['success'] = 'Appointment booked successfully and email sent!';
    } catch (Exception $e) {
        $_SESSION['success'] = 'Appointment booked, but email failed: ' . $mail->ErrorInfo;
    }
} else {
    $_SESSION['error'] = 'Failed to book appointment.';
}

header('Location: patient_dashboard.php');
exit;
?>
