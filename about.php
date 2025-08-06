<?php
// About page
$site_title = "About - Your Name";
$current_page = "about";

include_once 'includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <h1>About Me</h1>
        <p>Get to know more about my background, experience, and passion for technology</p>
    </div>
</section>

<section class="about-detailed">
    <div class="container">
        <div class="about-content-detailed">
            <div class="about-text-detailed">
                <h2>My Journey in Technology</h2>
                <p>With over [X] years of experience in the IT industry, I've had the privilege of working on diverse projects and with cutting-edge technologies. My journey began with a curiosity about how things work and evolved into a passion for creating solutions that make a difference.</p>
                
                <p>I specialize in web development, system administration, and IT consulting. My approach combines technical expertise with strong problem-solving skills and a commitment to delivering high-quality results.</p>
                
                <h3>What Drives Me</h3>
                <ul class="motivation-list">
                    <li><strong>Innovation:</strong> I'm constantly exploring new technologies and methodologies to stay at the forefront of the industry.</li>
                    <li><strong>Problem-Solving:</strong> I thrive on tackling complex challenges and finding elegant solutions.</li>
                    <li><strong>Continuous Learning:</strong> Technology evolves rapidly, and I'm committed to lifelong learning and professional development.</li>
                    <li><strong>Impact:</strong> I believe technology should serve people and make their lives better.</li>
                </ul>
                
                <h3>Education & Certifications</h3>
                <div class="education-grid">
                    <div class="education-item">
                        <h4>Bachelor's Degree in Computer Science</h4>
                        <p>University Name - Year</p>
                    </div>
                    <div class="education-item">
                        <h4>Certified PHP Developer</h4>
                        <p>Certification Body - Year</p>
                    </div>
                    <div class="education-item">
                        <h4>AWS Certified Solutions Architect</h4>
                        <p>Amazon Web Services - Year</p>
                    </div>
                    <div class="education-item">
                        <h4>Linux Professional Institute Certification</h4>
                        <p>LPI - Year</p>
                    </div>
                </div>
            </div>
            
            <div class="about-stats">
                <h3>By the Numbers</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">20+</div>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Technologies</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 120px 0 60px;
    text-align: center;
}

.page-header h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.about-detailed {
    padding: 80px 0;
}

.about-content-detailed {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 4rem;
    align-items: start;
}

.about-text-detailed h2 {
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: #1f2937;
}

.about-text-detailed h3 {
    font-size: 1.5rem;
    margin: 2rem 0 1rem;
    color: #2563eb;
}

.motivation-list {
    list-style: none;
    padding-left: 0;
}

.motivation-list li {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
    position: relative;
}

.motivation-list li::before {
    content: '→';
    position: absolute;
    left: 0;
    color: #2563eb;
    font-weight: bold;
}

.education-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.education-item {
    background: #f9fafb;
    padding: 1.5rem;
    border-radius: 8px;
    border-left: 4px solid #2563eb;
}

.education-item h4 {
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.education-item p {
    color: #6b7280;
    font-size: 0.9rem;
}

.about-stats {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    height: fit-content;
}

.about-stats h3 {
    text-align: center;
    margin-bottom: 2rem;
    color: #1f2937;
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2563eb;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    color: #6b7280;
    font-weight: 500;
}

@media (max-width: 768px) {
    .about-content-detailed {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .page-header h1 {
        font-size: 2.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include_once 'includes/footer.php'; ?>
