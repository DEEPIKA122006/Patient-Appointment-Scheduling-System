<?php
// manage_patients.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "patient_appointment_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM patients");
?>

<!DOCTYPE html>
<html>
<head>
    <title>👥 Manage Patients - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4fdfd;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            background-color: #00796b;
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
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #004d40;
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
            background-color: #1976d2;
            color: white;
        }
        .delete-btn {
            background-color: #d32f2f;
            color: white;
        }
        .back-btn {
            margin: 20px;
            padding: 10px 20px;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>

<h1>👥 Manage Patients</h1>

<table>
    <tr>
        <th>Patient ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= !empty($row['phone']) ? htmlspecialchars($row['phone']) : '-' ?></td>
        <td><?= !empty($row['gender']) ? htmlspecialchars($row['gender']) : '-' ?></td>
        <td>
            <a href="edit_patient.php?id=<?= $row['id'] ?>" class="btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
            <a href="delete_patient.php?id=<?= $row['id'] ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this patient?');"><i class="fas fa-trash"></i> Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>

</table>

<a href="admin_dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>

</body>
</html>

<?php $conn->close(); ?>
