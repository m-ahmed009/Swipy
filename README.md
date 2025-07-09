# 🛍️ Swippy – Laravel Full Stack eCommerce Store

**Swippy** is a complete Laravel-based eCommerce solution built with a clean admin panel, product management system, dynamic cart, and secure checkout flow. It's designed for real-world online stores with full-stack Laravel development practices.

---

## 🚀 Features

- 🔐 User Registration, Login & Admin Authentication
- 🗂️ Category & Subcategory Product Listing
- 📦 Add to Cart, Cart Management
- 💳 Checkout & Order Placement
- 💵 Discounts, Tax, and Price Calculation
- 🖼 Product Image Uploads (Thumbnail + Gallery)
- 📊 Admin Dashboard with Analytics
- 📬 Order Notification System
- 🔎 Product Search & Filters
- 🧾 Invoice/Receipt Generation
- 📱 Responsive Frontend (Bootstrap-based)

---

## 🧰 Tech Stack

| Layer         | Technology             |
|---------------|------------------------|
| Backend       | Laravel 10+            |
| Frontend      | Blade + Bootstrap      |
| Database      | MySQL                  |
| Auth System   | Laravel Auth (Breeze or Custom) |
| Package Tool  | Composer + NPM         |
| Asset Compile | Laravel Mix (Webpack)  |
| Versioning    | Git & GitHub           |

---

## 📦 Installation Guide

```bash
# Clone the repo
git clone https://github.com/yourusername/swippy.git
cd swippy

# Install PHP dependencies
composer install

# Install JS dependencies
npm install
npm run dev

# Set environment
cp .env.example .env
php artisan key:generate

# Setup DB
php artisan migrate --seed

# Start local server
php artisan serve


📸 Screenshots

# Client Side
![Screenshot (97)](https://github.com/user-attachments/assets/cd8cbbe1-661d-4cf8-af47-5042afe9cff0)

# Admin Pannel
![Screenshot (96)](https://github.com/user-attachments/assets/656a82b0-1c2b-4a45-9da0-4450b76e4f63)


🙋‍♂️ Author
Developed by Muhammad Ahmed
For portfolio or production use.
Feel free to fork or contribute!
