<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetching only Mobile Phones category from database
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :cat");
    $stmt->execute(['cat' => 'Mobile Phones']);
    $products_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
  <title>StyleHub | Mobile Phones</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/electronics.css" />
  <style>
    /* --- ORANGE HEADER STYLING --- */
    .brand-logo {
        color: #f18c02 !important; /* Brand Orange */
    }
    
    .search-btn {
        background-color: #f18c02 !important;
        border: none;
        color: white;
    }

    .main-navbar {
        background-color: #f18c02 !important; /* Main Nav Orange */
        padding: 0 !important;
    }

    .main-navbar .nav-link {
        color: white !important;
        font-size: 1rem;
        font-weight: 500;
        padding: 15px 20px !important;
        transition: background 0.3s;
    }

    .main-navbar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .main-navbar .nav-link.active {
        background-color: rgba(0, 0, 0, 0.1);
        font-weight: 700;
    }

    /* Red Contact Button Style */
    .nav-contact-btn {
        background-color: #ff2a00 !important;
        color: white !important;
        border-radius: 50px;
        padding: 8px 25px !important;
        margin: 5px 0;
        font-weight: bold !important;
    }

    /* --- UPDATED COLORS FOR BUTTONS & SLIDERS (#d16d08f2) --- */
    
    /* Main Buttons (Apply Filters and Add to Cart) */
    .btn-primary, .apply-btn {
        background-color: #d16d08f2 !important;
        border-color: #d16d08f2 !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    .btn-primary:hover, .apply-btn:hover {
        background-color: #a35506 !important; /* Darker shade for hover effect */
        border-color: #a35506 !important;
        transform: translateY(-2px);
    }

    /* Price Range Slider Thumb */
    .form-range::-webkit-slider-thumb {
        background: #d16d08f2 !important;
    }
    .form-range::-moz-range-thumb {
        background: #d16d08f2 !important;
    }
    .form-range::-ms-thumb {
        background: #d16d08f2 !important;
    }

    /* Price Text Color */
    .product-price {
        color: #d16d08f2 !important;
    }

    /* --- SIDEBAR & CONTENT --- */
    .sidebar-card {
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        padding: 25px;
        background: white;
    }
    
    .sidebar-card h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .price-range-box {
        background-color: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
    }

    /* Clean Product Card Style */
    .clean-product-card {
        border: 1px solid #eee;
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
        background: #fff;
    }
    .clean-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
    
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<header class="main-header">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-6">
                <div class="d-flex align-items-center">
                    <span class="brand-icon" style="color: #f18c02;"><i class="bi bi-shop fs-3"></i></span>
                    <span class="brand-logo fw-bold fs-3 ms-2">StyleHub</span>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-5 d-none d-md-block">
                <form class="search-form" id="searchForm">
                    <div class="input-group">
                        <input class="form-control search-input rounded-start-pill px-4" type="search" id="searchInput" placeholder="Search for products..." aria-label="Search">
                        <button class="search-btn rounded-end-pill px-3" type="button" onclick="applyFilters()"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            
            <div class="col-lg-3 col-md-3 col-6">
                <div class="d-flex align-items-center justify-content-end header-actions">
                    <a href="#" class="action-icon me-3 position-relative text-dark"><i class="bi bi-arrow-repeat fs-4"></i></a>
                    <a href="#" class="action-icon me-3 position-relative text-dark" onclick="showFavorites()">
                        <i class="bi bi-heart fs-4"></i>
                        <span class="cart-badge badge rounded-pill position-absolute top-0 start-100 translate-middle bg-danger" id="favCount">0</span>
                    </a>
                    <a href="./cart.php" class="action-icon position-relative text-dark">
                        <i class="bi bi-cart3 fs-4"></i>
                        <span class="cart-badge badge rounded-pill position-absolute top-0 start-100 translate-middle bg-danger" id="header-cart-count">0</span>
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
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Beauty & Jewelry</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
                        <li><a class="dropdown-item" href="beauty-products.php">Skincare</a></li>
                        <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Stationery & Gifts</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="gifts.php">Handmade Crafts</a></li>
                        <li><a class="dropdown-item" href="stationary.php">School Supplies</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Electronics</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./electronics.php">Mobile Phones</a></li>
                        <li><a class="dropdown-item" href="./laptops.php">Laptops</a></li>
                        <li><a class="dropdown-item" href="./accessories.php">Accessories</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Fashion</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="mens-wear.php">Men's Clothing</a></li>
                        <li><a class="dropdown-item" href="women-wear.php">Women's Clothing</a></li>
                    </ul>
                </li>
            </ul>
            <a href="tel:+01234567890" class="nav-link nav-contact-btn d-none d-lg-block">+0123 456 7890</a>
        </div>
    </div>
</nav>

