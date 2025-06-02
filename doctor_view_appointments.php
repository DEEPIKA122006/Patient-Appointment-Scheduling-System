<?php
session_start();
include 'db.php'; // Your database connection file

// Check if doctor is logged in
if (!isset($_SESSION['doctor_name'])) {
    header("Location: doctor_login.php");
    exit();
}

$doctor_name = $_SESSION['doctor_name'];

// Prepare SQL to get appointments by doctor name
$stmt = $conn->prepare("SELECT * FROM appointments WHERE doctor = ? ORDER BY appointment_date, appointment_time");
$stmt->bind_param("s", $doctor_name);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Doctor Appointments - Patient Appointment Scheduling System</title>
    <link rel="stylesheet" href="css/style.css" />
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 30px 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            width: 90%;
            max-width: 1100px;
            text-align: center;
        }
        h2 {
            color: #0077cc;
            margin-bottom: 25px;
            font-weight: 700;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        thead {
            background-color: #0077cc;
            color: white;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            font-size: 15px;
        }
        tbody tr:nth-child(even) {
            background-color: #f3f8ff;
        }
        tbody tr:hover {
            background-color: #d6eaff;
        }
        .no-appointments {
            font-size: 18px;
            color: #555;
            margin: 20px 0;
        }
        .btn-back {
            display: inline-block;
            background-color: #0077cc;
            color: white;
            padding: 15px 40px;
            border-radius: 30px;
            font-size: 20px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 119, 204, 0.6);
            transition: background-color 0.3s ease;
        }
        .btn-back i {
            margin-right: 10px;
        }
        .btn-back:hover {
            background-color: #004a80;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-user-md"></i> Appointments for Dr. <?php echo htmlspecialchars($doctor_name); ?></h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-id-badge"></i> ID</th>
                        <th><i class="fas fa-user-injured"></i> Patient ID</th>
                        <th><i class="fas fa-calendar-alt"></i> Date</th>
                        <th><i class="fas fa-clock"></i> Time</th>
                        <th><i class="fas fa-file-medical-alt"></i> Reason</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-calendar-plus"></i> Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['patient_id']; ?></td>
                        <td><?php echo $row['appointment_date']; ?></td>
                        <td><?php echo $row['appointment_time']; ?></td>
                        <td><?php echo htmlspecialchars($row['reason']); ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-appointments"><i class="fas fa-exclamation-circle"></i> No appointments found.</p>
        <?php endif; ?>

        <a href="doctor_dashboard.php" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>
</body>
</html>
