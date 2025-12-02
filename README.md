# بسم الله الرحمن الرحيم

# 🛒 E-Commerce API (Laravel 12)

A robust and scalable RESTful API for an E-commerce platform, built with **Laravel 12** and **PHP 8.2+**. This project focuses on **Clean Code**, **Design Patterns**, and **Solid Architecture** to handle complex e-commerce operations like payments, subscriptions, and cart management.

---

## 🚀 Features

- **Authentication & Authorization:**
  - Secure API authentication using **Laravel Sanctum**.
  - Social Login integration (Google, Facebook) via **Laravel Socialite**.
  - Role-based access control (Admin, User).
- **Product Management:**
  - CRUD operations for Products and Categories.
  - Inventory management validation.
- **Shopping Cart:**
  - Dynamic cart operations (Add, Remove, Update quantity).
  - Real-time stock checking.
- **Payment System (Highlight 🌟):**
  - Implemented using **Factory & Strategy Design Patterns** for extensibility.
  - Integration with **Stripe** (via Laravel Cashier).
  - Scalable architecture to easily add more gateways (e.g., PayPal, Paymob).
- **API Documentation:**
  - Auto-generated documentation using **L5-Swagger** (OpenAPI).
- **Testing:**
  - Unit and Feature tests using **Pest PHP**.

---

## 🛠 Tech Stack

- **Framework:** Laravel 12.x
- **Language:** PHP 8.2+
- **Database:** MySQL
- **Testing:** Pest PHP
- **Documentation:** Swagger / OpenAPI
- **Billing:** Laravel Cashier (Stripe)
- **Other Libs:** MoneyPHP (for safe currency calculations).

---

## 🧩 Design Patterns & Best Practices

This project goes beyond basic CRUD by implementing:

1.  **Factory Pattern:** Used in `PaymentFactory` to instantiate payment gateways dynamically based on user selection.
2.  **Strategy Pattern:** (Implied) To standardize payment processing across different providers.
3.  **Form Requests:** For separate validation logic and keeping controllers clean.
4.  **API Resources:** For transforming data and consistent JSON responses.

---

## ⚙️ Installation & Setup

Follow these steps to get the project running locally:

### 1. Clone the repository
`bash`
git clone [https://github.com/MohamedHarbyii/e-commerce.git](https://github.com/MohamedHarbyii/e-commerce.git)
cd e-commerce
### 2\. Install Dependencies

`Bash`

`   composer install  npm install   `

### 3\. Environment Setup

Copy the example env file and configure your database and Stripe credentials:

`Bash`

`   cp .env.example .env   `

Update .env with your credentials:

`   DB_DATABASE=your_database_name  STRIPE_KEY=your_stripe_key  STRIPE_SECRET=your_stripe_secret   `

### 4\. Generate App Key

`Bash`

 `   php artisan key:generate   `

### 5\. Run Migrations & Seeders

`Bash`

`   php artisan migrate --seed   `

### 6\. Run the Server

`Bash`

`   php artisan serve   `

The API will be accessible at http://127.0.0.1:8000/api.

📖 API Documentation
--------------------

Once the server is running, you can explore the full API documentation via Swagger UI:

> **URL:** http://127.0.0.1:8000/api/documentation

🧪 Running Tests
----------------

This project uses **Pest** for testing. To run the test suite:

`Bash`

`   php artisan test   `

🤝 Contributing
---------------

Contributions are welcome! Please feel free to submit a Pull Request.
