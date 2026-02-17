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
</head>
<body>
<!-- Header Section -->
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

  <!-- Navigation -->
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
  <!-- Main Content Section --> 

<main class="container-fluid py-4" role="main">
  <section class="row">
    <aside class="col-md-3" role="complementary">
      <div class="sidebar shadow-box p-4 mb-4" aria-label="Product filters">
        <h2 class="h4">Categories</h2>
        <div class="filter-section">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="catMen" checked disabled>
            <label class="form-check-label" for="catMen">Men's Fashion <span class="text-secondary">(20)</span></label>
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
        <div class="filter-buttons">
          <button id="applyBtn" type="button" aria-label="Apply filters">Apply Filters</button>
          <button id="resetBtn" type="button" aria-label="Reset filters">Reset Filters</button>
        </div>
      </div>
    </aside>
    <section class="col-md-9" aria-label="Products">
      <div class="mb-3 d-flex justify-content-between align-items-center">
        <p id="resultCount" class="m-0">Showing 1-20 of 20 results</p>
        <div>
          <label for="sortSelect" class="form-label visually-hidden">Sort products</label>
          <select class="form-select d-inline w-auto" id="sortSelect" style="display:inline-block;" onchange="sortProducts(this.value)">
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

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="cartItems"></div>
      <h5 class="mt-3">Total: ₹<span id="modalCartTotal">0.00</span></h5>
      <div class="modal-footer">
        <button class="btn btn-buy" onclick="buyNow()">Buy Now</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Favorites Modal -->
