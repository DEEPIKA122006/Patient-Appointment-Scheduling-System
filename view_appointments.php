<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// DB connection - update your credentials if needed
$conn = new mysqli("localhost", "root", "", "patient_appointment_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all appointments for this patient
$sql = "SELECT * FROM appointments WHERE patient_id = ? ORDER BY appointment_date DESC, appointment_time DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: center; }
        th { background: #007BFF; color: white; }
        tr:nth-child(even) { background: #f2f2f2; }
        .status-confirmed { color: green; font-weight: bold; }
        .status-cancelled { color: red; font-weight: bold; }
        .btn {
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
        .btn:hover { background: #0056b3; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);}
    </style>
</head>
<body>
<div class="container">
    <h2><i class="fas fa-calendar-check"></i> Your Appointments</h2>
    
    <?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Specialty</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Booked On</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['specialty']) ?></td>
                <td><?= htmlspecialchars($row['doctor']) ?></td>
                <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                <td><?= htmlspecialchars(substr($row['appointment_time'], 0, 5)) // HH:MM ?></td>
                <td><?= nl2br(htmlspecialchars($row['reason'])) ?></td>
                <td class="status-<?= strtolower($row['status']) ?>">
                    <?= htmlspecialchars($row['status']) ?>
                </td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p style="text-align:center; font-size:18px; color:#666;">No appointments found.</p>
    <?php endif; ?>

    <div style="text-align:center;">
        <a href="patient_dashboard.php" class="btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <a href="book_appointment.php" class="btn" style="background:#28a745;"><i class="fas fa-calendar-plus"></i> Book New Appointment</a>
        <a href="cancel_appointment.php" class="btn" style="background:#dc3545;"><i class="fas fa-times-circle"></i> Cancel Appointment</a>
    </div>
</div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
