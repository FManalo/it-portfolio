<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($site_title) ? $site_title : 'IT Portfolio'; ?></title>
    <meta name="description" content="Professional IT portfolio showcasing skills, projects, and experience in web development, system administration, and technology solutions.">
    <meta name="keywords" content="IT professional, web developer, PHP, MySQL, system administrator, portfolio">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <a href="index.php">
                    <i class="fas fa-code"></i>
                    <span>Frances Manalo</span>
                </a>
            </div>
            <div class="nav-menu" id="nav-menu">
                <ul class="nav-list">
                    <li><a href="#hero" class="nav-link <?php echo ($current_page == 'home') ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="#about" class="nav-link">About</a></li>
                    <li><a href="#skills" class="nav-link">Skills</a></li>
                    <li><a href="#projects" class="nav-link">Projects</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                    <li>
                        <button class="theme-toggle" id="theme-toggle" aria-label="Toggle dark mode">
                            <i class="fas fa-moon" id="theme-icon"></i>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="nav-toggle" id="nav-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <main class="main-content">
