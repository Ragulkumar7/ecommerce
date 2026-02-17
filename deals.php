<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetching all products to filter for deals
    $stmt = $pdo->query("SELECT * FROM products");
    $all_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>StyleHub | Best Deals & Offers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <style>
    /* --- THEME COLORS UPDATED --- */
    :root {
        --primary: #d16d08f2; /* Your Requested Color */
        --primary-dark: #b35900;
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
    }

    /* Header Styles */
    .main-header {
        background: #fff;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 0;
        z-index: 1030;
    }
    .brand-logo { font-weight: 800; color: var(--dark); font-size: 1.8rem; }
    .brand-icon {
        background: var(--primary);
        color: white;
        width: 40px; height: 40px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 10px; margin-right: 10px;
    }
    .search-input { border-radius: 50px; height: 46px; }
    .search-btn {
        position: absolute; right: 5px; top: 5px; height: 36px; width: 36px;
        border-radius: 50%; background: var(--primary); color: white; border: none;
    }
    .cart-badge {
        position: absolute; top: -8px; right: -8px;
        background: var(--secondary); color: white;
        font-size: 0.7rem; width: 18px; height: 18px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
    }

    /* Navigation - UPDATED COLOR */
    .main-navbar {
        background: var(--primary) !important; /* Applied #d16d08f2 here */
        padding: 0.5rem 0;
    }
    .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        padding: 0.7rem 1.2rem !important;
        position: relative;
    }
    .nav-link:hover, .nav-link.active { color: white !important; }
    .nav-link.active:after {
        content: ''; position: absolute; bottom: 0; left: 15%;
        width: 70%; height: 3px; background: var(--accent); border-radius: 3px;
    }

    /* Hero Banner */
    .hero-banner {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1498049794561-7780e7231661?w=1770&q=80') center center/cover no-repeat;
        min-height: 300px;
        display: flex; align-items: center; justify-content: center;
    }

    /* Sidebar & Product Cards */
    .filter-sidebar {
        background: white; border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05); padding: 1.5rem;
    }
    .filter-title { font-weight: 700; border-bottom: 2px solid var(--light-gray); margin-bottom: 1rem; }
    
    .product-card {
        transition: all 0.3s ease; border: none; border-radius: 12px;
        overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
    .product-img-container {
        position: relative; height: 200px; background: #f9f9f9;
        display: flex; align-items: center; justify-content: center;
    }
    .product-img { max-height: 100%; object-fit: contain; }
    .product-badge {
        position: absolute; top: 10px; left: 10px;
        background: var(--secondary); color: white;
        font-size: 0.75rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 50px;
    }
    .product-price { font-weight: 700; color: var(--primary); font-size: 1.2rem; }
    .original-price { color: var(--gray); text-decoration: line-through; font-size: 0.85rem; }
    
    .add-to-cart-btn {
        background: var(--primary); color: white; border: none;
        border-radius: 50px; padding: 0.5rem 1rem; width: 100%; transition: 0.3s;
    }
    .add-to-cart-btn:hover { background: var(--primary-dark); transform: translateY(-2px); }
  </style>
</head>
<body>

<header class="main-header">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-6">
                <div class="d-flex align-items-center text-decoration-none">
                    <span class="brand-icon"><i class="bi bi-shop"></i></span>
                    <span class="brand-logo">StyleHub</span>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="search-form">
                    <input class="form-control search-input" type="search" id="searchInput" placeholder="Search for deals...">
                    <button class="search-btn"><i class="bi bi-search"></i></button>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 text-end">
                <a href="#" class="action-icon me-3 position-relative text-dark"><i class="bi bi-heart fs-4"></i><span class="cart-badge">0</span></a>
                <a href="./cart.php" class="action-icon position-relative text-dark"><i class="bi bi-cart3 fs-4"></i><span class="cart-badge" id="header-cart-count">0</span></a>
            </div>
        </div>
    </div>
</header>

<nav class="main-navbar">
    <div class="container">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house me-1"></i> Home</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-gem me-1"></i> Beauty & Jewelry</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="beauty.php">Makeup</a></li>
                    <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-heart me-1"></i> Stationery & Gifts</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-pencil me-1"></i> Electronics</a>
            </li>
            <li class="nav-item"><a class="nav-link active" href="deals.php"><i class="bi bi-tag me-1"></i> Deals</a></li>
        </ul>
    </div>
</nav>

<section class="hero-banner">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold">Flash Sale & Hot Deals</h1>
        <p class="lead">Grab your favorites before they're gone!</p>
    </div>
</section>

<main class="container py-5">
  <div class="row">
    <aside class="col-lg-3 mb-4">
      <div class="filter-sidebar">
        <h5 class="filter-title">Filter by Budget</h5>
        <input type="range" class="form-range" id="priceRange" min="0" max="100000" value="100000" step="1000">
        <div class="d-flex justify-content-between mt-2">
            <span class="small">₹0</span>
            <span id="priceValue" class="fw-bold text-primary">₹1,00,000</span>
        </div>
        <button class="add-to-cart-btn mt-4" id="applyBtn">Apply Filters</button>
      </div>
    </aside>

    <section class="col-lg-9">
      <div class="d-flex justify-content-between align-items-center mb-4 px-2">
          <span id="resultCount" class="text-muted small"></span>
          <select class="form-select w-auto" id="sortSelect">
              <option value="discount">Biggest Discount</option>
              <option value="lowToHigh">Price: Low to High</option>
          </select>
      </div>
      <div class="row g-4" id="productContainer"></div>
    </section>
  </div>
</main>

<script>
  const products = [
    { id: 1, name: "Gaming Laptop Pro", price: 65000, old_price: 85000, category: "Electronics", image: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500" },
    { id: 2, name: "Premium Face Serum", price: 800, old_price: 1500, category: "Beauty", image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=500" },
    { id: 3, name: "Wireless Headphones", price: 2500, old_price: 5000, category: "Accessories", image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500" },
    { id: 4, name: "Gold Plated Bangle", price: 12000, old_price: 18000, category: "Jewelry", image: "./ASSEST/img/Gold.jpg" }
  ];

  function displayProducts(list) {
    const container = document.getElementById('productContainer');
    container.innerHTML = list.map(p => {
        const discount = Math.round(((p.old_price - p.price) / p.old_price) * 100);
        return `
        <div class="col-md-6 col-xl-4">
          <div class="product-card h-100 bg-white">
            <div class="product-img-container">
                <span class="product-badge">-${discount}% OFF</span>
                <img src="${p.image}" class="product-img">
            </div>
            <div class="p-3">
                <p class="small text-muted mb-1">${p.category}</p>
                <h5 class="h6 fw-bold text-truncate">${p.name}</h5>
                <div class="d-flex align-items-center mb-3">
                    <span class="product-price">₹${p.price.toLocaleString()}</span>
                    <span class="original-price ms-2">₹${p.old_price.toLocaleString()}</span>
                </div>
                <button class="add-to-cart-btn" onclick="addToCart(${p.id})">Grab Deal</button>
            </div>
          </div>
        </div>
    `}).join('');
    document.getElementById('resultCount').textContent = `Showing ${list.length} deals`;
  }

  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  function updateHeaderCart() {
      document.getElementById('header-cart-count').textContent = cart.length;
  }

  document.getElementById('priceRange').addEventListener('input', function() {
      document.getElementById('priceValue').textContent = '₹' + parseInt(this.value).toLocaleString();
  });

  document.getElementById('applyBtn').addEventListener('click', () => {
      const limit = document.getElementById('priceRange').value;
      const filtered = products.filter(p => p.price <= limit);
      displayProducts(filtered);
  });

  function addToCart(id) {
      const p = products.find(i => i.id === id);
      cart.push(p);
      localStorage.setItem('cart', JSON.stringify(cart));
      updateHeaderCart();
      alert(p.name + " added to your deals cart!");
  }

  window.onload = () => {
      displayProducts(products);
      updateHeaderCart();
  };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>