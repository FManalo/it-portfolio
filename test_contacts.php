<?php
// Test database connection and check submissions
try {
    $pdo = new PDO('mysql:host=localhost;dbname=portfolio_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Database connection: OK\n";
    
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM contact_submissions');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📊 Total contact submissions: " . $result['count'] . "\n";
    
    if ($result['count'] > 0) {
        $stmt = $pdo->query('SELECT * FROM contact_submissions ORDER BY submitted_at DESC LIMIT 5');
        $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "\n📝 Recent submissions:\n";
        foreach ($submissions as $sub) {
            echo "- " . $sub['name'] . " (" . $sub['email'] . ") - " . $sub['submitted_at'] . "\n";
            echo "  Subject: " . $sub['subject'] . "\n";
            echo "  Message: " . substr($sub['message'], 0, 50) . "...\n\n";
        }
    } else {
        echo "\n❌ No contact submissions found in database.\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
