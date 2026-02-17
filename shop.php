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
  <!-- Bootstrap 5 CSS & Bootstrap Icons CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* General Styles */
    :root {
      --primary: #d16d08f2;
      --primary-dark: #d16d08f2;
      --secondary: #ff6b6b;
      --dark: #1e1e2c;
      --light: #f8f9fa;
      --gray: #6c757d;
      --light-gray: #e9ecef;
      --accent: #ffd166;
      --success: #06d6a0;
      --beauty: #e83e8c;
      --homemade: #20c997;
      --stationery: #6f42c1;
      --jewelry: #ffc107;
      --mens: #007bff;
      --womens: #fd7e14;
      --electronics: #6610f2;
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
      box-shadow: 0 0 0 0.25rem rgba(209, 132, 125, 0.15);
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

    /* Navigation */
    .main-navbar {
      background: linear-gradient(to right, var(--primary), var(--primary-dark));
      padding: 0.5rem 0;
    }

    .nav-link {
      color: rgba(255, 255, 255, 0.85) !important;
      font-weight: 500;
      padding: 0.7rem 1.2rem !important;
      transition: all 0.3s;
      position: relative;
    }

    .nav-link:hover,
    .nav-link.active {
      color: white !important;
    }

    .nav-link.active:after {
      content: '';
      position: absolute;
      bottom: 0;
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
      color: var(--primary);
      font-weight: 600;
      border-radius: 50px;
      padding: 0.5rem 1.5rem;
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

    /* Category Filter */
    .category-filter {
      background: white;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
      padding: 1.5rem;
      margin-bottom: 2rem;
    }

    .category-btn {
      border: none;
      border-radius: 8px;
      padding: 0.6rem 1.2rem;
      margin: 0.3rem;
      font-weight: 500;
      transition: all 0.3s;
      cursor: pointer;
    }

    .category-btn:hover,
    .category-btn.active {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .beauty-btn {
      background: rgba(232, 62, 140, 0.15);
      color: var(--beauty);
    }

    .beauty-btn.active,
    .beauty-btn:hover {
      background: var(--beauty);
      color: white;
    }

    .homemade-btn {
      background: rgba(32, 201, 151, 0.15);
      color: var(--homemade);
    }

    .homemade-btn.active,
    .homemade-btn:hover {
      background: var(--homemade);
      color: white;
    }

    .stationery-btn {
      background: rgba(111, 66, 193, 0.15);
      color: var(--stationery);
    }

    .stationery-btn.active,
    .stationery-btn:hover {
      background: var(--stationery);
      color: white;
    }

    .jewelry-btn {
      background: rgba(255, 193, 7, 0.15);
      color: var(--jewelry);
    }

    .jewelry-btn.active,
    .jewelry-btn:hover {
      background: var(--jewelry);
      color: white;
    }

    .mens-btn {
      background: rgba(0, 123, 255, 0.15);
      color: var(--mens);
    }

    .mens-btn.active,
    .mens-btn:hover {
      background: var(--mens);
      color: white;
    }

    .womens-btn {
      background: rgba(253, 126, 20, 0.15);
      color: var(--womens);
    }

    .womens-btn.active,
    .womens-btn:hover {
      background: var(--womens);
      color: white;
    }

    .electronics-btn {
      background: rgba(102, 16, 242, 0.15);
      color: var(--electronics);
    }

    .electronics-btn.active,
    .electronics-btn:hover {
      background: var(--electronics);
      color: white;
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

    .form-check-label {
      color: #495057;
      font-weight: 500;
    }

    .filter-count {
      font-size: 0.85rem;
    }

    /* Product Cards */
    .product-card {
      transition: all 0.3s ease;
      border: none;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .product-img-container {
      position: relative;
      overflow: hidden;
      background: #f9f9f9;
      height: 240px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .product-img {
      max-height: 100%;
      max-width: 100%;
      object-fit: contain;
      transition: all 0.5s;
    }

    .product-card:hover .product-img {
      transform: scale(1.05);
    }

    .product-badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background: var(--secondary);
      color: white;
      font-size: 0.75rem;
      font-weight: 600;
      padding: 0.25rem 0.75rem;
      border-radius: 50px;
    }

    .product-actions {
      position: absolute;
      top: 15px;
      right: 15px;
      display: flex;
      flex-direction: column;
      opacity: 0;
      transition: all 0.3s;
    }

    .product-card:hover .product-actions {
      opacity: 1;
    }

    .action-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: white;
      color: var(--dark);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 0.5rem;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s;
      border: none;
      cursor: pointer;
    }

    .action-btn:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-2px);
    }

    .card-body {
      padding: 1.25rem;
    }

    .product-title {
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 0.75rem;
      font-size: 1.1rem;
      height: 52px;
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }

    .product-price {
      font-weight: 700;
      color: var(--primary);
      font-size: 1.25rem;
    }

    .original-price {
      color: var(--gray);
      text-decoration: line-through;
      font-size: 0.9rem;
    }

    .product-rating {
      color: #ffc107;
      margin-bottom: 0.75rem;
    }

    .product-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1rem;
    }

    .add-to-cart-btn {
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 50px;
      padding: 0.5rem 1.25rem;
      font-weight: 500;
      transition: all 0.3s;
      display: flex;
      align-items: center;
    }
    
    .add-to-cart-btn:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    .view-details-btn {
      color: var(--gray);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s;
      border: none;
      background: transparent;
      cursor: pointer;
    }

    .view-details-btn:hover {
      color: var(--primary);
    }

    /* Controls */
    .shop-controls {
      background: white;
      border-radius: 12px;
      padding: 1rem 1.5rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 2rem;
    }

    .results-count {
      color: var(--gray);
      font-weight: 500;
    }

    /* Pagination */
    .pagination .page-link {
      border: none;
      color: var(--dark);
      font-weight: 600;
      border-radius: 8px;
      margin: 0 3px;
      min-width: 42px;
      height: 42px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .pagination .page-item.active .page-link {
      background: var(--primary);
      color: white;
    }

    .pagination .page-link:hover {
      background: var(--light);
      color: var(--primary);
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

    .footer-links h5 {
      color: white;
      font-weight: 700;
      margin-bottom: 1.5rem;
      position: relative;
      padding-bottom: 0.75rem;
    }

    .footer-links h5:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 3px;
      background: var(--primary);
      border-radius: 3px;
    }

    .footer-links ul {
      list-style: none;
      padding: 0;
    }

    .footer-links ul li {
      margin-bottom: 0.75rem;
      transition: all 0.3s;
    }

    .footer-links ul li:hover {
      color: white;
      transform: translateX(5px);
    }

    .footer-links ul li a {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: all 0.3s;
    }

    .footer-links ul li a:hover {
      color: white;
    }

    .footer-newsletter input {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      color: white;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      margin-bottom: 1rem;
    }

    .footer-newsletter input::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .footer-newsletter input:focus {
      background: rgba(255, 255, 255, 0.15);
      box-shadow: none;
      color: white;
    }

    .footer-newsletter button {
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      transition: all 0.3s;
      width: 100%;
    }

    .footer-newsletter button:hover {
      background: var(--primary-dark);
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
      .filter-sidebar {
        position: static;
        margin-bottom: 2rem;
      }

      .hero-banner {
        min-height: 300px;
      }
    }

    @media (max-width: 768px) {
      .brand-logo {
        font-size: 1.5rem;
      }

      .hero-banner h1 {
        font-size: 2rem;
      }

      .product-title {
        font-size: 1rem;
        height: auto;
      }

      .footer-section {
        text-align: center;
      }

      .footer-links h5:after {
        left: 50%;
        transform: translateX(-50%);
      }
    }

    /* Toast Notification */
    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1050;
    }

    .toast {
      background-color: var(--success);
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

    .toast-message {
      flex-grow: 1;
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
  <!-- Toast Container -->
  <div class="toast-container" id="toastContainer"></div>

  <!-- Header Section -->
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
          <form class="search-form">
            <input class="form-control search-input" type="search" placeholder="Search for products..." aria-label="Search" id="searchInput">
            <button class="search-btn" type="submit"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
          <div class="d-flex align-items-center justify-content-end header-actions">
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-arrow-repeat"></i></a>
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-heart"></i><span class="cart-badge" id="favCount">0</span></a>
            <a href="cart.php" class="action-icon position-relative"><i class="bi bi-cart3"></i><span class="cart-badge" id="header-cart-count">0</span></a>
            <span class="fs-5 ms-2 fw-bold d-none d-lg-block">₹<span id="header-total">0.00</span></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Navigation -->
  <nav class="main-navbar">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="index.php"><i class="bi bi-house me-1"></i> Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-gem me-1"></i> Beauty & Jewelry
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
              <li><a class="dropdown-item" href="beauty-products.php">Skincare</a></li>
              <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-heart me-1"></i> Stationery & Gifts
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="gifts.php">Handmade Crafts</a></li>
              <li><a class="dropdown-item" href="stationary.php">School Supplies</a></li>
              <li><a class="dropdown-item" href="stationary.php">College Supplies</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-pencil me-1"></i> Electronics
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./electronics.php">Mobile Phones</a></li>
              <li><a class="dropdown-item" href="./electronics.php">Laptops</a></li>
              <li><a class="dropdown-item" href="./electronics.php">Accessories</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person me-1"></i> Fashion
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="mens-wear.php">Men's Clothing</a></li>
              <li><a class="dropdown-item" href="women-wear.php">Women's Clothing</a></li>
              <li><a class="dropdown-item" href="kids-wear.php">Kids' Clothing</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-tag me-1"></i> Deals</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Banner -->
  <section class="hero-banner">
    <div class="container text-white">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Products</a></li>
          <li class="breadcrumb-item active" aria-current="page">All Categories</li>
        </ol>
      </nav>
      <h1 class="display-4 fw-bold mb-3">Premium Collection</h1>
      <p class="lead mb-4">Discover our premium selection of products across all categories</p>
      <button class="btn btn-primary btn-lg">Shop Now <i class="bi bi-arrow-right ms-2"></i></button>
    </div>
  </section>

  <!-- Shop Page Section -->
  <section class="shop-page container py-5">
    <!-- Category Filter -->
    
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
            <label class="form-check-label" for="rating5">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </label>
            <span class="filter-count">(15)</span>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input rating-filter" type="checkbox" id="rating4" value="4" checked>
            <label class="form-check-label" for="rating4">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star text-warning"></i> & Up
            </label>
            <span class="filter-count">(20)</span>
          </div>
          
          <button class="btn btn-primary w-100 mt-4" id="applyFilters">Apply Filters</button>
          <button class="btn btn-outline-secondary w-100 mt-2" id="resetFilters">Reset Filters</button>
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
        
        <div class="row g-4" id="products-container">
          <!-- Products will be dynamically inserted here -->
        </div>
        
        <!-- Pagination -->
        <nav aria-label="Product pagination" class="mt-5">
          <ul class="pagination justify-content-center" id="pagination">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
      </section>
    </div>
  </section>

  <!-- Footer Section -->
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
            <button type="submit" class="btn">Subscribe</button>
          </form>
        </div>
      </div>
      <hr class="my-4 bg-light">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <p class="mb-0">&copy; 2025 StyleHub. All rights reserved.</p>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // =========================================================================
    // Complete E-Commerce Product Management System
    // =========================================================================
    
    // Product data array with complete details
    const products = [
      {
        id: 1,
        name: "Premium Men's Dress Series 7",
        image: "./ASSEST/img/Premium.jpg",
        badge: "Sale",
        price: 249.99,
        originalPrice: 299.99,
        rating: 4.5,
        ratingCount: 142,
        category: "mens",
        brand: "premium",
        description: "Premium quality men's dress with elegant design and comfortable fit. Perfect for formal occasions and business meetings.",
        features: ["Premium fabric", "Tailored fit", "Machine washable", "Available in multiple sizes"],
        inStock: true,
        sku: "MD-007"
      },
      {
        id: 2,
        name: "Women Fashion Dress",
        image: "./ASSEST/img/women.jpg",
        badge: "New",
        price: 179.99,
        originalPrice: null,
        rating: 4.0,
        ratingCount: 87,
        category: "womens",
        brand: "modern",
        description: "Stylish and comfortable women's fashion dress perfect for casual and semi-formal occasions.",
        features: ["Breathable fabric", "Trendy design", "Easy care", "Multiple color options"],
        inStock: true,
        sku: "WD-012"
      },
      {
        id: 3,
        name: "Luxury Smart Watch - Gold Edition",
        image: "./ASSEST/img/watch.jpg",
        badge: "",
        price: 349.99,
        originalPrice: 399.99,
        rating: 5.0,
        ratingCount: 215,
        category: "electronics",
        brand: "premium",
        description: "Premium luxury smart watch with advanced health monitoring features and elegant gold finish.",
        features: ["Heart rate monitor", "GPS tracking", "Waterproof", "7-day battery life", "Gold plated"],
        inStock: true,
        sku: "SW-003"
      },
      {
        id: 4,
        name: "Sports Smart Watch - Waterproof",
        image: "https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?auto=format&fit=crop&w=870&q=80",
        badge: "Sale",
        price: 199.99,
        originalPrice: 249.99,
        rating: 4.5,
        ratingCount: 163,
        category: "electronics",
        brand: "modern",
        description: "Rugged sports smart watch designed for active lifestyle with comprehensive fitness tracking.",
        features: ["Waterproof IP68", "Multi-sport modes", "Sleep tracking", "Phone notifications"],
        inStock: true,
        sku: "SW-004"
      },
      {
        id: 5,
        name: "Stationery Kit",
        image: "https://img.freepik.com/free-photo/top-view-wooden-desk-with-notebook-office-supplies_24837-170.jpg?w=740&q=80",
        badge: "",
        price: 129.99,
        originalPrice: null,
        rating: 4.0,
        ratingCount: 94,
        category: "stationery",
        brand: "classic",
        description: "Complete stationery kit with all essential items for students and professionals.",
        features: ["Complete set", "High quality materials", "Organized case", "Perfect for gifting"],
        inStock: true,
        sku: "ST-001"
      },
      {
        id: 6,
        name: "Premium Brand - Makeup Kit",
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkLV-qSVvs5Fr5UNrZ3nb6BrP0QF1k-u8akA&s",
        badge: "New",
        price: 159.99,
        originalPrice: 189.99,
        rating: 5.0,
        ratingCount: 201,
        category: "beauty",
        brand: "premium",
        description: "Professional makeup kit with premium quality cosmetics for all skin types.",
        features: ["Professional grade", "All skin types", "Long lasting", "Travel friendly case"],
        inStock: true,
        sku: "MK-005"
      },
      {
        id: 7,
        name: "Homemade Gift Basket",
        image: "https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=870&q=80",
        badge: "",
        price: 89.99,
        originalPrice: null,
        rating: 4.2,
        ratingCount: 76,
        category: "homemade",
        brand: "artisan",
        description: "Beautiful handmade gift basket with artisanal products perfect for any occasion.",
        features: ["Handmade items", "Eco-friendly packaging", "Customizable contents", "Perfect for gifting"],
        inStock: true,
        sku: "HG-007"
      },
      {
        id: 8,
        name: "Gold Plated Jewelry Set",
        image: "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&w=870&q=80",
        badge: "Sale",
        price: 299.99,
        originalPrice: 349.99,
        rating: 4.8,
        ratingCount: 134,
        category: "jewelry",
        brand: "premium",
        description: "Elegant gold plated jewelry set including necklace, earrings, and bracelet.",
        features: ["Gold plated", "Hypoallergenic", "Elegant design", "Gift box included"],
        inStock: true,
        sku: "JS-008"
      },
      {
        id: 9,
        name: "Professional Makeup Brushes",
        image: "https://images.unsplash.com/photo-1556228578-8c89e6adf883?auto=format&fit=crop&w=870&q=80",
        badge: "New",
        price: 79.99,
        originalPrice: null,
        rating: 4.6,
        ratingCount: 98,
        category: "beauty",
        brand: "classic",
        description: "Complete set of professional makeup brushes for flawless application.",
        features: ["Professional quality", "Synthetic bristles", "Easy to clean", "Travel case included"],
        inStock: true,
        sku: "MB-009"
      }
    ];

    // Cart and favorites management
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    // Filter configuration
    const filters = {
      categories: ['beauty', 'homemade', 'stationery', 'jewelry', 'mens', 'womens', 'electronics'],
      maxPrice: 1000,
      ratings: [4, 5],
      brands: ['premium', 'artisan', 'classic', 'modern'],
      searchTerm: '',
      sortKey: 'default'
    };

    // Helper function to render star ratings
    function renderRatingStars(rating) {
      let stars = "";
      for (let i = 1; i <= 5; i++) {
        if (rating >= i) {
          stars += '<i class="bi bi-star-fill"></i>';
        } else if (rating >= i - 0.5) {
          stars += '<i class="bi bi-star-half"></i>';
        } else {
          stars += '<i class="bi bi-star"></i>';
        }
      }
      return stars;
    }

    // Function to show toast notifications
    function showToast(message, type = 'success') {
      const toastContainer = document.getElementById('toastContainer');
      const toastId = 'toast-' + Date.now();
      
      const toast = document.createElement('div');
      toast.className = 'toast';
      toast.id = toastId;
      toast.innerHTML = `
        <div class="toast-message">${message}</div>
        <button class="toast-close" onclick="document.getElementById('${toastId}').remove()">&times;</button>
      `;
      
      toastContainer.appendChild(toast);
      
      // Auto remove after 3 seconds
      setTimeout(() => {
        if (document.getElementById(toastId)) {
          document.getElementById(toastId).remove();
        }
      }, 3000);
    }

    // Function to attach event handlers to product elements
    function attachProductEvents() {
      // Add to cart buttons
      document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
          const productId = parseInt(this.getAttribute('data-id'));
          addToCart(productId);
        });
      });

      // View details buttons
      document.querySelectorAll('.view-details-btn').forEach(button => {
        button.addEventListener('click', function() {
          const productId = parseInt(this.getAttribute('data-id'));
          showProductDetails(productId);
        });
      });

      // Wishlist buttons
      document.querySelectorAll('.wishlist-btn').forEach(button => {
        button.addEventListener('click', function() {
          const productId = parseInt(this.getAttribute('data-id'));
          addToFavorites(productId);
        });
      });

      // Quick view buttons
      document.querySelectorAll('.quick-view-btn').forEach(button => {
        button.addEventListener('click', function() {
          const productId = parseInt(this.getAttribute('data-id'));
          quickView(productId);
        });
      });
    }

    // Function to render products dynamically
    function renderProducts(productsToRender = products) {
      const container = document.getElementById("products-container");
      if (!container) return;
      
      container.innerHTML = "";

      productsToRender.forEach(product => {
        const badgeHtml = product.badge ? 
          `<span class="product-badge" ${product.badge === 'New' ? 'style="background: var(--success);"' : ''}>${product.badge}</span>` : '';
        
        const originalPriceHtml = product.originalPrice ? 
          `<span class="original-price ms-2">₹${product.originalPrice}</span>` : '';

        container.innerHTML += `
          <div class="col-md-6 col-xl-4" data-category="${product.category}">
            <div class="product-card card h-100">
              <div class="product-img-container">
                ${badgeHtml}
                <div class="product-actions">
                  <button class="action-btn wishlist-btn" data-id="${product.id}" title="Add to Wishlist">
                    <i class="bi bi-heart"></i>
                  </button>
                  <button class="action-btn compare-btn" data-id="${product.id}" title="Compare">
                    <i class="bi bi-arrow-repeat"></i>
                  </button>
                  <button class="action-btn quick-view-btn" data-id="${product.id}" title="Quick View">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
                <img src="${product.image}" class="product-img" alt="${product.name}" onerror="this.src='https://via.placeholder.com/300x300?text=Product+Image'">
              </div>
              <div class="card-body">
                <h5 class="product-title">${product.name}</h5>
                <div class="product-rating">
                  ${renderRatingStars(product.rating)}
                  <span class="text-muted ms-1">(${product.ratingCount})</span>
                </div>
                <div class="mb-3">
                  <span class="product-price">₹${product.price}</span>
                  ${originalPriceHtml}
                </div>
                <div class="product-footer">
                <a href="product-detail.php?id=${product.id}" class="btn btn-link view-details-btn" data-id="${product.id}">
                  View Details
                </a>
                  <button class="add-to-cart-btn" 
                          data-id="${product.id}" 
                          data-name="${product.name}" 
                          data-price="${product.price}" 
                          data-image="${product.image}">
                    <i class="bi bi-cart-plus me-1"></i> Add to Cart
                  </button>
                </div>
              </div>
            </div>
          </div>
        `;
      });

      attachProductEvents();
      updateResultsCount(productsToRender.length);
    }

    // Function to show product details in modal
    function showProductDetails(productId) {
      const product = products.find(p => p.id == productId);
      if (!product) return;

      // Remove existing modal if any
      const existingModal = document.getElementById('productDetailsModal');
      if (existingModal) {
        existingModal.remove();
      }

      // Create modal HTML
      const modalHtml = `
        <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="productDetailsModalLabel">${product.name}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="${product.image}" class="img-fluid rounded" alt="${product.name}" onerror="this.src='https://via.placeholder.com/400x400?text=Product+Image'">
                    ${product.badge ? `<span class="badge bg-primary mt-2">${product.badge}</span>` : ''}
                  </div>
                  <div class="col-md-6">
                    <div class="product-rating mb-3">
                      ${renderRatingStars(product.rating)}
                      <span class="text-muted ms-1">(${product.ratingCount} reviews)</span>
                    </div>
                    
                    <div class="mb-3">
                      <span class="h4 text-primary">₹${product.price}</span>
                      ${product.originalPrice ? `<span class="text-decoration-line-through text-muted ms-2">₹${product.originalPrice}</span>` : ''}
                    </div>

                    <p class="text-muted mb-3">${product.description}</p>

                    <div class="mb-3">
                      <strong>SKU:</strong> ${product.sku}<br>
                      <strong>Category:</strong> ${product.category}<br>
                      <strong>Stock:</strong> <span class="text-success">${product.inStock ? 'In Stock' : 'Out of Stock'}</span>
                    </div>

                    <div class="mb-3">
                      <strong>Features:</strong>
                      <ul class="list-unstyled mt-2">
                        ${product.features.map(feature => `<li><i class="bi bi-check-circle text-success me-2"></i>${feature}</li>`).join('')}
                      </ul>
                    </div>

                    <div class="mb-3">
                      <label for="quantity" class="form-label">Quantity:</label>
                      <div class="input-group" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="decreaseQty">-</button>
                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" id="increaseQty">+</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addToCartModal" 
                        data-id="${product.id}" data-name="${product.name}" 
                        data-price="${product.price}" data-image="${product.image}">
                  <i class="bi bi-cart-plus me-1"></i> Add to Cart
                </button>
              </div>
            </div>
          </div>
        </div>
      `;

      // Add modal to body
      document.body.insertAdjacentHTML('beforeend', modalHtml);

      // Initialize Bootstrap modal
      const modal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
      modal.show();

      // Attach quantity controls
      const quantityInput = document.getElementById('quantity');
      document.getElementById('increaseQty').addEventListener('click', () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
      });
      
      document.getElementById('decreaseQty').addEventListener('click', () => {
        if (parseInt(quantityInput.value) > 1) {
          quantityInput.value = parseInt(quantityInput.value) - 1;
        }
      });

      // Attach add to cart from modal
      document.getElementById('addToCartModal').addEventListener('click', () => {
        const quantity = parseInt(quantityInput.value);
        addToCart(product.id, quantity);
        modal.hide();
      });
    }

    // Quick view function
    function quickView(productId) {
      const product = products.find(p => p.id == productId);
      if (!product) return;

      // Remove existing modal if any
      const existingModal = document.getElementById('quickViewModal');
      if (existingModal) {
        existingModal.remove();
      }

      // Create modal HTML
      const modalHtml = `
        <div class="modal fade" id="quickViewModal" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">${product.name}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="${product.image}" class="img-fluid rounded" alt="${product.name}" onerror="this.src='https://via.placeholder.com/400x400?text=Product+Image'">
                  </div>
                  <div class="col-md-6">
                    <div class="product-rating mb-3">
                      ${renderRatingStars(product.rating)}
                      <span class="text-muted ms-1">(${product.ratingCount} reviews)</span>
                    </div>
                    
                    <h4 class="text-primary">₹${product.price}</h4>
                    ${product.originalPrice ? `<p class="text-muted"><s>₹${product.originalPrice}</s></p>` : ''}
                    
                    <p class="text-muted mb-3">${product.description.substring(0, 150)}...</p>
                    
                    <button class="btn btn-primary w-100 add-to-cart-btn" data-id="${product.id}">
                      <i class="bi bi-cart-plus me-1"></i> Add to Cart
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 view-details-btn" data-id="${product.id}">
                      View Full Details
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;

      // Add modal to body
      document.body.insertAdjacentHTML('beforeend', modalHtml);

      // Initialize Bootstrap modal
      const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
      modal.show();

      // Attach event handlers
      document.querySelector('#quickViewModal .add-to-cart-btn').addEventListener('click', () => {
        addToCart(product.id);
        modal.hide();
      });

      document.querySelector('#quickViewModal .view-details-btn').addEventListener('click', () => {
        modal.hide();
        showProductDetails(product.id);
      });
    }

    // Add to cart function
    function addToCart(productId, quantity = 1) {
      const product = products.find(p => p.id === productId);
      const existingItem = cart.find(item => item.id === productId);
      
      if (existingItem) {
        existingItem.quantity += quantity;
      } else {
        cart.push({
          id: product.id,
          name: product.name,
          price: product.price,
          image: product.image,
          quantity: quantity
        });
      }
      
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartUI();
      showToast(`${product.name} added to cart!`);
    }

    // Update cart UI
    function updateCartUI() {
      const itemCount = cart.reduce((total, item) => total + item.quantity, 0);
      const totalPrice = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
      
      document.getElementById('header-cart-count').textContent = itemCount;
      document.getElementById('header-total').textContent = totalPrice.toFixed(2);
    }

    // Add to favorites function
    function addToFavorites(productId) {
      const product = products.find(p => p.id === productId);
      
      if (!favorites.find(f => f.id === productId)) {
        favorites.push(product);
        localStorage.setItem('favorites', JSON.stringify(favorites));
        updateFavoritesCount();
        showToast(`${product.name} added to favorites!`);
      } else {
        showToast(`${product.name} is already in your favorites!`);
      }
    }

    // Update favorites count
    function updateFavoritesCount() {
      document.getElementById('favCount').textContent = favorites.length;
    }

    // Update results count
    function updateResultsCount(count) {
      document.getElementById('showing-count').textContent = `1-${Math.min(count, 12)}`;
      document.getElementById('total-count').textContent = count;
    }

    // Apply filters function
    function applyFilters() {
      let filteredProducts = products;

      // Filter by categories if any selected
      if (filters.categories.length > 0) {
        filteredProducts = filteredProducts.filter(product => 
          filters.categories.includes(product.category)
        );
      }

      // Filter by maximum price
      filteredProducts = filteredProducts.filter(product => 
        product.price <= filters.maxPrice
      );

      // Filter by ratings if any selected
      if (filters.ratings.length > 0) {
        filteredProducts = filteredProducts.filter(product => 
          filters.ratings.some(rating => Math.floor(product.rating) === Number(rating))
        );
      }

      // Filter by brands if any selected
      if (filters.brands.length > 0) {
        filteredProducts = filteredProducts.filter(product => 
          filters.brands.includes(product.brand)
        );
      }

      // Filter by search term in product name (case-insensitive)
      if (filters.searchTerm.trim() !== '') {
        const searchTermLower = filters.searchTerm.toLowerCase();
        filteredProducts = filteredProducts.filter(product => 
          product.name.toLowerCase().includes(searchTermLower)
        );
      }

      // Sort the filtered products
      switch (filters.sortKey) {
        case 'price-low':
          filteredProducts.sort((a, b) => a.price - b.price);
          break;
        case 'price-high':
          filteredProducts.sort((a, b) => b.price - a.price);
          break;
        case 'rating':
          filteredProducts.sort((a, b) => b.rating - a.rating);
          break;
        case 'newest':
          filteredProducts.sort((a, b) => b.id - a.id);
          break;
        default:
          // Default sort, no sorting needed
          break;
      }

      // Render filtered and sorted products
      renderProducts(filteredProducts);
    }

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
      // Render products initially
      renderProducts();
      
      // Update cart and favorites count
      updateCartUI();
      updateFavoritesCount();

      // Event listeners for filters
      document.querySelectorAll('.category-filter-check').forEach(cb => {
        cb.addEventListener('change', () => {
          filters.categories = Array.from(document.querySelectorAll('.category-filter-check:checked')).map(cb => cb.value);
          applyFilters();
        });
      });

      document.querySelectorAll('.rating-filter').forEach(cb => {
        cb.addEventListener('change', () => {
          filters.ratings = Array.from(document.querySelectorAll('.rating-filter:checked')).map(cb => cb.value);
          applyFilters();
        });
      });

      document.querySelectorAll('.brand-filter').forEach(cb => {
        cb.addEventListener('change', () => {
          filters.brands = Array.from(document.querySelectorAll('.brand-filter:checked')).map(cb => cb.value);
          applyFilters();
        });
      });

      const priceRange = document.getElementById('priceRange');
      const priceRangeValue = document.getElementById('priceRangeValue');
      priceRange.addEventListener('input', e => {
        filters.maxPrice = parseInt(e.target.value, 10);
        priceRangeValue.textContent = '₹' + e.target.value;
        applyFilters();
      });

      const searchInput = document.getElementById('searchInput');
      searchInput.addEventListener('input', e => {
        filters.searchTerm = e.target.value;
        applyFilters();
      });

      const sortSelect = document.getElementById('sortSelect');
      sortSelect.addEventListener('change', e => {
        filters.sortKey = e.target.value;
        applyFilters();
      });

      const resetBtn = document.getElementById('resetFilters');
      resetBtn.addEventListener('click', () => {
        // Reset all filters to default
        filters.categories = ['beauty', 'homemade', 'stationery', 'jewelry', 'mens', 'womens', 'electronics'];
        filters.ratings = [4, 5];
        filters.brands = ['premium', 'artisan', 'classic', 'modern'];
        filters.maxPrice = 1000;
        filters.searchTerm = '';
        filters.sortKey = 'default';

        // Update UI elements
        document.querySelectorAll('.category-filter-check').forEach(cb => cb.checked = true);
        document.querySelectorAll('.rating-filter').forEach(cb => {
          cb.checked = (cb.value === '4' || cb.value === '5');
        });
        document.querySelectorAll('.brand-filter').forEach(cb => cb.checked = true);
        priceRange.value = filters.maxPrice;
        priceRangeValue.textContent = '₹' + filters.maxPrice;
        searchInput.value = '';
        sortSelect.value = 'default';

        applyFilters();
      });

      // Apply filters button
      document.getElementById('applyFilters').addEventListener('click', applyFilters);
    });
  </script>
</body>
</html>