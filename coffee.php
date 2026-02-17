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
  <title>BrewHub | Premium Tea & Coffee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/tea.css">
</head>
<body>
<!-- Header Section -->
  <header class="main-header">
    <div class="container py-3">
      <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-6">
          <div class="d-flex align-items-center">
            <span class="brand-icon"><i class="bi bi-cup-hot"></i></span>
            <span class="brand-logo">BrewHub</span>
          </div>
        </div>
        <div class="col-lg-6 col-md-5 d-none d-md-block">
          <form class="search-form">
            <input id="searchInput" class="form-control search-input" type="search" placeholder="Search for products..." aria-label="Search">
            <button class="search-btn" type="button" onclick="filterProducts()"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
          <div class="d-flex align-items-center justify-content-end header-actions">
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-arrow-repeat"></i></a>
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-heart"></i><span class="cart-badge">0</span></a>
            <a href="cart.php" class="action-icon position-relative"><i class="bi bi-cart3"></i><span class="cart-badge" id="header-cart-count">0</span></a>
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
            <a class="nav-link" href="index.php"><i class="bi bi-house me-1"></i> Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-cup-straw me-1"></i> Tea & Coffee
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="tea-products.php">Premium Teas</a></li>
              <li><a class="dropdown-item" href="coffee-products.php">Specialty Coffee</a></li>
              <li><a class="dropdown-item" href="accessories.php">Brewing Accessories</a></li>
            </ul>
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
    <aside class="col-md-3" role="complementary" aria-label="Product filters">
      <div class="sidebar shadow-box p-4 mb-4">
        <h2 class="h4 mb-4">Filters</h2>
        <section class="filter-section mb-4" aria-label="Price filter">
          <h3 class="h5"><i class="bi bi-currency-rupee me-2"></i>Price Range</h3>
          <input id="priceRange" type="range" min="0" max="5000" value="5000" step="100" class="form-range" aria-label="Filter by price range" />
          <div class="d-flex justify-content-between mt-2 mb-0" style="font-weight: 600; font-size: 0.95rem;">
            <span>₹0</span>
            <span id="priceValue">₹5000</span>
          </div>
        </section>
        <section class="filter-section mb-4" aria-label="Category filter">
          <h3 class="h5">Category</h3>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="tea" value="Tea" />
            <label class="form-check-label" for="tea">Tea</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="coffee" value="Coffee" />
            <label class="form-check-label" for="coffee">Coffee</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input size-filter" id="accessories" value="Accessories" />
            <label class="form-check-label" for="accessories">Brewing Accessories</label>
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
        <select class="form-select d-inline w-auto" id="sortSelect" onchange="sortProducts(this.value)" aria-label="Sort products">
          <option value="default">Sort by</option>
          <option value="lowToHigh">Price - Low to High</option>
          <option value="highToLow">Price - High to Low</option>
        </select>
      </div>
      <div class="row g-4" id="productContainer" role="list"></div>
    </section>
  </section>
