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

<!-- About Section -->
<section id="about" class="about-section">
    <div class="container">
        <h2 class="section-title">About Me</h2>
        <div class="about-content">
            <div class="about-text">
                <p> Motivated and detail-oriented aspiring IT professional seeking
                    an entry-level position to apply technical knowledge and
                    problem-solving skills. Eager to contribute to a dynamic team,
                    grow within the industry, and support organizational goals
                    through continuous learning and dedication.</p>
                <p>I believe in continuous learning and staying updated with the latest technological trends.
                    My goal is to leverage technology to solve real-world problems and create meaningful impact.</p>

                <div class="skills-overview">
                    <h3>Core Competencies</h3>
                    <ul>
                        <li>Web Development (PHP, HTML, CSS, JavaScript)</li>
                        <li>Database Management (MySQL)</li>
                        <li>System Administration (Linux, Windows Server)</li>
                        <li>Network Configuration & Security</li>
                        <li>IT Support & Troubleshooting</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="skills-section">
    <div class="container">
        <h2 class="section-title">Technical Skills</h2>
        <div class="skills-grid">
            <div class="skill-category">
                <h3>Programming Languages</h3>
                <div class="skill-items">
                    <span class="skill-tag">PHP</span>
                    <span class="skill-tag">JavaScript</span>
                    <span class="skill-tag">Java</span>
                    <span class="skill-tag">C#</span>
                </div>
            </div>
            <div class="skill-category">
                <h3>Web Technologies</h3>
                <div class="skill-items">
                    <span class="skill-tag">HTML5</span>
                    <span class="skill-tag">CSS3</span>
                    <span class="skill-tag">Bootstrap</span>
                </div>
            </div>
            <div class="skill-category">
                <h3>Databases</h3>
                <div class="skill-items">
                    <span class="skill-tag">MySQL</span>
                    <span class="skill-tag">SQLite</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="projects-section">
    <div class="container">
        <h2 class="section-title">Featured Projects Gallery</h2>
        <p class="section-subtitle">Browse through my portfolio of web development and IT projects</p>
        
        <div class="photo-album">

            <!-- Project 1: DSWD-DV Tracking System -->
            <div class="photo-item" data-project="dswd-tracking">
                <div class="photo-frame">
                    <img src="assets/images/dswd.png" alt="DSWD-DV Tracking System" style="transform: scale(1); transform-origin: center; filter: brightness(1.1) contrast(1.1); object-fit: cover; width: 100%; height: 100%;">
                    <div class="photo-overlay">
                        <div class="photo-info">
                            <h3>DSWD-DV Tracking System</h3>
                            <p>Document Voucher tracking system for Department of Social Welfare and Development - streamlining administrative processes</p>
                            <div class="photo-tags">
                                <span class="tag">Laravel</span>
                                <span class="tag">MySQL</span>
                                <span class="tag">Tailwind CSS</span>
                                <span class="tag">Government System</span>
                            </div>
                            <div class="photo-buttons">
                                <a href="https://github.com/lugi77/dswd-dv-tracking-system" target="_blank" class="photo-btn secondary">GitHub Repo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="photo-caption">
                    <h4>DSWD-DV Tracking System</h4>
                    <span class="photo-date">2024</span>
                </div>
            </div>

            <!-- Project 2: TRIKE Admin System -->
            <div class="photo-item" data-project="trike-admin">
                <div class="photo-frame">
                    <img src="assets/images/trike-admin.jpg" alt="TRIKE Admin System">
                    <div class="photo-overlay">
                        <div class="photo-info">
                            <h3>TRIKE</h3>
                            <p>A mobile and web based application developed to addtress the long-standing safety issues in trycicle transportation</p>
                            <div class="photo-tags">
                                <span class="tag">Dart</span>
                                <span class="tag">Firebase</span>
                                <span class="tag">SMS Alert</span>
                                <span class="tag">Realtime Location Tracking</span>
                                <span class="tag">Audio Recording</span>
                                <span class="tag">Secured QR Code</span>
                                <span class="tag">Emergency reponse</span>
                            </div>
                            <div class="photo-buttons">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="photo-caption">
                    <h4>TRIKE</h4>
                    <span class="photo-date">2025</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title">Get In Touch</h2>
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
