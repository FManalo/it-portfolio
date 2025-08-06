<?php
// Test email functionality
echo "<h2>Email Configuration Test</h2>";

// Check if mail function exists
if (function_exists('mail')) {
    echo "✅ mail() function is available<br>";
} else {
    echo "❌ mail() function is NOT available<br>";
}

// Test basic email send
$to = "test@example.com";
$subject = "Test Email";
$message = "This is a test email";
$headers = "From: test@test.com";

if (mail($to, $subject, $message, $headers)) {
    echo "✅ Test email function returned TRUE (but may not actually send)<br>";
} else {
    echo "❌ Test email function returned FALSE<br>";
}

// Show PHP mail configuration
echo "<h3>PHP Mail Configuration:</h3>";
echo "SMTP: " . ini_get('SMTP') . "<br>";
echo "smtp_port: " . ini_get('smtp_port') . "<br>";
echo "sendmail_from: " . ini_get('sendmail_from') . "<br>";
echo "sendmail_path: " . ini_get('sendmail_path') . "<br>";
?>
