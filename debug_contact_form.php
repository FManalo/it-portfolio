<?php
// Debug version of contact form handler
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Contact Form Debug Mode</h2>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>Form Submitted!</h3>";
    echo "<p>POST data received:</p>";
    echo "<pre>" . print_r($_POST, true) . "</pre>";
    
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    
    echo "<h3>Processed Data:</h3>";
    echo "<p>Name: " . htmlspecialchars($name) . "</p>";
    echo "<p>Email: " . htmlspecialchars($email) . "</p>";
    echo "<p>Subject: " . htmlspecialchars($subject) . "</p>";
    echo "<p>Message: " . htmlspecialchars($message) . "</p>";
    
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
    
    if (!empty($errors)) {
        echo "<h3>❌ Validation Errors:</h3>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h3>✅ Validation Passed</h3>";
        
        // Try to save to database
        try {
            echo "<p>Attempting to save to database...</p>";
            
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
            
            $result = $stmt->execute([$name, $email, $subject, $message, $ip_address, $user_agent]);
            
            if ($result) {
                echo "<h3>✅ SUCCESS: Message saved to database!</h3>";
                
                // Check how many submissions we have now
                $countStmt = $pdo->query('SELECT COUNT(*) as count FROM contact_submissions');
                $count = $countStmt->fetch(PDO::FETCH_ASSOC);
                echo "<p>Total submissions in database: " . $count['count'] . "</p>";
                
                echo "<p><a href='admin.php'>View Admin Panel</a></p>";
            } else {
                echo "<h3>❌ FAILED: Could not save to database</h3>";
            }
            
        } catch (Exception $e) {
            echo "<h3>❌ DATABASE ERROR:</h3>";
            echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
} else {
    echo "<p>No form data submitted yet.</p>";
}
?>

<h3>Test the Contact Form:</h3>
<form action="debug_contact_form.php" method="POST">
    <p>
        <label>Name:</label><br>
        <input type="text" name="name" value="Test User" required>
    </p>
    <p>
        <label>Email:</label><br>
        <input type="email" name="email" value="test@example.com" required>
    </p>
    <p>
        <label>Subject:</label><br>
        <input type="text" name="subject" value="Test Subject" required>
    </p>
    <p>
        <label>Message:</label><br>
        <textarea name="message" required>This is a test message to verify the contact form is working properly.</textarea>
    </p>
    <p>
        <button type="submit">Submit Test</button>
    </p>
</form>

<p><a href="index.php">Back to Portfolio</a> | <a href="admin.php">Admin Panel</a></p>
