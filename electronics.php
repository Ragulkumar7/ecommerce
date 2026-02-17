
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>StyleHub | Electronics</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/electronics.css" />

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
            <input class="form-control search-input" type="search" placeholder="Search for products..." aria-label="Search" id="searchInput">
            <button class="search-btn" type="button" onclick="applyFilters()"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
          <div class="d-flex align-items-center justify-content-end header-actions">
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-arrow-repeat"></i></a>
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-heart"></i><span class="cart-badge" id="favCount">0</span></a>
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
        <div class="sidebar shadow-box" aria-label="Product filters">
          <h2 class="h4 mb-3">Filters</h2>
          <div class="filter-summary" id="filterSummary">No filters applied</div>
          
          <div class="filter-section mb-4 p-3" aria-label="Category filter">
            <h3 class="h5"><i class="bi bi-tags"></i> Category</h3>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="catElectronics" checked disabled />
              <label class="form-check-label" for="catElectronics">Electronics <span class="text-secondary">(11)</span></label>
            </div>
          </div>
          
          <div class="filter-section mb-4 p-3" aria-label="Price filter">
            <h3 class="h5"><i class="bi bi-currency-rupee me-2"></i>Price Range</h3>
            <input id="priceRange" type="range" min="0" max="1000000" value="1000000" step="10000" class="form-range mb-3" aria-valuemin="0" aria-valuemax="1000000" aria-valuenow="1000000" aria-label="Filter by price range" />
            <div class="d-flex justify-content-between mb-0">
              <span>₹0</span>
              <span id="priceValue">₹1,000,000</span>
            </div>
          </div>
          
          <div class="filter-section mb-4 p-3" aria-label="Rating filter">
            <h3 class="h5"><i class="bi bi-star-fill"></i> Rating</h3>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star5" value="5" />
              <label class="form-check-label" for="star5">
                <span class="rating">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </span>
                5 stars
              </label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star4" value="4" />
              <label class="form-check-label" for="star4">
                <span class="rating">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                </span>
                4 stars & above
              </label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star3" value="3" />
              <label class="form-check-label" for="star3">
                <span class="rating">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
                </span>
                3 stars & above
              </label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input rating-filter" id="star2" value="2" />
              <label class="form-check-label" for="star2">
                <span class="rating">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
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
          <p id="resultCount" class="m-0">Showing 1-11 of 11 results</p>
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
            <button class="btn btn-primary" onclick="buyNow()">Proceed to Checkout</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const products = [
      { id: 1, name: "Smart Watch", price: 4999.99, old_price: 4299.99, rating: 4.5, reviews: 142, tag: 'Sale', image: 'https://i.pinimg.com/736x/ef/bb/17/efbb17fc0cfc2be91f2c913c66676a5f.jpg', brand: 'Samsung', size: ['M', 'L'] },
      { id: 2, name: "Gaming Mouse", price: 379.99, old_price: 1000, rating: 4, reviews: 87, tag: 'New', image: 'https://i.pinimg.com/736x/bb/31/c2/bb31c26fcffdf72b62c5895e96d42b7a.jpg', brand: 'Logitech', size: ['S'] },
      { id: 3, name: "Airpods", price: 2099.99, old_price: 4099.99, rating: 5, reviews: 215, tag: 'Trend', image: 'https://i.pinimg.com/1200x/80/62/b0/8062b04b1f7e11c64a74809a6a13d151.jpg', brand: 'Apple', size: ['L', 'XL'] },
      { id: 4, name: "Earpods", price: 999.99, old_price: 2999.99, rating: 4.7, reviews: 103, tag: 'Sale', image: 'https://i.pinimg.com/1200x/80/62/b0/8062b04b1f7e11c64a74809a6a13d151.jpg', brand: 'Sony', size: ['XL'] },
      { id: 5, name: "iPhone 14 Pro", price: 80000.99, old_price: 100000.99, rating: 4.2, reviews: 70, tag: '', image: 'https://i.pinimg.com/736x/f5/c1/66/f5c16671a90ff6094847c3a765d26147.jpg', brand: 'Apple', size: ['XXL'] },
      { id: 6, name: "Samsung S23", price: 60000.99, old_price: 80000.99, rating: 5, reviews: 40, tag: 'New', image: 'https://i.pinimg.com/736x/66/c2/3f/66c23f9566266ec63f39b2dac1a56585.jpg', brand: 'Samsung', size: ['S', 'M'] },
      { id: 7, name: "Boat Earpods", price: 1459.99, old_price: 599.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/25/b9/83/25b9831c748b9af40ba25b98725b8d0b.jpg', brand: 'Boat', size: ['L', 'XL'] },
      { id: 8, name: "Bluetooth Speaker", price: 1649.99, old_price: 799.99, rating: 5, reviews: 90, tag: '', image: 'https://i.pinimg.com/736x/0f/16/d1/0f16d1d59c4a5ec23d2d98f40f7c177b.jpg', brand: 'JBL', size: ['XXL'] },
      { id: 9, name: "Airdopes", price: 1099.99, old_price: 2329.99, rating: 3.5, reviews: 20, tag: '', image: 'https://i.pinimg.com/1200x/b3/41/18/b34118f0a364d882fab16ee306352049.jpg', brand: 'Realme', size: ['S', 'M', 'L', 'XL', 'XXL'] },
      { id: 10, name: "Speaker", price: 1099.99, old_price: 2459.99, rating: 4.1, reviews: 101, tag: '', image: 'https://i.pinimg.com/1200x/63/dc/99/63dc99c69564601586138c26bf2ade9a.jpg', brand: 'Boat', size: ['XL'] },
      { id: 11, name: "Headphone", price: 1000.99, old_price: 2029.99, rating: 3.9, reviews: 50, tag: '', image: 'https://i.pinimg.com/736x/a8/33/7f/a8337f50ffaf22a9f4c350ed63362ec8.jpg', brand: 'Sony', size: ['M'] }
    ];
    
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let filterState = {
      keyword: '',
      priceLimit: 1000000,
      sizes: [],
      minRating: 0
    };
    let currentFilteredProducts = [...products];

    function displayProducts(productList) {
      const container = document.getElementById('productContainer');
      container.innerHTML = '';
      
      if (productList.length === 0) {
        container.innerHTML = `<div class="col-12 text-center"><p class="text-danger fw-bold mt-4 mb-4">No products found for the selected filters.<br>Try removing some filters.</p></div>`;
        document.getElementById('resultCount').textContent = `Showing 0 results`;
        return;
      }
      
      productList.forEach(p => {
        const badge = p.tag ? `<span class="badge bg-${p.tag === 'Sale' ? 'danger' : p.tag === 'New' ? 'success' : 'primary'}">${p.tag}</span>` : '';
        const oldPrice = p.old_price && p.old_price > p.price ? `<span class="product-old">₹${p.old_price.toLocaleString()}</span>` : '';
        let starsHTML = '';
        const fullStars = Math.floor(p.rating);
        const halfStar = p.rating % 1 >= 0.5;
        
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
              <img src="${p.image}" class="product-img" alt="${p.name}" onerror="this.src='https://via.placeholder.com/300x200?text=Product+Image'" />
              <div class="p-3">
                <h3 class="product-title">${p.name}</h3>
                <div class="mb-2">
                  <span class="rating">${starsHTML}</span>
                  <span class="text-secondary ms-2">(${p.reviews})</span>
                </div>
                <div class="mb-2">
                  <span class="product-price">₹${p.price.toLocaleString()}</span>
                  ${oldPrice}
                </div>
                <div class="mb-2">Brand: <strong>${p.brand}</strong></div>
                <div class="button-group">
                  <button class="btn btn-outline-primary btn-sm" onclick="quickView(${p.id})">Quick View</button>
                  <button class="btn btn-primary btn-sm" onclick="addToCart(${p.id})">Add to Cart</button>
                </div>
              </div>
            </div>
          </article>
        `;
      });
      
      const start = 1;
      const end = productList.length;
      document.getElementById('resultCount').textContent = `Showing ${start}-${end} of ${end} results`;
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
                    <img src="${product.image}" class="img-fluid rounded" alt="${product.name}" onerror="this.src='https://via.placeholder.com/400x400?text=Product+Image'">
                  </div>
                  <div class="col-md-6">
                    <h4 class="text-primary">₹${product.price.toLocaleString()}</h4>
                    ${product.old_price && product.old_price > product.price ? `<p class="text-muted"><s>₹${product.old_price.toLocaleString()}</s></p>` : ''}
                    <div class="mb-2">
                      <span class="rating">${generateRatingStars(product.rating)}</span>
                      <span class="text-secondary">(${product.reviews} reviews)</span>
                    </div>
                    <p><strong>Brand:</strong> ${product.brand}</p>
                    <p><strong>Available Sizes:</strong> ${product.size.join(', ')}</p>
                    <button class="btn btn-primary w-100 mt-3" onclick="addToCart(${product.id}); bootstrap.Modal.getInstance(document.getElementById('quickViewModal')).hide();">Add to Cart</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      
      const existingModal = document.getElementById('quickViewModal');
      if (existingModal) {
        existingModal.remove();
      }
      
      document.body.insertAdjacentHTML('beforeend', modalContent);
      const quickViewModal = new bootstrap.Modal(document.getElementById('quickViewModal'));
      quickViewModal.show();
    }

    function generateRatingStars(rating) {
      let starsHTML = '';
      const fullStars = Math.floor(rating);
      const halfStar = rating % 1 >= 0.5;
      
      for (let i = 1; i <= 5; i++) {
        if (i <= fullStars) starsHTML += '<i class="bi bi-star-fill"></i>';
        else if (i === fullStars + 1 && halfStar) starsHTML += '<i class="bi bi-star-half"></i>';
        else starsHTML += '<i class="bi bi-star"></i>';
      }
      return starsHTML;
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
      modalCartTotal.textContent = totalPrice.toLocaleString();
      
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

    function buyNow() {
      if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
      }
      
      alert('Proceeding to checkout...');
      // In a real application, this would redirect to a checkout page
    }

    function showToast(message) {
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

    function updateFilterSummary() {
      const summary = document.getElementById('filterSummary');
      const activeFilters = [];
      
      if (filterState.keyword) activeFilters.push(`Search: "${filterState.keyword}"`);
      if (filterState.priceLimit < 1000000) activeFilters.push(`Max Price: ₹${filterState.priceLimit.toLocaleString()}`);
      if (filterState.minRating > 0) activeFilters.push(`Min Rating: ${filterState.minRating}+ stars`);
      
      if (activeFilters.length === 0) {
        summary.textContent = 'No filters applied';
        summary.style.backgroundColor = '#f8f9fa';
      } else {
        summary.textContent = 'Active filters: ' + activeFilters.join(' • ');
        summary.style.backgroundColor = '#e8f5e8';
      }
    }

    function applyFilters() {
      // Get search keyword
      filterState.keyword = document.getElementById('searchInput').value.trim().toLowerCase();
      
      // Get price limit
      filterState.priceLimit = parseFloat(document.getElementById('priceRange').value);
      
      // Get selected rating (highest selected rating takes precedence)
      const ratingCheckboxes = document.querySelectorAll('.rating-filter:checked');
      if (ratingCheckboxes.length > 0) {
        const ratings = Array.from(ratingCheckboxes).map(cb => parseInt(cb.value));
        filterState.minRating = Math.max(...ratings);
      } else {
        filterState.minRating = 0;
      }
      
      // Apply filters to products
      currentFilteredProducts = products.filter(p => {
        const matchKeyword = filterState.keyword === '' || 
                            p.name.toLowerCase().includes(filterState.keyword) || 
                            p.brand.toLowerCase().includes(filterState.keyword);
        const matchPrice = p.price <= filterState.priceLimit;
        const matchRating = filterState.minRating === 0 || p.rating >= filterState.minRating;
        
        return matchKeyword && matchPrice && matchRating;
      });
      
      // Update UI
      displayProducts(currentFilteredProducts);
      updateFilterSummary();
      
      // Highlight active filter sections
      document.querySelectorAll('.filter-section').forEach(section => {
        section.classList.remove('filter-active');
      });
      
      if (filterState.keyword) {
        document.querySelector('.filter-section[aria-label="Category filter"]').classList.add('filter-active');
      }
      if (filterState.priceLimit < 1000000) {
        document.querySelector('.filter-section[aria-label="Price filter"]').classList.add('filter-active');
      }
      if (filterState.minRating > 0) {
        document.querySelector('.filter-section[aria-label="Rating filter"]').classList.add('filter-active');
      }
    }

    function resetFilters() {
      // Reset form elements
      document.getElementById('searchInput').value = '';
      document.getElementById('priceRange').value = 1000000;
      document.getElementById('priceValue').innerText = '₹1,000,000';
      document.querySelectorAll('.rating-filter').forEach(cb => cb.checked = false);
      
      // Reset filter state
      filterState = {
        keyword: '',
        priceLimit: 1000000,
        sizes: [],
        minRating: 0
      };
      
      // Reset product list
      currentFilteredProducts = [...products];
      
      // Update UI
      displayProducts(products);
      updateFilterSummary();
      
      // Remove active filter highlights
      document.querySelectorAll('.filter-section').forEach(section => {
        section.classList.remove('filter-active');
      });
    }

    function sortProducts(sortValue) {
      let sortedProducts = [...currentFilteredProducts];
      
      if (sortValue === 'lowToHigh') {
        sortedProducts.sort((a, b) => a.price - b.price);
      } else if (sortValue === 'highToLow') {
        sortedProducts.sort((a, b) => b.price - a.price);
      }
      // For 'best' option, we keep the current filtered order
      
      displayProducts(sortedProducts);
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
      // Price range input value update
      document.getElementById('priceRange').addEventListener('input', function() {
        document.getElementById('priceValue').innerText = '₹' + parseInt(this.value).toLocaleString();
      });
      
      // Apply filters button
      document.getElementById('applyBtn').addEventListener('click', applyFilters);
      
      // Reset filters button
      document.getElementById('resetBtn').addEventListener('click', resetFilters);
      
      // Auto-apply filters when rating checkboxes change
      document.querySelectorAll('.rating-filter').forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
      });
      
      // Auto-apply filters when price range changes
      document.getElementById('priceRange').addEventListener('change', applyFilters);
      
      // Search input enter key
      document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          applyFilters();
        }
      });
      
      // Initialize the page
      displayProducts(products);
      updateCartUI();
      updateFavoritesCount();
      updateFilterSummary();
    });
  </script>
</body>
</html>