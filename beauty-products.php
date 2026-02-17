<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetching only Makeup products
    $stmt = $pdo->query("SELECT * FROM products WHERE category = 'Makeup'");
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
  <title>StyleHub | Makeup Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/beauty-products.css" />
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
          <form class="search-form">
            <input class="form-control search-input" type="search" id="searchInput" placeholder="Search for products..." aria-label="Search">
            <button class="search-btn" type="button" onclick="filterProducts()"><i class="bi bi-search"></i></button>
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
    <aside class="col-md-3" role="complementary" aria-label="Product filters">
      <div class="sidebar shadow-box p-4 mb-4">
        <h2 class="h4 mb-4">Filters</h2>
        <section class="filter-section mb-4" aria-label="Price filter">
          <h3 class="h5"><i class="bi bi-currency-rupee me-2"></i>Price Range</h3>
          <input id="priceRange" type="range" min="0" max="1000" value="1000" step="10" class="form-range" aria-label="Filter by price range" />
          <div class="d-flex justify-content-between mt-2 mb-0" style="font-weight: 600; font-size: 0.95rem;">
            <span>₹0</span>
            <span id="priceValue">₹1000</span>
          </div>
        </section>
        <section class="filter-section mb-4" aria-label="Category filter">
          <h3 class="h5">Category</h3>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="skincare" value="Skincare" />
            <label class="form-check-label" for="skincare">Skincare</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="haircare" value="Haircare" />
            <label class="form-check-label" for="haircare">Haircare</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="fragrance" value="Fragrance" />
            <label class="form-check-label" for="fragrance">Fragrance</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="makeup" value="Makeup" checked />
            <label class="form-check-label" for="makeup">Makeup</label>
          </div>
        </section>
        <section class="filter-section" aria-label="Rating filter">
          <h3 class="h5">Rating</h3>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="star4" />
            <label class="form-check-label" for="star4">4 stars &amp; above</label>
          </div>
        </section>
        <div class="filter-buttons">
          <button id="applyBtn" type="button">Apply Filters</button>
          <button id="resetBtn" type="button">Reset Filters</button>
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
  // Global variables
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  
  // UPDATED: Products array now contains only MAKEUP items with correct placeholder images
  let products = [
    { 
      id: 4, 
      name: "Matte Red Lipstick", 
      price: 600, 
      category: "Makeup", 
      rating: 4.8, 
      reviews: 130, 
      image: "https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400&q=80" 
    },
    { 
      id: 6, 
      name: "Liquid Foundation", 
      price: 850, 
      category: "Makeup", 
      rating: 4.6, 
      reviews: 210, 
      image: "./assest/img/foundation.jpg"
    },
    { 
      id: 7, 
      name: "Volume Mascara", 
      price: 450, 
      category: "Makeup", 
      rating: 4.3, 
      reviews: 95, 
      image: "./assest/img/mascara.jpg"
    },
    { 
      id: 8, 
      name: "Black Eyeliner", 
      price: 300, 
      category: "Makeup", 
      rating: 4.5, 
      reviews: 320, 
      image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&q=80" 
    }
  ];

  let filterState = {
    keyword: "",
    priceLimit: 1000,
    categories: [], 
    minRating: 0
  };

  // Initialize the page
  document.addEventListener('DOMContentLoaded', function() {
    displayProducts(products); 
    updatePrice(document.getElementById("priceRange").value);
    updateCartUI();
    updateFavoritesCount();
    
    // Add event listeners
    document.getElementById("searchInput").addEventListener("input", filterProducts);
    document.getElementById("searchInput").addEventListener("keypress", function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        filterProducts();
      }
    });
    
    document.getElementById("priceRange").addEventListener("input", function(e) {
      updatePrice(e.target.value);
      filterProducts();
    });
    
    document.querySelectorAll(".size-filter, #star4").forEach(el => {
      el.addEventListener("change", filterProducts);
    });
    
    document.getElementById("applyBtn").addEventListener("click", filterProducts);
    
    document.getElementById("resetBtn").addEventListener("click", function() {
      document.getElementById("searchInput").value = "";
      document.getElementById("priceRange").value = 1000;
      updatePrice(1000);
      
      document.querySelectorAll(".size-filter, #star4").forEach(cb => cb.checked = false);
      // Optional: re-check makeup if you strictly want it always checked on reset
      // document.getElementById("makeup").checked = true; 
      
      filterState = {
        keyword: "",
        priceLimit: 1000,
        categories: [],
        minRating: 0
      };
      displayProducts(products);
    });
    
    document.getElementById("sortSelect").addEventListener("change", function() {
      sortProducts(this.value);
    });
  });

  function updatePrice(value) {
    document.getElementById("priceValue").textContent = `₹${value}`;
    filterState.priceLimit = parseInt(value);
  }

  function displayProducts(productsToDisplay) {
    const container = document.getElementById("productContainer");
    container.innerHTML = "";
    
    if(productsToDisplay.length === 0) {
      container.innerHTML = '<div class="col-12 text-center py-5"><h3>No products found</h3><p>Try adjusting your filters</p></div>';
      document.getElementById("resultCount").textContent = "No products found";
      return;
    }
    
    productsToDisplay.forEach(p => {
      const stars = "★★★★★".slice(0, Math.floor(p.rating)) + (p.rating % 1 >= 0.5 ? "½" : "");
      container.innerHTML += `
        <article class="col-12 col-sm-6 col-md-4 col-lg-3" role="listitem">
          <div class="product-card shadow-box position-relative">
            <img src="${p.image}" alt="${p.name}" class="product-img" style="object-fit: cover; height: 250px; width: 100%;" />
            <div class="p-3 d-flex flex-column" style="height: 200px;">
              <h3 class="product-title">${p.name}</h3>
              <div>
                <span class="rating" aria-label="${p.rating} stars">${stars}</span>
                <span class="text-secondary ms-2">(${p.reviews})</span>
              </div>
              <div class="mt-2 mb-3"><span class="product-price">₹${p.price}</span></div>
              <div class="button-group mt-auto d-flex gap-2">
                <button type="button" class="btn btn-outline-primary btn-sm flex-fill" onclick="viewDetails(${p.id})">View Details</button>
                <button type="button" class="btn btn-primary btn-sm flex-fill" onclick="addToCart(${p.id})">Add to Cart</button>
              </div>
            </div>
          </div>
        </article>
      `;
    });
    document.getElementById("resultCount").textContent = `Showing ${productsToDisplay.length} products`;
  }

  function filterProducts() {
    filterState.keyword = document.getElementById("searchInput").value.trim().toLowerCase();
    filterState.categories = Array.from(document.querySelectorAll(".size-filter:checked")).map(cb => cb.value);
    filterState.minRating = document.getElementById("star4").checked ? 4 : 0;

    const filtered = products.filter(p => {
      const matchesKeyword = p.name.toLowerCase().includes(filterState.keyword);
      const matchesPrice = p.price <= filterState.priceLimit;
      const matchesCategory = filterState.categories.length === 0 || filterState.categories.includes(p.category);
      const matchesRating = p.rating >= filterState.minRating;
      return matchesKeyword && matchesPrice && matchesCategory && matchesRating;
    });

    displayProducts(filtered);
  }

  function sortProducts(sortBy) {
    let filteredProducts = [...products]; // Start with all products
    
    // Apply current filters first
    filteredProducts = filteredProducts.filter(p => {
      const matchesKeyword = p.name.toLowerCase().includes(filterState.keyword);
      const matchesPrice = p.price <= filterState.priceLimit;
      const matchesCategory = filterState.categories.length === 0 || filterState.categories.includes(p.category);
      const matchesRating = p.rating >= filterState.minRating;
      return matchesKeyword && matchesPrice && matchesCategory && matchesRating;
    });
    
    // Then sort
    switch(sortBy) {
      case 'lowToHigh':
        filteredProducts.sort((a, b) => a.price - b.price);
        break;
      case 'highToLow':
        filteredProducts.sort((a, b) => b.price - a.price);
        break;
      default:
        // Default sorting
        break;
    }
    
    displayProducts(filteredProducts);
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

  function addToFavorites(productId) {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const product = products.find(p => p.id === productId);
    
    if (!favorites.find(f => f.id === productId)) {
      favorites.push(product);
      localStorage.setItem('favorites', JSON.stringify(favorites));
      updateFavoritesCount();
      showToast(`${product.name} added to favorites!`);
    } else {
      showToast(`${product.name} is already in your favorites!`);
    }
  }

  function updateFavoritesCount() {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    document.getElementById('favCount').textContent = favorites.length;
  }

  function viewDetails(productId) {
    const product = products.find(p => p.id === productId);
    showToast(`Viewing details for ${product.name}`);
  }

  function showToast(message) {
    const toastContainer = document.getElementById('toastContainer');
    const toastId = 'toast-' + Date.now();
    
    const toastHTML = `
      <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">StyleHub</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          ${message}
        </div>
      </div>
    `;
    
    toastContainer.insertAdjacentHTML('beforeend', toastHTML);
    
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
    toast.show();
    
    toastElement.addEventListener('hidden.bs.toast', function() {
      toastElement.remove();
    });
  }
</script>
</body>
</html>