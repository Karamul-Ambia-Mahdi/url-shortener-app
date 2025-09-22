# 🚀 Laravel URL Shortener API

A simple **URL Shortener API** built with **Laravel**.  
It allows users to **register, log in, shorten URLs, fetch their shortened URLs, and redirect from short codes.**  

---

## 📋 Features
- 🔐 User Registration & Login (**JWT-based authentication with Firebase**)
- ✂️ Shorten long URLs into unique short codes
- 📂 Retrieve all shortened URLs for the authenticated user
- ↪️ Redirect from shortened URL to original
- 📊 Track number of visits for each shortened URL

---

## ⚙️ Project Setup

### 1. Clone the Repository
```bash
git clone https://github.com/Karamul-Ambia-Mahdi/URL-Shortener-API
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Configure Environment
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
```
Update database credentials in `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url-shortener-app
DB_USERNAME=root
DB_PASSWORD=
```
Add JWT Key in `.env`:
```ini
JWT_KEY=123456ABCXYZAAABBBBCCCC123546
```

### 4. Generate App Key
```bash
php artisan key:generate
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Start Development Server
```bash
php artisan serve
```
App will run at:
`http://127.0.0.1:8000`

---

## 📂 Postman Documentation Link:

*https://documenter.getpostman.com/view/21246891/2sB3HtFwb8*

---
