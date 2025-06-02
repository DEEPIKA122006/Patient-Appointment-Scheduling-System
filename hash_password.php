<?php
include("db_connection.php");
$email = "doctor2@example.com";
$hashed = password_hash("123456", PASSWORD_DEFAULT);
$query = "UPDATE doctors SET password=? WHERE email=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $hashed, $email);
$stmt->execute();
echo "Password hashed!";
?>
<?php
include("db_connection.php");
$email = "doctor2@example.com";
$hashed = password_hash("123456", PASSWORD_DEFAULT);
$query = "UPDATE doctors SET password=? WHERE email=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $hashed, $email);
$stmt->execute();
echo "Password hashed!";
?>
