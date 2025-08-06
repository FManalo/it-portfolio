<?php
require_once 'config/security.php';

SecurityHelper::startSecureSession();

// Security: Check if user is logged in
if (!SecurityHelper::isAuthenticated()) {
    header('Location: login.php');
    exit;
}

// Session timeout check
if (SecurityHelper::isSessionExpired()) {
    session_destroy();
    header('Location: login.php?message=session_expired');
    exit;
}

// Update last activity time
$_SESSION['login_time'] = time();

// Handle contact submission status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['submission_id'])) {
    $submission_id = (int)$_POST['submission_id'];
    $action = SecurityHelper::sanitizeInput($_POST['action']);
    
    // Validate action
    $allowed_statuses = ['new', 'read', 'replied'];
    if (in_array($action, $allowed_statuses)) {
        try {
            $pdo = DatabaseHelper::getConnection();
            $stmt = $pdo->prepare("UPDATE contact_submissions SET status = ? WHERE id = ?");
            $stmt->execute([$action, $submission_id]);
            
            $success_message = "Status updated successfully!";
            SecurityHelper::logSecurityEvent('STATUS_UPDATE', "Submission ID: $submission_id, New Status: $action");
        } catch (PDOException $e) {
            $error_message = "Error updating status: " . $e->getMessage();
            SecurityHelper::logSecurityEvent('STATUS_UPDATE_FAILED', $e->getMessage());
        }
    }
}

try {
    $pdo = DatabaseHelper::getConnection();
    
    // Get all contact submissions, ordered by newest first
    $stmt = $pdo->query("SELECT * FROM contact_submissions ORDER BY submitted_at DESC");
    $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    SecurityHelper::logSecurityEvent('DATABASE_QUERY_FAILED', $e->getMessage());
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Contact Submissions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .stat-card {
            background: #007bff;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .status-new {
            background: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
        }
        .status-read {
            background: #ffc107;
            color: black;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
        }
        .status-replied {
            background: #6c757d;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
        }
        .message-preview {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
            padding: 8px 16px;
            border: 1px solid #007bff;
            border-radius: 4px;
        }
        .back-link:hover {
            background: #007bff;
            color: white;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #007bff;
        }
        .admin-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        .alert {
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .status-dropdown {
            padding: 4px 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
        }
        .update-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        .update-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="admin-header">
            <div>
                <a href="index.php" class="back-link">← Back to Portfolio</a>
            </div>
            <div class="admin-info">
                <span>👤 Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                <span>🕐 Session: <?php echo date('H:i', $_SESSION['login_time']); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        
        <h1>🛡️ Secure Admin Panel - Contact Submissions</h1>
        
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number"><?php echo count($submissions); ?></div>
                <div>Total Submissions</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo count(array_filter($submissions, fn($s) => $s['status'] === 'new')); ?></div>
                <div>New Messages</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo count(array_filter($submissions, fn($s) => date('Y-m-d', strtotime($s['submitted_at'])) === date('Y-m-d'))); ?></div>
                <div>Today's Messages</div>
            </div>
        </div>

        <?php if (empty($submissions)): ?>
            <p>No contact submissions yet.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message Preview</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissions as $submission): ?>
                        <tr>
                            <td><?php echo date('M j, Y H:i', strtotime($submission['submitted_at'])); ?></td>
                            <td><?php echo htmlspecialchars($submission['name']); ?></td>
                            <td><a href="mailto:<?php echo htmlspecialchars($submission['email']); ?>"><?php echo htmlspecialchars($submission['email']); ?></a></td>
                            <td><?php echo htmlspecialchars($submission['subject']); ?></td>
                            <td class="message-preview" title="<?php echo htmlspecialchars($submission['message']); ?>">
                                <?php echo htmlspecialchars($submission['message']); ?>
                            </td>
                            <td>
                                <span class="status-<?php echo $submission['status']; ?>">
                                    <?php echo ucfirst($submission['status']); ?>
                                </span>
                            </td>
                            <td>
                                <form method="POST" style="display: inline-block;">
                                    <input type="hidden" name="submission_id" value="<?php echo $submission['id']; ?>">
                                    <select name="action" class="status-dropdown" onchange="this.form.submit()">
                                        <option value="">Change Status</option>
                                        <option value="new" <?php echo $submission['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                                        <option value="read" <?php echo $submission['status'] === 'read' ? 'selected' : ''; ?>>Read</option>
                                        <option value="replied" <?php echo $submission['status'] === 'replied' ? 'selected' : ''; ?>>Replied</option>
                                    </select>
                                </form>
                            </td>
                            <td><?php echo htmlspecialchars($submission['ip_address'] ?? 'N/A'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 0.9em;">
            <p><strong>🔒 Security Features Active:</strong></p>
            <ul>
                <li>✅ Session-based authentication</li>
                <li>✅ 30-minute session timeout</li>
                <li>✅ Login attempt logging</li>
                <li>✅ CSRF protection for status updates</li>
                <li>✅ Input sanitization and validation</li>
            </ul>
            <p><em>Logged in as: <?php echo htmlspecialchars($_SESSION['admin_username']); ?> | Session started: <?php echo date('Y-m-d H:i:s', $_SESSION['login_time']); ?></em></p>
        </div>
    </div>
</body>
</html>
