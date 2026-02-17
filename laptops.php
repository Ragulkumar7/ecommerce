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
    /* Navbar Styling */
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

    .main-navbar .nav-link.active::after {
        content: "";
        position: absolute;
        bottom: 8px;
        left: 20%;
        width: 60%;
        height: 3px;
        background-color: #ffcc66;
    }

    /* Sidebar Styling */
    .sidebar-card {
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        padding: 25px;
        background: white;
    }

    /* --- UPDATED COLORS FOR BUTTONS & SLIDERS (#d16d08f2) --- */
    .apply-btn, .btn-primary {
        background-color: #d16d08f2 !important;
        border-color: #d16d08f2 !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    .apply-btn:hover, .btn-primary:hover {
        background-color: #a35506 !important; /* Darker shade for hover */
        border-color: #a35506 !important;
        transform: translateY(-2px);
        color: white !important;
    }

    /* Price Range Slider Thumb */
    .form-range::-webkit-slider-thumb {
        background: #d16d08f2 !important;
    }
    .form-range::-moz-range-thumb {
        background: #d16d08f2 !important;
    }

    /* Product card price text color */
    .text-primary {
        color: #d16d08f2 !important;
    }

    /* Clean Product Card */
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
                <form class="search-form" id="searchForm" onsubmit="event.preventDefault(); applyFilters();">
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
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Beauty & Jewelry
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
                        <li><a class="dropdown-item" href="skincare.php">Skincare</a></li>
                        <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Stationery & Gifts
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="gifts.php">Handmade Crafts</a></li>
                        <li><a class="dropdown-item" href="stationary.php">School Supplies</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Electronics
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./electronics.php">Mobile Phones</a></li>
                        <li><a class="dropdown-item" href="./laptops.php">Laptops</a></li>
                        <li><a class="dropdown-item" href="./accessories.php">Accessories</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Fashion
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="mens-wear.php">Men's Clothing</a></li>
                        <li><a class="dropdown-item" href="women-wear.php">Women's Clothing</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-5">
  <div class="row">
    <aside class="col-lg-4 col-xl-3 mb-4">
        <div class="sidebar-card shadow-sm p-4">
            <h2 class="h4 mb-3 fw-bold">Filters</h2>
            <div class="price-range-box bg-light border-0">
                <h3 class="h6 fw-bold mb-3">Price Range</h3>
                <input type="range" class="form-range" id="priceRange" min="0" max="150000" value="150000" step="5000" oninput="updatePriceLabel(this.value)">
                <div class="d-flex justify-content-between mt-3 fw-medium" style="font-size: 0.95rem;">
                    <span>₹0</span>
                    <span id="priceValue">₹150,000</span>
                </div>
            </div>
            <button class="btn btn-primary w-100 rounded-pill mb-2 apply-btn" onclick="applyFilters()">Apply Filters</button>
            <button class="btn btn-light w-100 rounded-pill border" onclick="location.reload()">Reset Filters</button>
        </div>
    </aside>

    <section class="col-lg-8 col-xl-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="m-0 text-muted" id="resultCount">Showing results...</p>
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
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  
  // Updated IDs to 800s to avoid conflict in product-details.php
  const laptops = [
    { id: 801, name: "Premium Business Laptop", price: 85000, category: "Laptops", rating: 4.8, reviews: 120, image: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500", brand: "BrandX" },
    { id: 802, name: "Ultra Gaming Pro", price: 125000, category: "Laptops", rating: 4.9, reviews: 230, image: "https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500", brand: "BrandY" },
    { id: 803, name: "Student Slim Note", price: 45000, category: "Laptops", rating: 4.5, reviews: 310, image: "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500", brand: "BrandZ" }
  ];

  function generateRatingStars(rating) {
      const fullStars = Math.floor(rating);
      const halfStar = (rating % 1) >= 0.5;
      let starsHTML = '';
      for (let i = 1; i <= 5; i++) {
        if (i <= fullStars) starsHTML += '<i class="bi bi-star-fill text-warning"></i>';
        else if (i === fullStars + 1 && halfStar) starsHTML += '<i class="bi bi-star-half text-warning"></i>';
        else starsHTML += '<i class="bi bi-star text-warning"></i>';
      }
      return starsHTML;
  }

  function displayProducts(list) {
    const container = document.getElementById('laptopContainer');
    
    if(list.length === 0) {
        container.innerHTML = '<div class="col-12 text-center py-5"><h4>No laptops match your criteria.</h4></div>';
        document.getElementById('resultCount').textContent = `Showing 0 results`;
        return;
    }

    container.innerHTML = list.map(p => `
        <div class="col-md-6 col-xl-4">
            <div class="clean-product-card p-3 h-100 shadow-sm d-flex flex-column position-relative">
                
                <a href="product-details.php?id=${p.id}" class="text-decoration-none text-dark">
                    <img src="${p.image}" class="img-fluid rounded mb-3 w-100" style="height:180px; object-fit:cover;" alt="${p.name}">
                    <h3 class="h6 fw-bold mb-1">${p.name}</h3>
                </a>
                
                <div class="mb-2">
                    <span class="small">${generateRatingStars(p.rating)}</span>
                    <span class="text-secondary ms-1" style="font-size: 0.8rem;">(${p.reviews} reviews)</span>
                </div>

                <div class="mb-3 mt-auto">
                    <span class="text-primary fw-bold fs-5">₹${p.price.toLocaleString()}</span>
                </div>
                
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
    const cartCountElement = document.getElementById('header-cart-count');
    const totalElement = document.getElementById('header-total');
    
    const itemCount = cart.reduce((total, item) => total + (item.quantity || 1), 0);
    const totalPrice = cart.reduce((total, item) => total + (item.price * (item.quantity || 1)), 0);
    
    if(cartCountElement) cartCountElement.textContent = itemCount;
    if(totalElement) totalElement.textContent = totalPrice.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
  }

  document.addEventListener('DOMContentLoaded', () => {
    displayProducts(laptops);
    updateCartUI();
    
    document.getElementById('searchInput').addEventListener('input', applyFilters);
  });
</script>
</body>
</html>