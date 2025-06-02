<?php
// update_profile.php (Patient)
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "patient_appointment_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$patient_id = $_SESSION['patient_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    $update_query = "UPDATE patients SET name=?, email=?, phone=?, gender=?, password=? WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssssi", $name, $email, $phone, $gender, $password, $patient_id);
    $stmt->execute();
    $success = true;
}

$result = $conn->query("SELECT * FROM patients WHERE id = $patient_id");
$patient = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>🛠️ Update Profile - Patient</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e0f2f1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #00796b;
        }

        .input-group {
            margin: 15px 0;
            text-align: left;
        }

        .input-group label {
            font-weight: bold;
            color: #004d40;
            display: block;
            margin-bottom: 5px;
        }

        .input-group input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .btn {
            background-color: #00796b;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            width: 100%;
        }

        .btn:hover {
            background-color: #004d40;
        }

        .back-btn {
            margin-top: 20px;
            display: inline-block;
            color: #00796b;
            text-decoration: none;
        }

        .success-msg {
            background-color: #c8e6c9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        @media (max-width: 600px) {
            .container {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fas fa-user-edit"></i> Update Profile</h2>

    <?php if (isset($success)): ?>
        <div class="success-msg">
            <i class="fas fa-check-circle"></i> Profile updated successfully!
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <label><i class="fas fa-user"></i> Name</label>
            <input type="text" name="name" required value="<?= htmlspecialchars($patient['name']) ?>">
        </div>

        <div class="input-group">
            <label><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" required value="<?= htmlspecialchars($patient['email']) ?>">
        </div>

        <div class="input-group">
            <label><i class="fas fa-phone"></i> Phone</label>
            <input type="text" name="phone" required value="<?= htmlspecialchars($patient['phone']) ?>">
        </div>

        <div class="input-group">
            <label><i class="fas fa-venus-mars"></i> Gender</label>
            <select name="gender" required>
                <option value="Male" <?= $patient['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $patient['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= $patient['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>

        <div class="input-group">
            <label><i class="fas fa-lock"></i> Password</label>
            <input type="password" name="password" required value="<?= htmlspecialchars($patient['password']) ?>">
        </div>

        <button class="btn"><i class="fas fa-save"></i> Update</button>
    </form>

    <a class="back-btn" href="patient_dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>

</body>
</html>

<?php $conn->close(); ?>

