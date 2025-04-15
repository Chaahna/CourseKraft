# 🎓 CourseKraft

**CourseKraft** is a Laravel-based web application designed to streamline and manage online courses, instructors, and student enrollments. Developed as part of an academic project, it supports robust course management functionality while offering a clean, user-friendly interface.

---

## 📌 Features

- 🧑‍🏫 Instructor dashboard to create and manage courses  
- 🎓 Student enrollment and course tracking  
- 🗂 Course listing and categorization  
- 🔐 User authentication and role-based access (Admin, Instructor, Student)  
- 📨 Messaging or announcement features (if applicable)  
- 📊 Admin view for system-wide user and course management  

---

## 🛠 Tech Stack

- **Backend**: Laravel 10 (PHP Framework)  
- **Frontend**: Blade Templating Engine, Bootstrap  
- **Database**: MySQL / MariaDB  
- **Dev Tools**: Composer, Laravel Artisan, Docker (optional), npm  

---

## 🚀 Getting Started

### 📦 Prerequisites

- PHP >= 8.1  
- Composer  
- MySQL  
- Node.js & npm  
- Laravel CLI (`composer global require laravel/installer`)  

### 🛠 Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Chaahna/CourseKraft.git
   cd CourseKraft
   ```

2. **Install dependencies:**

   ```bash
   composer install
   npm install
   ```

3. **Environment setup:**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set up your database:**

   - Create a database (e.g., `coursekraft_db`)
   - Update `.env` file with DB credentials

   ```bash
   php artisan migrate --seed
   ```

5. **Run the development server:**

   ```bash
   php artisan serve
   ```

6. **Access the application:**

   Visit `http://127.0.0.1:8000` in your browser

---

## 📚 License

This project was developed for educational purposes and is currently not licensed for commercial use. 

---