</main>

 <!-- Footer Section -->
  <footer class="footer-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h2 class="footer-brand-text mb-3">BrewHub</h2>
          <p class="mb-4">We offer the finest selection of premium teas and specialty coffees with fast shipping and excellent customer service.</p>
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
            <li><a href="#">Tea Collections</a></li>
            <li><a href="#">Coffee Beans</a></li>
            <li><a href="#">Brewing Equipment</a></li>
            <li><a href="#">Gift Sets</a></li>
            <li><a href="#">Subscription Boxes</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 mb-md-0 footer-links">
          <h5>Customer Service</h5>
          <ul>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Returns & Exchanges</a></li>
            <li><a href="#">Shipping & Delivery</a></li>
            <li><a href="#">Brewing Guides</a></li>
            <li><a href="#">FAQ</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4 footer-newsletter">
          <h5 class="mb-3">Newsletter</h5>
          <p>Subscribe to get special offers, brewing tips, and new product alerts.</p>
          <form>
            <input type="email" class="form-control mb-3" placeholder="Your email address">
            <button type="submit" class="btn">Subscribe</button>
          </form>
        </div>
      </div>
      <hr class="my-4 bg-light">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <p class="mb-0">&copy; 2023 BrewHub. All rights reserved.</p>
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
  const products = [
    { id: 1, name: "Earl Grey Premium Tea", price: 850, category: "Tea", rating: 4.7, reviews: 120, image: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
    { id: 2, name: "Ethiopian Yirgacheffe Coffee", price: 1200, category: "Coffee", rating: 4.8, reviews: 95, image: "https://images.unsplash.com/photo-1587734195503-904fca47e0e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
    { id: 3, name: "Ceramic Teapot Set", price: 1800, category: "Accessories", rating: 4.5, reviews: 65, image: "./ASSEST/img/teapot.jpg" },
    { id: 4, name: "Japanese Matcha Green Tea", price: 950, category: "Tea", rating: 4.9, reviews: 150, image: "https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
    { id: 5, name: "French Press Coffee Maker", price: 2200, category: "Accessories", rating: 4.6, reviews: 80, image: "https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
    { id: 6, name: "Colombian Supremo Coffee", price: 1100, category: "Coffee", rating: 4.7, reviews: 110, image: "https://images.unsplash.com/photo-1587734195503-904fca47e0e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
    { id: 7, name: "Chamomile Herbal Tea", price: 650, category: "Tea", rating: 4.4, reviews: 75, image: "./ASSEST/img/herbal.jpg" },
    { id: 8, name: "Coffee Grinder", price: 1500, category: "Accessories", rating: 4.3, reviews: 60, image: "./ASSEST/img/grinder.jpg" },
    { id: 9, name: "Assam Black Tea", price: 750, category: "Tea", rating: 4.6, reviews: 90, image: "https://images.unsplash.com/photo-1571934811356-5cc061b6821f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" }
  ];

  let filterState = {
    keyword: "",
    priceLimit: 5000,
    categories: [],
    minRating: 0
  };

  function displayProducts(filteredProducts) {
    const container = document.getElementById("productContainer");
    container.innerHTML = "";
    if(filteredProducts.length === 0) {
      document.getElementById("resultCount").textContent = "No products found.";
      return;
    }
    filteredProducts.forEach(p => {
      const stars = "★★★★★".slice(0, Math.floor(p.rating)) + (p.rating % 1 >= 0.5 ? "½" : "");
      container.innerHTML += `
        <article class="col-12 col-sm-6 col-md-4" role="listitem">
          <div class="product-card shadow-box position-relative">
            <img src="${p.image}" alt="${p.name}" class="product-img" />
            <div class="p-3">
              <h3 class="product-title">${p.name}</h3>
              <div>
                <span class="rating" aria-label="${p.rating} stars">${stars}</span>
                <span class="text-secondary ms-2">(${p.reviews})</span>
              </div>
              <div class="mt-2 mb-3"><span class="product-price">₹${p.price}</span></div>
              <div class="button-group mt-auto">
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="viewDetails(${p.id})">View Details</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="addToCart(${p.id})">Add to Cart</button>
              </div>
            </div>
          </div>
        </article>
      `;
    });
    document.getElementById("resultCount").textContent = `Showing ${filteredProducts.length} products`;
  }

  function filterProducts() {
    filterState.keyword = document.getElementById("searchInput").value.trim().toLowerCase();
    filterState.priceLimit = +document.getElementById("priceRange").value;
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

  function sortProducts(sortType) {
    let sortedProducts = [...products];
    
    if (sortType === 'lowToHigh') {
      sortedProducts.sort((a, b) => a.price - b.price);
    } else if (sortType === 'highToLow') {
      sortedProducts.sort((a, b) => b.price - a.price);
    }
    
    displayProducts(sortedProducts);
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

    function quickView(productId) {
      const product = products.find(p => p.id === productId);
      const modalContent = `
        <div class="modal fade" id="quickViewModal" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">${product.name}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="${product.image}" class="img-fluid" alt="${product.name}" onerror="this.src='https://via.placeholder.com/400x400?text=Product+Image'">
                  </div>
                  <div class="col-md-6">
                    <h4>₹${product.price.toLocaleString()}</h4>
                    ${product.old_price ? `<p class="text-muted"><s>₹${product.old_price.toLocaleString()}</s></p>` : ''}
                    <p>${generateRatingStars(product.rating)} (${product.reviews} reviews)</p>
                    <p><strong>Brand:</strong> ${product.brand}</p>
                    <p><strong>Material:</strong> ${product.material.join(', ')}</p>
                    <button class="btn btn-primary w-100 mt-3" onclick="addToCart(${product.id}); bootstrap.Modal.getInstance(document.getElementById('quickViewModal')).hide();">Add to Cart</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      
      // Remove existing modal if any
      const existingModal = document.getElementById('quickViewModal');
      if (existingModal) {
        existingModal.remove();
      }
      
      document.body.insertAdjacentHTML('beforeend', modalContent);
      const quickViewModal = new bootstrap.Modal(document.getElementById('quickViewModal'));
      quickViewModal.show();
    }

    function buyNow() {
      if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
      }
      
      alert('Proceeding to checkout...');
      // In a real application, this would redirect to a checkout page
    }

    function showToast(message) {
      // Create toast element if it doesn't exist
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

  function updatePrice(val) {
    document.getElementById("priceValue").textContent = "₹" + val;
    filterProducts();
  }

  // Event Listeners
  document.getElementById("priceRange").addEventListener("input", e => updatePrice(e.target.value));
  document.querySelectorAll(".size-filter, #star4").forEach(el => el.addEventListener("change", filterProducts));
  document.getElementById("applyBtn").addEventListener("click", filterProducts);
  document.getElementById("resetBtn").addEventListener("click", () => {
    document.getElementById("searchInput").value = "";
    document.getElementById("priceRange").value = 5000;
    document.getElementById("priceValue").textContent = "₹5000";
    document.querySelectorAll(".size-filter, #star4").forEach(cb => cb.checked = false);
    document.getElementById("sortSelect").value = "default";
    filterProducts();
  });

  // Search on Enter key
  document.getElementById("searchInput").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
      filterProducts();
    }
  });

  window.onload = () => {
    displayProducts(products);
    updatePrice(document.getElementById("priceRange").value);
  };
</script>
</body>
</html>