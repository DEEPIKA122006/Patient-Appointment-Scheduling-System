<?php
session_start();
include 'notification.php';
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

// Dummy data - replace with DB data
$specialties = ["Cardiologist", "Dentist", "Dermatologist", "General Physician"];
$doctors = [
    "Cardiologist" => ["Dr. A Sharma", "Dr. K Mehta"],
    "Dentist" => ["Dr. R Verma", "Dr. P Gupta"],
    "Dermatologist" => ["Dr. N Singh"],
    "General Physician" => ["Dr. T Rao", "Dr. H Khan"]
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/form.css"> <!-- ✅ Use this new CSS -->
</head>
<body>
<div class="form-container">
    <h2><i class="fas fa-calendar-plus"></i> Book Appointment</h2>

    <form method="POST" action="save_appointment.php">
        <label for="specialty">Select Specialty:</label>
        <select name="specialty" id="specialty" required onchange="loadDoctors()">
            <option value="">--Select Specialty--</option>
            <?php foreach ($specialties as $spec): ?>
                <option value="<?= $spec ?>"><?= $spec ?></option>
            <?php endforeach; ?>
        </select>

        <label for="doctor">Select Doctor:</label>
        <select name="doctor" id="doctor" required>
            <option value="">--Select Doctor--</option>
        </select>

        <label for="date">Select Date:</label>
        <input type="date" name="date" required min="<?= date('Y-m-d') ?>">

        <label for="time">Select Time:</label>
        <input type="time" name="time" required>

        <label for="reason">Reason for Visit (optional):</label>
        <textarea name="reason" placeholder="Describe your symptoms (optional)..."></textarea>

        <button type="submit"><i class="fas fa-check-circle"></i> Confirm Appointment</button>
    </form>
</div>

<script>
// Dummy JS logic for changing doctors - you can replace with AJAX + PHP in real app
const doctorList = <?= json_encode($doctors) ?>;

function loadDoctors() {
    const specialty = document.getElementById("specialty").value;
    const doctorSelect = document.getElementById("doctor");
    doctorSelect.innerHTML = '<option value="">--Select Doctor--</option>';

    if (doctorList[specialty]) {
        doctorList[specialty].forEach(function(doctor) {
            const option = document.createElement("option");
            option.value = doctor;
            option.text = doctor;
            doctorSelect.appendChild(option);
        });
    }
}
</script>
</body>
</html>

