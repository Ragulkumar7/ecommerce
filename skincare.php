<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetching only Skincare products
    $stmt = $pdo->query("SELECT * FROM products WHERE category = 'Skincare'");
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
  <title>StyleHub | Skincare Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/beauty-products.css" />
  <style>
    /* Navbar Theme */
    .main-navbar { background-color: #cd7d73 !important; }
    
    /* --- UPDATED COLORS FOR BUTTONS & SLIDERS (#d16d08f2) --- */
    
    /* Apply and Add to Cart Buttons */
    #applyBtn, .btn-primary, .btn-sm {
        background-color: #d16d08f2 !important;
        border-color: #d16d08f2 !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    #applyBtn:hover, .btn-primary:hover {
        background-color: #a35506 !important; /* Slightly darker hover */
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

    /* Reset Button */
    #resetBtn {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px 15px;
        background: white;
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
              <li><a class="dropdown-item" href="skincare.php">Skincare</a></li>
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

<main class="container-fluid py-4" role="main">
  <section class="row">
    <aside class="col-md-3">
      <div class="sidebar shadow-box p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 20px; background: white;">
        <h2 class="h4 mb-4">Filters</h2>
        <section class="filter-section mb-4">
          <h3 class="h5"><i class="bi bi-currency-rupee me-2"></i>Price Range</h3>
          <input id="priceRange" type="range" min="0" max="2000" value="2000" step="10" class="form-range" />
          <div class="d-flex justify-content-between mt-2">
            <span>₹0</span>
            <span id="priceValue">₹2000</span>
          </div>
        </section>
        <section class="filter-section mb-4">
          <h3 class="h5">Category</h3>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="skincare" value="Skincare" checked />
            <label class="form-check-label" for="skincare">Skincare</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="haircare" value="Haircare" />
            <label class="form-check-label" for="haircare">Haircare</label>
          </div>
        </section>
        <div class="filter-buttons">
          <button id="applyBtn" type="button" class="btn w-100 mb-2">Apply Filters</button>
          <button id="resetBtn" type="button" class="btn w-100">Reset Filters</button>
        </div>
      </div>
    </aside>
    <section class="col-md-9">
      <div class="mb-3 d-flex justify-content-between align-items-center">
        <p id="resultCount" class="m-0"></p>
        <select class="form-select d-inline w-auto" id="sortSelect">
          <option value="default">Sort by</option>
          <option value="lowToHigh">Price - Low to High</option>
          <option value="highToLow">Price - High to Low</option>
        </select>
      </div>
      <div class="row g-4" id="productContainer"></div>
    </section>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  
  let products = [
    // --- SKINCARE (400s) ---
    { id: 401, name: "Hydrating Moisturizer", price: 1200, category: "Skincare", rating: 4.9, reviews: 450, image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&q=80", desc: "Deep hydration formula perfect for dry skin types." },
    { id: 402, name: "Vitamin C Serum", price: 1500, category: "Skincare", rating: 4.7, reviews: 312, image: "./assest/img/serum.jpg", desc: "Brightening serum for a glowing and even complexion." },
    { id: 403, name: "Gentle Cleanser", price: 800, category: "Skincare", rating: 4.5, reviews: 180, image: "https://images.unsplash.com/photo-1556228720-195a672e8a03?w=400&q=80", desc: "Daily facial cleanser that doesn't strip skin of its natural oils." }
  ];

  let filterState = {
    keyword: "",
    priceLimit: 2000,
    categories: ["Skincare"], 
    minRating: 0
  };

  document.addEventListener('DOMContentLoaded', function() {
    displayProducts(products); 
    updateCartUI();
    updateFavoritesCount();

    document.getElementById("priceRange").addEventListener("input", function(e) {
      document.getElementById("priceValue").textContent = `₹${e.target.value}`;
      filterState.priceLimit = parseInt(e.target.value);
      filterProducts();
    });

    document.getElementById("applyBtn").addEventListener("click", filterProducts);
    document.getElementById("sortSelect").addEventListener("change", function() {
      sortProducts(this.value);
    });

    const searchForm = document.getElementById('searchForm');
    if(searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            filterState.keyword = document.getElementById('searchInput').value.toLowerCase();
            filterProducts();
        });
    }
  });

  function displayProducts(productsToDisplay) {
    const container = document.getElementById("productContainer");
    container.innerHTML = "";
    if(productsToDisplay.length === 0) {
      container.innerHTML = '<div class="col-12 text-center py-5"><h3>No products found</h3></div>';
      return;
    }
    productsToDisplay.forEach(p => {
      container.innerHTML += `
        <article class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="product-card p-3 shadow-sm h-100">
            <img src="${p.image}" alt="${p.name}" class="product-img mb-3 rounded" style="object-fit: cover; height: 200px; width: 100%;" />
            <h3 class="h6 fw-bold">${p.name}</h3>
            <p class="text-primary fw-bold" style="color: #d16d08f2 !important;">₹${p.price}</p>
            <button class="btn btn-primary btn-sm w-100" onclick="addToCart(${p.id})">Add to Cart</button>
          </div>
        </article>`;
    });
    document.getElementById("resultCount").textContent = `Showing ${productsToDisplay.length} products`;
  }

  function filterProducts() {
    const filtered = products.filter(p => {
      const matchesSearch = p.name.toLowerCase().includes(filterState.keyword);
      const matchesPrice = p.price <= filterState.priceLimit;
      const matchesCategory = filterState.categories.length === 0 || filterState.categories.includes(p.category);
      return matchesSearch && matchesPrice && matchesCategory;
    });
    displayProducts(filtered);
  }

  function sortProducts(sortBy) {
      if(sortBy === 'lowToHigh') products.sort((a, b) => a.price - b.price);
      else if(sortBy === 'highToLow') products.sort((a, b) => b.price - a.price);
      filterProducts();
  }

  function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    cart.push(product);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI();
  }

  function updateCartUI() {
    const itemCount = cart.length;
    const totalPrice = cart.reduce((total, item) => total + item.price, 0);
    document.getElementById('header-cart-count').textContent = itemCount;
    document.getElementById('header-total').textContent = totalPrice.toFixed(2);
  }

  function updateFavoritesCount() {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const countEl = document.getElementById('favCount');
    if(countEl) countEl.textContent = favorites.length;
  }
</script>
</body>
</html>