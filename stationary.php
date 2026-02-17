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
  <style>
    /* --- UPDATED COLORS FOR BUTTONS & SLIDERS (#d16d08f2) --- */
    
    /* Main Buttons (Apply Filters, Add to Cart) */
    #applyBtn, .btn-primary {
        background-color: #d16d08f2 !important;
        border-color: #d16d08f2 !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    #applyBtn:hover, .btn-primary:hover {
        background-color: #a35506 !important; /* Darker shade for hover */
        border-color: #a35506 !important;
        transform: translateY(-2px);
    }

    /* Range Slider Thumb Color */
    .form-range::-webkit-slider-thumb {
        background: #d16d08f2 !important;
    }
    .form-range::-moz-range-thumb {
        background: #d16d08f2 !important;
    }

    /* Price Text Color */
    .product-price {
        color: #d16d08f2 !important;
        font-weight: bold;
        font-size: 1.1rem;
    }

    /* Rating Star Color */
    .bi-star-fill, .bi-star-half {
        color: #d16d08f2 !important;
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
  </style>
</head>
<body>
<header class="main-header">
  <div class="container py-3">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-4 col-6">
        <div class="d-flex align-items-center">
          <span class="brand-icon" style="color: #d16d08f2;"><i class="bi bi-shop"></i></span>
          <span class="brand-logo">StyleHub</span>
        </div>
      </div>
      <div class="col-lg-6 col-md-5 d-none d-md-block">
        <form class="search-form">
          <input id="searchInput" class="form-control search-input" type="search" placeholder="Search for products..." aria-label="Search">
          <button class="search-btn" type="submit" style="background-color: #d16d08f2; border-color: #d16d08f2;"><i class="bi bi-search text-white"></i></button>
        </form>
      </div>
      <div class="col-lg-3 col-md-3 col-6">
        <div class="d-flex align-items-center justify-content-end header-actions">
          <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-arrow-repeat"></i></a>
          <a href="#" class="action-icon me-3 position-relative">
            <i class="bi bi-heart"></i>
            <span class="cart-badge bg-dark" id="favCount">0</span>
          </a>
          <a href="cart.php" class="action-icon position-relative">
            <i class="bi bi-cart3"></i>
            <span class="cart-badge bg-dark" id="header-cart-count">0</span>
          </a>
          <span class="fs-5 ms-2 fw-bold d-none d-lg-block">₹<span id="header-total">0.00</span></span>
        </div>
      </div>
    </div>
  </div>
</header>

<nav class="main-navbar" style="background-color: #d16d08f2 !important;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link active text-white" href="index.php"><i class="bi bi-house me-1"></i> Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gem me-1"></i> Beauty & Jewelry
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
            <li><a class="dropdown-item" href="beauty-products.php">Skincare</a></li>
            <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-heart me-1"></i> Stationery & Gifts
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="gifts.php">Handmade Crafts</a></li>
            <li><a class="dropdown-item" href="stationary.php">School Supplies</a></li>
            <li><a class="dropdown-item" href="stationary.php">College Supplies</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-pencil me-1"></i> Electronics
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./electronics.php">Mobile Phones</a></li>
            <li><a class="dropdown-item" href="./electronics.php">Laptops</a></li>
            <li><a class="dropdown-item" href="./electronics.php">Accessories</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person me-1"></i> Fashion
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="mens-wear.php">Men's Clothing</a></li>
            <li><a class="dropdown-item" href="women-wear.php">Women's Clothing</a></li>
            <li><a class="dropdown-item" href="kids-wear.php">Kids' Clothing</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#"><i class="bi bi-tag me-1"></i> Deals</a>
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
          <button id="applyBtn" type="button" class="btn w-100 mb-2 rounded-pill">Apply Filters</button>
          <button id="resetBtn" type="button" class="btn btn-light w-100 rounded-pill" style="border: 1px solid #ddd;">Reset Filters</button>
        </div>
      </div>
    </aside>
    <section class="col-md-9" aria-label="Products">
      <div class="mb-3 d-flex justify-content-between align-items-center">
        <p id="resultCount" class="m-0 text-muted"></p>
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

<footer class="footer-section bg-dark text-white pt-5 pb-3">
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
          <li><a href="#" class="text-white-50 text-decoration-none">Women's Fashion</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-4 mb-4 mb-md-0 footer-links">
        <h5 class="text-white">Customer Service</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white-50 text-decoration-none">Contact Us</a></li>
          <li><a href="#" class="text-white-50 text-decoration-none">Returns & Exchanges</a></li>
          <li><a href="#" class="text-white-50 text-decoration-none">Shipping & Delivery</a></li>
          <li><a href="#" class="text-white-50 text-decoration-none">Product Support</a></li>
          <li><a href="#" class="text-white-50 text-decoration-none">FAQ</a></li>
        </ul>
      </div>
      <div class="col-lg-4 col-md-4 footer-newsletter">
        <h5 class="mb-3 text-white">Newsletter</h5>
        <p class="text-white-50">Subscribe to get special offers, free giveaways, and new product alerts.</p>
        <form>
          <input type="email" class="form-control mb-3" placeholder="Your email address">
          <button type="submit" class="btn btn-primary rounded-pill w-100">Subscribe</button>
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
          <a href="#" class="text-white-50 text-decoration-none">Cookie Policy</a>
        </div>
      </div>
    </div>
  </div>
</footer>

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
    { id: 701, name: "Gel Pen Set", price: 150, rating: 4.5, reviews: 120, category: "Pen", image: "https://i.pinimg.com/1200x/18/dd/a7/18dda7156ace505cf245e0d58705a218.jpg" },
    { id: 702, name: "Spiral Notebook", price: 80, rating: 4.2, reviews: 90, category: "Notebook", image: "https://i.pinimg.com/736x/ed/8d/16/ed8d1658bb2f25a9ef4688fd6413ab06.jpg" },
    { id: 703, name: "White Eraser", price: 20, rating: 4.0, reviews: 40, category: "Eraser", image: "https://i.pinimg.com/736x/f2/d1/23/f2d123ab237f8577f87bb10967abfd6a.jpg" },
    { id: 704, name: "Permanent Marker", price: 120, rating: 4.7, reviews: 140, category: "Marker", image: "https://i.pinimg.com/736x/19/0f/ab/190fabd11ddbcbc63dbe23c9478c1d86.jpg" },
    { id: 705, name: "Ballpoint Pen", price: 100, rating: 4.3, reviews: 70, category: "Pen", image: "https://i.pinimg.com/1200x/a7/56/23/a75623f1ee5b4059967682858ed4e4cc.jpg" }
  ]' ?>;

  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  let filterState = {
    keyword: '',
    priceLimit: 150,
    categories: [],
    minRating: 0
  };

  // UPDATED DISPLAY FUNCTION: Clean card style, image/title linked to product-details.php
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
          <div class="clean-product-card p-3 h-100 d-flex flex-column shadow-sm position-relative">
            
            <a href="product-details.php?id=${p.id}" class="text-decoration-none text-dark">
              <img src="${p.image}" alt="${p.name}" class="img-fluid rounded mb-3 w-100" style="height:200px; object-fit:cover;" onerror="this.src='https://via.placeholder.com/300x300?text=Product+Image'">
              <h3 class="h6 fw-bold mb-1">${p.name}</h3>
            </a>
            
            <div class="mb-2">
              <span class="small" aria-label="${p.rating} stars">${starsHTML}</span> 
              <span class="text-secondary ms-1" style="font-size:0.8rem;">(${p.reviews} reviews)</span>
            </div>
            
            <div class="mb-3">
              <span class="product-price">₹${p.price}</span>
            </div>
            
            <button type="button" class="btn btn-primary btn-sm w-100 rounded-pill mt-auto" onclick="addToCart(${p.id})">
              Add to Cart
            </button>
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

  function showCartModal() {
    const cartItems = document.getElementById('cartItems');
    const modalCartTotal = document.getElementById('modalCartTotal');
    if (cart.length === 0) {
      cartItems.innerHTML = '<p class="text-center">Your cart is empty</p>';
    } else {
      cartItems.innerHTML = cart.map(item => `
        <div class="d-flex align-items-center mb-3 p-2 border-bottom">
          <img src="${item.image}" alt="${item.name}" class="rounded me-3" width="60" height="60" style="object-fit: cover;">
          <div class="flex-grow-1">
            <h6 class="mb-0">${item.name}</h6>
            <p class="mb-0">₹${item.price.toLocaleString()} x ${item.quantity}</p>
          </div>
          <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${item.id})"><i class="bi bi-trash"></i></button>
        </div>
      `).join('');
    }
    modalCartTotal.textContent = cart.reduce((total, item) => total + (item.price * item.quantity), 0).toFixed(2);
    new bootstrap.Modal(document.getElementById('cartModal')).show();
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

  function buyNow() { alert('Proceeding to checkout...'); }

  function showToast(message) {
    let toast = document.getElementById('toast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'toast';
      toast.className = 'toast align-items-center text-white bg-dark border-0 position-fixed bottom-0 end-0 m-3';
      toast.setAttribute('role', 'alert');
      toast.innerHTML = `<div class="d-flex"><div class="toast-body">${message}</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>`;
      document.body.appendChild(toast);
    } else { toast.querySelector('.toast-body').textContent = message; }
    new bootstrap.Toast(toast).show();
  }

  document.getElementById('priceRange').addEventListener('input', e => {
    document.getElementById('priceValue').textContent = `₹${e.target.value}`;
    applyFilters();
  });
  
  document.getElementById('searchInput').addEventListener('input', applyFilters);
  document.querySelectorAll('.size-filter, #star4').forEach(el => el.addEventListener('change', applyFilters));
  document.getElementById('applyBtn').addEventListener('click', applyFilters);
  
  document.getElementById('resetBtn').addEventListener('click', () => { 
    document.getElementById('searchInput').value = '';
    document.getElementById('priceRange').value = 150;
    document.getElementById('priceValue').textContent = '₹150';
    document.querySelectorAll('.size-filter, #star4').forEach(cb => cb.checked = false);
    document.getElementById('sortSelect').value = 'default';
    filterState = { keyword: '', priceLimit: 150, categories: [], minRating: 0 };
    displayProducts(products); 
  });
  
  document.getElementById('sortSelect').addEventListener('change', function() { sortProducts(this.value); });

  window.onload = () => {
    displayProducts(products);
    updateCartUI();
    updateFavoritesCount();
  };
</script>
</body>
</html>