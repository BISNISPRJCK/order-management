# Simple Order Management System (Laravel REST API)

Backend REST API sederhana untuk manajemen user, produk, customer, dan order menggunakan laravel dan Sanctum Authentication

🚀 Tech Stack

-   Laravel 12
-   PHP 8.2
-   MySQL / MariaDB
-   Laravel Sanctum
-   PHPUnit
-   Git

📌 Fitur

-   Authentication menggunakan Sanctum
-   Manajemen User (Admin & Staff)
-   Manajemen Product
-   Manajemen Customer
-   Order & Order Items
-   Otomatis hitung total order
-   Validasi stok produk
-   Database transaction
-   Role-based access (Admin only)
-   Feature Test

⚙️ Installation

1. Clone Repository
    - git clone https://github.com/USERNAME/order-management.git
    - cd order-management
2. Install Dependency
    - composer install
3. Setup Environment
    - cp .env.example .env
    - php artisan key:generate

🗄️ Database Setup

Edit File .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=order_management
DB_USERNAME=root
DB_PASSWORD=

Jalankan migration:
php artisan migrate

👤 Seeder Admin (Optional tapi disarankan)

    php artisan db:seed

Default admin :
Email : admin@mail.com
Password : password
Role : admin

🔐 Authentication

Login :
POST /api/login

Request :
{
"email": "admin@mail.com",
"password": "password"
}

Response :
{
"token": "Bearer TOKEN"
}

Gunakan Token Pada Header :

    Authorization: Bearer TOKEN

📦 API Endpoint (Ringkas)

User (Admin Only)

    - GET /api/users
    - POST /api/users
    - PUT /api/users/{id}
    - DELETE /api/users/{id}

Product

    - GET /api/products
    - POST /api/products
    - PATCH /api/products/{id}
    - DELETE /api/products/{id}

Customer

    - GET /api/customers
    - POST /api/customers
    - PATCH /api/customers/{id}
    - DELETE /api/customers/{id}

Order

    - POST /api/orders

Request contoh :
{
"customer_id": 1,
"status": "paid",
"items": [
{
"product_id": 1,
"quantity": 2
}
]
}

🧪 Testing

Menjalankan Seluruh Test:
php artisan test

Test Mencakup :

    - Order berhasil dibuat
    - Stok berkurang saat status paid
    - Order ditolak jika stok tidak cukup
    - User non-admin tidak bisa akses API user

🧠 Business Rules - Status order: draft, paid, cancelled - Draft tidak mengurangi stok - Paid mengurangi stok - Stok tidak boleh negatif - Total order dihitung otomatis - Semua proses order menggunakan database transaction

📁 Project Structure (Ringkas)

        app/
    ├── Http/Controllers/Api
    ├── Models
    ├── Policies
    database/
    ├── migrations
    ├── seeders
    tests/
    ├── Feature
