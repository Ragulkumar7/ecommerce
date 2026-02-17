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
    /* Custom Styling to match your screenshot */
    .main-navbar {
        background-color: #cd7d73 !important; /* The reddish-clay color from your image */
        padding: 10px 0;
    }
    .main-navbar .nav-link {
        color: white !important;
        font-weight: 500;
        display: flex;
        align-items: center;
        border-bottom: 3px solid transparent;
        padding-bottom: 5px;
    }
    .main-navbar .nav-link:hover {
        color: #f8f9fa !important;
    }
    .main-navbar .nav-link.active {
        border-bottom: 3px solid #ffcc66; /* The yellow active indicator from your image */
    }
    .main-navbar .nav-link i {
        margin-right: 8px;
        font-size: 1.1rem;
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
            <span class="brand-icon"><i class="bi bi-shop"></i></span>
            <span class="brand-logo">StyleHub</span>
          </div>
        </div>
        <div class="col-lg-6 col-md-5 d-none d-md-block">
          <form class="search-form" id="searchForm">
            <input class="form-control search-input" type="search" placeholder="Search for mobile phones..." aria-label="Search" id="searchInput">
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

  <nav class="main-navbar">
    <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="index.php"><i class="bi bi-house"></i> Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-gem"></i> Beauty & Jewelry
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
              <li><a class="dropdown-item" href="skincare.php">Skincare</a></li>
              <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-heart"></i> Stationery & Gifts
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="gifts.php">Handmade Crafts</a></li>
              <li><a class="dropdown-item" href="stationary.php">School Supplies</a></li>
              <li><a class="dropdown-item" href="stationary.php">College Supplies</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-pencil"></i> Electronics
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./electronics.php">Mobile Phones</a></li>
              <li><a class="dropdown-item" href="./laptops.php">Laptops</a></li>
              <li><a class="dropdown-item" href="./accessories.php">Accessories</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-person"></i> Fashion
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="mens-wear.php">Men's Clothing</a></li>
              <li><a class="dropdown-item" href="women-wear.php">Women's Clothing</a></li>
              <li><a class="dropdown-item" href="kids-wear.php">Kids' Clothing</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-tag"></i> Deals</a>
          </li>
        </ul>
    </div>
  </nav>

  <main class="container-fluid py-4" role="main">
    <section class="row">
      <aside class="col-md-3">
        <div class="sidebar shadow-box p-3">
          <h2 class="h4 mb-3">Filters</h2>
          <div class="filter-section mb-4">
            <h3 class="h5">Price Range</h3>
            <input id="priceRange" type="range" min="0" max="150000" value="150000" step="5000" class="form-range" oninput="updatePrice(this.value)" />
            <div class="d-flex justify-content-between">
              <span>₹0</span>
              <span id="priceValue">₹150,000</span>
            </div>
          </div>
          <button class="btn btn-primary w-100" onclick="applyFilters()">Apply Filters</button>
        </div>
      </aside>
      
      <section class="col-md-9">
        <div class="mb-3 d-flex justify-content-between align-items-center">
          <p id="resultCount" class="m-0">Showing results</p>
          <select class="form-select w-auto" id="sortSelect" onchange="sortProducts(this.value)">
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
    const products = [
      { id: 5, name: "iPhone 14 Pro", price: 80000, rating: 4.2, reviews: 70, image: 'https://i.pinimg.com/736x/f5/c1/66/f5c16671a90ff6094847c3a765d26147.jpg', brand: 'Apple' },
      { id: 6, name: "Samsung S23", price: 60000, rating: 5, reviews: 40, image: 'https://i.pinimg.com/736x/66/c2/3f/66c23f9566266ec63f39b2dac1a56585.jpg', brand: 'Samsung' }
    ];
    
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function displayProducts(list) {
      const container = document.getElementById('productContainer');
      container.innerHTML = list.map(p => `
        <div class="col-12 col-sm-6 col-md-4">
          <div class="product-card shadow-sm p-3 border rounded">
            <img src="${p.image}" class="img-fluid mb-3 rounded" style="height: 200px; width: 100%; object-fit: cover;">
            <h3 class="h6 fw-bold">${p.name}</h3>
            <p class="text-primary fw-bold">₹${p.price.toLocaleString()}</p>
            <button class="btn btn-primary btn-sm w-100" onclick="addToCart(${p.id})">Add to Cart</button>
          </div>
        </div>
      `).join('');
      document.getElementById('resultCount').textContent = `Showing ${list.length} results`;
    }

    function updatePrice(val) {
        document.getElementById('priceValue').innerText = '₹' + parseInt(val).toLocaleString();
    }

    function addToCart(id) {
      const p = products.find(i => i.id === id);
      cart.push(p);
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartUI();
    }

    function updateCartUI() {
      document.getElementById('header-cart-count').textContent = cart.length;
      const total = cart.reduce((sum, p) => sum + p.price, 0);
      document.getElementById('header-total').textContent = total.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', () => {
      displayProducts(products);
      updateCartUI();
    });
  </script>
</body>
</html>