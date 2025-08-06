<?php
// Debug contact form submission
echo "=== CONTACT FORM DEBUG ===\n";

// Test database function directly
function testSaveContactSubmission($name, $email, $subject, $message) {
    try {
        echo "Attempting to save to database...\n";
        
        // Database configuration
        $host = 'localhost';
        $dbname = 'portfolio_db';
        $username = 'root';
        $password = '';
        
        $pdo = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo "Database connection successful\n";
        
        $stmt = $pdo->prepare("
            INSERT INTO contact_submissions (name, email, subject, message, ip_address, user_agent, submitted_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'localhost';
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'test-agent';
        
        echo "Executing insert statement...\n";
        $result = $stmt->execute([$name, $email, $subject, $message, $ip_address, $user_agent]);
        
        if ($result) {
            echo "✅ SUCCESS: Contact submission saved!\n";
            return true;
        } else {
            echo "❌ FAILED: Insert returned false\n";
            return false;
        }
        
    } catch (PDOException $e) {
        echo "❌ DATABASE ERROR: " . $e->getMessage() . "\n";
        return false;
    }
}

// Test the function
$result = testSaveContactSubmission(
    'Test User',
    'test@example.com', 
    'Test Subject',
    'This is a test message to verify the contact form is working properly.'
);

// Check database after test
try {
    $pdo = new PDO('mysql:host=localhost;dbname=portfolio_db', 'root', '');
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM contact_submissions');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "\nTotal submissions in database: " . $result['count'] . "\n";
    
    if ($result['count'] > 0) {
        $stmt = $pdo->query('SELECT * FROM contact_submissions ORDER BY submitted_at DESC LIMIT 1');
        $latest = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Latest submission: " . $latest['name'] . " - " . $latest['email'] . "\n";
    }
} catch (Exception $e) {
    echo "Error checking database: " . $e->getMessage() . "\n";
}
?>
