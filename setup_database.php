<?php
// Database setup script for IT Portfolio
// Run this script once to create the database and table

$host = 'localhost';
$username = 'root';  // Default XAMPP MySQL username
$password = '';      // Default XAMPP MySQL password (empty)
$dbname = 'portfolio_db';

try {
    // First, connect without specifying database to create it
    $pdo = new PDO("mysql:host={$host}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ Database '{$dbname}' created successfully or already exists.<br>";
    
    // Now connect to the specific database
    $pdo = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create contact_submissions table
    $sql = "CREATE TABLE IF NOT EXISTS contact_submissions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(500) NOT NULL,
        message TEXT NOT NULL,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        ip_address VARCHAR(45),
        user_agent TEXT,
        status ENUM('new', 'read', 'replied') DEFAULT 'new',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "✓ Table 'contact_submissions' created successfully or already exists.<br>";
    
    // Create an index for better performance
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_email ON contact_submissions(email)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_submitted_at ON contact_submissions(submitted_at)");
    echo "✓ Database indexes created successfully.<br>";
    
    echo "<h3>Database Setup Complete!</h3>";
    echo "<p>Your portfolio database is now ready to use.</p>";
    echo "<p><strong>Database Details:</strong></p>";
    echo "<ul>";
    echo "<li>Host: {$host}</li>";
    echo "<li>Database: {$dbname}</li>";
    echo "<li>Username: {$username}</li>";
    echo "<li>Password: " . (empty($password) ? '[empty]' : '[set]') . "</li>";
    echo "</ul>";
    
    // Test the connection by getting table info
    $stmt = $pdo->query("DESCRIBE contact_submissions");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h4>Table Structure:</h4>";
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>Column</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    foreach ($columns as $column) {
        echo "<tr>";
        echo "<td>{$column['Field']}</td>";
        echo "<td>{$column['Type']}</td>";
        echo "<td>{$column['Null']}</td>";
        echo "<td>{$column['Key']}</td>";
        echo "<td>{$column['Default']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
    echo "<p>Make sure XAMPP MySQL is running and try again.</p>";
}
?>
