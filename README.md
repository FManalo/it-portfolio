# IT Portfolio - Frances E. Manalo

A professional IT portfolio website showcasing web development projects and technical skills.

## 🚀 Features

- **Responsive Design**: Modern, mobile-first design that works on all devices
- **Project Gallery**: Showcase of real projects including DSWD-DV Tracking System and TRIKE
- **Contact Form**: Functional contact form for professional inquiries
- **Secure Admin Panel**: Password-protected admin interface for managing contacts
- **Clean UI**: Professional photo album style project presentation

## 🛠️ Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Styling**: Custom CSS with modern design principles
- **Security**: Session-based authentication, CSRF protection

## 📂 Project Structure

```
it-portfolio/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── images/
│   └── js/
│       └── script.js
├── config/
│   └── security.php
├── includes/
│   ├── header.php
│   └── footer.php
├── index.php
├── about.php
├── contact.php
├── admin.php
├── login.php
└── logout.php
```

## 🚀 Getting Started

### Prerequisites
- Web server (Apache/Nginx)
- PHP 7.4 or higher
- MySQL database

### Installation

1. Clone the repository:
```bash
git clone https://github.com/YourUsername/it-portfolio.git
```

2. Set up your web server to point to the project directory

3. Configure database connection in `config/database.php` (create this file)

4. Import the database schema if using the contact form functionality

5. Set up admin credentials in `config/security.php`

## 📋 Featured Projects

### DSWD-DV Tracking System
- Document Voucher tracking system for Department of Social Welfare and Development
- Built with Laravel, MySQL, and Tailwind CSS
- [GitHub Repository](https://github.com/lugi77/dswd-dv-tracking-system)

### TRIKE
- Mobile and web application addressing tricycle transportation safety
- Built with Dart and Firebase

## 📞 Contact

- **Email**: francesmanalo12@gmail.com
- **Phone**: 09155098084
- **Location**: Davao City
- **LinkedIn**: [Frances Manalo](https://linkedin.com/in/frances-manalo-270687275)
- **GitHub**: [FManalo](https://github.com/FManalo)

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

⭐ If you found this portfolio helpful, please consider giving it a star!
   - Update contact information in `contact.php`
   - Replace placeholder content with your information
   - Add your profile picture and project images

4. **Customization**:
   - Edit `index.php` to update personal information
   - Modify `assets/css/style.css` for styling changes
   - Update social media links and contact details
   - Add your actual project information and images

## Configuration

### Contact Form Setup

1. Open `contact.php`
2. Update the email address on line 46:
   ```php
   $to = "your.email@example.com"; // Replace with your email
   ```

3. Update auto-reply sender email on line 70:
   ```php
   'From: your.email@example.com', // Replace with your email
   ```

### Content Customization

1. **Personal Information**: Update name, title, and description in `index.php`
2. **Skills**: Modify the skills sections to match your expertise
3. **Projects**: Replace project examples with your actual work
4. **Experience**: Update the timeline with your professional experience
5. **About Page**: Customize `about.php` with your background

### Images

Add the following images to `assets/images/`:
- `profile.jpg` - Your profile picture (300x300px recommended)
- `project1.jpg`, `project2.jpg`, `project3.jpg` - Project screenshots
- Any additional project images

## Features Included

### Responsive Navigation
- Mobile-friendly hamburger menu
- Smooth scrolling to sections
- Active section highlighting

### Hero Section
- Gradient background
- Profile image display
- Call-to-action buttons
- Typing animation effect

### Skills Section
- Categorized skill display
- Modern tag-based layout
- Hover animations

### Projects Showcase
- Grid layout for project cards
- Project technology tags
- Live demo and source code links

### Timeline Experience
- Professional experience timeline
- Responsive design for mobile
- Clean, readable format

### Contact Form
- PHP-powered contact handling
- Email validation
- Auto-reply functionality
- Success/error notifications

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Performance Features

- Optimized CSS and JavaScript
- Lazy loading for images
- Compressed assets
- Minimal HTTP requests

## Security Features

- Input sanitization
- XSS protection
- CSRF protection for forms
- Secure email handling

## SEO Features

- Semantic HTML structure
- Meta tags optimization
- Open Graph tags
- Schema markup ready

## Customization Tips

1. **Colors**: Update CSS custom properties for easy color changes
2. **Fonts**: Change Google Fonts import in `header.php`
3. **Layout**: Modify CSS Grid and Flexbox properties
4. **Animations**: Adjust transition timings in CSS
5. **Content**: Update all placeholder text and images

## Local Development

For local development, you can use:
- XAMPP, WAMP, or MAMP for PHP
- Live Server extension for VS Code
- PHP built-in server: `php -S localhost:8000`

## Deployment

1. Upload files to your web hosting provider
2. Ensure PHP is enabled
3. Update file permissions if necessary
4. Test contact form functionality
5. Add SSL certificate for HTTPS

## License

This project is open source and available under the [MIT License](LICENSE).

## Support

If you need help with setup or customization:
1. Check the documentation
2. Review the code comments
3. Test on a local server first
4. Ensure all file paths are correct

## Credits

- Icons: Font Awesome
- Fonts: Google Fonts
- Inspiration: Modern web design trends
- Framework: Custom CSS Grid/Flexbox

---

**Note**: Remember to replace all placeholder content with your actual information before deploying to production.
