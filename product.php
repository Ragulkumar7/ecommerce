<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Product Details | StyleHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <!-- Link to the new product.css file -->
    <link rel="stylesheet" href="./assest/css/product.css" />
</head>
<body>

<!-- HEADER -->
  <header class="navbar navbar px-4 py-2 border-bottom" style="background-color:#cf665c;" role="banner">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <span class="bi bi-shop me-2" style="font-size:2rem;"></span>StyleHub
    </a>
    <form class="d-flex mx-auto w-50" role="search" onsubmit="event.preventDefault(); filterProducts();">
      <input class="form-control me-2 searchbar" type="search" placeholder="Search for products..." aria-label="Search"
        id="searchInput" />
      <button class="btn btn-light" type="submit" aria-label="Submit Search"><i class="bi bi-search"></i></button>
    </form>
    <nav class="d-flex align-items-center gap-3" aria-label="User options">
      <span class="bi bi-arrow-repeat" style="font-size:1.5em;" title="Refresh page" role="button" tabindex="0"
        onclick="location.reload()"></span>
      <span class="bi bi-heart position-relative" style="font-size:1.5em;" title="Favorites" role="button" tabindex="0">
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="favCount"
          aria-live="polite">0</span>
      </span>
      <span class="bi bi-cart3 position-relative clickable" style="font-size:1.5em;cursor:pointer;"
        title="Shopping cart" role="button" tabindex="0" onclick="showCartModal()">
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCount"
          aria-live="polite">0</span>
      </span>
      <span class="fw-bold fs-5">₹<span id="cartTotal" aria-live="polite">0.00</span></span>
    </nav>
  </header>

<!-- MAIN CONTENT -->
<main class="container-fluid my-3 bg-white" role="main">
    <div id="productDetailContainer" class="p-3">
        <!-- The entire product layout will be injected here by product.js -->
    </div>
    <div id="productNotFound" class="text-center py-5" style="display:none;">
        <h2 class="h2">Product Not Found</h2>
        <p>Sorry, the product you are looking for does not exist.</p>
        <a href="./mens-wear.php" class="btn btn-primary">Back to Shop</a>
    </div>
</main>


<!-- CART MODAL -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="cartItems">
            <!-- Cart items will be populated here -->
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <h5 class="mb-0">Total: ₹<span id="modalCartTotal">0.00</span></h5>
            <button class="btn btn-success" onclick="buyNow()">Proceed to Checkout</button>
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
          <p class="mb-4">We offer the best products at competitive prices with fast shipping and excellent customer
            service.</p>
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
<script src="./assest/js/product.js"></script>
</body>
</html>

