<!DOCTYPE html>
<html>
<head>
    <title>Simple Contact Test</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #005a87; }
        .success { color: green; background: #d4edda; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .error { color: #721c24; background: #f8d7da; padding: 10px; border-radius: 4px; margin: 10px 0; }
    </style>
</head>
<body>
    <h2>Simple Contact Form Test</h2>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h3>Form Submission Received!</h3>";
        echo "<p><strong>Method:</strong> " . $_SERVER['REQUEST_METHOD'] . "</p>";
        echo "<p><strong>POST Data:</strong></p>";
        echo "<pre>" . print_r($_POST, true) . "</pre>";
        
        // Test database connection and save
        $name = htmlspecialchars(trim($_POST['name'] ?? ''));
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
        $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
        $message = htmlspecialchars(trim($_POST['message'] ?? ''));
        
        if ($name && $email && $subject && $message) {
            try {
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
                
                echo "<div class='success'>✅ SUCCESS: Contact submission saved to database!</div>";
                
                // Check if it was actually saved
                $stmt = $pdo->query("SELECT COUNT(*) as count FROM contact_submissions WHERE email = '$email' AND submitted_at >= DATE_SUB(NOW(), INTERVAL 5 MINUTE)");
                $row = $stmt->fetch();
                echo "<div class='success'>✅ Verification: Found " . $row['count'] . " recent submission(s) from your email</div>";
                
            } catch (Exception $e) {
                echo "<div class='error'>❌ DATABASE ERROR: " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='error'>❌ VALIDATION ERROR: Please fill all fields correctly</div>";
        }
        
        echo "<hr>";
    }
    ?>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="Test User" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="test@example.com" required>
        </div>
        
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" value="Test from Simple Form" required>
        </div>
        
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="4" required>This is a test message to verify the contact form is working properly.</textarea>
        </div>
        
        <button type="submit">Submit Test</button>
    </form>
    
    <hr>
    <p><a href="index.php">← Back to Portfolio</a></p>
    <p><a href="admin.php">View Admin Panel</a></p>
    
    <?php
    // Show current database status
    echo "<h3>Current Database Status:</h3>";
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=portfolio_db", 'root', '');
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM contact_submissions");
        $row = $stmt->fetch();
        echo "<p>Total submissions in database: <strong>" . $row['total'] . "</strong></p>";
        
        $stmt = $pdo->query("SELECT name, email, subject, submitted_at FROM contact_submissions ORDER BY submitted_at DESC LIMIT 3");
        echo "<p><strong>Last 3 submissions:</strong></p>";
        echo "<ul>";
        while ($row = $stmt->fetch()) {
            echo "<li>" . htmlspecialchars($row['name']) . " (" . $row['email'] . ") - " . $row['subject'] . " at " . $row['submitted_at'] . "</li>";
        }
        echo "</ul>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>Database connection failed: " . $e->getMessage() . "</p>";
    }
    ?>
</body>
</html>
