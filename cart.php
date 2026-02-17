

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart - Electro</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="ASSEST/css/cart.css">

</head>
<body>

<!-- Header Section -->
<header class="main-header">
  <div class="container py-3">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-4 col-6">
        <div class="d-flex align-items-center">
          <span class="brand-icon">
            <i class="bi bi-lightning-charge-fill"></i>
          </span>
          <span class="brand-logo">Electro</span>
        </div>
      </div>
      <div class="col-lg-6 col-md-5 d-none d-md-block">
        <form class="search-form">
          <input class="form-control search-input" type="search" placeholder="Search for products..." aria-label="Search">
          <button class="search-btn" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>
      <div class="col-lg-3 col-md-3 col-6">
        <div class="d-flex align-items-center justify-content-end header-actions">
          <a href="#" class="action-icon me-3 position-relative">
            <i class="bi bi-arrow-repeat"></i>
          </a>
          <a href="#" class="action-icon me-3 position-relative">
            <i class="bi bi-heart"></i>
            <span class="cart-badge">3</span>
          </a>
          <a href="cart.html" class="action-icon position-relative">
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
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-4">
        <a class="navbar-brand d-flex align-items-center py-2" href="#">
          <i class="bi bi-grid-3x3-gap-fill text-white me-2"></i>
          <span class="fw-bold text-white">Browse Categories</span>
        </a>
      </div>
      <div class="col-lg-7 col-md-5">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
          <li class="nav-item"><a class="nav-link active" href="cart.php">Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-3 text-end d-none d-md-block">
      </div>
    </div>
  </div>
</nav>

<!-- Cart Page -->
<section class="container my-5">
  <div class="row g-4">
    <!-- Cart Table -->
    <div class="col-lg-8">
      <div class="table-responsive">
        <table class="table cart-table align-middle">
          <thead class="table-dark">
            <tr>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="cart-items">
            <!-- Cart items will be dynamically inserted here -->
          </tbody>
        </table>
      </div>
      
      <div id="empty-cart" class="empty-cart d-none">
        <i class="bi bi-cart-x"></i>
        <p>Your cart is empty</p>
        <a href="shop.php" class="btn btn-continue mt-3"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
      </div>
      
      <a href="shop.php" class="btn btn-continue mt-3" id="continue-shopping"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
    </div>

    <!-- Cart Summary -->
    <div class="col-lg-4">
      <div class="summary-box">
        <h4>Cart Summary</h4>
        <div class="d-flex justify-content-between">
          <span>Subtotal</span>
          <span>₹<span id="summary-subtotal">0.00</span></span>
        </div>
        <div class="d-flex justify-content-between">
          <span>Shipping</span>
          <span>₹<span id="summary-shipping">0.00</span></span>
        </div>
        <div class="d-flex justify-content-between">
          <span>Tax</span>
          <span>₹<span id="summary-tax">0.00</span></span>
        </div>
        <hr>
        <div class="d-flex justify-content-between fw-bold fs-5">
          <span>Total</span>
          <span>₹<span id="summary-total">0.00</span></span>
        </div>
        <a href="./checkout.php" class="btn btn-checkout w-100 mt-4" id="checkout-btn">Proceed to Checkout</a>
      </div>
      
      <!-- Demo products to add to cart -->
      <div class="demo-products">
        <h5>Demo Products</h5>
        <div class="d-grid gap-2">
          <button class="btn btn-outline-primary btn-add" data-id="1" data-name="Premium Smart Watch Series 7" data-price="249.99" data-image="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=764&q=80">Add Smart Watch</button>
          <button class="btn btn-outline-primary btn-add" data-id="2" data-name="Noise Cancelling Wireless Earbuds" data-price="129.99" data-image="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80">Add Earbuds</button>
          <button class="btn btn-outline-primary btn-add" data-id="3" data-name="Flagship Smartphone 128GB" data-price="899.99" data-image="https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=684&q=80">Add Smartphone</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Toast Notification -->
<div class="toast-notification">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class="bi bi-cart-check me-2"></i>
      <strong class="me-auto">Electro Cart</strong>
      <small>Just now</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toast-message">
      Item added to your cart!
    </div>
  </div>
</div>

<!-- Footer Section -->
<footer class="footer-section">
  <div class="container">
    <div class="row g-5">
      <!-- Brand and Info -->
      <div class="col-lg-4 col-md-6">
        <div class="d-flex align-items-center mb-4">
          <span class="brand-icon me-2">
            <i class="bi bi-lightning-charge-fill"></i>
          </span>
          <span class="footer-brand-text">Electro</span>
        </div>
        <p class="mb-4">
          We provide the best quality electronics with premium customer service. Our products are carefully selected to ensure the best experience for our customers.
        </p>
        <ul class="list-unstyled">
          <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>123 Tech Street, San Francisco, CA 94103</li>
          <li class="mb-2"><i class="bi bi-envelope me-2"></i>support@electro.example.com</li>
          <li class="mb-0"><i class="bi bi-telephone me-2"></i>+1 (555) 123-4567</li>
        </ul>
      </div>
      
      <!-- Quick Links #1 -->
      <div class="col-lg-2 col-md-6">
        <h5>Shop Categories</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">Smartphones</a></li>
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">Laptops</a></li>
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">Headphones</a></li>
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">Wearables</a></li>
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">Speakers</a></li>
          <li class="mb-0"><a href="#" class="text-light text-decoration-none">Accessories</a></li>
        </ul>
      </div>
      
      <!-- Quick Links #2 -->
      <div class="col-lg-2 col-md-6">
        <h5>Customer Service</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">Contact Us</a></li>
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">FAQs</a></li>
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">Shipping Info</a></li>
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">Returns & Exchanges</a></li>
          <li class="mb-2"><a href="#" class="text-light text-decoration-none">Warranty</a></li>
          <li class="mb-0"><a href="#" class="text-light text-decoration-none">Track Order</a></li>
        </ul>
      </div>
      
      <!-- Newsletter -->
      <div class="col-lg-4 col-md-6">
        <h5>Join Our Newsletter</h5>
        <p class="mb-3">Subscribe to receive updates, access to exclusive deals, and more.</p>
        <form>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Your Name">
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" placeholder="Your Email">
          </div>
          <button type="submit" class="btn btn-primary w-100">Subscribe Now</button>
        </form>
      </div>
    </div>
    
    <hr class="mt-4 mb-4 border-secondary">
    
    <div class="row">
      <div class="col-md-6 text-center text-md-start">
        <p class="mb-0">&copy; 2023 Electro. All Rights Reserved.</p>
      </div>
      <div class="col-md-6 text-center text-md-end">
        <div class="d-flex justify-content-md-end justify-content-center gap-3">
          <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
          <a href="#" class="text-light"><i class="bi bi-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assest/js/cart.js"></script>

</body>
</html>