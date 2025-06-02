<?php
session_start();
if (!isset($_SESSION['doctor_name'])) {
    header("Location: doctor_login.php");
    exit();
}
$doctor_name = $_SESSION['doctor_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Info</title>
    <style>
        body {
            background: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
        }
        .container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 14px;
            border: 1px solid #ccc;
        }
        th {
            background: #0072ff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f1f1f1;
        }
        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #0072ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>👥 Patient Info - Dr. <?php echo htmlspecialchars($doctor_name); ?></h2>

        <!-- Sample table, replace with DB records -->
        <table>
            <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Contact</th>
                <th>Medical History</th>
            </tr>
            <tr>
                <td>101</td>
                <td>John Doe</td>
                <td>32</td>
                <td>+91-9876543210</td>
                <td>Diabetic</td>
            </tr>
            <!-- Add dynamic rows here -->
        </table>

        <a href="doctor_dashboard.php">⬅️ Back to Dashboard</a>
    </div>
</body>
</html>
