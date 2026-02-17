<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetching only Accessories for Laptops and Mobiles
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :cat");
    $stmt->execute(['cat' => 'Accessories']);
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
  <title>StyleHub | Accessories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/electronics.css" />
  <style>
    /* Styling for the clay-red navbar */
    .main-navbar {
        background-color: #cd7d73 !important;
        padding: 10px 0;
    }
    .main-navbar .nav-link {
        color: white !important;
        font-weight: 500;
        border-bottom: 3px solid transparent;
    }
    .main-navbar .nav-link.active {
        border-bottom: 3px solid #ffcc66;
    }
    
    /* Rounded Sidebar Styling */
    .sidebar-card {
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        padding: 25px;
        background: white;
    }
    .price-range-box {
        background-color: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
    }

    /* --- UPDATED BUTTONS WITH COLOR #d16d08f2 --- */
    .apply-btn, .btn-primary {
        background-color: #d16d08f2 !important; /* Burnt Orange */
        border-color: #d16d08f2 !important;
        color: white !important;
        border: none;
        border-radius: 12px;
        padding: 12px;
        width: 100%;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .apply-btn:hover, .btn-primary:hover {
        background-color: #a35506 !important; /* Slightly darker on hover */
        border-color: #a35506 !important;
        transform: translateY(-2px);
    }

    /* Updated Slider Color */
    .form-range::-webkit-slider-thumb {
        background: #d16d08f2 !important;
    }

    .product-card {
        border: 1px solid #eee;
        border-radius: 15px;
        transition: transform 0.3s;
        background: #fff;
    }
    .product-card:hover {
        transform: translateY(-5px);
    }
  </style>
</head>
<body>

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
                    <input class="form-control search-input" type="search" id="searchInput" placeholder="Search for products..." aria-label="Search">
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
                    <a href="./cart.php" class="action-icon position-relative">
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
                        <li><a class="dropdown-item" href="./laptops.php">Laptops</a></li>
                        <li><a class="dropdown-item" href="./accessories.php">Accessories</a></li>
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

<main class="container py-5">
  <div class="row">
    <aside class="col-lg-4 col-xl-3 mb-4">
        <div class="sidebar-card shadow-sm">
            <h2 class="h4 fw-bold mb-3">Filters</h2>
            <div class="price-range-box">
                <h3 class="h6 fw-bold mb-3">Price Range</h3>
                <input type="range" class="form-range" id="priceRange" min="0" max="20000" value="20000" step="500" oninput="updatePriceLabel(this.value)">
                <div class="d-flex justify-content-between mt-2 small">
                    <span>₹0</span>
                    <span id="priceValue">₹20,000</span>
                </div>
            </div>
            
            <button class="apply-btn" onclick="applyFilters()">Apply Filters</button>
        </div>
    </aside>

    <section class="col-lg-8 col-xl-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 m-0 fw-bold">Essential Tech Accessories</h1>
            <p class="m-0 text-muted small" id="resultCount">Showing results...</p>
        </div>
        <div class="row g-4" id="accessoryContainer">
            </div>
    </section>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  let cart = JSON.parse(localStorage.getItem('stylehubCart')) || [];
  
  // Mixed Accessories Data
  const accessories = [
{ id: 301, name: "Wireless Gaming Mouse", price: 2500, category: "Accessories", reviews: 45, rating: 4.5, brand: "Logitech", image: "https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500", desc: "High-speed wireless mouse with customizable DPI and RGB lighting." },
    { id: 302, name: "Fast Charging Type-C Cable", price: 499, category: "Accessories", reviews: 112, rating: 4.2, brand: "Samsung", image: "https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=500", desc: "Durable braided cable for ultra-fast charging and data sync." },
    { id: 303, name: "Laptop Cooling Pad", price: 1800, category: "Accessories", reviews: 89, rating: 4.0, brand: "Zeb", image: "https://images.unsplash.com/photo-1587202395103-53d748273615?w=500", desc: "Dual fan system to keep your laptop cool during intensive gaming." },
    { id: 304, name: "Bluetooth Selfie Stick", price: 850, category: "Accessories", reviews: 56, rating: 4.1, brand: "Generic", image: "https://images.unsplash.com/photo-1574944985070-8f3ebc6b79d2?w=500", desc: "Extendable selfie stick with integrated Bluetooth shutter and tripod base." },
    { id: 305, name: "65W Laptop Power Adapter", price: 3200, category: "Accessories", reviews: 23, rating: 4.7, brand: "Dell", image: "https://images.unsplash.com/photo-1585338107529-13afc5f02586?w=500", desc: "Compact and efficient 65W power brick compatible with most modern USB-C laptops." },
  ];

  function displayProducts(list) {
    const container = document.getElementById('accessoryContainer');
    container.innerHTML = list.map(p => `
        <div class="col-md-6 col-xl-4">
            <div class="product-card p-3 h-100 shadow-sm">
                <a href="product-details.php?id=${p.id}" class="text-decoration-none text-dark">
                    <img src="${p.image}" class="img-fluid rounded mb-3" style="height:160px; width:100%; object-fit:cover;">
                    <h5 class="h6 fw-bold mb-1">${p.name}</h5>
                </a>
                <p class="text-primary fw-bold mb-3" style="color: #d16d08f2 !important;">₹${p.price.toLocaleString()}</p>
                <button class="btn btn-primary btn-sm w-100 rounded-pill" onclick="addToCart(${p.id})">Add to Cart</button>
            </div>
        </div>
    `).join('');
    document.getElementById('resultCount').textContent = `Showing ${list.length} results`;
  }

  function updatePriceLabel(val) {
    document.getElementById('priceValue').innerText = '₹' + parseInt(val).toLocaleString();
  }

  function applyFilters() {
    const priceLimit = document.getElementById('priceRange').value;
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    const filtered = accessories.filter(p => {
        const matchesPrice = p.price <= priceLimit;
        const matchesSearch = p.name.toLowerCase().includes(searchTerm);
        return matchesPrice && matchesSearch;
    });
    displayProducts(filtered);
  }

  function addToCart(id) {
    const product = accessories.find(p => p.id === id);
    cart.push(product);
    localStorage.setItem('stylehubCart', JSON.stringify(cart));
    updateCartUI();
  }

  function updateCartUI() {
    const count = cart.length;
    document.getElementById('header-cart-count').textContent = count;
    const total = cart.reduce((sum, p) => sum + p.price, 0);
    document.getElementById('header-total').textContent = total.toLocaleString();
  }

  document.addEventListener('DOMContentLoaded', () => {
    displayProducts(accessories);
    updateCartUI();
  });
</script>
</body>
</html>