<div class="modal fade" id="favoritesModal" tabindex="-1" aria-labelledby="favoritesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="favoritesModalLabel">Your Favorites</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="favoritesItems"></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  <!-- Footer Section -->
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
            <button type="submit" class="btn">Subscribe</button>
          </form>
        </div>
      </div>
      <hr class="my-4 bg-light">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <p class="mb-0">&copy; 2023 Electro. All rights reserved.</p>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // --- 1. PRODUCT DATA ---
  const products = [
    { id: 1, name: "Premium Men's Dress Series 7", price: 249.99, old_price: 299.99, rating: 4.5, reviews: 142, tag: 'Sale', image: 'https://i.pinimg.com/736x/76/0f/aa/760faa8086afb8c9d2d5c93715db4ec0.jpg', brand: 'Levis', size: ['M', 'L'] },
    { id: 2, name: "Premium Men's Dress Series 5", price: 179.99, old_price: 0, rating: 4, reviews: 87, tag: 'New', image: 'https://i.pinimg.com/736x/83/20/77/8320778b243c6ba85310486acad071dc.jpg', brand: 'Peter England', size: ['S', 'M', 'L'] },
    { id: 3, name: "Luxury shirt", price: 349.99, old_price: 399.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/c0/d8/28/c0d828a20dabf18765790f22fd2bd23b.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 4, name: "Premium Men's Dress Series 3", price: 399.99, old_price: 499.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/77/10/52/7710525232ffc1e816ead33d6e42d774.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 5, name: "Premium Men's Dress Series 8", price: 299.99, old_price: 369.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/0f/94/96/0f9496deadaff29c0fb556fbdced4a27.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 6, name: "Premium Men's Dress Series 2", price: 399.99, old_price: 479.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/0c/7e/55/0c7e55546c747e433ee53455189dfcab.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 7, name: "Premium Men's Dress Series 5", price: 449.99, old_price: 599.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/83/0b/5f/830b5fa86c2d6c8975adc064d9ca6748.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 8, name: "Premium Men's Dress Series 8", price: 649.99, old_price: 799.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/2e/a6/fe/2ea6fe61dd9411fc5ac5380dabd2139e.jpg', brand: 'Levis', size: ['L', 'XL'] },
    { id: 9, name: "Premium Men's Dress Series 9", price: 649.99, old_price: 699.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/01/14/ac/0114ac8082112da2e1efc45c389a8e9a.jpg', brand: 'Levis', size: ['L', 'XL'] },
  ];
  
  // --- 2. GLOBAL STATE ---
  let cart = JSON.parse(localStorage.getItem('stylehubCart')) || [];
  let currentlyDisplayedProducts = [...products];

  // --- 3. UTILITY FUNCTIONS ---
  
  /**
   * Generates star rating HTML
   * @param {number} rating - The rating value
   * @returns {string} HTML string for star rating
   */
  function generateRatingStars(rating) {
    let starsHTML = '';
    const fullStars = Math.floor(rating);
    const halfStar = (rating % 1) >= 0.5;
    
    for(let i = 1; i <= 5; i++) {
      if(i <= fullStars) {
        starsHTML += '<i class="bi bi-star-fill"></i>';
      } else if(i === fullStars + 1 && halfStar) {
        starsHTML += '<i class="bi bi-star-half"></i>';
      } else {
        starsHTML += '<i class="bi bi-star"></i>';
      }
    }
    return starsHTML;
  }

  /**
   * Shows a toast notification
   * @param {string} message - Message to display
   */
  function showToast(message) {
    let toast = document.getElementById('toast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'toast';
      toast.className = 'toast align-items-center text-white bg-primary border-0 position-fixed bottom-0 end-0 m-3';
      toast.setAttribute('role', 'alert');
      toast.innerHTML = `
        <div class="d-flex">
          <div class="toast-body">${message}</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
      `;
      document.body.appendChild(toast);
    } else {
      toast.querySelector('.toast-body').textContent = message;
    }
    
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
  }

  // --- 4. PRODUCT DISPLAY FUNCTIONS ---
  
  /**
   * Renders a list of products to the page.
   * @param {Array} productList - The array of product objects to display.
   */
  function displayProducts(productList) {
    const container = document.getElementById('productContainer');
    if (!container) return;
    
    container.innerHTML = ''; // Clear existing products
    
    if (productList.length === 0) {
      container.innerHTML = '<p class="text-center">No products match your criteria.</p>';
      const resultCount = document.getElementById('resultCount');
      if (resultCount) resultCount.textContent = 'No results found';
      return;
    }

    productList.forEach(p => {
      const badge = p.tag ? `<span class="badge bg-${p.tag === 'Sale' ? 'danger' : 'success'}">${p.tag}</span>` : '';
      const oldPrice = p.old_price > p.price ? `<span class="product-old">₹${p.old_price.toFixed(2)}</span>` : '';
      const starsHTML = generateRatingStars(p.rating);
      const sizes = p.size.join(", ");

      container.innerHTML += `
        <article class="col-12 col-sm-6 col-md-4" role="listitem">
          <div class="product-card shadow-box position-relative">
            ${badge}
            <img src="${p.image}" class="product-img" alt="${p.name}" />
            <div class="p-3">
              <h3 class="product-title">${p.name}</h3>
              <div>
                <span class="rating">${starsHTML}</span>
                <span class="text-secondary ms-2">(${p.reviews})</span>
              </div>
              <div class="mt-2">
                <span class="product-price">₹${p.price.toFixed(2)}</span>
                ${oldPrice}
              </div>
              <div class="mt-2 mb-2">Available Sizes: <strong>${sizes}</strong></div>
              <div class="button-group">
                <button class="btn btn-outline-primary btn-sm" onclick="viewDetails(${p.id})">View Details</button>
                <button class="btn btn-primary btn-sm" onclick="addToCart(${p.id})">Add to Cart</button>
                <button class="btn btn-outline-secondary btn-sm" onclick="addToFavorites(${p.id})">
                  <i class="bi bi-heart"></i>
                </button>
              </div>
            </div>
          </div>
        </article>
      `;
    });
    
    const resultCount = document.getElementById('resultCount');
    if (resultCount) {
      resultCount.textContent = `Showing ${productList.length} of ${products.length} results`;
    }
    currentlyDisplayedProducts = [...productList];
  }

  /**
   * Navigates to the product detail page.
   * @param {number} productId - The ID of the product to view.
   */
  function viewDetails(productId) {
    window.location.href = `product.php?id=${productId}`;
  }

  // --- 5. CART FUNCTIONS ---
  
  /**
   * Adds a product to the cart
   * @param {number} productId - The ID of the product to add
   */
  function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;
    
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
    
    localStorage.setItem('stylehubCart', JSON.stringify(cart));
    updateCartUI();
    showToast(`${product.name} added to cart!`);
  }

  /**
   * Updates the cart UI elements
   */
  function updateCartUI() {
    const itemCount = cart.reduce((total, item) => total + item.quantity, 0);
    const totalPrice = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    
    const cartCountElement = document.getElementById('header-cart-count');
    const totalElement = document.getElementById('header-total');
    
    if (cartCountElement) cartCountElement.textContent = itemCount;
    if (totalElement) totalElement.textContent = totalPrice.toFixed(2);
  }

  /**
   * Shows the cart modal
   */
  function showCartModal() {
    const modal = document.getElementById('cartModal');
    const cartItems = document.getElementById('cartItems');
    const modalCartTotal = document.getElementById('modalCartTotal');
    
    if (!modal || !cartItems || !modalCartTotal) return;
    
    if (cart.length === 0) {
      cartItems.innerHTML = '<p class="text-center">Your cart is empty</p>';
    } else {
      cartItems.innerHTML = cart.map(item => `
        <div class="d-flex align-items-center mb-3 p-2 border-bottom">
          <img src="${item.image}" alt="${item.name}" class="rounded me-3" width="60" height="60" 
               onerror="this.src='https://via.placeholder.com/60x60?text=Product'">
          <div class="flex-grow-1">
            <h6 class="mb-0">${item.name}</h6>
            <p class="mb-0">₹${item.price.toFixed(2)} x ${item.quantity}</p>
            <p class="mb-0 fw-bold">Subtotal: ₹${(item.price * item.quantity).toFixed(2)}</p>
          </div>
          <div>
            <button class="btn btn-sm btn-outline-secondary me-1" onclick="updateQuantity(${item.id}, -1)">-</button>
            <button class="btn btn-sm btn-outline-secondary me-1" onclick="updateQuantity(${item.id}, 1)">+</button>
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

  /**
   * Updates item quantity in cart
   * @param {number} productId - Product ID
   * @param {number} change - Change in quantity (+1 or -1)
   */
  function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (!item) return;
    
    item.quantity += change;
    
    if (item.quantity <= 0) {
      removeFromCart(productId);
      return;
    }
    
    localStorage.setItem('stylehubCart', JSON.stringify(cart));
    updateCartUI();
    showCartModal(); // Refresh modal
  }

  /**
   * Removes a product from the cart
   * @param {number} productId - The ID of the product to remove
   */
  function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    localStorage.setItem('stylehubCart', JSON.stringify(cart));
    updateCartUI();
    showCartModal(); // Refresh modal
  }

  /**
   * Initiates checkout process
   */
  function buyNow() {
    if (cart.length === 0) {
      alert('Your cart is empty!');
      return;
    }
    
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    alert(`Proceeding to checkout...\nTotal: ₹${total.toFixed(2)}`);
    // In a real application, this would redirect to a checkout page
  }

  // --- 6. FAVORITES FUNCTIONS ---
  
  /**
   * Adds a product to favorites
   * @param {number} productId - The ID of the product to add to favorites
   */
  function addToFavorites(productId) {
    const favorites = JSON.parse(localStorage.getItem('stylehubFavorites')) || [];
    const product = products.find(p => p.id === productId);
    
    if (!product) return;
    
    if (!favorites.find(f => f.id === productId)) {
      favorites.push(product);
      localStorage.setItem('stylehubFavorites', JSON.stringify(favorites));
      updateFavoritesCount();
      showToast(`${product.name} added to favorites!`);
    } else {
      showToast(`${product.name} is already in your favorites!`);
    }
  }

  /**
   * Shows the favorites modal
   */
  function showFavorites() {
    const favorites = JSON.parse(localStorage.getItem('stylehubFavorites')) || [];
    const favoritesItems = document.getElementById('favoritesItems');
    const modal = document.getElementById('favoritesModal');
    
    if (!favoritesItems || !modal) return;
    
    if (favorites.length === 0) {
      favoritesItems.innerHTML = '<p class="text-center">Your favorites list is empty</p>';
    } else {
      favoritesItems.innerHTML = favorites.map(item => `
        <div class="d-flex align-items-center mb-3 p-2 border-bottom">
          <img src="${item.image}" alt="${item.name}" class="rounded me-3" width="60" height="60">
          <div class="flex-grow-1">
            <h6 class="mb-0">${item.name}</h6>
            <p class="mb-0 text-success">₹${item.price.toFixed(2)}</p>
            <div class="rating">${generateRatingStars(item.rating)}</div>
          </div>
          <div>
            <button class="btn btn-sm btn-primary me-2" onclick="addToCart(${item.id}); bootstrap.Modal.getInstance(document.getElementById('favoritesModal')).hide();">
              Add to Cart
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="removeFromFavorites(${item.id})">
              Remove
            </button>
          </div>
        </div>
      `).join('');
    }
    
    new bootstrap.Modal(modal).show();
  }

  /**
   * Removes a product from favorites
   * @param {number} productId - The ID of the product to remove
   */
  function removeFromFavorites(productId) {
    let favorites = JSON.parse(localStorage.getItem('stylehubFavorites')) || [];
    favorites = favorites.filter(item => item.id !== productId);
    localStorage.setItem('stylehubFavorites', JSON.stringify(favorites));
    updateFavoritesCount();
    showFavorites(); // Refresh modal
  }

  /**
   * Updates the favorites count in the UI
   */
  function updateFavoritesCount() {
    const favorites = JSON.parse(localStorage.getItem('stylehubFavorites')) || [];
    const favCountElement = document.getElementById('favCount');
    if (favCountElement) {
      favCountElement.textContent = favorites.length;
    }
  }

  // --- 7. FILTER AND SEARCH FUNCTIONS ---
  
  /**
   * Updates the price display when range slider changes
   * @param {string} val - The new price value
   */
  function updatePrice(val) {
    const priceValueElement = document.getElementById('priceValue');
    if (priceValueElement) {
      priceValueElement.innerText = '₹' + val;
    }
    filterProducts();
  }

  /**
   * Filters products based on current filter settings
   */
  function filterProducts() {
    const searchInput = document.getElementById('searchInput');
    const priceRange = document.getElementById('priceRange');
    const star4 = document.getElementById('star4');
    
    let keyword = searchInput ? searchInput.value.toLowerCase() : '';
    let priceLimit = priceRange ? parseFloat(priceRange.value) : 5000;
    let selectedBrands = Array.from(document.querySelectorAll('.brand-filter:checked')).map(cb => cb.value);
    let selectedSizes = Array.from(document.querySelectorAll('.size-filter:checked')).map(cb => cb.value);
    let starFilter = star4 ? star4.checked : false;

    let filtered = products.filter(p => {
      let matchesSearch = p.name.toLowerCase().includes(keyword);
      let matchesPrice = p.price <= priceLimit;
      let matchesBrand = selectedBrands.length === 0 || selectedBrands.includes(p.brand);
      let matchesSize = selectedSizes.length === 0 || p.size.some(sz => selectedSizes.includes(sz));
      let matchesStar = !starFilter || p.rating >= 4;
      
      return matchesSearch && matchesPrice && matchesBrand && matchesSize && matchesStar;
    });
    
    displayProducts(filtered);
  }

  /**
   * Sorts products based on selected criteria
   * @param {string} sortValue - The sort criteria
   */
  function sortProducts(sortValue) {
    // Get currently displayed products (filtered products)
    let productsToSort = [...currentlyDisplayedProducts];
    
    if(sortValue === 'lowToHigh') {
      productsToSort.sort((a, b) => a.price - b.price);
    } else if(sortValue === 'highToLow') {
      productsToSort.sort((a, b) => b.price - a.price);
    } else if(sortValue === 'best') {
      productsToSort.sort((a, b) => b.rating - a.rating);
    }
    
    displayProducts(productsToSort);
  }

  /**
   * Resets all filters to default values
   */
  function resetFilters() {
    const searchInput = document.getElementById('searchInput');
    const priceRange = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');
    const star4 = document.getElementById('star4');
    const sortSelect = document.getElementById('sortSelect');
    
    if (searchInput) searchInput.value = '';
    if (priceRange) {
      priceRange.value = priceRange.max;
      if (priceValue) priceValue.innerText = '₹' + priceRange.max;
    }
    
    document.querySelectorAll('.brand-filter').forEach(cb => cb.checked = false);
    document.querySelectorAll('.size-filter').forEach(cb => cb.checked = false);
    if (star4) star4.checked = false;
    if (sortSelect) sortSelect.value = 'best';
    
    filterProducts();
  }

  // --- 8. INITIALIZATION ---
  
  /**
   * Initialize the page when DOM is ready
   */
  function initializePage() {
    // Display initial products
    displayProducts(products);
    
    // Update UI counters
    updateCartUI();
    updateFavoritesCount();
    
    // Add event listeners
    const applyBtn = document.getElementById('applyBtn');
    const resetBtn = document.getElementById('resetBtn');
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    
    if (applyBtn) {
      applyBtn.addEventListener('click', filterProducts);
    }
    
    if (resetBtn) {
      resetBtn.addEventListener('click', resetFilters);
    }
    
    if (searchForm) {
      searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        filterProducts();
      });
    }
    
    if (searchInput) {
      searchInput.addEventListener('input', function() {
        // Optional: Add real-time search with debounce
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(filterProducts, 300);
      });
    }
    
    // Add click listener for cart icon in header
    const cartIcon = document.querySelector('.action-icon[href="./cart.php"]');
    if (cartIcon) {
      cartIcon.addEventListener('click', function(e) {
        e.preventDefault();
        showCartModal();
      });
    }
    
    console.log('StyleHub Men\'s Wear page initialized successfully');
  }

  // --- 9. EVENT LISTENERS ---
  
  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializePage);
  } else {
    initializePage();
  }

  // Handle page visibility changes to update cart from other tabs
  document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
      cart = JSON.parse(localStorage.getItem('stylehubCart')) || [];
      updateCartUI();
      updateFavoritesCount();
    }
  });

</script>
</body>

</html>