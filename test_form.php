<?php
// Test form submission
echo "<h2>Testing Contact Form Submission</h2>";

// Simulate form data
$_POST['name'] = 'Test User';
$_POST['email'] = 'test@example.com';
$_POST['subject'] = 'Test Subject';
$_POST['message'] = 'This is a test message for debugging purposes.';
$_SERVER['REQUEST_METHOD'] = 'POST';

echo "<p>Simulating form submission with test data...</p>";

// Include the contact.php logic
ob_start();
include 'contact.php';
$output = ob_get_clean();

echo "<h3>Results:</h3>";
echo "<pre>" . htmlspecialchars($output) . "</pre>";

// Check if anything was saved to database
try {
    $pdo = new PDO('mysql:host=localhost;dbname=portfolio_db', 'root', '');
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM contact_submissions');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p>Submissions in database after test: " . $result['count'] . "</p>";
} catch (Exception $e) {
    echo "<p>Database error: " . $e->getMessage() . "</p>";
}
?>
