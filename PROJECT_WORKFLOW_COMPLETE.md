# 🍽️ Yummy Restaurant - Complete Project Workflow

## 📋 Table of Contents
1. [Project Overview](#project-overview)
2. [User Flow (Customer)](#user-flow-customer)
3. [Admin Flow](#admin-flow)
4. [Technical Architecture](#technical-architecture)
5. [Database Structure](#database-structure)
6. [Authentication System](#authentication-system)
7. [Payment Integration](#payment-integration)
8. [File Structure](#file-structure)

---

## 🎯 Project Overview

**Yummy Restaurant** ek complete restaurant management system hai jisme:
- **Frontend**: Customer website (Home, Menu, Gallery, About, Contact)
- **Backend**: Admin dashboard (Orders, Users, Content Management)
- **E-commerce**: Cart, Checkout, Payment (Razorpay)
- **Authentication**: Separate login for Admin & Customers

---

## 👤 User Flow (Customer)

### Step 1: Browse Website
```
Home Page (/) 
  ↓
User dekh sakta hai:
  - Hero Section (Main banner with restaurant info)
  - About Section (Restaurant ki kahani)
  - Gallery (Food photos)
  - Menu (All food items with prices)
  - Contact Form
```

**Files Involved:**
- `resources/views/home.blade.php` - Hero section
- `resources/views/about.blade.php` - About section
- `resources/views/gallery.blade.php` - Gallery
- `resources/views/menu.blade.php` - Menu items
- `resources/views/contact.blade.php` - Contact form

### Step 2: Menu Browse & Add to Cart
```
Menu Page (/menu)
  ↓
User actions:
  1. Menu items dekhe (categories: Starters, Main Course, Desserts, etc.)
  2. Item details dekhe (name, price, description, image)
  3. "Add to Cart" button click kare
  4. Cart badge update ho (header mein)
```

**How it works:**
- Menu items database se load hote hain
- JavaScript localStorage mein cart save hota hai
- Real-time cart count update hota hai

**Files:**
- `resources/views/menu.blade.php` - Menu display
- `app/Models/MenuSection.php` - Menu model
- JavaScript in menu.blade.php - Cart functionality

### Step 3: View Cart
```
Cart Icon Click (/cart)
  ↓
User dekh sakta hai:
  - All cart items
  - Quantity adjust kar sakta hai (+/-)
  - Items remove kar sakta hai
  - Subtotal, Tax, Delivery Fee
  - Total Amount
  - "Proceed to Checkout" button
```

**Files:**
- `resources/views/cart.blade.php` - Cart page
- JavaScript localStorage - Cart data storage

### Step 4: Checkout Process
```
Proceed to Checkout (/checkout)
  ↓
Check: User logged in hai?
  ├─ NO → Redirect to Login/Register
  └─ YES → Show checkout form
```

**Checkout Form:**
1. **User Info** (Auto-filled if logged in)
   - Name, Email (from session)
   
2. **Delivery Address**
   - Complete Address
   - City
   - Pincode
   
3. **Payment Method**
   - Cash on Delivery (COD)
   - Razorpay (Card/UPI/Net Banking)

**Files:**
- `resources/views/checkout.blade.php` - Checkout page
- `app/Http/Controllers/OrderController.php` - Order processing

### Step 5: User Registration/Login
```
If not logged in:
  ↓
User Login (/user/login)
  OR
User Register (/user/register)
  ↓
After successful login:
  → Redirect back to Checkout
```

**Registration:**
- Name, Email, Phone, Password
- Role automatically set to "customer"
- Uses `web` guard (separate from admin)

**Login:**
- Email & Password
- Uses `web` guard
- Admin cannot login here

**Files:**
- `resources/views/user/login.blade.php` - User login
- `resources/views/user/register.blade.php` - User register
- `app/Http/Controllers/UserAuthController.php` - User auth logic

### Step 6: Place Order

#### Option A: Cash on Delivery (COD)
```
Select "COD" → Click "Place Order"
  ↓
Backend Process:
  1. Validate address & cart items
  2. Create Order in database
  3. Create Order Items
  4. Set payment_status = "pending"
  5. Generate Order Number (ORD-XXXXXXXX)
  ↓
Response:
  - Success message
  - Order number
  - Redirect to "My Orders"
```

#### Option B: Razorpay Payment
```
Select "Razorpay" → Click "Place Order"
  ↓
Step 1: Create Razorpay Order
  - Backend creates order with Razorpay API
  - Returns order_id, amount, key
  ↓
Step 2: Open Razorpay Checkout Modal
  - User enters card/UPI details
  - Completes payment
  ↓
Step 3: Payment Verification
  - Razorpay sends payment_id, signature
  - Backend verifies signature
  - If valid: Create order in database
  - Set payment_status = "paid"
  ↓
Step 4: Success
  - Order created
  - Payment record saved
  - Redirect to "My Orders"
```

**Files:**
- `app/Http/Controllers/OrderController.php`
  - `placeOrder()` - COD orders
  - `createRazorpayOrder()` - Create Razorpay order
  - `verifyPayment()` - Verify Razorpay payment
- `config/razorpay.php` - Razorpay config
- `app/Models/Order.php` - Order model
- `app/Models/OrderItem.php` - Order items model
- `app/Models/Payment.php` - Payment model

### Step 7: View Orders
```
My Orders (/my-orders)
  ↓
User dekh sakta hai:
  - All orders (latest first)
  - Order number, date, status
  - Total amount
  - Payment status
  - Order items
  - Delivery address
```

**Files:**
- `resources/views/user/orders.blade.php` - Orders list
- `resources/views/user/order-details.blade.php` - Order details
- `app/Http/Controllers/OrderController.php` - `myOrders()`, `orderDetails()`

---

## 👨‍💼 Admin Flow

### Step 1: Admin Login
```
Admin Login (/login)
  ↓
Uses "admin" guard (separate from users)
  ↓
First time setup:
  - If no users exist
  - Auto-create admin account
  ↓
After login:
  → Redirect to Dashboard
```

**Special Features:**
- Admin cannot login via user login page
- User cannot login via admin login page
- Separate sessions (admin & user can be logged in simultaneously)

**Files:**
- `resources/views/auth/login.blade.php` - Admin login page
- `app/Http/Controllers/AuthController.php` - Admin auth logic

### Step 2: Admin Dashboard
```
Dashboard (/dashboard)
  ↓
Admin dekh sakta hai:
  - Total contacts count
  - Recent contacts (last 5)
  - Quick stats
  - Navigation to all sections
```

**Sidebar Menu:**
1. Dashboard
2. Home Page Management
   - Hero Section
   - About Section
   - Gallery
   - Menu
   - Contact
3. Orders Management
4. Customers Management
5. Messages (Contact form submissions)
6. Logout

**Files:**
- `resources/views/dashboard.blade.php` - Dashboard
- `resources/views/layouts/dashboard.blade.php` - Admin layout
- `app/Http/Controllers/AuthController.php` - `dashboard()`

### Step 3: Content Management

#### Hero Section Management
```
Admin → Hero Section (/admin/hero)
  ↓
Can do:
  - View all hero sections
  - Create new hero section
  - Edit existing
  - Delete
  - Activate/Deactivate
```

**Fields:**
- Title
- Subtitle
- Description
- Button Text
- Button Link
- Background Image
- Is Active (only one can be active)

**Files:**
- `resources/views/admin/hero/index.blade.php` - List
- `resources/views/admin/hero/create.blade.php` - Create
- `resources/views/admin/hero/edit.blade.php` - Edit
- `app/Http/Controllers/Admin/HeroSectionController.php`
- `app/Models/HeroSection.php`

#### About Section Management
```
Admin → About Section (/admin/about)
  ↓
Similar to Hero Section:
  - Create/Edit/Delete
  - Title, Description, Images
  - Features list
  - Is Active
```

**Files:**
- `resources/views/admin/about/` - Views
- `app/Http/Controllers/Admin/AboutSectionController.php`
- `app/Models/AboutSection.php`

#### Gallery Management
```
Admin → Gallery (/admin/gallery)
  ↓
Can do:
  - Upload images
  - Add title & description
  - Set category
  - Delete images
  - Reorder images
```

**Files:**
- `resources/views/admin/gallery/index.blade.php`
- `app/Http/Controllers/Admin/GallerySectionController.php`
- `app/Models/GallerySection.php`

#### Menu Management
```
Admin → Menu (/admin/menu)
  ↓
Can do:
  - Add menu items
  - Edit items (name, price, description, image)
  - Set category (Starters, Main Course, etc.)
  - Set order (display order)
  - Activate/Deactivate items
  - Delete items
```

**Files:**
- `resources/views/admin/menu/` - Views
- `app/Http/Controllers/Admin/MenuSectionController.php`
- `app/Models/MenuSection.php`

### Step 4: Orders Management
```
Admin → Orders (/admin/orders)
  ↓
Can see:
  - All customer orders
  - Order details
  - Customer info
  - Order items
  - Payment status
  - Delivery address
  ↓
Can do:
  - Update order status:
    * Pending
    * Confirmed
    * Preparing
    * Out for Delivery
    * Delivered
    * Cancelled
  - View order details
  - Filter by status
```

**Files:**
- `resources/views/admin/orders/index.blade.php` - Orders list
- `resources/views/admin/orders/show.blade.php` - Order details
- `app/Http/Controllers/Admin/OrderManagementController.php`

### Step 5: Customers Management
```
Admin → Customers (/admin/users)
  ↓
Can see:
  - All registered customers
  - Customer details
  - Order history
  - Contact info
```

**Files:**
- `resources/views/admin/users/index.blade.php` - Users list
- `resources/views/admin/users/show.blade.php` - User details
- `app/Http/Controllers/Admin/UserManagementController.php`

### Step 6: Messages Management
```
Admin → Messages (/admin/contacts)
  ↓
Can see:
  - All contact form submissions
  - Name, Email, Phone, Message
  - Submission date
  ↓
Can do:
  - Reply via email
  - Mark as read
```

**Files:**
- `resources/views/admin/contacts.blade.php`
- `app/Http/Controllers/ContactController.php`
- `app/Models/Contact.php`

---

## 🏗️ Technical Architecture

### Frontend Stack
```
HTML/CSS/JavaScript
  ↓
Bootstrap 5 (UI Framework)
  ↓
Bootstrap Icons
  ↓
AOS (Animation on Scroll)
  ↓
Blade Templates (Laravel)
```

### Backend Stack
```
Laravel 12 (PHP Framework)
  ↓
MySQL Database
  ↓
Eloquent ORM
  ↓
Authentication (Multiple Guards)
  ↓
Session Management
```

### Payment Integration
```
Razorpay PHP SDK
  ↓
Razorpay Checkout.js
  ↓
Payment Verification
```

---

## 🗄️ Database Structure

### Users Table
```sql
users
  - id
  - name
  - email (unique)
  - phone
  - password
  - role (admin/customer)
  - is_admin (boolean)
  - created_at
  - updated_at
```

### Orders Table
```sql
orders
  - id
  - user_id (foreign key → users)
  - order_number (unique, e.g., ORD-ABC12345)
  - subtotal
  - tax
  - delivery_fee
  - total
  - status (pending/confirmed/preparing/out_for_delivery/delivered/cancelled)
  - payment_status (pending/paid/failed)
  - payment_method (cod/razorpay)
  - delivery_address
  - phone
  - created_at
  - updated_at
```

### Order Items Table
```sql
order_items
  - id
  - order_id (foreign key → orders)
  - menu_item_id (foreign key → menu_sections)
  - item_name
  - quantity
  - price
  - customizations (nullable)
  - created_at
  - updated_at
```

### Payments Table
```sql
payments
  - id
  - order_id (foreign key → orders)
  - payment_id (Razorpay payment ID)
  - payment_method (razorpay)
  - amount
  - status (success/failed/pending)
  - transaction_id (Razorpay order ID)
  - created_at
  - updated_at
```

### Menu Sections Table
```sql
menu_sections
  - id
  - name
  - description
  - price
  - category (Starters/Main Course/Desserts/Beverages)
  - image
  - is_active (boolean)
  - order (display order)
  - created_at
  - updated_at
```

### Hero Sections Table
```sql
hero_sections
  - id
  - title
  - subtitle
  - description
  - button_text
  - button_link
  - background_image
  - is_active (boolean)
  - created_at
  - updated_at
```

### About Sections Table
```sql
about_sections
  - id
  - title
  - description
  - image_1
  - image_2
  - features (JSON)
  - is_active (boolean)
  - created_at
  - updated_at
```

### Gallery Sections Table
```sql
gallery_sections
  - id
  - title
  - description
  - image
  - category
  - order
  - created_at
  - updated_at
```

### Contacts Table
```sql
contacts
  - id
  - name
  - email
  - phone
  - subject
  - message
  - created_at
  - updated_at
```

---

## 🔐 Authentication System

### Two Separate Guards

#### 1. Admin Guard (`admin`)
```php
// config/auth.php
'guards' => [
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
]

// Usage
Auth::guard('admin')->attempt($credentials)
Auth::guard('admin')->user()
Auth::guard('admin')->logout()
```

**Routes:**
- `/login` - Admin login
- `/dashboard` - Admin dashboard
- `/admin/*` - All admin routes

**Middleware:**
- `auth:admin` - Protects admin routes

#### 2. Web Guard (`web`) - Default
```php
// config/auth.php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
]

// Usage
Auth::guard('web')->attempt($credentials)
Auth::guard('web')->user()
Auth::guard('web')->logout()
```

**Routes:**
- `/user/login` - User login
- `/user/register` - User register
- `/checkout` - Checkout (requires auth)
- `/my-orders` - User orders

**Middleware:**
- `auth:web` - Protects user routes

### Session Management
```
Admin Session: login_admin_[hash]
User Session: login_web_[hash]

Both can exist simultaneously!
```

---

## 💳 Payment Integration

### Razorpay Flow

#### 1. Configuration
```php
// config/razorpay.php
return [
    'key_id' => env('RAZORPAY_KEY_ID'),
    'key_secret' => env('RAZORPAY_KEY_SECRET'),
];

// .env
RAZORPAY_KEY_ID=rzp_test_RnRAtobAgg9CWZ
RAZORPAY_KEY_SECRET=MSInLNnnUNscD3TupMPTbnAa
```

#### 2. Create Order (Backend)
```php
// OrderController::createRazorpayOrder()
$api = new Api(config('razorpay.key_id'), config('razorpay.key_secret'));

$razorpayOrder = $api->order->create([
    'receipt' => 'order_' . time(),
    'amount' => $amount * 100, // Paise mein
    'currency' => 'INR',
]);

return response()->json([
    'order_id' => $razorpayOrder['id'],
    'key' => config('razorpay.key_id'),
]);
```

#### 3. Open Checkout (Frontend)
```javascript
// checkout.blade.php
const options = {
    key: result.key,
    amount: result.amount,
    order_id: result.order_id,
    handler: function (response) {
        // Payment successful
        verifyPayment(response);
    },
    prefill: {
        name: userName,
        email: userEmail,
        contact: userPhone
    }
};

const rzp = new Razorpay(options);
rzp.open();
```

#### 4. Verify Payment (Backend)
```php
// OrderController::verifyPayment()
$api->utility->verifyPaymentSignature([
    'razorpay_order_id' => $orderId,
    'razorpay_payment_id' => $paymentId,
    'razorpay_signature' => $signature
]);

// If verified, create order
Order::create([...]);
Payment::create([...]);
```

---

## 📁 File Structure

```
restaurant-project/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php (Admin auth)
│   │       ├── UserAuthController.php (User auth)
│   │       ├── OrderController.php (Orders & Payment)
│   │       ├── ContactController.php (Contact form)
│   │       └── Admin/
│   │           ├── HeroSectionController.php
│   │           ├── AboutSectionController.php
│   │           ├── GallerySectionController.php
│   │           ├── MenuSectionController.php
│   │           ├── OrderManagementController.php
│   │           └── UserManagementController.php
│   │
│   └── Models/
│       ├── User.php
│       ├── Order.php
│       ├── OrderItem.php
│       ├── Payment.php
│       ├── MenuSection.php
│       ├── HeroSection.php
│       ├── AboutSection.php
│       ├── GallerySection.php
│       └── Contact.php
│
├── config/
│   ├── auth.php (Guards configuration)
│   ├── session.php (Session settings)
│   └── razorpay.php (Razorpay config)
│
├── database/
│   └── migrations/
│       ├── create_users_table.php
│       ├── create_orders_table.php
│       ├── create_order_items_table.php
│       ├── create_payments_table.php
│       ├── create_menu_sections_table.php
│       ├── create_hero_sections_table.php
│       ├── create_about_sections_table.php
│       ├── create_gallery_sections_table.php
│       └── create_contacts_table.php
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── main.blade.php (Customer layout)
│       │   ├── header.blade.php (Customer header)
│       │   └── dashboard.blade.php (Admin layout)
│       │
│       ├── auth/
│       │   └── login.blade.php (Admin login)
│       │
│       ├── user/
│       │   ├── login.blade.php (User login)
│       │   ├── register.blade.php (User register)
│       │   ├── orders.blade.php (User orders)
│       │   └── order-details.blade.php
│       │
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── contacts.blade.php
│       │   ├── hero/ (Hero CRUD views)
│       │   ├── about/ (About CRUD views)
│       │   ├── gallery/ (Gallery CRUD views)
│       │   ├── menu/ (Menu CRUD views)
│       │   ├── orders/ (Orders management)
│       │   └── users/ (Users management)
│       │
│       ├── home.blade.php (Homepage)
│       ├── about.blade.php (About page)
│       ├── menu.blade.php (Menu page)
│       ├── gallery.blade.php (Gallery page)
│       ├── contact.blade.php (Contact page)
│       ├── cart.blade.php (Cart page)
│       └── checkout.blade.php (Checkout page)
│
├── routes/
│   └── web.php (All routes)
│
├── public/
│   ├── css/
│   ├── js/
│   └── images/
│
└── .env (Environment variables)
```

---

## 🔄 Complete Data Flow

### Customer Order Flow
```
1. User browses menu
   ↓
2. Adds items to cart (localStorage)
   ↓
3. Goes to cart page
   ↓
4. Proceeds to checkout
   ↓
5. Login/Register (if not logged in)
   ↓
6. Fills delivery address
   ↓
7. Selects payment method
   ↓
8. Places order
   ↓
   ├─ COD: Order created → Database
   └─ Razorpay: Payment → Verify → Order created
   ↓
9. Order confirmation
   ↓
10. View in "My Orders"
```

### Admin Order Management Flow
```
1. Customer places order
   ↓
2. Order appears in Admin Dashboard
   ↓
3. Admin views order details
   ↓
4. Admin updates status:
   - Pending → Confirmed
   - Confirmed → Preparing
   - Preparing → Out for Delivery
   - Out for Delivery → Delivered
   ↓
5. Customer sees updated status in "My Orders"
```

---

## 🎨 Key Features

### Customer Features
✅ Browse menu with categories
✅ Add to cart with quantity
✅ View cart & modify items
✅ User registration & login
✅ Secure checkout process
✅ Multiple payment options (COD & Razorpay)
✅ Order tracking
✅ Order history
✅ Contact form

### Admin Features
✅ Separate admin authentication
✅ Dashboard with stats
✅ Content management (Hero, About, Gallery, Menu)
✅ Order management with status updates
✅ Customer management
✅ Contact form submissions
✅ Real-time updates

### Technical Features
✅ Separate authentication guards (Admin & User)
✅ Session management (simultaneous logins)
✅ Payment gateway integration (Razorpay)
✅ Payment verification & security
✅ Responsive design
✅ AJAX for cart operations
✅ LocalStorage for cart persistence
✅ Image upload & management
✅ Email notifications (contact replies)

---

## 🚀 How to Use

### For Development
```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Configure database in .env
DB_DATABASE=restaurant-db
DB_USERNAME=root
DB_PASSWORD=

# 4. Run migrations
php artisan migrate

# 5. Start server
php artisan serve

# 6. Access
Customer Site: http://localhost:8000
Admin Login: http://localhost:8000/login
```

### For Testing
```bash
# Clear cache
php artisan config:clear
php artisan cache:clear

# Test Razorpay
Card: 4111 1111 1111 1111
CVV: 123
Expiry: 12/25
```

---

## 📝 Summary

Ye ek **complete restaurant management system** hai jisme:

1. **Customer Side**: Menu browsing, cart, checkout, payment, order tracking
2. **Admin Side**: Content management, order management, customer management
3. **Authentication**: Separate guards for admin & users
4. **Payment**: Razorpay integration with COD option
5. **Database**: Proper relationships & data structure
6. **Security**: CSRF protection, password hashing, payment verification

**Sab kuch connected hai aur smoothly work kar raha hai!** 🎉
