<?php
include 'includes/db_connect.php'; // your DB connection file path

function hash_passwords_in_table($conn, $table_name) {
    $result = $conn->query("SELECT id, password FROM $table_name");
    
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $plain_password = $row['password'];

        if (password_get_info($plain_password)['algo'] === 0) { // if not hashed yet
            $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
            $conn->query("UPDATE $table_name SET password='$hashed_password' WHERE id=$id");
            echo "Password hashed for $table_name id: $id <br>";
        } else {
            echo "Password for $table_name id: $id already hashed <br>";
        }
    }
}

hash_passwords_in_table($conn, 'patients');
hash_passwords_in_table($conn, 'doctors');
hash_passwords_in_table($conn, 'admins');

echo "All passwords hashed successfully.";
?>
