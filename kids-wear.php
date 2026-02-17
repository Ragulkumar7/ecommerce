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
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
  <title>StyleHub | Kids' Fashion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/kids-wear.css" />
  <style>
    /* Styling for the navbar */
    .main-navbar { background-color: #cd7d73 !important; padding: 10px 0; }
    .main-navbar .nav-link { color: white !important; font-weight: 500; border-bottom: 3px solid transparent; }
    .main-navbar .nav-link.active { border-bottom: 3px solid #ffcc66; }

    /* --- UPDATED COLORS FOR BUTTONS & SLIDERS (#d16d08f2) --- */
    #applyBtn, .btn-primary {
        background-color: #d16d08f2 !important;
        border-color: #d16d08f2 !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    #applyBtn:hover, .btn-primary:hover {
        background-color: #a35506 !important; 
        border-color: #a35506 !important;
        transform: translateY(-2px);
    }

    .form-range::-webkit-slider-thumb { background: #d16d08f2 !important; }
    .form-range::-moz-range-thumb { background: #d16d08f2 !important; }

    .product-price {
        color: #d16d08f2 !important;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .bi-star-fill, .bi-star-half { color: #d16d08f2 !important; }

    /* Clean Product Card Style */
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
  </style>
</head>
<body>
<header class="main-header">
    <div class="container py-3">
      <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-6">
          <div class="d-flex align-items-center">
            <span class="brand-icon" style="color: #d16d08f2;"><i class="bi bi-shop fs-3"></i></span>
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
            <a href="cart.php" class="action-icon position-relative text-dark">
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
      <div class="d-flex justify-content-between align-items-center">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Beauty & Jewelry</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
              <li><a class="dropdown-item" href="skincare.php">Skincare</a></li>
              <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Stationery & Gifts</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="gifts.php">Handmade Crafts</a></li>
              <li><a class="dropdown-item" href="stationary.php">School Supplies</a></li>
              <li><a class="dropdown-item" href="stationary.php">College Supplies</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Electronics</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./electronics.php">Mobile Phones</a></li>
              <li><a class="dropdown-item" href="./electronics.php">Laptops</a></li>
              <li><a class="dropdown-item" href="./electronics.php">Accessories</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Fashion</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="mens-wear.php">Men's Clothing</a></li>
              <li><a class="dropdown-item" href="women-wear.php">Women's Clothing</a></li>
              <li><a class="dropdown-item" href="kids-wear.php">Kids' Clothing</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="#">Deals</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container-fluid py-4" role="main">
    <section class="row">
      <aside class="col-md-3" role="complementary">
        <div class="sidebar shadow-box p-4 bg-white rounded border mb-4" aria-label="Product filters">
          <h2 class="h4 mb-3 fw-bold">Filters</h2>
          
          <div class="filter-section mb-4">
            <h3 class="h6 fw-bold mb-2">Category</h3>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="catKids" checked disabled />
              <label class="form-check-label" for="catKids">Kids' Fashion <span class="text-secondary">(11)</span></label>
            </div>
          </div>
          
          <div class="filter-section mb-4">
            <h3 class="h6 fw-bold mb-2">Price Range</h3>
            <input id="priceRange" type="range" min="0" max="1000" value="1000" step="10" class="form-range mb-2" aria-label="Filter by price range" />
            <div class="d-flex justify-content-between mb-0" style="font-weight: 500; font-size: 0.90rem;">
              <span>₹0</span>
              <span id="priceValue">₹1000</span>
            </div>
          </div>
          
          <div class="filter-section mb-4">
            <h3 class="h6 fw-bold mb-2">Size</h3>
            <div class="form-check form-check-inline me-3">
              <input type="checkbox" class="form-check-input size-filter" id="sizeS" value="S" />
              <label for="sizeS" class="form-check-label">S</label>
            </div>
            <div class="form-check form-check-inline me-3">
              <input type="checkbox" class="form-check-input size-filter" id="sizeM" value="M" />
              <label for="sizeM" class="form-check-label">M</label>
            </div>
            <div class="form-check form-check-inline me-3">
              <input type="checkbox" class="form-check-input size-filter" id="sizeL" value="L" />
              <label for="sizeL" class="form-check-label">L</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input size-filter" id="sizeXL" value="XL" />
              <label for="sizeXL" class="form-check-label">XL</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input size-filter" id="sizeXXL" value="XXL" />
              <label for="sizeXXL" class="form-check-label">XXL</label>
            </div>
          </div>
          
          <div class="filter-section mb-4">
            <h3 class="h6 fw-bold mb-2">Rating</h3>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star4" value="4" />
              <label class="form-check-label" for="star4">4 stars & above</label>
            </div>
          </div>
          
          <div class="filter-buttons">
            <button id="applyBtn" type="button" class="btn w-100 rounded-pill mb-2">Apply Filters</button>
            <button id="resetBtn" type="button" class="btn btn-light border w-100 rounded-pill">Reset Filters</button>
          </div>
        </div>
      </aside>
      
      <section class="col-md-9" aria-label="Products">
        <div class="mb-3 d-flex justify-content-between align-items-center">
          <p id="resultCount" class="m-0 text-muted">Showing results</p>
          <div>
            <label for="sortSelect" class="form-label visually-hidden">Sort products</label>
            <select class="form-select d-inline w-auto" id="sortSelect">
              <option value="best">Best Match</option>
              <option value="lowToHigh">Price: Low to High</option>
              <option value="highToLow">Price: High to Low</option>
            </select>
          </div>
        </div>
        <div class="row g-4" id="productContainer" role="list"></div>
      </section>
    </section>
  </main>

  <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="cartItems"></div>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <h5>Total: ₹<span id="modalCartTotal">0.00</span></h5>
            <button class="btn btn-primary rounded-pill px-4" onclick="buyNow()">Proceed to Checkout</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer-section bg-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h2 class="footer-brand-text mb-3 text-white">StyleHub</h2>
          <p class="mb-4 text-white-50">We offer the best products at competitive prices with fast shipping and excellent customer service.</p>
          <div class="d-flex">
            <a href="#" class="text-light me-3"><i class="bi bi-facebook fs-4"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-twitter fs-4"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-instagram fs-4"></i></a>
            <a href="#" class="text-light"><i class="bi bi-linkedin fs-4"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 mb-md-0 footer-links">
          <h5 class="text-white">Shop</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white-50 text-decoration-none">Beauty & Jewelry</a></li>
            <li><a href="#" class="text-white-50 text-decoration-none">Homemade Gifts</a></li>
            <li><a href="#" class="text-white-50 text-decoration-none">Stationery</a></li>
            <li><a href="#" class="text-white-50 text-decoration-none">Men's Fashion</a></li>
            <li><a href="#" class="text-white-50 text-decoration-none">Kids' Fashion</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 mb-md-0 footer-links">
          <h5 class="text-white">Customer Service</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white-50 text-decoration-none">Contact Us</a></li>
            <li><a href="#" class="text-white-50 text-decoration-none">Returns & Exchanges</a></li>
            <li><a href="#" class="text-white-50 text-decoration-none">Shipping & Delivery</a></li>
            <li><a href="#" class="text-white-50 text-decoration-none">FAQ</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4 footer-newsletter">
          <h5 class="mb-3 text-white">Newsletter</h5>
          <p class="text-white-50">Subscribe to get special offers, free giveaways, and new product alerts.</p>
          <form>
            <input type="email" class="form-control mb-3" placeholder="Your email address">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Subscribe</button>
          </form>
        </div>
      </div>
      <hr class="my-4 border-secondary">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <p class="mb-0 text-white-50">&copy; 2023 StyleHub. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <div class="d-flex justify-content-md-end">
            <a href="#" class="text-white-50 me-3 text-decoration-none">Privacy Policy</a>
            <a href="#" class="text-white-50 me-3 text-decoration-none">Terms of Service</a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // --- PRODUCT DATA WITH UPDATED NAMES & 900s IDs ---
    const products = [
      { id: 901, name: "Kids Casual Shirt", price: 249.99, old_price: 299.99, rating: 4.5, reviews: 142, tag: 'Sale', image: 'https://i.pinimg.com/736x/24/cd/94/24cd940984616cfa0b3402c9392959cc.jpg', brand: 'Levis', size: ['M', 'L'], category: "Kids' Fashion" },
      { id: 902, name: "Boys Denim Outfit", price: 179.99, old_price: 0, rating: 4, reviews: 87, tag: 'New', image: 'https://i.pinimg.com/736x/18/6a/5c/186a5cf32acf976d98771bbcfa471d2f.jpg', brand: 'Peter England', size: ['S'], category: "Kids' Fashion" },
      { id: 903, name: "Kids Party Wear", price: 349.99, old_price: 399.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/ce/c9/c7/cec9c7d5839d06a8ac8c1e0166d023d0.jpg', brand: 'Levis', size: ['L', 'XL'], category: "Kids' Fashion" },
      { id: 904, name: "Boys Checked Shirt", price: 199.99, old_price: 319.99, rating: 4.7, reviews: 103, tag: 'Sale', image: 'https://i.pinimg.com/736x/de/18/ce/de18ce9aa032809056a3a3e6426892a3.jpg', brand: 'Arrow', size: ['XL'], category: "Kids' Fashion" },
      { id: 905, name: "Kids Blue Casuals", price: 329.99, old_price: 369.99, rating: 4.2, reviews: 70, tag: '', image: 'https://i.pinimg.com/736x/8e/ff/23/8eff231c8650e4dd9593c9d03aaf9149.jpg', brand: 'Levis', size: ['XXL'], category: "Kids' Fashion" },
      { id: 906, name: "Kids Cotton Tee", price: 149.99, old_price: 179.99, rating: 3.8, reviews: 40, tag: '', image: 'https://i.pinimg.com/736x/b2/08/a6/b208a6d1276f7476e219c187775d3491.jpg', brand: 'Levis', size: ['S', 'M'], category: "Kids' Fashion" },
      { id: 907, name: "Urban Kids Classic", price: 449.99, old_price: 599.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/55/f9/25/55f92534185658fd1469ec3c39842254.jpg', brand: 'Levis', size: ['L', 'XL'], category: "Kids' Fashion" },
      { id: 908, name: "Premium Kids Hoodie", price: 649.99, old_price: 799.99, rating: 5, reviews: 90, tag: '', image: 'https://i.pinimg.com/1200x/52/a6/69/52a669d90cffe0269fe47f0a669898da.jpg', brand: 'Levis', size: ['XXL'], category: "Kids' Fashion" },
      { id: 909, name: "Kids Fit Shirt", price: 299.99, old_price: 329.99, rating: 3.5, reviews: 20, tag: '', image: 'https://i.pinimg.com/1200x/ca/c4/7f/cac47f801fe9074c657c97648c59fbec.jpg', brand: 'Levis', size: ['S', 'M', 'L', 'XL', 'XXL'], category: "Kids' Fashion" },
      { id: 910, name: "Kids Premium Jacket", price: 399.99, old_price: 459.99, rating: 4.1, reviews: 101, tag: '', image: 'https://i.pinimg.com/1200x/59/89/2f/59892fa010836473215d6cfcce79dc3b.jpg', brand: 'Levis', size: ['XL'], category: "Kids' Fashion" },
      { id: 911, name: "Casual Boys Shirt", price: 189.99, old_price: 229.99, rating: 3.9, reviews: 50, tag: '', image: 'https://i.pinimg.com/1200x/fc/c6/57/fcc6579ef8490df930365f9f7e42c205.jpg', brand: 'Levis', size: ['M'], category: "Kids' Fashion" }
    ];
    
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let filterState = {
      keyword: '',
      priceLimit: 1000,
      sizes: [],
      minRating: 0
    };
    let currentFilteredProducts = [...products];

    // --- DISPLAY LOGIC (CLEAN CARD STYLE) ---
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
        
        let starsHTML = '';
        const fullStars = Math.floor(p.rating);
        const halfStar = p.rating % 1 >= 0.5;
        
        for (let i = 1; i <= 5; i++) {
          if (i <= fullStars) starsHTML += '<i class="bi bi-star-fill text-warning"></i>';
          else if (i === fullStars + 1 && halfStar) starsHTML += '<i class="bi bi-star-half text-warning"></i>';
          else starsHTML += '<i class="bi bi-star text-warning"></i>';
        }
        
        let sizes = p.size.join(", ");
        
        container.innerHTML += `
          <article class="col-12 col-sm-6 col-md-4" role="listitem">
            <div class="clean-product-card shadow-sm position-relative d-flex flex-column h-100 p-3">
              ${badge}
              <a href="product-details.php?id=${p.id}" class="text-decoration-none text-dark">
                <img src="${p.image}" class="img-fluid rounded mb-3 w-100" alt="${p.name}" style="height:250px; object-fit:cover;" onerror="this.src='https://via.placeholder.com/300x300?text=Product'"/>
                <h3 class="h6 fw-bold mb-1">${p.name}</h3>
              </a>
              
              <div class="mb-2">
                <span class="rating small">${starsHTML}</span>
                <span class="text-secondary ms-1" style="font-size: 0.8rem;">(${p.reviews} reviews)</span>
              </div>
              
              <div class="mb-2">
                <span class="product-price fs-5">₹${p.price.toFixed(2)}</span>
                ${oldPrice}
              </div>
              
              <div class="mb-3 small text-muted">Sizes: <strong>${sizes}</strong></div>
              
              <button class="btn btn-primary btn-sm w-100 rounded-pill mt-auto" onclick="addToCart(${p.id})">Add to Cart</button>
            </div>
          </article>
        `;
      });
      
      document.getElementById('resultCount').textContent = `Showing 1-${productList.length} of ${productList.length} results`;
    }

    // --- FILTERS & SORTING ---
    function updatePrice(val) {
      document.getElementById('priceValue').innerText = '₹' + val;
    }

    function applyFilters() {
      filterState.keyword = document.getElementById('searchInput').value.trim().toLowerCase();
      filterState.priceLimit = parseFloat(document.getElementById('priceRange').value);
      filterState.sizes = Array.from(document.querySelectorAll('.size-filter:checked')).map(cb => cb.value);
      
      const ratingChecks = Array.from(document.querySelectorAll('.rating-filter:checked')).map(cb => parseInt(cb.value));
      filterState.minRating = ratingChecks.length > 0 ? Math.min(...ratingChecks) : 0;

      let filtered = products.filter(p => {
        let matchesKeyword = p.name.toLowerCase().includes(filterState.keyword);
        let matchesPrice = p.price <= filterState.priceLimit;
        let matchesSize = filterState.sizes.length === 0 || p.size.some(sz => filterState.sizes.includes(sz));
        let matchesRating = filterState.minRating === 0 || p.rating >= filterState.minRating;
        return matchesKeyword && matchesPrice && matchesSize && matchesRating;
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

    // --- CART ---
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
      
      document.getElementById('header-cart-count').textContent = itemCount;
      document.getElementById('header-total').textContent = totalPrice.toFixed(2);
    }

    function showCartModal() {
      const modal = document.getElementById('cartModal');
      const cartItems = document.getElementById('cartItems');
      const modalCartTotal = document.getElementById('modalCartTotal');
      
      if (cart.length === 0) {
        cartItems.innerHTML = '<p class="text-center py-4">Your cart is empty</p>';
      } else {
        cartItems.innerHTML = cart.map(item => `
          <div class="d-flex align-items-center mb-3 p-2 border-bottom">
            <img src="${item.image}" alt="${item.name}" class="rounded me-3" width="60" height="60" style="object-fit:cover;">
            <div class="flex-grow-1">
              <h6 class="mb-0">${item.name}</h6>
              <p class="mb-0 text-muted">₹${item.price.toLocaleString()} x ${item.quantity}</p>
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

    function buyNow() {
      if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
      }
      alert('Proceeding to checkout...');
    }

    // --- INIT & LISTENERS ---
    document.addEventListener('DOMContentLoaded', function() {
      displayProducts(products);
      updateCartUI();
      
      document.getElementById('priceRange').addEventListener('input', function() {
        updatePrice(this.value);
        applyFilters();
      });
      
      document.getElementById('applyBtn').addEventListener('click', applyFilters);
      
      document.getElementById('resetBtn').addEventListener('click', function() {
        document.getElementById('searchInput').value = '';
        document.getElementById('priceRange').value = 1000;
        document.getElementById('priceValue').innerText = '₹1000';
        document.querySelectorAll('.size-filter, .rating-filter').forEach(cb => cb.checked = false);
        document.getElementById('sortSelect').value = 'best';
        
        filterState = { keyword: '', priceLimit: 1000, sizes: [], minRating: 0 };
        currentFilteredProducts = [...products];
        displayProducts(products);
      });
      
      document.querySelectorAll('.size-filter, .rating-filter').forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
      });
      
      document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        applyFilters();
      });
      
      document.getElementById('searchInput').addEventListener('input', applyFilters);
    });
  </script>
</body>
</html>