<?php
// view_appointments_admin.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "patient_appointment_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Join query to get patient and doctor names
$sql = "SELECT a.id, p.name AS patient_name, d.name AS doctor_name, a.appointment_date, a.appointment_time, a.status 
        FROM appointments a
        JOIN patients p ON a.patient_id = p.id
        JOIN doctors d ON a.doctor_id = d.id
        ORDER BY a.appointment_date DESC, a.appointment_time DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>📋 All Appointments - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f4f8;
            margin: 0;
            text-align: center;
        }
        h1 {
            background: #3f51b5;
            color: white;
            padding: 20px;
            margin: 0;
        }
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #ccc;
        }
        th {
            background: #283593;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .status {
            font-weight: bold;
            padding: 6px 10px;
            border-radius: 6px;
        }
        .Confirmed {
            background: #4caf50;
            color: white;
        }
        .Cancelled {
            background: #f44336;
            color: white;
        }
        .Pending {
            background: #ff9800;
            color: white;
        }
        .back-btn {
            display: inline-block;
            margin: 20px;
            background: #3f51b5;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
        }
        .back-btn i {
            margin-right: 6px;
        }
    </style>
</head>
<body>

<h1>📋 All Appointments - Admin View</h1>

<table>
    <tr>
        <th>Appointment ID</th>
        <th>Patient Name</th>
        <th>Doctor Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['patient_name']) ?></td>
                <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                <td><?= htmlspecialchars($row['appointment_time']) ?></td>
                <td><span class="status <?= $row['status'] ?>"><?= htmlspecialchars($row['status']) ?></span></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="6">No appointments found.</td></tr>
    <?php endif; ?>
</table>

<a href="admin_dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>

</body>
</html>

<?php $conn->close(); ?>

