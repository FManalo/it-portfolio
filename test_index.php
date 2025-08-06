<?php
// Configuration
$site_title = "Your Name - IT Professional";
$current_page = "home";

// Include header
include_once 'includes/header.php';
?>

<!-- Hero Section -->
<section id="hero" class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Hello, I'm <span class="highlight">Frances E. Manalo</span></h1>
                <h2>IT Professional & Web Developer</h2>
                <p>Passionate about technology, problem-solving, and creating innovative solutions.
                    Specialized in web development, system administration, and IT support.</p>
                <div class="hero-buttons">
                    <a href="#about" class="btn btn-primary">Learn More</a>
                    <a href="#contact" class="btn btn-secondary">Contact Me</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="assets/images/Frances.png" alt="Profile Picture" class="profile-img">
            </div>
        </div>
    </div>
</section>

<!-- Contact Section (Simplified for Testing) -->
<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title">Get In Touch (TEST VERSION)</h2>
        
        <style>
            .test-form { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
            .test-form input, .test-form textarea { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ddd; border-radius: 4px; }
            .test-form button { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        </style>
        
        <div class="test-form">
            <h3>Direct Form Submission Test (No JavaScript)</h3>
            <form method="POST" action="contact.php">
                <p>
                    <label>Name:</label>
                    <input type="text" name="name" value="Test User" required>
                </p>
                <p>
                    <label>Email:</label>
                    <input type="email" name="email" value="test@example.com" required>
                </p>
                <p>
                    <label>Subject:</label>
                    <input type="text" name="subject" value="Test Subject" required>
                </p>
                <p>
                    <label>Message:</label>
                    <textarea name="message" rows="4" required>This is a test message from the main portfolio page.</textarea>
                </p>
                <button type="submit">Submit Direct Test</button>
            </form>
        </div>
        
        <div class="contact-content">
            <div class="contact-info">
                <div class="contact-item">
                    <h3>Let's Connect</h3>
                    <p>I'm always interested in new opportunities and exciting projects. 
                       Whether you have a question, want to discuss a project, or just want to say hello, 
                       feel free to reach out!</p>
                </div>
                <div class="contact-item">
                    <h4>📧 Email</h4>
                    <p>francesmanalo12@gmail.com</p>
                </div>
                <div class="contact-item">
                    <h4>📱 Phone</h4>
                    <p>09155098084</p>
                </div>
                <div class="contact-item">
                    <h4>📍 Location</h4>
                    <p>Davao City</p>
                </div>
            </div>
            
            <div class="contact-form">
                <h3>Original Form (with JavaScript)</h3>
                <form action="contact.php" method="POST" id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Tell me about your project or inquiry..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
                
                <!-- Success/Error Messages -->
                <div id="formMessages" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'includes/footer.php'; ?>
