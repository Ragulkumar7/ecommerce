<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM products WHERE category = 'jewelry'");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // If database fails, use sample data
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>StyleHub | Gold & Jewelry</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/gold.css">
  <style>
    /* Added only this specific class to give the cards that clean hover effect you liked */
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

    /* --- UPDATED COLORS FOR BUTTONS & SLIDERS (#d16d08f2) --- */
    
    /* Apply Filter and Add to Cart Buttons */
    #applyBtn, .btn-primary, .btn-sm {
        background-color: #d16d08f2 !important;
        border-color: #d16d08f2 !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    #applyBtn:hover, .btn-primary:hover {
        background-color: #a35506 !important; /* Slightly darker shade for hover */
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
          <form class="search-form" onsubmit="handleSearch(event)">
            <input class="form-control search-input" type="search" id="searchInput" placeholder="Search for products..." aria-label="Search">
            <button class="search-btn" type="submit"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
          <div class="d-flex align-items-center justify-content-end header-actions">
            <a href="#" class="action-icon me-3 position-relative" onclick="showCartModal()"><i class="bi bi-arrow-repeat"></i></a>
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-heart"></i><span class="cart-badge" id="favCount">0</span></a>
            <a href="cart.php" class="action-icon position-relative" onclick="showCartModal()">
              <i class="bi bi-cart3"></i><span class="cart-badge" id="header-cart-count">0</span>
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

  <section class="hero-banner">
    <div class="container text-white">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Products</a></li>
          <li class="breadcrumb-item active" aria-current="page">Gold Jewelry</li>
        </ol>
      </nav>
      <h1 class="display-4 fw-bold mb-3">Exquisite Gold Jewelry Collection</h1>
      <p class="lead mb-4">Discover our premium selection of handcrafted gold jewelry with timeless elegance</p>
      <button class="btn btn-primary btn-lg" onclick="scrollToProducts()">Shop Now <i class="bi bi-arrow-right ms-2"></i></button>
    </div>
  </section>

  <section class="shop-page container py-5" id="products-section">
    <div class="row">
      <aside class="col-md-3" role="complementary">
        <div class="filter-sidebar shadow-box p-3" aria-label="Product filters">
          <h2 class="h4 mb-4">Categories</h2>
          <div class="filter-section mb-4 p-3" aria-label="Category filter">
            <div class="form-check">
              <input type="checkbox" class="form-check-input category-filter" id="catGold" value="gold" checked>
              <label class="form-check-label" for="catGold"><i class="bi bi-gem me-2"></i> Gold Jewelry <span class="text-secondary">(24)</span></label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input category-filter" id="catSilver" value="silver">
              <label class="form-check-label" for="catSilver"><i class="bi bi-diamond me-2"></i> Silver Jewelry <span class="text-secondary">(18)</span></label>
            </div>
          </div>

          <div class="filter-section mb-4 p-3">
            <h3 class="h5"><i class="bi bi-currency-rupee me-2"></i>Price Range</h3>
            <input id="priceRange" type="range" min="0" max="100000" value="100000" step="1000" class="form-range mb-3" aria-valuemin="0" aria-valuemax="100000" aria-valuenow="100000" aria-label="Filter by price range" />
            <div class="d-flex justify-content-between mb-0">
              <span>₹0</span>
              <span id="priceValue">₹100000</span>
            </div>
          </div>

          <div class="filter-section mb-4 p-3" aria-label="Material filter">
            <h3 class="h5"><i class="bi bi-gem"></i> Material</h3>
            <div class="form-check">
              <input type="checkbox" class="form-check-input material-filter" id="material24k" value="24k">
              <label for="material24k" class="form-check-label">24K Gold</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input material-filter" id="material22k" value="22k">
              <label for="material22k" class="form-check-label">22K Gold</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input material-filter" id="material18k" value="18k">
              <label for="material18k" class="form-check-label">18K Gold</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input material-filter" id="materialSilver" value="silver">
              <label for="materialSilver" class="form-check-label">Sterling Silver</label>
            </div>
          </div>

          <div class="filter-section mb-4 p-3" aria-label="Rating filter">
            <h3 class="h5"><i class="bi bi-star-fill"></i> Rating</h3>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star4" value="4">
              <label class="form-check-label" for="star4">4 stars &amp; above</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star3" value="3">
              <label class="form-check-label" for="star3">3 stars &amp; above</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star2" value="2">
              <label class="form-check-label" for="star2">2 stars &amp; above</label>
            </div>
          </div>

          <div class="filter-buttons">
            <button id="applyBtn" type="button" class="btn btn-primary w-100">Apply Filters</button>
            <button id="resetBtn" type="button" class="btn btn-outline-secondary w-100 mt-2">Reset Filters</button>
          </div>
        </div>
      </aside>
      
      <section class="col-md-9" aria-label="Products">
        <div class="shop-controls d-flex justify-content-between align-items-center mb-4">
          <p id="resultCount" class="results-count m-0">Showing 1-6 of 6 results</p>
          <div class="d-flex align-items-center">
            <label for="sortSelect" class="form-label me-2 mb-0">Sort by:</label>
            <select class="form-select form-select-sm" id="sortSelect" style="width: auto;">
              <option value="best">Best Match</option>
              <option value="lowToHigh">Price: Low to High</option>
              <option value="highToLow">Price: High to Low</option>
              <option value="rating">Highest Rated</option>
            </select>
          </div>
        </div>
        
        <div class="row g-4" id="productContainer" role="list"></div>
        
        <nav aria-label="Product pagination" class="mt-5">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
      </section>
    </div>
  </section>

  <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="cartItems"></div>
        <div class="modal-footer">
          <h5 class="mt-3 me-auto">Total: ₹<span id="modalCartTotal">0.00</span></h5>
          <button class="btn btn-primary" onclick="buyNow()">Buy Now</button>
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h2 class="footer-brand-text mb-3">StyleHub</h2>
          <p class="mb-4">We offer premium products across multiple categories with competitive prices, fast shipping and excellent customer service.</p>
          <div class="d-flex">
            <a href="#" class="text-light me-3"><i class="bi bi-facebook fs-4"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-twitter fs-4"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-instagram fs-4"></i></a>
            <a href="#" class="text-light"><i class="bi bi-linkedin fs-4"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 mb-md-0 footer-links">
          <h5>Categories</h5>
          <ul>
            <li><a href="#">Jewelry</a></li>
            <li><a href="#">Fashion</a></li>
            <li><a href="#">Stationery</a></li>
            <li><a href="#">Electronics</a></li>
            <li><a href="#">Home & Gifts</a></li>
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
            <button type="submit" class="btn">Subscribe</button>
          </form>
        </div>
      </div>
      <hr class="my-4 bg-light">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <p class="mb-0">&copy; 2023 StyleHub. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <div class="d-flex justify-content-md-end">
            <a href="#" class="text-light me-3">Privacy Policy</a>
            <a href="#" class="text-light me-3">Terms of Service</a>
            <a href="#" class="text-light">Cookie Policy</a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div id="toastContainer" aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 9999"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const products = [
      { id: 10, name: "High Gold plated bangle with Ruby & Emerald Stones", price: 24999, old_price: 29999, rating: 4.5, reviews: 142, tag: 'Sale', image: './assest/img/IMG_20250818_165443.png', brand: 'GoldCraft', material: ['24k'], category: 'gold' },
      { id: 11, name: "High Gold plated bangle with AD Stones", price: 17999, old_price: 0, rating: 4, reviews: 87, tag: 'New', image: './assest/img/IMG_20250818_171359.png', brand: 'Heritage Gold', material: ['22k'], category: 'gold' },
      { id: 12, name: "Premium Quality Meganthi Polish Jhumka", price: 34999, old_price: 39999, rating: 5, reviews: 215, tag: 'Trend', image: './ASSEST/img/IMG_20250829_123319.png', brand: 'DiamondLuxe', material: ['18k'], category: 'gold' },
      { id: 13, name: "Premium Quality Meganthi Polish Necklace..", price: 19999, old_price: 24999, rating: 4.5, reviews: 163, tag: 'Sale', image: './ASSEST/img/IMG_20250829_123828.png', brand: 'SilverEssence', material: ['silver'], category: 'silver' },
      { id: 14, name: "Premium Quality Meganthi Polish Necklace with Ear rings", price: 12999, old_price: 0, rating: 4, reviews: 94, tag: '', image: './ASSEST/img/IMG_20250829_124455.png', brand: 'DiamondLuxe', material: ['18k'], category: 'gold' },
      { id: 15, name: "High Gold Plated 24 Rope chain", price: 15999, old_price: 18999, rating: 5, reviews: 201, tag: 'New', image: './ASSEST/img/IMG-20250811-WA0153.png', brand: 'GoldCraft', material: ['24k'], category: 'gold' },
      { id: 16, name: "High Gold plated 2 layer White & Ruby stones Necklace with Earrings", price: 17999, old_price: 0, rating: 4, reviews: 87, tag: 'New', image: './assest/img/IMG-20250717-WA0068.png', brand: 'Heritage Gold', material: ['22k'], category: 'gold' },
      { id: 17, name: "Premium Quality Gold Plated White & Red Colour Stones Three laver Necklace with Ear rings", price: 34999, old_price: 39999, rating: 5, reviews: 215, tag: 'Trend', image: './ASSEST/img/IMG-20250811-WA0153.png', brand: 'DiamondLuxe', material: ['18k'], category: 'gold' },
      { id: 18, name: "High Gold plated White & Ruby Stones Necklace & Haram set", price: 19999, old_price: 24999, rating: 4.5, reviews: 163, tag: 'Sale', image: './ASSEST/img/IMG-20250826-WA0026.jpg', brand: 'SilverEssence', material: ['silver'], category: 'silver' },
      { id: 19, name: "High Gold plated White & Ruby Stones Peackcock design Necklace & Haram set", price: 12999, old_price: 0, rating: 4, reviews: 94, tag: '', image: './ASSEST/img/IMG-20250903-WA0054.png', brand: 'DiamondLuxe', material: ['18k'], category: 'gold' },
      { id: 20, name: "High Gold plated Red, Green & Gold plated Necklace", price: 15999, old_price: 18999, rating: 5, reviews: 201, tag: 'New', image: './ASSEST/img/IMG-20250903-WA0060.png', brand: 'GoldCraft', material: ['24k'], category: 'gold' }
    ];

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let filteredProducts = [...products];
    let sortBy = 'best';

    document.addEventListener('DOMContentLoaded', function() {
      renderProducts();
      updateCartUI();
      updateFavoritesCount();
      
      const priceRange = document.getElementById('priceRange');
      const priceValue = document.getElementById('priceValue');
      
      priceRange.addEventListener('input', function() {
        priceValue.textContent = '₹' + parseInt(this.value).toLocaleString();
      });
      
      document.getElementById('applyBtn').addEventListener('click', applyFilters);
      document.getElementById('resetBtn').addEventListener('click', resetFilters);
      document.getElementById('sortSelect').addEventListener('change', function() { sortProducts(this.value); });
      document.getElementById('searchInput').addEventListener('input', applyFilters);
      
      document.querySelectorAll('.category-filter, .material-filter, .rating-filter').forEach(filter => {
        filter.addEventListener('change', applyFilters);
      });
    });

    function renderProducts() {
      const container = document.getElementById('productContainer');
      container.innerHTML = '';
      
      if (filteredProducts.length === 0) {
        container.innerHTML = '<div class="col-12 text-center"><p class="fs-5">No products found matching your criteria.</p></div>';
        document.getElementById('resultCount').textContent = `Showing 0 of ${products.length} results`;
        return;
      }
      
      filteredProducts.forEach(product => {
        const ratingStars = generateRatingStars(product.rating);
        
        const productCard = `
          <div class="col-md-6 col-xl-4" role="listitem">
            <div class="clean-product-card p-3 h-100 shadow-sm d-flex flex-column">
              
              <a href="product-details.php?id=${product.id}" class="text-decoration-none text-dark">
                <img src="${product.image}" class="img-fluid rounded mb-3 w-100" alt="${product.name}" style="height: 200px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/300x300?text=Product+Image'">
                <h5 class="h6 fw-bold mb-1">${product.name}</h5>
              </a>
              
              <div class="mb-2">
                <span class="text-warning small">${ratingStars}</span>
                <span class="text-secondary ms-1" style="font-size: 0.8rem;">(${product.reviews} reviews)</span>
              </div>
              
              <div class="mb-3">
                <span class="text-primary fw-bold fs-5">₹${product.price.toLocaleString()}</span>
                ${product.old_price ? `<span class="text-muted text-decoration-line-through ms-2 small">₹${product.old_price.toLocaleString()}</span>` : ''}
              </div>
              
              <button type="button" class="btn btn-primary btn-sm w-100 rounded-pill mt-auto" onclick="addToCart(${product.id})">
                Add to Cart
              </button>
              
            </div>
          </div>
        `;
        container.innerHTML += productCard;
      });
      
      document.getElementById('resultCount').textContent = `Showing 1-${filteredProducts.length} of ${filteredProducts.length} results`;
    }

    function generateRatingStars(rating) {
      let stars = '';
      const fullStars = Math.floor(rating);
      const hasHalfStar = rating % 1 !== 0;
      
      for (let i = 0; i < fullStars; i++) { stars += '<i class="bi bi-star-fill"></i>'; }
      if (hasHalfStar) { stars += '<i class="bi bi-star-half"></i>'; }
      
      const emptyStars = 5 - Math.ceil(rating);
      for (let i = 0; i < emptyStars; i++) { stars += '<i class="bi bi-star"></i>'; }
      return stars;
    }

    function applyFilters() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const maxPrice = parseInt(document.getElementById('priceRange').value);
      
      const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked')).map(cb => cb.value);
      const selectedMaterials = Array.from(document.querySelectorAll('.material-filter:checked')).map(cb => cb.value);
      const selectedRatings = Array.from(document.querySelectorAll('.rating-filter:checked')).map(cb => parseInt(cb.value));
      const minRating = selectedRatings.length > 0 ? Math.min(...selectedRatings) : 0;
      
      filteredProducts = products.filter(product => {
        const matchesSearch = product.name.toLowerCase().includes(searchTerm) || product.brand.toLowerCase().includes(searchTerm);
        const matchesPrice = product.price <= maxPrice;
        const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(product.category);
        const matchesMaterial = selectedMaterials.length === 0 || selectedMaterials.some(material => product.material.includes(material));
        const matchesRating = product.rating >= minRating;
        
        return matchesSearch && matchesPrice && matchesCategory && matchesMaterial && matchesRating;
      });
      
      sortProducts(sortBy);
      renderProducts();
    }

    function resetFilters() {
      document.getElementById('searchInput').value = '';
      document.getElementById('priceRange').value = 100000;
      document.getElementById('priceValue').textContent = '₹100,000';
      document.querySelectorAll('.category-filter, .material-filter, .rating-filter').forEach(cb => cb.checked = false);
      document.getElementById('catGold').checked = true;
      document.getElementById('sortSelect').value = 'best';
      
      filteredProducts = [...products];
      sortBy = 'best';
      sortProducts('best');
      renderProducts();
    }

    function sortProducts(criteria) {
      sortBy = criteria;
      switch(criteria) {
        case 'lowToHigh': filteredProducts.sort((a, b) => a.price - b.price); break;
        case 'highToLow': filteredProducts.sort((a, b) => b.price - a.price); break;
        case 'rating': filteredProducts.sort((a, b) => b.rating - a.rating); break;
        default: filteredProducts.sort((a, b) => a.id - b.id); break;
      }
      renderProducts();
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
      showToast(`${product.name} added to cart!`);
    }

    function updateCartUI() {
      const itemCount = cart.reduce((total, item) => total + item.quantity, 0);
      const totalPrice = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
      
      document.getElementById('header-cart-count').textContent = itemCount;
      document.getElementById('header-total').textContent = totalPrice.toFixed(2);
    }

    function showCartModal() {
      const modal = document.getElementById('cartModal');
      const cartItems = document.getElementById('cartItems');
      const modalCartTotal = document.getElementById('modalCartTotal');
      
      if (cart.length === 0) {
        cartItems.innerHTML = '<p class="text-center">Your cart is empty</p>';
      } else {
        cartItems.innerHTML = cart.map(item => `
          <div class="d-flex align-items-center mb-3 p-2 border-bottom">
            <img src="${item.image}" alt="${item.name}" class="rounded me-3" width="60" height="60" onerror="this.src='https://via.placeholder.com/60x60?text=Product'">
            <div class="flex-grow-1">
              <h6 class="mb-0">${item.name}</h6>
              <p class="mb-0">₹${item.price.toLocaleString()} x ${item.quantity}</p>
              <p class="mb-0 fw-bold">Subtotal: ₹${(item.price * item.quantity).toLocaleString()}</p>
            </div>
            <div>
              <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${item.id})">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </div>
        `).join('');
      }
      
      const totalPrice = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
      modalCartTotal.textContent = totalPrice.toFixed(2);
      
      new bootstrap.Modal(modal).show();
    }

    function removeFromCart(productId) {
      cart = cart.filter(item => item.id !== productId);
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartUI();
      showCartModal();
    }

    function updateFavoritesCount() {
      const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
      document.getElementById('favCount').textContent = favorites.length;
    }

    function buyNow() {
      if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
      }
      alert('Proceeding to checkout...');
    }

    function showToast(message) {
      let toast = document.getElementById('toast');
      if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast';
        toast.className = 'toast align-items-center text-white bg-primary border-0 position-fixed bottom-0 end-0 m-3';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        toast.innerHTML = `
          <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        `;
        document.body.appendChild(toast);
      } else {
        toast.querySelector('.toast-body').textContent = message;
      }
      const bsToast = new bootstrap.Toast(toast);
      bsToast.show();
    }

    function handleSearch(event) {
      event.preventDefault();
      applyFilters();
    }

    function scrollToProducts() {
      document.getElementById('products-section').scrollIntoView({ behavior: 'smooth' });
    }
  </script>
</body>
</html>