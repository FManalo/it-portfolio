<?php
// Backup of original contact.php
// Enhanced contact form handler with debugging
error_log("Contact form accessed at " . date('Y-m-d H:i:s'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("POST request received with data: " . print_r($_POST, true));
    
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    
    $errors = [];
    
    // Validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    
    if (!$email) {
        $errors[] = "Please enter a valid email address.";
    }
    
    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required.";
    }
    
    if (strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters long.";
    }
    
    error_log("Validation errors: " . print_r($errors, true));
    
    // If no errors, process the form
    if (empty($errors)) {
        $success = false;
        
        // Always save to database first
        try {
            error_log("Attempting to save contact submission to database");
            saveContactSubmission($name, $email, $subject, $message);
            $success = true;
            $success_message = "Thank you for your message! I'll get back to you soon.";
            error_log("Contact submission saved successfully");
        } catch (Exception $e) {
            $errors[] = "Sorry, there was an error saving your message. Please try again.";
            error_log("Database error: " . $e->getMessage());
        }
        
        // Try to send email (but don't fail if it doesn't work)
        if ($success) {
            try {
                $to = "francesmanalo12@gmail.com";
                $email_subject = "Portfolio Contact: " . $subject;
                
                // Simple text email (more likely to work)
                $email_body = "New Contact Form Submission\n\n";
                $email_body .= "Name: " . $name . "\n";
                $email_body .= "Email: " . $email . "\n";
                $email_body .= "Subject: " . $subject . "\n";
                $email_body .= "Message: " . $message . "\n";
                $email_body .= "Date: " . date('Y-m-d H:i:s') . "\n";
                
                $headers = "From: " . $email . "\r\n";
                $headers .= "Reply-To: " . $email . "\r\n";
                
                // Try to send email
                $mail_sent = mail($to, $email_subject, $email_body, $headers);
                
                if (!$mail_sent) {
                    error_log("Email failed to send for contact form submission from: " . $email);
                    $success_message .= " (Note: Message saved successfully, but email notification may be delayed)";
                }
                
            } catch (Exception $e) {
                error_log("Email error: " . $e->getMessage());
            }
        }
    }
} else {
    error_log("Contact.php accessed without POST method");
}

// Save contact submissions to database
function saveContactSubmission($name, $email, $subject, $message) {
    try {
        // Database configuration
        $host = 'localhost';
        $dbname = 'portfolio_db';
        $username = 'root';
        $password = '';
        
        $pdo = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("
            INSERT INTO contact_submissions (name, email, subject, message, ip_address, user_agent, submitted_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        
        $stmt->execute([$name, $email, $subject, $message, $ip_address, $user_agent]);
        
        return true;
        
    } catch (PDOException $e) {
        error_log("Database error in saveContactSubmission: " . $e->getMessage());
        throw $e;
    }
}

// Handle redirects
if (isset($success_message)) {
    // Success - redirect back with success message
    $redirect_url = "index.php#contact?status=success&message=" . urlencode($success_message);
    header("Location: $redirect_url");
    exit;
} elseif (!empty($errors)) {
    // Error - redirect back with error message
    $error_message = implode(" ", $errors);
    $redirect_url = "index.php#contact?status=error&message=" . urlencode($error_message);
    header("Location: $redirect_url");
    exit;
}

// If accessed directly, redirect to home
header("Location: index.php");
exit;
?>
