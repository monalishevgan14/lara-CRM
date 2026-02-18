# 📌 CRM Product Management System

## 📖 Project Overview

This is a **CRM (Customer Relationship Management) Product Management System** built using Laravel.  
The application allows administrators to manage products, perform bulk uploads using CSV, handle soft deletes (Trash), and view dashboard analytics such as revenue, orders, and top-selling products.

The system is designed with a modern admin layout including sidebar navigation, top navbar, pagination, and interactive charts.

---

# 🚀 Features

## 📊 Dashboard
- Total Users count
- Total Orders count
- Total Revenue calculation
- Latest Orders listing
- Top Selling Products
- Monthly Revenue Chart (Chart.js)
- Monthly Orders Chart

---

## 📦 Product Management
- Add new product
- View product list
- Search products
- Filter by stock (In Stock / Low / Out of Stock)
- Pagination (10 records per page)
- Soft delete products
- Bulk delete selected products
- Restore deleted products
- Permanently delete products from Trash

---

## 📂 Bulk Product Upload
- Upload CSV file
- Process large CSV in background using Laravel Queue
- Asynchronous data processing
- Automatic product creation from CSV rows

---

## 🗑 Trash Management
- View soft deleted products
- Restore selected products
- Permanently delete selected products

---

## 👤 Admin Interface
- Professional Admin Layout
- Fixed Sidebar navigation
- Top Navbar with:
  - Profile dropdown
  - User Activation link
  - Logout option
- Responsive design (Bootstrap 5)
- Clean pagination layout

---

# 🛠 Technologies Used

## Backend
- Laravel 10+
- PHP 8+
- MySQL
- Eloquent ORM
- Laravel Queue (Database driver)
- MVC Architecture

## Frontend
- Blade Template Engine
- Bootstrap 5
- Bootstrap Icons
- Chart.js

---
# ⚙ Installation Guide

---

## 1️⃣ Clone Repository

```bash
git clone <repository-url>
cd project-folder
```

---

## 2️⃣ Install Dependencies

```bash
composer install
```

---

## 3️⃣ Setup Environment

Copy environment file:

```bash
cp .env.example .env
```

Update database credentials inside `.env`:

```env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

---

## 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

## 5️⃣ Run Migrations

```bash
php artisan migrate
```

---

## 6️⃣ Setup Queue (Important for Bulk Upload)

Inside your `.env` file:

```env
QUEUE_CONNECTION=database
```

Create queue table:

```bash
php artisan queue:table
php artisan migrate
```

Start queue worker:

```bash
php artisan queue:work
```

⚠ Keep this running when importing large CSV files.

---

## 7️⃣ Run Application

```bash
php artisan serve
```

Open in browser:

```
http://127.0.0.1:8000
```

---

# 📁 Project Structure

```
app/
 ├── Models/
 ├── Http/
 │    └── Controllers/
 ├── Jobs/
 │    └── ImportProductsFromCsv.php
resources/
 ├── views/
routes/
database/
```

---

# 📄 CSV Format for Bulk Upload

Your CSV file must follow this format:

```csv
name,price,stock
Laptop,55000,10
Phone,20000,5
Mouse,500,25
```

---

# 🔄 Queue Job Example

Bulk upload is processed using Laravel Jobs:

```
app/Jobs/ImportProductsFromCsv.php
```

This ensures:

- Large files do not freeze the application
- Background processing
- Better performance
- Scalable system

---

# 🧑‍💻 Author

Developed by **Monali Shevgan**

---

# 📌 Future Improvements

- User Authentication System
- Role & Permission Management
- API Integration
- Reports Export (PDF/Excel)
- Product Images Upload
- Sales Module

---

# ⭐ License

This project is open-source and available for learning and professional portfolio use.
