<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetching only Laptop products from the database
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :cat");
    $stmt->execute(['cat' => 'Laptops']);
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
  <title>StyleHub | Laptops</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/electronics.css" />
  <style>
    /* Updated terracotta/clay-red navbar styling based on screenshot */
    .main-navbar {
        background-color: #cd7d73 !important;
        padding: 0;
    }

    .main-navbar .nav-link {
        color: white !important;
        font-size: 1.1rem;
        font-weight: 500;
        padding: 15px 20px !important;
        margin-right: 10px;
        position: relative;
        transition: all 0.3s ease;
    }

    /* The yellow underline for the active link from screenshot */
    .main-navbar .nav-link.active::after {
        content: "";
        position: absolute;
        bottom: 8px;
        left: 20%;
        width: 60%;
        height: 3px;
        background-color: #ffcc66;
    }

    .main-navbar .nav-link:hover {
        opacity: 0.9;
        color: #f8f9fa !important;
    }

    .main-navbar .nav-link i {
        margin-right: 8px;
    }

    /* Sidebar Styling */
    .sidebar-card {
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        padding: 25px;
        background: white;
        max-width: 350px;
    }
    .sidebar-card h2 {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 20px;
    }
    .price-range-box {
        background-color: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .price-range-box h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 25px;
    }
    .apply-btn {
        background-color: #0d6efd;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px;
        width: 100%;
        font-size: 1.2rem;
        font-weight: 500;
    }

    .product-card {
        border: 1px solid #eee;
        border-radius: 15px;
        transition: transform 0.3s;
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

<main class="container py-5">
  <div class="row">
    <aside class="col-lg-4 col-xl-3 mb-4">
        <div class="sidebar-card shadow-sm">
            <h2>Filters</h2>
            <div class="price-range-box">
                <h3>Price Range</h3>
                <input type="range" class="form-range" id="priceRange" min="0" max="150000" value="150000" step="5000" oninput="updatePriceLabel(this.value)">
                <div class="d-flex justify-content-between mt-3 fw-medium">
                    <span>₹0</span>
                    <span id="priceValue">₹150,000</span>
                </div>
            </div>
            <button class="apply-btn" onclick="applyFilters()">Apply Filters</button>
        </div>
    </aside>

    <section class="col-lg-8 col-xl-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="m-0 text-muted" id="resultCount">Showing laptops...</p>
            <select class="form-select w-auto" id="sortSelect" onchange="sortProducts(this.value)">
                <option value="default">Best Match</option>
                <option value="lowToHigh">Price: Low to High</option>
                <option value="highToLow">Price: High to Low</option>
            </select>
        </div>
        <div class="row g-4" id="laptopContainer">
            </div>
    </section>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  let cart = JSON.parse(localStorage.getItem('stylehubCart')) || [];
  
  const laptops = [
    { id: 101, name: "Premium Business Laptop", price: 85000, image: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500", brand: "BrandX" },
    { id: 102, name: "Ultra Gaming Pro", price: 125000, image: "https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500", brand: "BrandY" },
    { id: 103, name: "Student Slim Note", price: 45000, image: "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500", brand: "BrandZ" }
  ];

  function displayProducts(list) {
    const container = document.getElementById('laptopContainer');
    container.innerHTML = list.map(p => `
        <div class="col-md-6 col-xl-4">
            <div class="product-card p-3 h-100 bg-white shadow-sm">
                <img src="${p.image}" class="img-fluid rounded mb-3" style="height:180px; width:100%; object-fit:cover;">
                <h5 class="h6 fw-bold">${p.name}</h5>
                <p class="text-primary fw-bold fs-5">₹${p.price.toLocaleString()}</p>
                <button class="btn btn-outline-primary btn-sm w-100" onclick="addToCart(${p.id})">Add to Cart</button>
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
    const filtered = laptops.filter(p => p.price <= priceLimit && p.name.toLowerCase().includes(searchTerm));
    displayProducts(filtered);
  }

  function sortProducts(order) {
    let sorted = [...laptops];
    if (order === 'lowToHigh') sorted.sort((a, b) => a.price - b.price);
    if (order === 'highToLow') sorted.sort((a, b) => b.price - a.price);
    displayProducts(sorted);
  }

  function addToCart(id) {
    const product = laptops.find(p => p.id === id);
    cart.push(product);
    localStorage.setItem('stylehubCart', JSON.stringify(cart));
    updateCartUI();
  }

  function updateCartUI() {
    const cartCountElement = document.getElementById('header-cart-count');
    const totalElement = document.getElementById('header-total');
    if(cartCountElement) cartCountElement.textContent = cart.length;
    const total = cart.reduce((sum, p) => sum + p.price, 0);
    if(totalElement) totalElement.textContent = total.toLocaleString();
  }

  document.addEventListener('DOMContentLoaded', () => {
    displayProducts(laptops);
    updateCartUI();
  });
</script>
</body>
</html>