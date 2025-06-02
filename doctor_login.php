<?php
session_start();
if (isset($_SESSION['doctor_logged_in'])) {
    header("Location: doctor_dashboard.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "patient_appointment_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, name, email, password FROM doctors WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $doctor = $result->fetch_assoc();

        // Assuming passwords are stored hashed, use password_verify
        if (password_verify($password, $doctor['password'])) {
            // Correct login
            $_SESSION['doctor_logged_in'] = true;
            $_SESSION['doctor_id'] = $doctor['id'];
            $_SESSION['doctor_name'] = $doctor['name'];

            header("Location: doctor_dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e0f2f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }
        h2 {
            margin-bottom: 30px;
            color: #00796b;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        button {
            background-color: #00796b;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #004d40;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .fa-user-md {
            font-size: 50px;
            color: #00796b;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <i class="fas fa-user-md"></i>
    <h2>Doctor Login</h2>

    <?php if($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <input type="email" name="email" placeholder="Email" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
<p class="center-text"><a href="select_role.php"><i class="fas fa-arrow-left"></i> Back to Role Selection</a></p>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

