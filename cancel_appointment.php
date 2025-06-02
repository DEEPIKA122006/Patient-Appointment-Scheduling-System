<?php
session_start();
include 'notification.php'; 
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// DB connection
$conn = new mysqli("localhost", "root", "", "patient_appointment_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle cancel request (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_id'])) {
    $cancel_id = intval($_POST['cancel_id']);
    
    // Verify appointment belongs to this patient and is upcoming and confirmed
    $check_sql = "SELECT * FROM appointments WHERE id = ? AND patient_id = ? AND status = 'Confirmed' AND appointment_date >= CURDATE()";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $cancel_id, $patient_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows === 1) {
        // Update status to Cancelled
        $update_sql = "UPDATE appointments SET status = 'Cancelled' WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $cancel_id);
        if ($update_stmt->execute()) {
            $success_message = "Appointment cancelled successfully.";
        } else {
            $error_message = "Error cancelling appointment. Please try again.";
        }
        $update_stmt->close();
    } else {
        $error_message = "Invalid appointment or cannot cancel.";
    }
    $check_stmt->close();
}

// Fetch upcoming confirmed appointments for patient
$sql = "SELECT * FROM appointments WHERE patient_id = ? AND status = 'Confirmed' AND appointment_date >= CURDATE() ORDER BY appointment_date, appointment_time";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cancel Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body { font-family: Arial, sans-serif; background: #fff3f3; padding: 20px; }
        h2 { text-align: center; color: #b30000; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: center; }
        th { background: #dc3545; color: white; }
        tr:nth-child(even) { background: #ffe6e6; }
        .btn-cancel {
            background: #dc3545;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            transition: background 0.3s ease;
        }
        .btn-cancel:hover {
            background: #a71d2a;
        }
        .message {
            max-width: 600px;
            margin: 10px auto;
            padding: 12px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .btn-back {
            background: #007BFF;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
        }
        .btn-back:hover { background: #0056b3; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);}
    </style>
</head>
<body>
<div class="container">
    <h2><i class="fas fa-times-circle"></i> Cancel Appointment</h2>
    
    <?php if (isset($success_message)): ?>
        <div class="message success"><?= htmlspecialchars($success_message) ?></div>
    <?php elseif (isset($error_message)): ?>
        <div class="message error"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <form method="POST" onsubmit="return confirmCancel();" >
        <table>
            <thead>
                <tr>
                    <th>Specialty</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reason</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['specialty']) ?></td>
                    <td><?= htmlspecialchars($row['doctor']) ?></td>
                    <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                    <td><?= htmlspecialchars(substr($row['appointment_time'],0,5)) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['reason'])) ?></td>
                    <td>
                        <button type="submit" name="cancel_id" value="<?= $row['id'] ?>" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </form>
    <?php else: ?>
        <p style="text-align:center; font-size:18px; color:#666;">No upcoming confirmed appointments to cancel.</p>
    <?php endif; ?>

    <div style="text-align:center;">
        <a href="view_appointments.php" class="btn-back"><i class="fas fa-arrow-left"></i> Back to View Appointments</a>
        <a href="patient_dashboard.php" class="btn-back"><i class="fas fa-home"></i> Dashboard</a>
    </div>
</div>

<script>
function confirmCancel() {
    return confirm("Are you sure you want to cancel this appointment?");
}
</script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

