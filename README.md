# 🚀 Employee Management System

<div align="center">

![Employee Management System](hero-banner.png)

**A Modern, Full-Featured Employee Management Solution**

[![PHP Version](https://img.shields.io/badge/PHP-7.2%2B-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-orange.svg)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Maintenance](https://img.shields.io/badge/Maintained-Yes-brightgreen.svg)](https://github.com/PraveenG19/employee-management-system)

[Features](#-features) • [Installation](#-installation) • [Usage](#-usage) • [Screenshots](#-screenshots) • [Contributing](#-contributing)

</div>

---

## 📋 Overview

A comprehensive web-based Employee Management System built with PHP and MySQL. This system streamlines HR operations, employee tracking, project management, and leave administration with an intuitive interface and robust backend.

### 🎯 Key Highlights

- **Dual Portal System**: Separate interfaces for administrators and employees
- **Real-time Dashboard**: Live statistics and performance metrics
- **Project Tracking**: Assign, monitor, and evaluate employee projects
- **Leave Management**: Streamlined leave application and approval workflow
- **Salary Management**: Automated salary calculation with bonus integration
- **Performance Ranking**: Employee performance tracking and ranking system
- **Secure Authentication**: Role-based access control with encrypted passwords

---

## ✨ Features

### 👨‍💼 Admin Portal

| Feature | Description |
|---------|-------------|
| 📊 **Dashboard Analytics** | Real-time insights into employee performance, attendance, and project status |
| 👥 **Employee Management** | Add, edit, delete, and view comprehensive employee profiles |
| 📝 **Leave Approval System** | Review and approve/reject employee leave requests with reason tracking |
| 🎯 **Project Assignment** | Assign projects to employees with deadlines and track submissions |
| 💰 **Salary Administration** | Manage base salaries, bonuses, and generate salary reports |
| 📈 **Performance Tracking** | Monitor employee rankings based on project completion and quality |
| 🔐 **Secure Access Control** | Admin-only access with password protection |

### 👤 Employee Portal

| Feature | Description |
|---------|-------------|
| 🏠 **Personal Dashboard** | View assigned projects, leave status, and salary information |
| 📄 **Profile Management** | Update personal information, contact details, and profile picture |
| 🌴 **Leave Application** | Apply for leave with date range and reason specification |
| 📦 **Project Submission** | Submit completed projects before deadlines |
| 💵 **Salary Viewing** | Access salary details including base pay and bonuses |
| 🔔 **Status Notifications** | Real-time updates on leave approvals and project feedback |
| 🔒 **Password Management** | Change password with secure encryption |

---

## 🛠️ Technology Stack

```
Frontend:  HTML5 | CSS3 | JavaScript | jQuery
Backend:   PHP 7.2+
Database:  MySQL 5.7+
Server:    Apache (XAMPP/WAMP/LAMP)
Libraries: Font Awesome | Material Design Icons | Select2 | DateRangePicker
```

---

## 📦 Installation

### Prerequisites

- **XAMPP/WAMP/LAMP** (Apache + MySQL + PHP)
- **PHP 7.2 or higher**
- **MySQL 5.7 or higher**
- **Modern web browser** (Chrome, Firefox, Edge)

### Step-by-Step Setup

#### 1️⃣ Clone the Repository

```bash
git clone https://github.com/PraveenG19/employee-management-system.git
```

#### 2️⃣ Move to Server Directory

```bash
# For XAMPP (Windows)
copy employee-management-system C:\xampp\htdocs\

# For XAMPP (Linux/Mac)
cp -r employee-management-system /opt/lampp/htdocs/

# For WAMP (Windows)
copy employee-management-system C:\wamp64\www\
```

#### 3️⃣ Start Server Services

- Open **XAMPP/WAMP Control Panel**
- Start **Apache** and **MySQL** services
- Ensure both services show green/running status

#### 4️⃣ Create Database

**Option A: Using phpMyAdmin (Recommended)**

1. Open browser: `http://localhost/phpmyadmin`
2. Click **"New"** in the left sidebar
3. Database name: `ems`
4. Collation: `utf8_general_ci`
5. Click **"Create"**

**Option B: Using MySQL Command Line**

```bash
mysql -u root -p
CREATE DATABASE ems;
exit;
```

#### 5️⃣ Import Database Schema

**Option A: Using phpMyAdmin**

1. Select `ems` database
2. Click **"Import"** tab
3. Choose file: `db/ems.sql`
4. Click **"Go"**
5. Wait for success message

**Option B: Using Command Line**

```bash
# Windows (XAMPP)
C:\xampp\mysql\bin\mysql.exe -u root ems < db/ems.sql

# Linux/Mac
mysql -u root -p ems < db/ems.sql
```

#### 6️⃣ Configure Database Connection

Edit `process/dbh.php` if needed (default settings work for most installations):

```php
$servername = "localhost";
$dBUsername = "root";
$dbPassword = "";        // Add your MySQL password if set
$dBName = "ems";
```

#### 7️⃣ Launch Application

Open your browser and navigate to:

```
http://localhost/employee-management-system/index.html
```

---

## 🔐 Default Login Credentials

### Administrator Access
```
Email:    admin@gmail.com
Password: admin
```

### Employee Access
```
Email:    john@gmail.com
Password: 1234
```

> ⚠️ **Security Note**: Change default passwords immediately after first login in production environments.

---

## 📱 Usage Guide

### For Administrators

1. **Login** → Use admin credentials at `alogin.html`
2. **Add Employees** → Navigate to "Add Employee" section
3. **Assign Projects** → Select employee and set project details with deadline
4. **Review Leaves** → Approve or reject leave applications with comments
5. **Manage Salaries** → Set base salary and bonuses for employees
6. **View Reports** → Access dashboard for comprehensive analytics

### For Employees

1. **Login** → Use employee credentials at `elogin.html`
2. **View Dashboard** → Check assigned projects and deadlines
3. **Apply Leave** → Submit leave request with date range and reason
4. **Submit Projects** → Upload completed work before deadline
5. **Update Profile** → Modify personal information and upload photo
6. **Check Salary** → View current salary breakdown

---

## 📸 Screenshots

### Admin Dashboard
![Admin Dashboard](assets/admin.png)

### Employee Portal
![Employee Portal](assets/avatar.png)

---

## 🗂️ Project Structure

```
employee-management-system/
│
├── assets/                 # Images and media files
│   ├── admin.png
│   └── avatar.png
│
├── css/                    # Stylesheets
│   └── main.css
│
├── db/                     # Database files
│   └── ems.sql            # Database schema and seed data
│
├── js/                     # JavaScript files
│   └── global.js
│
├── process/                # Backend PHP processing
│   ├── addempprocess.php  # Add employee handler
│   ├── applyleaveprocess.php
│   ├── aprocess.php       # Admin authentication
│   ├── assignp.php        # Project assignment
│   ├── dbh.php           # Database connection
│   ├── eprocess.php      # Employee authentication
│   └── images/           # Uploaded employee photos
│
├── vendor/                 # Third-party libraries
│   ├── datepicker/
│   ├── font-awesome-4.7/
│   ├── jquery/
│   ├── mdi-font/
│   └── select2/
│
├── index.html             # Landing page
├── alogin.html           # Admin login
├── elogin.html           # Employee login
├── aloginwel.php         # Admin dashboard
├── eloginwel.php         # Employee dashboard
├── addemp.php            # Add employee form
├── viewemp.php           # View employees
├── assignproject.php     # Project assignment
├── applyleave.php        # Leave application
├── myprofile.php         # Employee profile
└── README.md             # Documentation
```

---

## 🔧 Configuration

### Database Configuration

Edit `process/dbh.php`:

```php
$servername = "localhost";     // Database host
$dBUsername = "root";          // Database username
$dbPassword = "your_password"; // Database password
$dBName = "ems";              // Database name
```

### Upload Directory

Ensure write permissions for:
```
process/images/
```

### Security Settings

1. Change default admin password
2. Enable HTTPS in production
3. Set proper file permissions (755 for directories, 644 for files)
4. Use prepared statements (already implemented)

---

## 🚀 Advanced Features

### AI-Enhanced Capabilities (Future Roadmap)

- 🤖 **Smart Leave Prediction**: ML-based leave pattern analysis
- 📊 **Performance Analytics**: AI-driven employee performance insights
- 🎯 **Project Recommendation**: Intelligent project-employee matching
- 📧 **Automated Notifications**: Smart email/SMS alerts
- 📈 **Predictive Analytics**: Forecast employee turnover and productivity
- 🔍 **Intelligent Search**: Natural language query processing

---

## 🐛 Troubleshooting

### Common Issues

**Issue**: "Database connection failed"
```
Solution: Check MySQL service is running and credentials in dbh.php are correct
```

**Issue**: "Table doesn't exist"
```
Solution: Import db/ems.sql file into ems database
```

**Issue**: "Permission denied for uploads"
```
Solution: Set write permissions on process/images/ directory
chmod 755 process/images/
```

**Issue**: "Page not found (404)"
```
Solution: Ensure project is in htdocs folder and Apache is running
```

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Development Guidelines

- Follow PSR-12 coding standards for PHP
- Write meaningful commit messages
- Add comments for complex logic
- Test thoroughly before submitting PR
- Update documentation for new features

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Praveen Kumar**

- GitHub: [@PraveenG19](https://github.com/PraveenG19)
- Repository: [employee-management-system](https://github.com/PraveenG19/employee-management-system)

---

## 🙏 Acknowledgments

- Font Awesome for icons
- jQuery team for JavaScript library
- Select2 for enhanced dropdowns
- Material Design for UI components
- Open source community for inspiration

---

## 📞 Support

For support, issues, or feature requests:

- 🐛 [Report Bug](https://github.com/PraveenG19/employee-management-system/issues)
- 💡 [Request Feature](https://github.com/PraveenG19/employee-management-system/issues)
- 📧 Contact: Open an issue on GitHub

---

## 🌟 Show Your Support

Give a ⭐️ if this project helped you!

---

<div align="center">

**Made with ❤️ by Praveen Kumar**

[⬆ Back to Top](#-employee-management-system)

</div>
