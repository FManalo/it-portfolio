<?php
// Direct test of contact form submission
echo "<h2>Testing Contact Form Submission</h2>";

// Test 1: Check if we can reach contact.php
echo "<h3>Test 1: Form Submission Test</h3>";
?>
<form method="POST" action="contact.php">
    <p><label>Name: <input type="text" name="name" value="Test User" required></label></p>
    <p><label>Email: <input type="email" name="email" value="test@example.com" required></label></p>
    <p><label>Subject: <input type="text" name="subject" value="Test Subject" required></label></p>
    <p><label>Message: <textarea name="message" required>This is a test message from the direct form test.</textarea></label></p>
    <p><input type="submit" value="Submit Test"></p>
</form>

<?php
// Test 2: Check database connection
echo "<h3>Test 2: Database Connection Test</h3>";
try {
    $host = 'localhost';
    $dbname = 'portfolio_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection successful<br>";
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'contact_submissions'");
    if ($stmt->rowCount() > 0) {
        echo "✅ contact_submissions table exists<br>";
        
        // Check recent submissions
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM contact_submissions WHERE submitted_at >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
        $row = $stmt->fetch();
        echo "📊 Recent submissions (last hour): " . $row['count'] . "<br>";
        
        // Show last few submissions
        $stmt = $pdo->query("SELECT name, email, subject, submitted_at FROM contact_submissions ORDER BY submitted_at DESC LIMIT 3");
        echo "<h4>Last 3 submissions:</h4>";
        while ($row = $stmt->fetch()) {
            echo "- " . htmlspecialchars($row['name']) . " (" . $row['email'] . ") - " . $row['subject'] . " at " . $row['submitted_at'] . "<br>";
        }
    } else {
        echo "❌ contact_submissions table does not exist<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

// Test 3: Check form parameters
echo "<h3>Test 3: Current Request Info</h3>";
echo "Request method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
if (!empty($_POST)) {
    echo "POST data received:<br>";
    foreach ($_POST as $key => $value) {
        echo "- " . htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br>";
    }
} else {
    echo "No POST data received<br>";
}
?>

<p><a href="index.php">← Back to Portfolio</a></p>
<p><a href="admin.php">View Admin Panel</a></p>
