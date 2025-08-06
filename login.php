<?php
require_once 'config/security.php';

SecurityHelper::startSecureSession();

// Check if user is already logged in
if (SecurityHelper::isAuthenticated()) {
    header('Location: admin.php');
    exit;
}

$error_message = '';
$lockout_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    
    // Check rate limiting
    if (!SecurityHelper::checkLoginAttempts($ip)) {
        $lockout_message = 'Too many failed login attempts. Please try again in 5 minutes.';
        SecurityHelper::logSecurityEvent('LOGIN_RATE_LIMITED', "IP: $ip");
    } else {
        $username = SecurityHelper::sanitizeInput($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (SecurityHelper::verifyCredentials($username, $password)) {
            // Successful login
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            $_SESSION['login_time'] = time();
            
            SecurityHelper::logSecurityEvent('LOGIN_SUCCESS', "User: $username, IP: $ip");
            
            // Redirect to admin panel
            header('Location: admin.php');
            exit;
        } else {
            // Failed login
            SecurityHelper::recordFailedLogin($ip);
            $error_message = 'Invalid username or password.';
            SecurityHelper::logSecurityEvent('LOGIN_FAILED', "Attempted username: $username, IP: $ip");
        }
    }
}

// Check for logout message
$logout_message = '';
if (isset($_GET['message'])) {
    switch ($_GET['message']) {
        case 'logged_out':
            $logout_message = 'You have been successfully logged out.';
            break;
        case 'session_expired':
            $logout_message = 'Your session has expired. Please log in again.';
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Portfolio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h1 {
            color: #333;
            margin: 0;
            font-size: 28px;
        }
        
        .login-header p {
            color: #666;
            margin: 10px 0 0 0;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        
        .warning-message {
            background: #fff3cd;
            color: #856404;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #ffeaa7;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #667eea;
            text-decoration: none;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
        
        .security-note {
            background: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 14px;
            border: 1px solid #bee5eb;
        }
        
        .security-note strong {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>🔐 Admin Login</h1>
            <p>Portfolio Management System</p>
        </div>
        
        <?php if ($logout_message): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($logout_message); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($lockout_message): ?>
            <div class="warning-message">
                <?php echo htmlspecialchars($lockout_message); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required autocomplete="username">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
        
        <div class="back-link">
            <a href="index.php">← Back to Portfolio</a>
        </div>
        
        <div class="security-note">
            <strong>Security Information:</strong>
            Default credentials are username: <strong>frances</strong> and password: <strong>admin123</strong>. 
            Please change these in the login.php file for production use.
        </div>
    </div>
</body>
</html>
