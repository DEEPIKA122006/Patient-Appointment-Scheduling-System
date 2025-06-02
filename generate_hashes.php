<?php
echo "Patient password hash: " . password_hash('patientpass', PASSWORD_DEFAULT) . "\n";
echo "Doctor password hash: " . password_hash('doctorpass', PASSWORD_DEFAULT) . "\n";
echo "Admin password hash: " . password_hash('adminpass', PASSWORD_DEFAULT) . "\n";
?>
