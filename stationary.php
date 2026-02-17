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
    // If database fails, use sample data
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
        <form class="search-form">
          <input id="searchInput" class="form-control search-input" type="search" placeholder="Search for products..." aria-label="Search">
          <button class="search-btn" type="submit"><i class="bi bi-search"></i></button>
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
    <aside class="col-md-3" role="complementary" aria-label="Product filters">
      <div class="sidebar shadow-box p-4 mb-4">
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

<!-- Footer -->
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

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Your Shopping Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="cartItems"></div>
        <div class="d-flex justify-content-between align-items-center mt-3">
          <h5>Total: ₹<span id="modalCartTotal">0.00</span></h5>
          <button class="btn btn-primary" onclick="buyNow()">Checkout</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Use PHP products if available, otherwise use sample data
  const products = <?php echo !empty($products) ? json_encode($products) : '[
    { id: 1, name: "Gel Pen Set", price: 150, rating: 4.5, reviews: 120, category: "Pen", image: "https://i.pinimg.com/1200x/18/dd/a7/18dda7156ace505cf245e0d58705a218.jpg" },
    { id: 2, name: "Spiral Notebook", price: 80, rating: 4.2, reviews: 90, category: "Notebook", image: "https://i.pinimg.com/736x/ed/8d/16/ed8d1658bb2f25a9ef4688fd6413ab06.jpg" },
    { id: 3, name: "White Eraser", price: 20, rating: 4.0, reviews: 40, category: "Eraser", image: "https://i.pinimg.com/736x/f2/d1/23/f2d123ab237f8577f87bb10967abfd6a.jpg" },
    { id: 4, name: "Permanent Marker", price: 120, rating: 4.7, reviews: 140, category: "Marker", image: "https://i.pinimg.com/736x/19/0f/ab/190fabd11ddbcbc63dbe23c9478c1d86.jpg" },
    { id: 5, name: "Ballpoint Pen", price: 100, rating: 4.3, reviews: 70, category: "Pen", image: "https://i.pinimg.com/1200x/a7/56/23/a75623f1ee5b4059967682858ed4e4cc.jpg" }
  ]' ?>;

  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  let filterState = {
    keyword: '',
    priceLimit: 150,
    categories: [],
    minRating: 0
  };

  function displayProducts(productsList) {
    const container = document.getElementById("productContainer");
    container.innerHTML = "";
    
    if (productsList.length === 0) {
      document.getElementById("resultCount").textContent = "No products found.";
      container.innerHTML = '<div class="col-12 text-center py-5"><h3>No products match your criteria</h3><p>Try adjusting your filters</p></div>';
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
          <div class="product-card shadow-box position-relative">
            <img src="${p.image}" alt="${p.name}" class="product-img" />
            <div class="p-3">
              <h3 class="product-title">${p.name}</h3>
              <div><span class="rating" aria-label="${p.rating} stars">${starsHTML}</span> <span class="text-secondary ms-2">(${p.reviews})</span></div>
              <div class="mt-2 mb-3"><span class="product-price">₹${p.price}</span></div>
              <div class="button-group">
                <button class="btn btn-outline-primary btn-sm" onclick="quickView(${p.id})">Quick View</button>
                <button class="btn btn-primary btn-sm" onclick="addToCart(${p.id})">Add to Cart</button>
              </div>
            </div>
          </div>
        </article>
      `;
    });
    
    document.getElementById("resultCount").textContent = `Showing ${productsList.length} product${productsList.length !== 1 ? 's' : ''}`;
  }

  function applyFilters() {
    filterState.keyword = document.getElementById('searchInput').value.trim().toLowerCase();
    filterState.priceLimit = +document.getElementById('priceRange').value;
    filterState.categories = Array.from(document.querySelectorAll('.size-filter:checked')).map(cb => cb.value);
    filterState.minRating = document.getElementById('star4').checked ? 4 : 0;

    const filtered = products.filter(p => {
      const matchesKeyword = p.name.toLowerCase().includes(filterState.keyword);
      const matchesPrice = p.price <= filterState.priceLimit;
      const matchesCategory = filterState.categories.length === 0 || filterState.categories.includes(p.category);
      const matchesRating = filterState.minRating === 0 || p.rating >= filterState.minRating;
      return matchesKeyword && matchesPrice && matchesCategory && matchesRating;
    });
    
    // Apply sorting after filtering
    const sortValue = document.getElementById('sortSelect').value;
    sortProducts(sortValue, filtered);
  }

  function sortProducts(sortValue, productsToSort = null) {
    let productsList = productsToSort || products;
    
    if(sortValue === 'lowToHigh') {
      productsList = [...productsList].sort((a,b) => a.price - b.price);
    } else if(sortValue === 'highToLow') {
      productsList = [...productsList].sort((a,b) => b.price - a.price);
    }
    
    displayProducts(productsList);
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
    const cartItems = document.getElementById('cartItems');
    const modalCartTotal = document.getElementById('modalCartTotal');
    
    if (cart.length === 0) {
      cartItems.innerHTML = '<p class="text-center">Your cart is empty</p>';
    } else {
      cartItems.innerHTML = cart.map(item => `
        <div class="d-flex align-items-center mb-3 p-2 border-bottom">
          <img src="${item.image}" alt="${item.name}" class="rounded me-3" width="60" height="60" style="object-fit: cover;" onerror="this.src='https://via.placeholder.com/60x60?text=Product'">
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
    
    const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
    cartModal.show();
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
    
    // Remove existing modal if any
    const existingModal = document.getElementById('quickViewModal');
    if (existingModal) {
      existingModal.remove();
    }
    
    const fullStars = Math.floor(product.rating);
    const halfStar = product.rating % 1 >= 0.5;
    let starsHTML = '';
    for(let i=1; i<=5; i++) {
      if(i <= fullStars) starsHTML += '<i class="bi bi-star-fill text-warning"></i>';
      else if(i === fullStars + 1 && halfStar) starsHTML += '<i class="bi bi-star-half text-warning"></i>';
      else starsHTML += '<i class="bi bi-star text-warning"></i>';
    }
    
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
                  <img src="${product.image}" class="img-fluid rounded" alt="${product.name}" style="height: 300px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/400x400?text=Product+Image'">
                </div>
                <div class="col-md-6">
                  <h4 class="text-primary">₹${product.price.toLocaleString()}</h4>
                  <div class="mb-2">${starsHTML} <span class="text-secondary">(${product.reviews} reviews)</span></div>
                  <p class="mb-2"><strong>Category:</strong> ${product.category}</p>
                  <p class="mb-3">${product.description || 'High-quality stationery product perfect for everyday use.'}</p>
                  <button class="btn btn-primary w-100 mt-3" onclick="addToCart(${product.id}); bootstrap.Modal.getInstance(document.getElementById('quickViewModal')).hide();">Add to Cart</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
    
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
    localStorage.removeItem('cart');
    cart = [];
    updateCartUI();
    const cartModal = bootstrap.Modal.getInstance(document.getElementById('cartModal'));
    cartModal.hide();
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

  // Event listeners
  document.getElementById('priceRange').addEventListener('input', e => {
    document.getElementById('priceValue').textContent = `₹${e.target.value}`;
    applyFilters();
  });

  document.getElementById('searchInput').addEventListener('input', applyFilters);
  
  document.querySelectorAll('.size-filter, #star4').forEach(el => {
    el.addEventListener('change', applyFilters);
  });
  
  document.getElementById('applyBtn').addEventListener('click', applyFilters);
  
  document.getElementById('resetBtn').addEventListener('click', () => {
    document.getElementById('searchInput').value = '';
    document.getElementById('priceRange').value = 150;
    document.getElementById('priceValue').textContent = '₹150';
    document.querySelectorAll('.size-filter').forEach(cb => cb.checked = false);
    document.getElementById('star4').checked = false;
    document.getElementById('sortSelect').value = 'default';
    displayProducts(products);
  });

  document.getElementById('sortSelect').addEventListener('change', function() {
    sortProducts(this.value);
  });

  // Initialize the page
  window.onload = () => {
    displayProducts(products);
    updateCartUI();
    updateFavoritesCount();
    document.getElementById('priceValue').textContent = '₹' + document.getElementById('priceRange').value;
  };
</script>
</body>
</html>