# Kenyan High School Management System

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![Filament](https://img.shields.io/badge/Filament-3.x-purple.svg)

A comprehensive, user-friendly school management system built specifically for Kenyan high schools. This application leverages Laravel's powerful backend and Filament's elegant admin panel to provide a complete solution for managing students, staff, finances, examinations, and more.

## Features

### Academic Management
- **Student Information System**
  - Complete student profiles with academic history
  - Student admission and enrollment workflows
  - Student photo ID generation
  - Guardian/parent contact information
  - Automatic assignment to streams and subjects
  
- **Examination Management**
  - KCSE exam preparation and analysis
  - Custom exam creation and grading
  - Performance tracking and analytics
  - Automated grade calculation based on Kenyan grading system
  - Term report card generation
  
- **Curriculum Management**
  - 8-4-4 and CBC curriculum support
  - Subject registration and management
  - Customizable timetable generation
  - Lesson planning and resource allocation

### Administrative Features
- **Staff Management**
  - Teacher profiles and qualifications
  - TSC number tracking
  - Staff attendance monitoring
  - Performance evaluation tools
  - Payroll integration
  
- **Financial Management**
  - Fee structure configuration
  - Student fee tracking and receipting
  - Payment plans and reminders
  - Expense tracking and budgeting
  - Financial reporting (term/annual)
  - MPESA integration for payments
  
- **Communication Tools**
  - Bulk SMS integration for announcements
  - Parent portal access
  - Digital notice board
  - Automated attendance notifications

### Specialized Tools
- **Library Management**
  - Book inventory and lending system
  - Digital resources catalog
  
- **Boarding Facilities**
  - Dormitory allocation
  - Leave management
  - Visitor logging
  
- **Inventory Management**
  - School assets tracking
  - Consumables management
  - Procurement workflows

## Screenshots

![Dashboard](screenshots/dashboard.png)
![Student Management](screenshots/student-management.png)
![Examination Results](screenshots/examination-results.png)
![Fee Management](screenshots/fee-management.png)

## System Requirements

- PHP ^8.1
- MySQL 5.7+ or MariaDB 10.3+
- Composer
- Node.js & NPM
- Apache/Nginx web server

## Installation

1. Clone the repository
```bash
git clone https://github.com/yourusername/kenyan-school-management.git
cd kenyan-school-management
```

2. Install dependencies
```bash
composer install
npm install
npm run build
```

3. Set up environment variables
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database in the `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_management
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations and seed initial data
```bash
php artisan migrate --seed
```

6. Start the development server
```bash
php artisan serve
```

7. Access the admin panel at `http://localhost:8000/admin`

## Default Login Credentials

**Admin:**
- Email: admin@example.com
- Password: password

## Customization

### School Details

Update your school's information in the School Settings panel:
- School name, logo, and motto
- Contact information
- Term dates
- Grading systems

### Fee Structure

Configure your school's fee structure:
- Different fees for different forms
- Boarding vs. day scholar rates
- Optional fees (e.g., bus service, extracurricular)
- Payment schedules

## Deployment

For production deployment, ensure you follow Laravel's deployment best practices:
- Configure proper server permissions
- Set up production environment variables
- Enable HTTPS
- Configure caching
- Set up proper backup systems

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Support

For support, please contact us at support@kenyaschoolsystem.com or open an issue on GitHub.

## Roadmap

- Mobile application for parents and teachers
- Advanced analytics dashboard
- Integration with government education systems
- Online learning module
- Alumni tracking system

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgements

- [Laravel](https://laravel.com)
- [Filament](https://filamentphp.com)
- [AfricasTalking SMS API](https://africastalking.com)
- [Safaricom M-PESA API](https://developer.safaricom.co.ke)
