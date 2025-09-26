# 🛍️ Swippy – Laravel Full Stack eCommerce Store

**Swippy** is a complete Laravel-based eCommerce solution built with a clean admin panel, product management system, dynamic cart, and secure checkout flow. It's designed for real-world online stores with full-stack Laravel development practices.


📸 Screenshots

# Client Side

<img width="1366" height="616" alt="image" src="https://github.com/user-attachments/assets/6c595eea-454c-4c67-ab63-4a19509e5623" />

<img width="1366" height="612" alt="image" src="https://github.com/user-attachments/assets/94a68074-efcb-4dca-9d36-11944de24ad2" />


# Admin Pannel

<img width="1366" height="617" alt="image" src="https://github.com/user-attachments/assets/25858878-2424-4fb8-ac81-5a21440b7a1c" />

<img width="1366" height="618" alt="image" src="https://github.com/user-attachments/assets/8ba2e4f2-a726-4dad-84cf-e864b92a4886" />

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



🙋‍♂️ Author
Developed by Muhammad Ahmed
For portfolio or production use.
Feel free to fork or contribute!