<main class="container-fluid py-4" role="main">
  <section class="row">
    <aside class="col-md-3">
      <div class="sidebar-card shadow-sm p-4">
        <h2 class="h4 mb-3">Filters</h2>
        <div class="filter-section mb-4">
          <h3 class="h6 fw-bold mb-3">Price Range</h3>
          <input id="priceRange" type="range" min="0" max="150000" value="150000" step="5000" class="form-range" oninput="updatePrice(this.value)" />
          <div class="d-flex justify-content-between mt-2" style="font-weight: 600; font-size: 0.95rem;">
            <span>₹0</span>
            <span id="priceValue">₹150,000</span>
          </div>
        </div>
        <button class="btn btn-primary w-100 apply-btn rounded-pill mb-2" onclick="applyFilters()">Apply Filters</button>
        <button class="btn btn-light border w-100 rounded-pill" onclick="location.reload()">Reset Filters</button>
      </div>
    </aside>
    
    <section class="col-md-9">
      <div class="mb-3 d-flex justify-content-between align-items-center">
        <p id="resultCount" class="m-0 text-muted">Showing results</p>
        <select class="form-select w-auto d-inline" id="sortSelect" onchange="sortProducts(this.value)">
          <option value="best">Best Match</option>
          <option value="lowToHigh">Price: Low to High</option>
          <option value="highToLow">Price: High to Low</option>
        </select>
      </div>
      <div class="row g-4" id="productContainer"></div>
    </section>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Updated IDs to 601, 602 to match the master array
  const products = [
    { id: 601, name: "iPhone 14 Pro", price: 80000, rating: 4.2, reviews: 70, image: 'https://i.pinimg.com/736x/f5/c1/66/f5c16671a90ff6094847c3a765d26147.jpg', brand: 'Apple', category: 'Mobile Phones' },
    { id: 602, name: "Samsung S23", price: 60000, rating: 5.0, reviews: 40, image: 'https://i.pinimg.com/736x/66/c2/3f/66c23f9566266ec63f39b2dac1a56585.jpg', brand: 'Samsung', category: 'Mobile Phones' }
  ];
  
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  function displayProducts(list) {
    const container = document.getElementById('productContainer');
    
    if (list.length === 0) {
      container.innerHTML = '<div class="col-12 text-center py-5"><h4>No products found matching your criteria.</h4></div>';
      document.getElementById('resultCount').textContent = `Showing 0 results`;
      return;
    }

    container.innerHTML = list.map(p => {
      const fullStars = Math.floor(p.rating);
      const halfStar = (p.rating % 1) >= 0.5;
      let starsHTML = '';
      for (let i = 1; i <= 5; i++) {
        if (i <= fullStars) starsHTML += '<i class="bi bi-star-fill text-warning"></i>';
        else if (i === fullStars + 1 && halfStar) starsHTML += '<i class="bi bi-star-half text-warning"></i>';
        else starsHTML += '<i class="bi bi-star text-warning"></i>';
      }

      return `
      <div class="col-12 col-sm-6 col-md-4">
        <div class="clean-product-card shadow-sm p-3 d-flex flex-column h-100 position-relative">
          
          <a href="product-details.php?id=${p.id}" class="text-decoration-none text-dark">
              <img src="${p.image}" class="img-fluid mb-3 rounded w-100" style="height: 200px; object-fit: cover;" alt="${p.name}">
              <h3 class="h6 fw-bold mb-1">${p.name}</h3>
          </a>
          
          <div class="mb-2">
            <span class="small">${starsHTML}</span>
            <span class="text-secondary ms-1" style="font-size: 0.8rem;">(${p.reviews} reviews)</span>
          </div>
          
          <div class="mb-3">
            <span class="product-price fw-bold fs-5">₹${p.price.toLocaleString()}</span>
          </div>
          
          <button class="btn btn-primary btn-sm w-100 rounded-pill mt-auto" onclick="addToCart(${p.id})">Add to Cart</button>
        </div>
      </div>
    `}).join('');
    
    document.getElementById('resultCount').textContent = `Showing ${list.length} products`;
  }

  function updatePrice(val) {
      document.getElementById('priceValue').innerText = '₹' + parseInt(val).toLocaleString();
  }

  function applyFilters() {
      const priceLimit = parseFloat(document.getElementById('priceRange').value);
      const keyword = document.getElementById('searchInput').value.toLowerCase();
      
      const filtered = products.filter(p => {
        const matchesPrice = p.price <= priceLimit;
        const matchesSearch = p.name.toLowerCase().includes(keyword);
        return matchesPrice && matchesSearch;
      });
      displayProducts(filtered);
  }
  
  function sortProducts(order) {
      let sorted = [...products];
      if (order === 'lowToHigh') sorted.sort((a, b) => a.price - b.price);
      if (order === 'highToLow') sorted.sort((a, b) => b.price - a.price);
      displayProducts(sorted);
  }

  function addToCart(id) {
    const product = products.find(i => i.id === id);
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) { 
      existingItem.quantity += 1; 
    } else { 
      cart.push({ ...product, quantity: 1 }); 
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI();
    alert(`${product.name} added to cart!`);
  }

  function updateCartUI() {
    const itemCount = cart.reduce((total, item) => total + (item.quantity || 1), 0);
    const totalPrice = cart.reduce((total, item) => total + (item.price * (item.quantity || 1)), 0);
    document.getElementById('header-cart-count').textContent = itemCount;
    document.getElementById('header-total').textContent = totalPrice.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
  }

  document.addEventListener('DOMContentLoaded', () => {
    displayProducts(products);
    updateCartUI();
    
    // Search on enter key
    document.getElementById('searchForm').addEventListener('submit', function(e) {
      e.preventDefault();
      applyFilters();
    });
  });
</script>
</body>
</html>