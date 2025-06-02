<?php
// manage_doctors.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "patient_appointment_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html>
<head>
    <title>👨‍⚕️ Manage Doctors - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            background-color: #3949ab;
            color: white;
            padding: 20px 0;
            margin: 0;
        }
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #303f9f;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            padding: 6px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .edit-btn {
            background-color: #039be5;
            color: white;
        }
        .delete-btn {
            background-color: #e53935;
            color: white;
        }
        .back-btn {
            margin: 20px;
            padding: 10px 20px;
            background-color: #3949ab;
            color: white;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: #1a237e;
        }
    </style>
</head>
<body>

<h1>👨‍⚕️ Manage Doctors</h1>

<table>
    <tr>
        <th>Doctor ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Specialty</th>
        <th>Availability</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= !empty($row['specialty']) ? htmlspecialchars($row['specialty']) : '-' ?></td>
            <td><?= !empty($row['availability']) ? htmlspecialchars($row['availability']) : '-' ?></td>
            <td>
                <a href="edit_doctor.php?id=<?= $row['id'] ?>" class="btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                <a href="delete_doctor.php?id=<?= $row['id'] ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this doctor?');"><i class="fas fa-trash"></i> Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<a href="admin_dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>

</body>
</html>

<?php $conn->close(); ?>

