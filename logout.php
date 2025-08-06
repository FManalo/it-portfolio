<?php
require_once 'config/security.php';

SecurityHelper::startSecureSession();

// Log the logout
if (isset($_SESSION['admin_username'])) {
    SecurityHelper::logSecurityEvent('LOGOUT', "User: {$_SESSION['admin_username']}");
}

// Destroy the session
session_destroy();

// Redirect to login page
header('Location: login.php?message=logged_out');
exit;
?>
