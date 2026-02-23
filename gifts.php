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
    /* Styling for the clay-red navbar */
    .main-navbar { background-color: #6F4AA2 !important; padding: 10px 0; }
    .main-navbar .nav-link { color: white !important; font-weight: 500; border-bottom: 3px solid transparent; }
    .main-navbar .nav-link.active { border-bottom: 3px solid #ffcc66; }

    /* --- UPDATED COLORS FOR BUTTONS & SLIDERS (#6F4AA2) --- */
    
    /* Main Buttons (Apply Filters, Add to Cart) */
    #applyBtn, .btn-primary {
        background-color: #6F4AA2 !important;
        border-color: #6F4AA2 !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    #applyBtn:hover, .btn-primary:hover {
        background-color: #5a3a80 !important; 
        border-color: #5a3a80 !important;
        transform: translateY(-2px);
    }

    /* Range Slider Thumb Color */
    .form-range::-webkit-slider-thumb {
        background: #6F4AA2 !important;
    }
    .form-range::-moz-range-thumb {
        background: #6F4AA2 !important;
    }

    /* Price Text Color */
    .product-price {
        color: #6F4AA2 !important;
        font-weight: bold;
        font-size: 1.1rem;
    }

    /* Rating Star Color */
    .bi-star-fill, .bi-star-half {
        color: #6F4AA2 !important;
    }

    /* Clean Product Card Style matching other pages */
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
    .product-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    /* --- FOOTER STYLES --- */
    .main-footer {
        background: #1e1e2c;
        color: white;
        border-top: 5px solid #6F4AA2;
    }
    .footer-links li { margin-bottom: 12px; }
    .footer-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s;
        font-size: 0.95rem;
    }
    .footer-links a:hover { color: #ffd166; padding-left: 5px; }
    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 50%;
        margin-right: 10px;
        text-decoration: none;
        transition: 0.3s;
    }
    .social-links a:hover { background: #6F4AA2; transform: translateY(-3px); }
    .footer-bottom {
        background: rgba(0, 0, 0, 0.2);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }
    .btn-accent {
        background-color: #ffd166;
        color: #1e1e2c;
        font-weight: 600;
        border-radius: 0 10px 10px 0;
    }
  </style>
</head>
<body>

<header class="main-header">
    <div class="container py-3">
      <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-6">
          <div class="d-flex align-items-center">
            <span class="brand-icon" style="color: #6F4AA2;"><i class="bi bi-shop fs-3"></i></span>
            <span class="brand-logo fw-bold fs-3 ms-2">StyleHub</span>
          </div>
        </div>
        <div class="col-lg-6 col-md-5 d-none d-md-block">
          <form class="search-form" id="searchForm">
            <div class="input-group">
                <input class="form-control search-input rounded-start-pill px-4" type="search" id="searchInput" placeholder="Search for products..." aria-label="Search">
                <button class="btn btn-primary rounded-end-pill px-3" type="submit"><i class="bi bi-search"></i></button>
            </div>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
          <div class="d-flex align-items-center justify-content-end header-actions">
            <a href="#" class="action-icon me-3 position-relative text-dark"><i class="bi bi-arrow-repeat fs-4"></i></a>
            <a href="#" class="action-icon me-3 position-relative text-dark">
              <i class="bi bi-heart fs-4"></i>
              <span class="cart-badge badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle" id="favCount">0</span>
            </a>
            <a href="./cart.php" class="action-icon position-relative text-dark">
              <i class="bi bi-cart3 fs-4"></i>
              <span class="cart-badge badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle" id="header-cart-count">0</span>
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
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Beauty & Jewelry</a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
              <li><a class="dropdown-item" href="skincare.php">Skincare</a></li>
              <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">Stationery & Gifts</a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="gifts.php">Handmade Crafts</a></li>
              <li><a class="dropdown-item" href="stationary.php">School Supplies</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Electronics</a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./electronics.php">Mobile Phones</a></li>
              <li><a class="dropdown-item" href="./laptops.php">Laptops</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Fashion</a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="mens-wear.php">Men's Clothing</a></li>
              <li><a class="dropdown-item" href="women-wear.php">Women's Clothing</a></li>
          </ul>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="deals.php"><i class="bi bi-tag me-1"></i> Deals</a>
          </li>
      </ul>

    </div>
</nav>

<main class="container-fluid py-4" role="main">
  <section class="row">
    <aside class="col-md-3" role="complementary">
      <div class="sidebar shadow-box p-4 bg-white rounded border mb-4">
        <h2 class="h4 mb-3 fw-bold">Filters</h2>
        <div class="filter-section mb-4">
          <h3 class="h6 fw-bold mb-2">Gift Categories</h3>
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

        <div class="filter-section mb-4">
            <h3 class="h6 fw-bold mb-2">Price Range</h3>
            <input id="priceRange" type="range" min="0" max="5000" value="5000" step="50" class="form-range mb-2" oninput="updatePrice(this.value)" />
            <div class="d-flex justify-content-between mb-0" style="font-weight: 500; font-size: 0.90rem;">
                <span>₹0</span>
                <span id="priceValue">₹5000</span>
            </div>
        </div>

        <div class="filter-buttons">
          <button id="applyBtn" type="button" class="btn btn-primary w-100 rounded-pill mb-2" onclick="filterProducts()">Apply Filters</button>
          <button id="resetBtn" type="button" class="btn btn-light border w-100 rounded-pill" onclick="location.reload()">Reset</button>
        </div>
      </div>
    </aside>

    <section class="col-md-9">
      <div class="mb-3 d-flex justify-content-between align-items-center">
        <p id="resultCount" class="m-0 text-muted">Showing results</p>
        <select class="form-select d-inline w-auto" id="sortSelect" onchange="sortProducts(this.value)">
          <option value="best">Best Match</option>
          <option value="lowToHigh">Price: Low to High</option>
          <option value="highToLow">Price: High to Low</option>
        </select>
      </div>
      <div class="row g-4" id="productContainer"></div>
    </section>
  </section>
</main>

<footer class="main-footer mt-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <span class="brand-icon text-white"><i class="bi bi-shop fs-3"></i></span>
                    <span class="brand-logo text-white fw-bold fs-3 ms-2">StyleHub</span>
                </div>
                <p class="text-white-50">Your one-stop destination for the latest in fashion, electronics, and handmade gifts. Quality products delivered to your doorstep.</p>
                <div class="social-links mt-4">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white fw-bold mb-4">Quick Links</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="electronics.php">Electronics</a></li>
                    <li><a href="gifts.php">Gifts</a></li>
                    <li><a href="mens-wear.php">Fashion</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white fw-bold mb-4">Support</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white fw-bold mb-4">Newsletter</h5>
                <p class="text-white-50">Get updates on new arrivals and offers.</p>
                <form class="mt-3">
                    <div class="input-group">
                        <input type="email" class="form-control border-0" placeholder="Email Address">
                        <button class="btn btn-accent" type="button">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-bottom py-3 text-center">
        <div class="container">
            <p class="mb-0 text-white-50">&copy; 2026 StyleHub. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Products updated with 1100s IDs
  const products = [
    { id: 1101, name: "Hand-Painted Ceramic Vase", price: 899.00, old_price: 1200.00, rating: 4.8, reviews: 45, tag: 'Sale', image: './ASSEST/img/vas.jpg', category: 'Handmade' },
    { id: 1102, name: "Customized Wooden Photo Frame", price: 450.00, old_price: 0, rating: 4.5, reviews: 120, tag: 'Best Seller', image: 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&q=80&w=400', category: 'Personalized' },
    { id: 1103, name: "Scented Soy Wax Candle Set", price: 599.00, old_price: 750.00, rating: 4.2, reviews: 30, tag: 'New', image: 'https://images.unsplash.com/photo-1603006905003-be475563bc59?auto=format&fit=crop&q=80&w=400', category: 'Decor' },
    { id: 1104, name: "Engraved Leather Keychain", price: 299.00, old_price: 399.00, rating: 4.7, reviews: 88, tag: '', image: './ASSEST/img/keychain.jpg', category: 'Personalized' },
    { id: 1105, name: "Artisanal Terracotta Planters", price: 650.00, old_price: 759.99, rating: 4.4, reviews: 52, tag:'Limited Offer', image:'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&q=80&w=400', category:'Decor'}
  ];

  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  let currentFilteredProducts = [...products];

  function generateRatingStars(rating) {
    let starsHTML = '';
    const fullStars = Math.floor(rating);
    const halfStar = (rating % 1) >= 0.5;
    for(let i = 1; i <= 5; i++) {
        if(i <= fullStars) starsHTML += '<i class="bi bi-star-fill text-warning"></i>';
        else if(i === fullStars + 1 && halfStar) starsHTML += '<i class="bi bi-star-half text-warning"></i>';
        else starsHTML += '<i class="bi bi-star text-warning"></i>';
    }
    return starsHTML;
  }

  function displayProducts(productList) {
    const container = document.getElementById('productContainer');
    container.innerHTML = '';
    
    if (productList.length === 0) {
      container.innerHTML = `<div class="col-12 text-center py-5"><h4 class="text-muted">No products found matching your filters.</h4></div>`;
      document.getElementById('resultCount').textContent = `Showing 0 results`;
      return;
    }
    
    productList.forEach(p => {
      const badge = p.tag ? `<span class="badge bg-${p.tag === 'Sale' ? 'danger' : 'success'} position-absolute" style="top:10px; right:10px; z-index:2;">${p.tag}</span>` : '';
      const oldPrice = p.old_price && p.old_price > p.price ? `<span class="text-muted text-decoration-line-through small ms-2">₹${p.old_price.toFixed(2)}</span>` : '';
      
      container.innerHTML += `
        <article class="col-12 col-sm-6 col-md-4" role="listitem">
            <div class="clean-product-card shadow-sm position-relative d-flex flex-column h-100 p-3">
              ${badge}
              <a href="product-details.php?id=${p.id}" class="text-decoration-none text-dark">
                <img src="${p.image}" class="img-fluid rounded mb-3 w-100" alt="${p.name}" style="height:250px; object-fit:cover;" onerror="this.src='https://via.placeholder.com/300x300?text=Product'"/>
                <p class="text-muted small mb-1">${p.category}</p>
                <h3 class="h6 fw-bold mb-1">${p.name}</h3>
              </a>
              
              <div class="mb-2">
                <span class="rating small">${generateRatingStars(p.rating)}</span>
                <span class="text-secondary ms-1" style="font-size: 0.8rem;">(${p.reviews} reviews)</span>
              </div>
              
              <div class="mb-3">
                <span class="product-price fs-5">₹${p.price.toFixed(2)}</span>
                ${oldPrice}
              </div>
              
              <button class="btn btn-primary btn-sm w-100 rounded-pill mt-auto" onclick="addToCart(${p.id})">Add to Cart</button>
            </div>
        </article>
      `;
    });
    
    document.getElementById('resultCount').textContent = `Showing 1-${productList.length} of ${productList.length} results`;
  }

  function updatePrice(val) {
    document.getElementById('priceValue').innerText = '₹' + val;
  }

  function filterProducts() {
    const searchInput = document.getElementById('searchInput').value.trim().toLowerCase();
    const priceLimit = parseFloat(document.getElementById('priceRange').value);
    const selectedTypes = Array.from(document.querySelectorAll('.type-filter:checked')).map(cb => cb.value);

    let filtered = products.filter(p => {
      let matchesSearch = searchInput === '' || p.name.toLowerCase().includes(searchInput);
      let matchesPrice = p.price <= priceLimit;
      let matchesType = selectedTypes.length === 0 || selectedTypes.includes(p.category);
      return matchesSearch && matchesPrice && matchesType;
    });

    currentFilteredProducts = filtered;
    sortProducts(document.getElementById('sortSelect').value, false);
  }

  function sortProducts(sortValue, callDisplay = true) {
    let sortedProducts = [...currentFilteredProducts];
    
    if (sortValue === 'lowToHigh') {
      sortedProducts.sort((a, b) => a.price - b.price);
    } else if (sortValue === 'highToLow') {
      sortedProducts.sort((a, b) => b.price - a.price);
    } else {
      sortedProducts.sort((a, b) => a.id - b.id);
    }
    
    if(callDisplay) displayProducts(sortedProducts);
  }

  function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
      existingItem.quantity += 1;
    } else {
      cart.push({
        id: product.id,
        name: product.name,
        price: product.price,
        image: product.image,
        quantity: 1
      });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI();
    alert(`${product.name} added to cart!`);
  }

  function updateCartUI() {
    const itemCount = cart.reduce((total, item) => total + item.quantity, 0);
    const totalPrice = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    
    const cartCountElement = document.getElementById('header-cart-count');
    const totalElement = document.getElementById('header-total');
    
    if (cartCountElement) cartCountElement.textContent = itemCount;
    if (totalElement) totalElement.textContent = totalPrice.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
  }

  document.addEventListener('DOMContentLoaded', () => {
    displayProducts(products);
    updateCartUI();
    
    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
      searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        filterProducts();
      });
    }
  });
</script>
</body>
</html>