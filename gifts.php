<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM products");
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
  <title>StyleHub | Gifts & Handmade Crafts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/gifts.css" />
  <style>
    /* Custom styles to match the image provided */
    .main-navbar {
        background-color: #c97d75; 
        padding: 10px 0;
    }
    .main-navbar .nav-link {
        color: white !important;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .main-navbar .nav-link:hover {
        opacity: 0.8;
    }
    .main-navbar .active-link-indicator {
        border-bottom: 2px solid #f2c94c; 
        padding-bottom: 2px;
    }
    .product-card img {
        transition: transform 0.3s ease;
    }
    .product-card:hover img {
        transform: scale(1.05);
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
      <ul class="nav justify-content-start">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="bi bi-house-door"></i> <span class="active-link-indicator">Home</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-gem"></i> Beauty & Jewelry
          </a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
              <li><a class="dropdown-item" href="beauty-products.php">Skincare</a></li>
              <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-heart"></i> Stationery & Gifts
          </a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="gifts.php">Handmade Crafts</a></li>
              <li><a class="dropdown-item" href="stationary.php">School Supplies</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-pencil"></i> Electronics
          </a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./electronics.php">Mobile Phones</a></li>
              <li><a class="dropdown-item" href="./electronics.php">Laptops</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person"></i> Fashion
          </a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="mens-wear.php">Men's Clothing</a></li>
              <li><a class="dropdown-item" href="women-wear.php">Women's Clothing</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-tag"></i> Deals
          </a>
        </li>
      </ul>
    </div>
</nav>

<main class="container-fluid py-4" role="main">
  <section class="row">
    <aside class="col-md-3" role="complementary">
      <div class="sidebar shadow-box p-4 mb-4">
        <h2 class="h4">Gift Categories</h2>
        <div class="filter-section">
          <div class="form-check">
            <input type="checkbox" class="form-check-input type-filter" id="type1" value="Handmade" onchange="filterProducts()"><label class="form-check-label" for="type1">Handmade Crafts</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input type-filter" id="type2" value="Personalized" onchange="filterProducts()"><label class="form-check-label" for="type2">Personalized</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input type-filter" id="type3" value="Decor" onchange="filterProducts()"><label class="form-check-label" for="type3">Home Decor</label>
          </div>
        </div>

        <h3 class="h5 mt-4 mb-3">Price Range</h3>
        <input id="priceRange" type="range" min="0" max="5000" value="5000" step="50" class="form-range" oninput="updatePrice(this.value)" />
        <div class="d-flex justify-content-between mb-3">
          <span>₹0</span>
          <span id="priceValue">₹5000</span>
        </div>

        <div class="filter-buttons">
          <button id="applyBtn" type="button" class="btn btn-primary w-100 mb-2">Apply Filters</button>
          <button id="resetBtn" type="button" class="btn btn-outline-secondary w-100">Reset</button>
        </div>
      </div>
    </aside>

    <section class="col-md-9">
      <div class="mb-3 d-flex justify-content-between align-items-center">
        <p id="resultCount" class="m-0">Showing 0 results</p>
        <select class="form-select d-inline w-auto" id="sortSelect" onchange="sortProducts(this.value)">
          <option value="best">Popularity</option>
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
    { id: 101, name: "Hand-Painted Ceramic Vase", price: 899.00, old_price: 1200.00, rating: 4.8, reviews: 45, tag: 'Sale', image: './ASSEST/img/vas.jpg', category: 'Handmade' },
    { id: 102, name: "Customized Wooden Photo Frame", price: 450.00, old_price: 0, rating: 4.5, reviews: 120, tag: 'Best Seller', image: 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&q=80&w=400', category: 'Personalized' },
    { id: 103, name: "Scented Soy Wax Candle Set", price: 599.00, old_price: 750.00, rating: 4.2, reviews: 30, tag: 'New', image: 'https://images.unsplash.com/photo-1603006905003-be475563bc59?auto=format&fit=crop&q=80&w=400', category: 'Decor' },
    { id: 105, name: "Engraved Leather Keychain", price: 299.00, old_price: 399.00, rating: 4.7, reviews: 88, tag: '', image: './ASSEST/img/keychain.jpg', category: 'Personalized' },
    { id: 106, name: "Artisanal Terracotta Planters", price: 650.00, old_price: 759.99, rating: 4.4, reviews: 52, tag:'Limited Offer', image:'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&q=80&w=400', category:'Decor'}
];

  let cart = JSON.parse(localStorage.getItem('stylehubCart')) || [];

  function generateRatingStars(rating) {
    let starsHTML = '';
    for(let i = 1; i <= 5; i++) {
        starsHTML += i <= Math.floor(rating) ? '<i class="bi bi-star-fill text-warning"></i>' : '<i class="bi bi-star text-warning"></i>';
    }
    return starsHTML;
  }

  function displayProducts(productList) {
    const container = document.getElementById('productContainer');
    if (!container) return;
    container.innerHTML = '';
    productList.forEach(p => {
      container.innerHTML += `
        <article class="col-12 col-sm-6 col-md-4">
          <div class="product-card shadow-sm position-relative border h-100 bg-white">
            <img src="${p.image}" class="card-img-top p-2" alt="${p.name}" style="height:250px; width:100%; object-fit:cover;">
            <div class="p-3">
              <p class="text-muted small mb-1">${p.category}</p>
              <h3 class="h6 fw-bold">${p.name}</h3>
              <div class="small mb-2">${generateRatingStars(p.rating)} (${p.reviews})</div>
              <div class="mb-3"><span class="fs-5 fw-bold text-primary">₹${p.price.toFixed(2)}</span></div>
              <div class="d-grid gap-2">
                <button class="btn btn-primary btn-sm py-2">Add to Cart</button>
                <button class="btn btn-outline-secondary btn-sm py-2"><i class="bi bi-heart"></i> Favorite</button>
              </div>
            </div>
          </div>
        </article>
      `;
    });
    document.getElementById('resultCount').textContent = `Showing ${productList.length} unique gifts`;
  }

  function updateCartUI() {
    const itemCount = cart.reduce((total, item) => total + item.quantity, 0);
    const totalPrice = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    const cartCountElem = document.getElementById('header-cart-count');
    const totalElem = document.getElementById('header-total');
    if(cartCountElem) cartCountElem.textContent = itemCount;
    if(totalElem) totalElem.textContent = totalPrice.toFixed(2);
  }

  document.addEventListener('DOMContentLoaded', () => {
    displayProducts(products);
    updateCartUI();
  });
</script>
</body>
</html>