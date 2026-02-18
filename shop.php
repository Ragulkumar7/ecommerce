<?php
// Database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

$products = [];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM products WHERE category = 'products'");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // If database fails, use sample data
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StyleHub - Premium Shopping Destination</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* General Styles */
    :root {
      --primary: #6F4AA2;
      --primary-dark: #5a3a80;
      --secondary: #ff6b6b;
      --dark: #1e1e2c;
      --light: #f8f9fa;
      --gray: #6c757d;
      --light-gray: #e9ecef;
      --accent: #ffd166;
    }

    body {
      font-family: 'Inter', sans-serif;
      color: #333;
      overflow-x: hidden;
    }

    /* Header Styles */
    .main-header {
      background: #fff;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
      position: sticky;
      top: 0;
      z-index: 1030;
    }

    .brand-logo {
      font-weight: 800;
      color: var(--dark);
      font-size: 1.8rem;
      letter-spacing: -0.5px;
    }

    .brand-icon {
      background: var(--primary);
      color: white;
      width: 40px;
      height: 40px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      margin-right: 10px;
    }

    .search-form {
      position: relative;
    }

    .search-input {
      border-radius: 50px;
      padding-left: 20px;
      padding-right: 50px;
      height: 46px;
      border: 1px solid var(--light-gray);
      transition: all 0.3s;
    }

    .search-input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 0.25rem rgba(111, 74, 162, 0.15);
    }

    .search-btn {
      position: absolute;
      right: 5px;
      top: 5px;
      height: 36px;
      width: 36px;
      border-radius: 50%;
      background: var(--primary);
      color: white;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s;
    }

    .search-btn:hover {
      background: var(--primary-dark);
    }

    .header-actions .action-icon {
      position: relative;
      color: var(--dark);
      font-size: 1.4rem;
      transition: all 0.3s;
      text-decoration: none;
    }

    .header-actions .action-icon:hover {
      color: var(--primary);
    }

    .cart-badge {
      position: absolute;
      top: -8px;
      right: -8px;
      background: var(--secondary);
      color: white;
      font-size: 0.7rem;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Navigation - FIXED TO MATCH YOUR PERFECT IMAGE */
    .main-navbar {
      background: linear-gradient(to right, #6F4AA2, #5a3a80);
      padding: 5px 0;
    }

    .nav-link {
      color: rgba(255, 255, 255, 0.9) !important;
      font-weight: 500;
      padding: 0.8rem 1.2rem !important;
      transition: all 0.3s;
      position: relative;
      display: flex;
      align-items: center;
    }

    .nav-link i {
      margin-right: 8px;
      font-size: 1.1rem;
    }

    .nav-link:hover,
    .nav-link.active {
      color: white !important;
    }

    .nav-link.active:after {
      content: '';
      position: absolute;
      bottom: 5px;
      left: 15%;
      width: 70%;
      height: 3px;
      background: var(--accent);
      border-radius: 3px;
    }

    .dropdown-menu {
      border: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      border-radius: 10px;
      padding: 0.5rem;
      margin-top: 0.5rem;
    }

    .dropdown-item {
      border-radius: 6px;
      padding: 0.5rem 1rem;
    }

    .dropdown-item:hover {
      background: var(--light);
    }

    .phone-btn {
      background: white;
      color: var(--primary) !important;
      font-weight: 600;
      border-radius: 50px;
      padding: 0.5rem 1.5rem !important;
      transition: all 0.3s;
    }

    .phone-btn:hover {
      background: var(--light);
      transform: translateY(-2px);
    }

    /* Hero Banner */
    .hero-banner {
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1498049794561-7780e7231661?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80') center center/cover no-repeat;
      min-height: 380px;
      display: flex;
      align-items: center;
      position: relative;
    }

    .breadcrumb-item a {
      color: rgba(255, 255, 255, 0.8) !important;
      text-decoration: none;
      transition: all 0.3s;
    }

    .breadcrumb-item a:hover {
      color: white !important;
    }

    /* Filter Sidebar */
    .filter-sidebar {
      background: white;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
      padding: 1.5rem;
      position: sticky;
      top: 120px;
      height: fit-content;
    }

    .filter-title {
      color: var(--dark);
      font-weight: 700;
      font-size: 1.2rem;
      margin-bottom: 1.2rem;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid var(--light-gray);
    }

    .form-check-input:checked {
      background-color: var(--primary);
      border-color: var(--primary);
    }

    /* Product Card Styling */
    .clean-product-card {
        border: 1px solid #eee;
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
        background: #fff;
        overflow: hidden;
    }
    .clean-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }

    .form-range::-webkit-slider-thumb { background: var(--primary) !important; }
    .form-range::-moz-range-thumb { background: var(--primary) !important; }
    
    .btn-primary {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: white !important;
    }
    .btn-primary:hover {
        background-color: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
        transform: translateY(-2px);
    }

    .shop-controls {
      background: white;
      border-radius: 12px;
      padding: 1rem 1.5rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 2rem;
    }

    /* Footer */
    .footer-section {
      background: var(--dark);
      color: rgba(255, 255, 255, 0.8);
      padding: 4rem 0 2rem;
      margin-top: 4rem;
    }

    .footer-brand-text {
      color: white;
      font-weight: 800;
      font-size: 2rem;
      letter-spacing: -1px;
    }

    /* Toast Notification */
    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1050;
    }

    .toast {
      background-color: #28a745;
      color: white;
      border-radius: 8px;
      padding: 10px 20px;
      margin-bottom: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      display: flex;
      align-items: center;
      justify-content: space-between;
      min-width: 300px;
    }

    .toast-close {
      background: none;
      border: none;
      color: white;
      font-size: 1.2rem;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="toast-container" id="toastContainer"></div>

  <header class="main-header">
    <div class="container py-3">
      <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-6">
          <div class="d-flex align-items-center">
            <span class="brand-icon"><i class="bi bi-shop"></i></span>
            <span class="brand-logo">StyleHub</span>
          </div>
        </div>
        <div class="col-lg-6 col-md-5 d-none d-md-block">
          <form class="search-form" id="searchForm">
            <input class="form-control search-input" type="search" placeholder="Search for products..." aria-label="Search" id="searchInput">
            <button class="search-btn" type="submit"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
          <div class="d-flex align-items-center justify-content-end header-actions">
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-arrow-repeat"></i></a>
            <a href="#" class="action-icon me-3 position-relative" onclick="showFavorites()">
              <i class="bi bi-heart"></i>
              <span class="cart-badge" id="favCount">0</span>
            </a>
            <a href="cart.php" class="action-icon position-relative">
              <i class="bi bi-cart3"></i>
              <span class="cart-badge" id="header-cart-count">0</span>
            </a>
            <span class="fs-5 ms-2 fw-bold d-none d-lg-block">₹<span id="header-total">0.00</span></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <nav class="main-navbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="bi bi-house"></i> Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-gem"></i> Beauty & Jewelry</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
                        <li><a class="dropdown-item" href="skincare.php">Skincare</a></li>
                        <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-heart"></i> Stationery & Gifts</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="gifts.php">Handmade Crafts</a></li>
                        <li><a class="dropdown-item" href="stationary.php">School Supplies</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-pencil"></i> Electronics</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./electronics.php">Mobile Phones</a></li>
                        <li><a class="dropdown-item" href="./laptops.php">Laptops</a></li>
                        <li><a class="dropdown-item" href="./accessories.php">Accessories</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-person"></i> Fashion</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="mens-wear.php">Men's Clothing</a></li>
                        <li><a class="dropdown-item" href="women-wear.php">Women's Clothing</a></li>
                        <li><a class="dropdown-item" href="kids-wear.php">Kids' Clothing</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="deals.php "><i class="bi bi-tag"></i> Deals</a>
                </li>
            </ul>
            <a href="tel:+01234567890" class="nav-link phone-btn text-dark d-none d-lg-block">+0123 456 7890</a>
        </div>
    </div>
  </nav>

  <section class="hero-banner">
    <div class="container text-white">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Products</a></li>
          <li class="breadcrumb-item active text-white" aria-current="page">All Categories</li>
        </ol>
      </nav>
      <h1 class="display-4 fw-bold mb-3">Premium Collection</h1>
      <p class="lead mb-4">Discover our premium selection of products across all categories</p>
    </div>
  </section>

  <section class="shop-page container py-5">
    <div class="row">
      <aside class="col-lg-3">
        <div class="filter-sidebar">
          <h3 class="filter-title">Categories</h3>
          <div class="form-check mb-2">
            <input class="form-check-input category-filter-check" type="checkbox" id="category-beauty" value="beauty" checked>
            <label class="form-check-label" for="category-beauty">Beauty Products</label>
            <span class="filter-count">(24)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input category-filter-check" type="checkbox" id="category-homemade" value="homemade" checked>
            <label class="form-check-label" for="category-homemade">Homemade Gifts</label>
            <span class="filter-count">(18)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input category-filter-check" type="checkbox" id="category-stationery" value="stationery" checked>
            <label class="form-check-label" for="category-stationery">Stationery</label>
            <span class="filter-count">(12)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input category-filter-check" type="checkbox" id="category-jewelry" value="jewelry" checked>
            <label class="form-check-label" for="category-jewelry">Jewelry</label>
            <span class="filter-count">(15)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input category-filter-check" type="checkbox" id="category-mens" value="mens" checked>
            <label class="form-check-label" for="category-mens">Men's Fashion</label>
            <span class="filter-count">(20)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input category-filter-check" type="checkbox" id="category-womens" value="womens" checked>
            <label class="form-check-label" for="category-womens">Women's Fashion</label>
            <span class="filter-count">(22)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input category-filter-check" type="checkbox" id="category-electronics" value="electronics" checked>
            <label class="form-check-label" for="category-electronics">Electronics</label>
            <span class="filter-count">(16)</span>
          </div>
          
          <h3 class="filter-title mt-4">Price Range</h3>
          <div class="range-slider mb-4">
            <input type="range" class="form-range" id="priceRange" min="0" max="1000" step="10" value="1000">
            <div class="d-flex justify-content-between">
              <span>₹0</span>
              <span id="priceRangeValue">₹1000</span>
            </div>
          </div>
          
          <h3 class="filter-title mt-4">Brand</h3>
          <div class="form-check mb-2">
            <input class="form-check-input brand-filter" type="checkbox" id="brand1" value="premium" checked>
            <label class="form-check-label" for="brand1">Premium</label>
            <span class="filter-count">(8)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input brand-filter" type="checkbox" id="brand2" value="artisan" checked>
            <label class="form-check-label" for="brand2">Artisan</label>
            <span class="filter-count">(6)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input brand-filter" type="checkbox" id="brand3" value="classic" checked>
            <label class="form-check-label" for="brand3">Classic</label>
            <span class="filter-count">(5)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input brand-filter" type="checkbox" id="brand4" value="modern" checked>
            <label class="form-check-label" for="brand4">Modern</label>
            <span class="filter-count">(3)</span>
          </div>
          
          <h3 class="filter-title mt-4">Customer Rating</h3>
          <div class="form-check mb-2">
            <input class="form-check-input rating-filter" type="checkbox" id="rating5" value="5" checked>
            <label class="form-check-label text-warning" for="rating5">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input rating-filter" type="checkbox" id="rating4" value="4" checked>
            <label class="form-check-label text-warning" for="rating4">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i> & Up
            </label>
          </div>
          
          <button class="btn btn-primary w-100 mt-4 rounded-pill" id="applyFilters">Apply Filters</button>
          <button class="btn btn-outline-secondary w-100 mt-2 rounded-pill" id="resetFilters">Reset Filters</button>
        </div>
      </aside>
      
      <section class="col-lg-9">
        <div class="shop-controls d-flex justify-content-between align-items-center mb-4">
          <p class="results-count mb-0">Showing <span id="showing-count">1-12</span> of <span id="total-count">127</span> results</p>
          <div class="d-flex align-items-center">
            <label class="me-2 mb-0">Sort by:</label>
            <select class="form-select form-select-sm" id="sortSelect" style="width: auto;">
              <option value="default">Best Match</option>
              <option value="price-low">Price: Low to High</option>
              <option value="price-high">Price: High to Low</option>
              <option value="rating">Highest Rated</option>
              <option value="newest">Newest First</option>
            </select>
          </div>
        </div>
        
        <div class="row g-4" id="products-container"></div>
      </section>
    </div>
  </section>

  <div class="modal fade" id="cartModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header"><h5>Shopping Cart</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body" id="cartItems"></div>
        <div class="modal-footer">
          <h5 class="mt-3 me-auto">Total: ₹<span id="modalCartTotal">0.00</span></h5>
          <button class="btn btn-primary rounded-pill px-4" onclick="buyNow()">Proceed to Checkout</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="favoritesModal" tabindex="-1">
    <div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5>Your Favorites</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body" id="favoritesItems"></div></div></div>
  </div>

 <footer class="footer-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h2 class="footer-brand-text mb-3">StyleHub</h2>
          <p class="mb-4">We offer the best products at competitive prices with fast shipping and excellent customer service.</p>
          <div class="d-flex">
            <a href="#" class="text-light me-3"><i class="bi bi-facebook fs-4"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-twitter fs-4"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-instagram fs-4"></i></a>
            <a href="#" class="text-light"><i class="bi bi-linkedin fs-4"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 mb-md-0 footer-links">
          <h5>Shop</h5>
          <ul>
            <li><a href="#">Beauty & Jewelry</a></li>
            <li><a href="#">Homemade Gifts</a></li>
            <li><a href="#">Stationery</a></li>
            <li><a href="#">Men's Fashion</a></li>
            <li><a href="#">Women's Fashion</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 mb-md-0 footer-links">
          <h5>Customer Service</h5>
          <ul>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Returns & Exchanges</a></li>
            <li><a href="#">Shipping & Delivery</a></li>
            <li><a href="#">Product Support</a></li>
            <li><a href="#">FAQ</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4 footer-newsletter">
          <h5 class="mb-3">Newsletter</h5>
          <p>Subscribe to get special offers, free giveaways, and new product alerts.</p>
          <form>
            <input type="email" class="form-control mb-3" placeholder="Your email address">
            <button type="submit" class="btn btn-primary">Subscribe</button>
          </form>
        </div>
      </div>
      <hr class="my-4 bg-light">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <p class="mb-0">&copy; 2023 StyleHub. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <div class="d-flex justify-content-md-end">
            <a href="#" class="text-light me-3">Privacy Policy</a>
            <a href="#" class="text-light me-3">Terms of Service</a>
            <a href="#" class="text-light">Cookie Policy</a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div id="toastContainer" aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 9999"></div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const products = [
      { id: 1001, name: "Premium Men's Dress Series 7", image: "./ASSEST/img/Premium.jpg", badge: "Sale", price: 249.99, rating: 4.5, ratingCount: 142, category: "mens", brand: "premium" },
      { id: 1002, name: "Women Fashion Dress", image: "./ASSEST/img/women.jpg", badge: "New", price: 179.99, rating: 4.0, ratingCount: 87, category: "womens", brand: "modern" },
      { id: 1003, name: "Luxury Smart Watch - Gold Edition", image: "./ASSEST/img/watch.jpg", price: 349.99, rating: 5.0, ratingCount: 215, category: "electronics", brand: "premium" },
      { id: 1004, name: "Sports Smart Watch", image: "https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?auto=format&fit=crop&w=870&q=80", price: 199.99, rating: 4.5, ratingCount: 163, category: "electronics", brand: "modern" },
      { id: 1005, name: "Stationery Kit", image: "https://img.freepik.com/free-photo/top-view-wooden-desk-with-notebook-office-supplies_24837-170.jpg?w=740&q=80", price: 129.99, rating: 4.0, ratingCount: 94, category: "stationery", brand: "classic" },
      { id: 1006, name: "Premium Brand - Makeup Kit", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkLV-qSVvs5Fr5UNrZ3nb6BrP0QF1k-u8akA&s", badge: "New", price: 159.99, rating: 5.0, ratingCount: 201, category: "beauty", brand: "premium" },
      { id: 1007, name: "Homemade Gift Basket", image: "https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=870&q=80", price: 89.99, rating: 4.2, ratingCount: 76, category: "homemade", brand: "artisan" },
      { id: 1008, name: "Gold Plated Jewelry Set", image: "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&w=870&q=80", price: 299.99, rating: 4.8, ratingCount: 134, category: "jewelry", brand: "premium" }
    ];

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    function renderRatingStars(rating) {
      let stars = "";
      for (let i = 1; i <= 5; i++) {
        if (rating >= i) stars += '<i class="bi bi-star-fill text-warning"></i>';
        else if (rating >= i - 0.5) stars += '<i class="bi bi-star-half text-warning"></i>';
        else stars += '<i class="bi bi-star text-warning"></i>';
      }
      return stars;
    }

    function showToast(message) {
      const container = document.getElementById('toastContainer');
      const id = 'toast-' + Date.now();
      const toast = document.createElement('div');
      toast.className = 'toast';
      toast.id = id;
      toast.innerHTML = `<div class="toast-message">${message}</div><button class="toast-close" onclick="document.getElementById('${id}').remove()">&times;</button>`;
      container.appendChild(toast);
      setTimeout(() => { if (document.getElementById(id)) document.getElementById(id).remove(); }, 3000);
    }

    function renderProducts(list = products) {
      const container = document.getElementById("products-container");
      container.innerHTML = list.length === 0 ? '<div class="col-12 text-center py-5"><h4>No products found</h4></div>' : "";
      
      list.forEach(p => {
        const badge = p.badge ? `<span class="badge bg-${p.badge === 'Sale' ? 'danger' : 'success'} position-absolute" style="top:10px; right:10px;">${p.badge}</span>` : '';
        container.innerHTML += `
          <div class="col-md-6 col-xl-4">
            <div class="clean-product-card p-3 h-100 d-flex flex-column shadow-sm position-relative">
              ${badge}
              <a href="product-details.php?id=${p.id}" class="text-decoration-none text-dark">
                <img src="${p.image}" class="img-fluid rounded mb-3 w-100" style="height:250px; object-fit:cover;">
                <h3 class="h6 fw-bold mb-1">${p.name}</h3>
              </a>
              <div class="mb-2"><span class="rating small">${renderRatingStars(p.rating)}</span></div>
              <div class="mb-3"><span class="product-price fs-5">₹${p.price.toFixed(2)}</span></div>
              <button class="btn btn-primary btn-sm w-100 rounded-pill mt-auto" onclick="addToCart(${p.id})">Add to Cart</button>
            </div>
          </div>
        `;
      });
      document.getElementById('showing-count').textContent = `1-${list.length}`;
      document.getElementById('total-count').textContent = products.length;
    }

    function addToCart(productId) {
      const product = products.find(p => p.id === productId);
      const existing = cart.find(item => item.id === productId);
      if (existing) existing.quantity += 1;
      else cart.push({...product, quantity: 1});
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartUI();
      showToast(`${product.name} added!`);
    }

    function updateCartUI() {
      const count = cart.reduce((t, i) => t + i.quantity, 0);
      const total = cart.reduce((t, i) => t + (i.price * i.quantity), 0);
      document.getElementById('header-cart-count').textContent = count;
      document.getElementById('header-total').textContent = total.toFixed(2);
    }

    function applyFilters() {
      const search = document.getElementById('searchInput').value.trim().toLowerCase();
      const maxPrice = parseFloat(document.getElementById('priceRange').value);
      const selCats = Array.from(document.querySelectorAll('.category-filter-check:checked')).map(cb => cb.value);

      const filtered = products.filter(p => {
        const matchSearch = search === '' || p.name.toLowerCase().includes(search);
        const matchPrice = p.price <= maxPrice;
        const matchCat = selCats.length === 0 || selCats.includes(p.category);
        return matchSearch && matchPrice && matchCat;
      });
      renderProducts(filtered);
    }

    document.addEventListener('DOMContentLoaded', () => {
      renderProducts();
      updateCartUI();
      document.getElementById('priceRange').addEventListener('input', e => {
        document.getElementById('priceRangeValue').textContent = '₹' + e.target.value;
        applyFilters();
      });
      document.getElementById('searchInput').addEventListener('input', applyFilters);
      document.getElementById('applyFilters').addEventListener('click', applyFilters);
      document.getElementById('resetFilters').addEventListener('click', () => location.reload());
    });
  </script>
</body>
</html>