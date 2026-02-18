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

    $stmt = $pdo->query("SELECT * FROM products WHERE category = 'stationery'");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // If database fails, use sample data via JavaScript
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>StyleHub | Stationery Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/stationary.css" />
  <style>
    /* --- THEME COLORS (#6F4AA2) --- */
    #applyBtn, .btn-primary, .btn-outline-primary:hover {
        background-color: #6F4AA2 !important;
        border-color: #6F4AA2 !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    .btn-outline-primary {
        color: #6F4AA2 !important;
        border-color: #6F4AA2 !important;
    }

    #applyBtn:hover, .btn-primary:hover {
        background-color: #5a3a80 !important;
        border-color: #5a3a80 !important;
        transform: translateY(-2px);
    }

    .form-range::-webkit-slider-thumb { background: #6F4AA2 !important; }
    .form-range::-moz-range-thumb { background: #6F4AA2 !important; }

    .product-price {
        color: #6F4AA2 !important;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .bi-star-fill, .bi-star-half { color: #6F4AA2 !important; }

    .product-card {
        border: 1px solid #eee;
        border-radius: 15px;
        transition: transform 0.3s;
        background: #fff;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .product-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    /* --- HEADER & NAVBAR STYLES --- */
    .main-navbar { 
      background: linear-gradient(to right, #6F4AA2, #5a3a80) !important; 
      padding: 10px 0; 
    }
    .main-navbar .nav-link { 
      color: white !important; 
      font-weight: 500; 
      display: flex; 
      align-items: center; 
      position: relative;
    }
    .main-navbar .nav-link.active:after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 15%;
      width: 70%;
      height: 3px;
      background: #ffd166; 
      border-radius: 3px;
    }
    .brand-icon {
      background: #6F4AA2;
      color: white;
      width: 40px;
      height: 40px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      margin-right: 10px;
    }
    .brand-logo {
      font-weight: bold;
      font-size: 1.5rem;
      color: #333;
    }
    .search-form {
      display: flex;
      background: #f8f9fa;
      border-radius: 50px;
      padding: 5px 15px;
      border: 1px solid #ddd;
    }
    .search-input {
      border: none;
      background: transparent;
      box-shadow: none !important;
    }
    .search-btn {
      background: none;
      border: none;
      color: #6F4AA2;
    }
    .action-icon {
      color: #333;
      font-size: 1.4rem;
      text-decoration: none;
    }
    .cart-badge {
      position: absolute;
      top: -5px;
      right: -10px;
      background: #6F4AA2;
      color: white;
      font-size: 0.7rem;
      padding: 2px 6px;
      border-radius: 50%;
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
          <button class="search-btn" type="button" onclick="applyFilters()"><i class="bi bi-search"></i></button>
        </form>
      </div>
      <div class="col-lg-3 col-md-3 col-6">
        <div class="d-flex align-items-center justify-content-end header-actions">
          <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-arrow-repeat"></i></a>
          <a href="#" class="action-icon me-3 position-relative">
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
          <a class="nav-link" href="index.php"><i class="bi bi-house me-1"></i> Home</a>
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
            <i class="bi bi-heart me-1 active"></i> Stationery & Gifts
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
          <a class="nav-link" href="deals.php"><i class="bi bi-tag me-1"></i> Deals</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container-fluid py-4" role="main">
  <section class="row">
    <aside class="col-md-3" role="complementary" aria-label="Product filters">
      <div class="sidebar shadow-box p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 20px; background: white;">
        <h2 class="h4 mb-4">Filters</h2>
        
        <section class="filter-section mb-4" aria-label="Price filter">
          <h3 class="h5"><i class="bi bi-currency-rupee me-2"></i>Price Range</h3>
          <input id="priceRange" type="range" min="0" max="150" value="150" step="10" class="form-range" aria-label="Filter by price range" />
          <div class="d-flex justify-content-between mt-2 mb-0" style="font-weight: 600; font-size: 0.95rem;">
            <span>₹0</span>
            <span id="priceValue">₹150</span>
          </div>
        </section>

        <section class="filter-section mb-4" aria-label="Category filter">
          <h3 class="h5">Category</h3>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="pen" value="Pen" />
            <label class="form-check-label" for="pen">Pen</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="notebook" value="Notebook" />
            <label class="form-check-label" for="notebook">Notebook</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="eraser" value="Eraser" />
            <label class="form-check-label" for="eraser">Eraser</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="marker" value="Marker" />
            <label class="form-check-label" for="marker">Marker</label>
          </div>
        </section>

        <section class="filter-section" aria-label="Rating filter">
          <h3 class="h5">Rating</h3>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="star4" />
            <label class="form-check-label" for="star4">4 stars &amp; above</label>
          </div>
        </section>

        <div class="filter-buttons mt-3">
          <button id="applyBtn" type="button" class="btn w-100 mb-2">Apply Filters</button>
          <button id="resetBtn" type="button" class="btn btn-light w-100" style="border: 1px solid #ddd;">Reset Filters</button>
        </div>
      </div>
    </aside>

    <section class="col-md-9" aria-label="Products">
      <div class="mb-3 d-flex justify-content-between align-items-center">
        <p id="resultCount" class="m-0"></p>
        <select class="form-select d-inline w-auto" id="sortSelect" aria-label="Sort products">
          <option value="default">Sort by</option>
          <option value="lowToHigh">Price - Low to High</option>
          <option value="highToLow">Price - High to Low</option>
        </select>
      </div>
      <div class="row g-4" id="productContainer" role="list"></div>
    </section>
  </section>
</main>

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
    <div class="row text-center text-md-start">
      <div class="col-md-6 mb-3 mb-md-0">
        <p class="mb-0">&copy; 2023 StyleHub. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const products = <?php echo !empty($products) ? json_encode($products) : '[
    { id: 1, name: "Gel Pen Set", price: 150, rating: 4.5, reviews: 120, category: "Pen", image: "https://i.pinimg.com/1200x/18/dd/a7/18dda7156ace505cf245e0d58705a218.jpg" },
    { id: 2, name: "Spiral Notebook", price: 80, rating: 4.2, reviews: 90, category: "Notebook", image: "https://i.pinimg.com/736x/ed/8d/16/ed8d1658bb2f25a9ef4688fd6413ab06.jpg" },
    { id: 3, name: "White Eraser", price: 20, rating: 4.0, reviews: 40, category: "Eraser", image: "https://i.pinimg.com/736x/f2/d1/23/f2d123ab237f8577f87bb10967abfd6a.jpg" },
    { id: 4, name: "Permanent Marker", price: 120, rating: 4.7, reviews: 140, category: "Marker", image: "https://i.pinimg.com/736x/19/0f/ab/190fabd11ddbcbc63dbe23c9478c1d86.jpg" },
    { id: 5, name: "Ballpoint Pen", price: 100, rating: 4.3, reviews: 70, category: "Pen", image: "https://i.pinimg.com/1200x/a7/56/23/a75623f1ee5b4059967682858ed4e4cc.jpg" }
  ]' ?>;

  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  function displayProducts(productsList) {
    const container = document.getElementById("productContainer");
    container.innerHTML = "";
    
    if (productsList.length === 0) {
      document.getElementById("resultCount").textContent = "No products found.";
      container.innerHTML = '<div class="col-12 text-center py-5"><h3>No products match your criteria</h3></div>';
      return;
    }
    
    productsList.forEach(p => {
      const fullStars = Math.floor(p.rating);
      const halfStar = p.rating % 1 >= 0.5;
      let starsHTML = '';
      for(let i=1; i<=5; i++) {
        if(i <= fullStars) starsHTML += '<i class="bi bi-star-fill"></i>';
        else if(i === fullStars + 1 && halfStar) starsHTML += '<i class="bi bi-star-half"></i>';
        else starsHTML += '<i class="bi bi-star"></i>';
      }
      
      container.innerHTML += `
        <article class="col-12 col-sm-6 col-md-4" role="listitem">
          <div class="product-card shadow-sm">
            <img src="${p.image}" alt="${p.name}" class="product-img" />
            <div class="p-3">
              <h3 class="h6 fw-bold mb-1">${p.name}</h3>
              <div class="mb-2"><span class="small">${starsHTML}</span> <span class="text-secondary ms-1" style="font-size:0.8rem;">(${p.reviews})</span></div>
              <div class="mt-2 mb-3"><span class="product-price">₹${p.price}</span></div>
              <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm flex-grow-1" onclick="quickView(${p.id})">Quick View</button>
                <button class="btn btn-primary btn-sm flex-grow-1" onclick="addToCart(${p.id})">Add to Cart</button>
              </div>
            </div>
          </div>
        </article>
      `;
    });
    document.getElementById("resultCount").textContent = `Showing ${productsList.length} products`;
  }

  function applyFilters() {
    const keyword = document.getElementById('searchInput').value.toLowerCase();
    const priceLimit = +document.getElementById('priceRange').value;
    const categories = Array.from(document.querySelectorAll('.size-filter:checked')).map(cb => cb.value);
    const minRating = document.getElementById('star4').checked ? 4 : 0;

    const filtered = products.filter(p => {
      return p.name.toLowerCase().includes(keyword) && 
             p.price <= priceLimit && 
             (categories.length === 0 || categories.includes(p.category)) &&
             p.rating >= minRating;
    });
    
    displayProducts(filtered);
  }

  function quickView(id) { alert('Viewing product ID: ' + id); }
  
  function addToCart(id) { 
    const product = products.find(p => p.id === id);
    cart.push(product);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI();
    alert(product.name + ' added to cart!'); 
  }

  function updateCartUI() {
    document.getElementById('header-cart-count').textContent = cart.length;
    const total = cart.reduce((sum, item) => sum + item.price, 0);
    document.getElementById('header-total').textContent = total.toFixed(2);
  }

  document.getElementById('priceRange').addEventListener('input', e => {
    document.getElementById('priceValue').textContent = `₹${e.target.value}`;
    applyFilters();
  });
  
  document.getElementById('searchInput').addEventListener('input', applyFilters);
  document.querySelectorAll('.size-filter, #star4').forEach(el => el.addEventListener('change', applyFilters));
  document.getElementById('applyBtn').addEventListener('click', applyFilters);
  document.getElementById('resetBtn').addEventListener('click', () => { location.reload(); });

  window.onload = () => {
    displayProducts(products);
    updateCartUI();
  };
</script>
</body>
</html>