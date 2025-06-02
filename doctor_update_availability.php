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
    <title>Update Availability</title>
    <style>
        body {
            background: #f0f0f0;
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            background: white;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        h2 {
            margin-bottom: 20px;
        }
        label, input {
            display: block;
            margin: 10px auto;
            font-size: 16px;
        }
        input[type="submit"] {
            background: #0072ff;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 30px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>👨‍⚕️ Update Availability - Dr. <?php echo htmlspecialchars($doctor_name); ?></h2>
        <form method="post" action="">
            <label for="available_date">Available Date:</label>
            <input type="date" name="available_date" required>

            <label for="available_time">Available Time:</label>
            <input type="time" name="available_time" required>

            <input type="submit" value="Update">
        </form>

        <br>
        <a href="doctor_dashboard.php">⬅️ Back to Dashboard</a>
    </div>
</body>
</html>
