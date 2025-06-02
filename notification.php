<?php
if (isset($_SESSION['message'])) {
    $type = $_SESSION['message_type'] ?? 'info';
    $alertClass = match ($type) {
        'success' => 'alert-success',
        'danger'  => 'alert-danger',
        'warning' => 'alert-warning',
        default   => 'alert-info'
    };
    echo "<div class='alert $alertClass alert-dismissible fade show text-center fs-5' role='alert'>
            <i class='bi bi-info-circle-fill'></i> {$_SESSION['message']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>
