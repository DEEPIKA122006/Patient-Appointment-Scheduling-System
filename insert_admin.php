<?php
include 'db_connection.php'; // ✅ This brings in the connectDB() function

$conn = connectDB();

$name = "Admin User";
$email = "admin@example.com";
$password = password_hash("admin123", PASSWORD_DEFAULT); // secure hashed password

$stmt = $conn->prepare("INSERT INTO admin (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "✅ Admin inserted!";
} else {
    echo "❌ Error inserting admin: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
