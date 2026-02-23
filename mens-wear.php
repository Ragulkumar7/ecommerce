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
  <title>StyleHub | Men's Fashion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/mens-wear.css" />
  <style>
    /* --- NAVIGATION VISIBILITY FIX --- */
    .main-navbar .nav-link {
        color: white !important; /* Forces the text to be white */
        font-weight: 500;
    }

    .main-navbar .nav-link:hover {
        color: rgba(255, 255, 255, 0.8) !important; /* Slight fade on hover for better UX */
    }

    /* Clean Product Card Style matching your other pages */
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

    /* Target Add to Cart button color */
    .clean-product-card .btn-primary {
        background-color: #6F4AA2 !important;
        border-color: #6F4AA2 !important;
    }
    
    .clean-product-card .btn-primary:hover {
        background-color: #5a3a80 !important; 
        border-color: #5a3a80 !important;
    }

    /* Target Price Text color to match */
    .text-primary {
        color: #6F4AA2 !important;
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
            <input class="form-control search-input" type="search" id="searchInput" placeholder="Search for products..." aria-label="Search">
            <button class="search-btn" type="submit"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
          <div class="d-flex align-items-center justify-content-end header-actions">
            <a href="#" class="action-icon me-3 position-relative text-dark"><i class="bi bi-arrow-repeat fs-4"></i></a>
            <a href="#" class="action-icon me-3 position-relative text-dark" onclick="showFavorites()">
              <i class="bi bi-heart fs-4"></i>
              <span class="cart-badge badge rounded-pill position-absolute top-0 start-100 translate-middle bg-danger" id="favCount">0</span>
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
            <a class="nav-link" href="index.php"><i class="bi bi-house me-1"></i> Home</a>
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
              <i class="bi bi-person me-1 active"></i> Fashion
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
    <aside class="col-md-3" role="complementary">
      <div class="sidebar shadow-box p-4 mb-4" aria-label="Product filters">
        <h2 class="h4">Categories</h2>
        <div class="filter-section">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="catMen" checked disabled>
            <label class="form-check-label" for="catMen">Men's Fashion <span class="text-secondary">(9)</span></label>
          </div>
        </div>
        <h3 class="h5 mt-4 mb-3">Price Range</h3>
        <input id="priceRange" type="range" min="0" max="5000" value="5000" step="50" class="form-range" oninput="updatePrice(this.value)" aria-valuemin="0" aria-valuemax="5000" aria-valuenow="5000" aria-label="Filter by price range" />
        <div class="d-flex justify-content-between mb-3">
          <span>₹0</span>
          <span id="priceValue">₹5000</span>
        </div>
        <div class="filter-section">
          <h3 class="h5">Brand</h3>
          <div class="form-check"><input type="checkbox" class="form-check-input brand-filter" id="brand1" value="Levis" onchange="filterProducts()"><label class="form-check-label" for="brand1">Levis</label></div>
          <div class="form-check"><input type="checkbox" class="form-check-input brand-filter" id="brand2" value="Peter England" onchange="filterProducts()"><label class="form-check-label" for="brand2">Peter England</label></div>
        </div>
        <div class="filter-section">
          <h3 class="h5">Size</h3>
          <div class="form-check form-check-inline"><input type="checkbox" class="form-check-input size-filter" id="sizeS" value="S" onchange="filterProducts()"><label for="sizeS" class="form-check-label">S</label></div>
          <div class="form-check form-check-inline"><input type="checkbox" class="form-check-input size-filter" id="sizeM" value="M" onchange="filterProducts()"><label for="sizeM" class="form-check-label">M</label></div>
          <div class="form-check form-check-inline"><input type="checkbox" class="form-check-input size-filter" id="sizeL" value="L" onchange="filterProducts()"><label for="sizeL" class="form-check-label">L</label></div>
          <div class="form-check form-check-inline"><input type="checkbox" class="form-check-input size-filter" id="sizeXL" value="XL" onchange="filterProducts()"><label for="sizeXL" class="form-check-label">XL</label></div>
        </div>
        <div class="filter-section">
          <h3 class="h5">Rating</h3>
          <div class="form-check"><input type="checkbox" class="form-check-input" id="star4" onchange="filterProducts()"><label class="form-check-label" for="star4">4 stars & above</label></div>
        </div>
        <div class="filter-buttons mt-3">
          <button id="applyBtn" type="button" class="btn btn-primary w-100 rounded-pill mb-2" aria-label="Apply filters" style="background-color: #6F4AA2; border: none;">Apply Filters</button>
          <button id="resetBtn" type="button" class="btn btn-light border w-100 rounded-pill" aria-label="Reset filters">Reset Filters</button>
        </div>
      </div>
    </aside>
    <section class="col-md-9" aria-label="Products">
      <div class="mb-3 d-flex justify-content-between align-items-center">
        <p id="resultCount" class="m-0 text-muted">Showing results</p>
        <div>
          <select class="form-select w-auto" id="sortSelect" onchange="sortProducts(this.value)">
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
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="cartItems"></div>
      <h5 class="mt-3 px-3">Total: ₹<span id="modalCartTotal">0.00</span></h5>
      <div class="modal-footer">
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
          <form>
            <input type="email" class="form-control mb-3" placeholder="Your email address">
            <button type="submit" class="btn btn-primary" style="background-color: #6F4AA2; border: none;">Subscribe</button>
          </form>
        </div>
      </div>
      <hr class="my-4 bg-light">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <p class="mb-0">&copy; 2023 StyleHub. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <a href="#" class="text-light me-3">Privacy Policy</a>
          <a href="#" class="text-light">Cookie Policy</a>
        </div>
      </div>
    </div>
  </footer>

  <div id="toastContainer" aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 9999"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const products = [
    { id: 501, name: "Premium Men's Dress Series 7", price: 249.99, old_price: 299.99, rating: 4.5, reviews: 142, tag: 'Sale', image: 'https://i.pinimg.com/736x/76/0f/aa/760faa8086afb8c9d2d5c93715db4ec0.jpg', brand: 'Levis', size: ['M', 'L'] },
    { id: 502, name: "Premium Men's Dress Series 5", price: 179.99, old_price: 0, rating: 4, reviews: 87, tag: 'New', image: 'https://i.pinimg.com/736x/83/20/77/8320778b243c6ba85310486acad071dc.jpg', brand: 'Peter England', size: ['S', 'M', 'L'] },
    { id: 503, name: "Luxury shirt", price: 349.99, old_price: 399.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/c0/d8/28/c0d828a20dabf18765790f22fd2bd23b.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 504, name: "Premium Men's Dress Series 3", price: 399.99, old_price: 499.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/77/10/52/7710525232ffc1e816ead33d6e42d774.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 505, name: "Premium Men's Dress Series 8", price: 299.99, old_price: 369.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/0f/94/96/0f9496deadaff29c0fb556fbdced4a27.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 506, name: "Premium Men's Dress Series 2", price: 399.99, old_price: 479.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/0c/7e/55/0c7e55546c747e433ee53455189dfcab.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 507, name: "Premium Men's Dress Series 5", price: 449.99, old_price: 599.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/83/0b/5f/830b5fa86c2d6c8975adc064d9ca6748.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 508, name: "Premium Men's Dress Series 8", price: 649.99, old_price: 799.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/2e/a6/fe/2ea6fe61dd9411fc5ac5380dabd2139e.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 509, name: "Premium Men's Dress Series 9", price: 649.99, old_price: 699.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/01/14/ac/0114ac8082112da2e1efc45c389a8e9a.jpg', brand: 'Levis', size: ['L', 'XL'] },
  ];
  
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  let currentlyDisplayedProducts = [...products];

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
      container.innerHTML = '<p class="text-center w-100 py-5">No products match your criteria.</p>';
      document.getElementById('resultCount').textContent = 'No results found';
      return;
    }

    productList.forEach(p => {
      const badge = p.tag ? `<span class="badge bg-${p.tag === 'Sale' ? 'danger' : 'success'} position-absolute" style="top:10px; right:10px; z-index:2;">${p.tag}</span>` : '';
      const oldPrice = p.old_price > p.price ? `<span class="text-muted text-decoration-line-through small ms-2">₹${p.old_price.toFixed(2)}</span>` : '';
      const starsHTML = generateRatingStars(p.rating);
      const sizes = p.size.join(", ");
      container.innerHTML += `
        <article class="col-12 col-sm-6 col-md-4" role="listitem">
          <div class="clean-product-card shadow-sm position-relative d-flex flex-column h-100 p-3">
            ${badge}
            <a href="product-details.php?id=${p.id}" class="text-decoration-none text-dark">
              <img src="${p.image}" class="img-fluid rounded mb-3 w-100" alt="${p.name}" style="height:250px; object-fit:cover;" onerror="this.src='https://via.placeholder.com/300x300?text=Product+Image'"/>
              <h3 class="h6 fw-bold mb-1">${p.name}</h3>
            </a>
            <div class="mb-2">
              <span class="rating small">${starsHTML}</span>
              <span class="text-secondary ms-1" style="font-size: 0.8rem;">(${p.reviews} reviews)</span>
            </div>
            <div class="mb-2">
              <span class="text-primary fw-bold fs-5">₹${p.price.toFixed(2)}</span>
              ${oldPrice}
            </div>
            <div class="mb-3 small text-muted">Sizes: <strong>${sizes}</strong></div>
            <button class="btn btn-primary btn-sm w-100 rounded-pill mt-auto" onclick="addToCart(${p.id})">Add to Cart</button>
          </div>
        </article>
      `;
    });
    
    document.getElementById('resultCount').textContent = `Showing ${productList.length} products`;
    currentlyDisplayedProducts = [...productList];
  }

  function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);
    if (existingItem) { existingItem.quantity += 1; } 
    else { cart.push({ id: product.id, name: product.name, price: product.price, image: product.image, quantity: 1 }); }
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

  function showToast(message) {
    let toast = document.getElementById('toast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'toast';
      toast.className = 'toast align-items-center text-white bg-dark border-0 position-fixed bottom-0 end-0 m-3';
      toast.setAttribute('role', 'alert');
      toast.innerHTML = `<div class="d-flex"><div class="toast-body">${message}</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>`;
      document.body.appendChild(toast);
    } else {
      toast.querySelector('.toast-body').textContent = message;
    }
    new bootstrap.Toast(toast).show();
  }

  function updatePrice(val) {
    document.getElementById('priceValue').innerText = '₹' + val;
  }

  function filterProducts() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const priceLimit = parseFloat(document.getElementById('priceRange').value);
    const selectedSizes = Array.from(document.querySelectorAll('.size-filter:checked')).map(cb => cb.value);

    let filtered = products.filter(p => {
      let matchesSearch = p.name.toLowerCase().includes(searchInput);
      let matchesPrice = p.price <= priceLimit;
      let matchesSize = selectedSizes.length === 0 || p.size.some(sz => selectedSizes.includes(sz));
      return matchesSearch && matchesPrice && matchesSize;
    });
    
    displayProducts(filtered);
  }

  function sortProducts(sortValue) {
    let productsToSort = [...currentlyDisplayedProducts];
    if(sortValue === 'lowToHigh') productsToSort.sort((a, b) => a.price - b.price);
    else if(sortValue === 'highToLow') productsToSort.sort((a, b) => b.price - a.price);
    displayProducts(productsToSort);
  }

  document.getElementById('applyBtn').addEventListener('click', filterProducts);
  document.getElementById('resetBtn').addEventListener('click', () => location.reload());
  
  window.onload = () => {
    displayProducts(products);
    updateCartUI();
  };
</script>
</body>
</html>