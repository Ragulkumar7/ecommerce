
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>StyleHub | Men's Fashion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/women-wear.css">
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
          <form class="search-form" onsubmit="event.preventDefault(); applyFilters();">
            <input id="searchInput" class="form-control search-input" type="search" placeholder="Search for products..."
              aria-label="Search" />
            <button class="search-btn" type="submit"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
          <div class="d-flex align-items-center justify-content-end header-actions">
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-arrow-repeat"></i></a>
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-heart"></i><span
                class="cart-badge">0</span></a>
            <a href="cart.php" class="action-icon position-relative"><i class="bi bi-cart3"></i><span class="cart-badge"
                id="header-cart-count">0</span></a>
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

  <main class="container-fluid py-4" role="main">
    <section class="row">
      <aside class="col-md-3" role="complementary">
        <div class="sidebar shadow-box" aria-label="Product filters">
          <h2 class="h4 mb-4">Categories</h2>
          <div class="filter-section mb-4 p-3" aria-label="Category filter">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="catMen" checked disabled />
              <label class="form-check-label" for="catMen"><i class="bi bi-person-fill me-2"></i> Women's Fashion <span
                  class="text-secondary">(20)</span></label>
            </div>
          </div>

          <div class="filter-section mb-4 p-3">
            <h3 class="h5"><i class="bi bi-currency-rupee me-2"></i>Price Range</h3>
            <input id="priceRange" type="range" min="0" max="5000" value="5000" step="50" class="form-range mb-3"
              aria-valuemin="0" aria-valuemax="5000" aria-valuenow="5000" aria-label="Filter by price range" />
            <div class="d-flex justify-content-between mb-0">
              <span>₹0</span>
              <span id="priceValue">₹5000</span>
            </div>
          </div>

          <div class="filter-section mb-4 p-3" aria-label="Size filter">
            <h3 class="h5"><i class="bi bi-arrows-expand"></i> Size</h3>
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
            <div class="form-check form-check-inline me-3">
              <input type="checkbox" class="form-check-input size-filter" id="sizeXL" value="XL" />
              <label for="sizeXL" class="form-check-label">XL</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input size-filter" id="sizeXXL" value="XXL" />
              <label for="sizeXXL" class="form-check-label">XXL</label>
            </div>
          </div>

          <div class="filter-section mb-4 p-3" aria-label="Rating filter">
            <h3 class="h5"><i class="bi bi-star-fill"></i> Rating</h3>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star5" value="5" />
              <label class="form-check-label" for="star5">
                <span class="rating">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </span>
                5 stars
              </label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star4" value="4" />
              <label class="form-check-label" for="star4">
                <span class="rating">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                </span>
                4 stars & above
              </label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star3" value="3" />
              <label class="form-check-label" for="star3">
                <span class="rating">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star"></i><i class="bi bi-star"></i>
                </span>
                3 stars & above
              </label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star2" value="2" />
              <label class="form-check-label" for="star2">
                <span class="rating">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i
                    class="bi bi-star"></i><i class="bi bi-star"></i>
                </span>
                2 stars & above
              </label>
            </div>
          </div>

          <div class="filter-buttons">
            <button id="applyBtn" type="button">Apply Filters</button>
            <button id="resetBtn" type="button">Reset Filters</button>
          </div>
        </div>
      </aside>
      <section class="col-md-9" aria-label="Products">
        <div class="mb-3 d-flex justify-content-between align-items-center">
          <p id="resultCount" class="m-0">Showing 1-20 of 20 results</p>
          <div>
            <label for="sortSelect" class="form-label visually-hidden">Sort products</label>
            <select class="form-select d-inline w-auto" id="sortSelect" onchange="sortProducts(this.value)">
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

  <!-- Footer -->
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
            <input type="email" class="form-control mb-3" placeholder="Your email address" />
            <button type="submit" class="btn">Subscribe</button>
          </form>
        </div>
      </div>
      <hr class="my-4 bg-light" />
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
    const products = [
      { id: 1, name: "SilentParrot Ladies' Panties - Classic Collection", price: 299.99, old_price: 899.99, rating: 4.5, reviews: 142, tag: 'Sale', image: 'https://www.silentparrot.in/wp-content/uploads/2025/06/1.jpg', brand: 'Slient parrot', size: ['L', 'XL', 'S', 'X'] },
      { id: 2, name: "SilentParrot Multi-Pack Ladies' Collection (3-Pack)", price: 179.99, old_price: 0, rating: 4, reviews: 87, tag: 'New', image: 'https://www.silentparrot.in/wp-content/uploads/2025/06/2.jpg', brand: 'Slient parrot', size: ['L', 'XL', 'S', 'X'] },
      { id: 3, name: "SilentParrot Premium Cotton Panties - Blue Patterns", price: 349.99, old_price: 399.99, rating: 5, reviews: 215, tag: '', image: 'https://test.divasprik.in/Silentparrot/frontend/ASSETS/images/womenproduct2.jpg', brand: 'Slient parrot', size: ['L', 'XL', 'S', 'X'] },
      { id: 4, name: "Premium Men's Dress Series 3", price: 399.99, old_price: 499.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/f5/a0/4c/f5a04c9dfbcfceb0eebc347d7ffa71b5.jpg', brand: 'Levis', size: ['L', 'XL'] },
      { id: 5, name: "Premium Men's Dress Series 8", price: 299.99, old_price: 369.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/1200x/49/67/15/496715d79127f5bf9b1864625400216b.jpg', brand: 'Levis', size: ['L', 'XL'] },
      { id: 6, name: "Premium Men's Dress Series 2", price: 399.99, old_price: 479.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/1200x/aa/07/19/aa0719404f01f341cbeb2771a489ef81.jpg', brand: 'Levis', size: ['L', 'XL'] },
      { id: 7, name: "Premium Men's Dress Series 5", price: 449.99, old_price: 599.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/b7/af/12/b7af1257268780a1f43495fefd2e6601.jpg', brand: 'Levis', size: ['L', 'XL'] },
      { id: 8, name: "Premium Men's Dress Series 8", price: 649.99, old_price: 799.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/1200x/19/3e/cf/193ecf4993db80e67e9d125adadfe9f3.jpg', brand: 'Levis', size: ['L', 'XL'] },
      { id: 9, name: "Premium Men's Dress Series 9", price: 649.99, old_price: 699.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/5e/64/9b/5e649bad379266840a64a9699fd746d6.jpg', brand: 'Levis', size: ['L', 'XL'] },
    ];

    let cart = [];

    let filterState = {
      keyword: '',
      priceLimit: 5000,
      sizes: [],
      minRating: 0
    };

    function displayProducts(productList) {
      const container = document.getElementById('productContainer');
      container.innerHTML = '';
      if (productList.length === 0) {
        container.innerHTML = '<p>No products found.</p>';
        document.getElementById('resultCount').textContent = 'No results found';
        return;
      }
      productList.forEach(p => {
        const badge = p.tag ? `<span class="badge bg-${p.tag === 'Sale' ? 'danger' : 'success'}">${p.tag}</span>` : '';
        const oldPrice = p.old_price > p.price ? `<span class="product-old">₹${p.old_price.toFixed(2)}</span>` : '';
        let starsHTML = '';
        const fullStars = Math.floor(p.rating);
        const halfStar = (p.rating % 1) >= 0.5;
        for (let i = 1; i <= 5; i++) {
          if (i <= fullStars) starsHTML += '<i class="bi bi-star-fill"></i>';
          else if (i === fullStars + 1 && halfStar) starsHTML += '<i class="bi bi-star-half"></i>';
          else starsHTML += '<i class="bi bi-star"></i>';
        }
        let sizes = p.size.join(", ");
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
                <button class="btn btn-outline-primary btn-sm" onclick="quickView(${p.id})">View Details</button>
                <button class="btn btn-primary btn-sm" onclick="addToCart(${p.id})">Add to Cart</button>
              </div>
            </div>
          </div>
        </article>
        `;
      });
      document.getElementById('resultCount').textContent = `Showing 1-${productList.length} of ${productList.length} results`;
    }

    function viewDetails(productId) {
      alert('View Details clicked for product ID: ' + productId);
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

    // Update price label dynamically when slider moves
    document.getElementById('priceRange').addEventListener('input', function () {
      document.getElementById('priceValue').innerText = '₹' + this.value;
    });

    // Add event listeners so filters apply on change
    document.querySelectorAll('.size-filter').forEach(el => el.addEventListener('change', applyFilters));
    document.querySelectorAll('.rating-filter').forEach(el => el.addEventListener('change', applyFilters));
    document.getElementById('priceRange').addEventListener('change', applyFilters);

    document.getElementById('applyBtn').addEventListener('click', applyFilters);

    document.getElementById('resetBtn').addEventListener('click', () => {
      document.getElementById('searchInput').value = '';
      document.getElementById('priceRange').value = 5000;
      document.getElementById('priceValue').innerText = '₹5000';
      document.querySelectorAll('.size-filter').forEach(cb => cb.checked = false);
      document.querySelectorAll('.rating-filter').forEach(cb => cb.checked = false);

      filterState = {
        keyword: '',
        priceLimit: 5000,
        sizes: [],
        minRating: 0
      };

      displayProducts(products);
    });

    function applyFilters() {
      filterState.keyword = document.getElementById('searchInput').value.trim().toLowerCase();
      filterState.priceLimit = parseFloat(document.getElementById('priceRange').value);
      filterState.sizes = Array.from(document.querySelectorAll('.size-filter:checked')).map(cb => cb.value);
      // Determine highest selected rating or 0 if none
      const ratingChecks = Array.from(document.querySelectorAll('.rating-filter:checked')).map(cb => parseInt(cb.value));
      filterState.minRating = ratingChecks.length > 0 ? Math.min(...ratingChecks) : 0;

      let filtered = products.filter(p => {
        let matchesKeyword = p.name.toLowerCase().includes(filterState.keyword);
        let matchesPrice = p.price <= filterState.priceLimit;
        let matchesSize = filterState.sizes.length === 0 || p.size.some(sz => filterState.sizes.includes(sz));
        let matchesRating = filterState.minRating === 0 || p.rating >= filterState.minRating;
        return matchesKeyword && matchesPrice && matchesSize && matchesRating;
      });

      displayProducts(filtered);
    }

    function sortProducts(sortValue) {
      const container = document.getElementById('productContainer');
      // Get currently displayed products by reading product titles shown
      let displayedIds = Array.from(container.children).map(div => {
        return products.find(p => p.name === div.querySelector('.product-title').textContent).id;
      });
      let currentProducts = products.filter(p => displayedIds.includes(p.id));

      if (sortValue === 'lowToHigh') {
        currentProducts.sort((a, b) => a.price - b.price);
      } else if (sortValue === 'highToLow') {
        currentProducts.sort((a, b) => b.price - a.price);
      } else {
        currentProducts = [...products];
      }
      displayProducts(currentProducts);
    }

    window.onload = () => {
      displayProducts(products);
      updateCartUI();

      // Link search input to filters for immediate application
      document.getElementById('searchInput').addEventListener('input', applyFilters);
    };
  </script>
</body>

</html>