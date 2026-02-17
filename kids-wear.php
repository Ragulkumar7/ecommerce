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
  <link rel="stylesheet" href="./assest/css/kids-wear.css">
  <style>
    /* --- UPDATED COLORS FOR BUTTONS & SLIDERS (#d16d08f2) --- */
    
    /* Apply Filters, Add to Cart, and Modal Buy Now Buttons */
    #applyBtn, .btn-primary, .btn-buy {
        background-color: #d16d08f2 !important;
        border-color: #d16d08f2 !important;
        color: white !important;
        transition: all 0.3s ease;
        padding: 10px;
        border-radius: 8px;
        font-weight: 500;
    }

    #applyBtn:hover, .btn-primary:hover, .btn-buy:hover {
        background-color: #a35506 !important; /* Slightly darker shade for hover */
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

    /* Price Text Color in Cards */
    .product-price {
        color: #d16d08f2 !important;
        font-weight: bold;
    }

    /* Star Rating Color */
    .rating i {
        color: #d16d08f2 !important;
    }

    /* Sidebar Structure Preservation */
    .sidebar { border: 1px solid #e0e0e0; border-radius: 20px; background: white; overflow: hidden; }
  </style>
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
            <button class="search-btn" type="button" onclick="applyFilters()"><i class="bi bi-search"></i></button>
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
          <h2 class="h4 mb-3">Filters</h2>
          <div class="filter-summary" id="filterSummary">No filters applied</div>
          
          <div class="filter-section mb-4 p-3" aria-label="Category filter">
            <h3 class="h5"><i class="bi bi-tags"></i> Category</h3>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="catMen" checked disabled />
              <label class="form-check-label" for="catMen">Men's Fashion <span class="text-secondary">(11)</span></label>
            </div>
          </div>
          
          <div class="filter-section mb-4 p-3" aria-label="Price filter">
            <h3 class="h5"><i class="bi bi-currency-rupee me-2"></i>Price Range</h3>
            <input id="priceRange" type="range" min="0" max="1000" value="1000" step="10" class="form-range mb-3" aria-valuemin="0" aria-valuemax="1000" aria-valuenow="1000" aria-label="Filter by price range" />
            <div class="d-flex justify-content-between mb-0">
              <span>₹0</span>
              <span id="priceValue">₹1000</span>
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
            <button id="resetBtn" type="button" class="btn btn-outline-secondary w-100 mt-2">Reset Filters</button>
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

  <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
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
      { id: 1, name: "Dress Shirt Alpha", price: 249.99, old_price: 299.99, rating: 4.5, reviews: 142, tag: 'Sale', image: 'https://i.pinimg.com/736x/24/cd/94/24cd940984616cfa0b3402c9392959cc.jpg', brand: 'Levis', size: ['M', 'L'] },
      { id: 2, name: "Cotton Slim S Only", price: 179.99, old_price: 0, rating: 4, reviews: 87, tag: 'New', image: 'https://i.pinimg.com/736x/18/6a/5c/186a5cf32acf976d98771bbcfa471d2f.jpg', brand: 'Peter England', size: ['S'] },
      { id: 3, name: "Luxury Shirt", price: 349.99, old_price: 399.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/ce/c9/c7/cec9c7d5839d06a8ac8c1e0166d023d0.jpg', brand: 'Levis', size: ['L', 'XL'] },
      { id: 4, name: "Checked Work Shirt (XL)", price: 199.99, old_price: 319.99, rating: 4.7, reviews: 103, tag: 'Sale', image: 'https://i.pinimg.com/736x/de/18/ce/de18ce9aa032809056a3a3e6426892a3.jpg', brand: 'Arrow', size: ['XL'] },
      { id: 5, name: "Casual Blue (XXL)", price: 329.99, old_price: 369.99, rating: 4.2, reviews: 70, tag: '', image: 'https://i.pinimg.com/736x/8e/ff/23/8eff231c8650e4dd9593c9d03aaf9149.jpg', brand: 'Levis', size: ['XXL'] },
      { id: 6, name: "Crew Tee - S/M", price: 149.99, old_price: 179.99, rating: 3.8, reviews: 40, tag: '', image: 'https://i.pinimg.com/736x/b2/08/a6/b208a6d1276f7476e219c187775d3491.jpg', brand: 'Levis', size: ['S', 'M'] },
      { id: 7, name: "Urban Classic L/XL", price: 449.99, old_price: 599.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/55/f9/25/55f92534185658fd1469ec3c39842254.jpg', brand: 'Levis', size: ['L', 'XL'] },
      { id: 8, name: "Premium Oversize XXL", price: 649.99, old_price: 799.99, rating: 5, reviews: 90, tag: '', image: 'https://i.pinimg.com/1200x/52/a6/69/52a669d90cffe0269fe47f0a669898da.jpg', brand: 'Levis', size: ['XXL'] },
      { id: 9, name: "All Fit Shirt", price: 299.99, old_price: 329.99, rating: 3.5, reviews: 20, tag: '', image: 'https://i.pinimg.com/1200x/ca/c4/7f/cac47f801fe9074c657c97648c59fbec.jpg', brand: 'Levis', size: ['S', 'M', 'L', 'XL', 'XXL'] },
      { id: 10, name: "XL Only Premium", price: 399.99, old_price: 459.99, rating: 4.1, reviews: 101, tag: '', image: 'https://i.pinimg.com/1200x/59/89/2f/59892fa010836473215d6cfcce79dc3b.jpg', brand: 'Levis', size: ['XL'] },
      { id: 11, name: "Casual Shirt - M", price: 189.99, old_price: 229.99, rating: 3.9, reviews: 50, tag: '', image: 'https://i.pinimg.com/1200x/fc/c6/57/fcc6579ef8490df930365f9f7e42c205.jpg', brand: 'Levis', size: ['M'] }
    ];
    
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let filterState = {
      keyword: '',
      priceLimit: 1000,
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
        const badge = p.tag ? `<span class="badge bg-${p.tag === 'Sale' ? 'danger' : 'success'}">${p.tag}</span>` : '';
        const oldPrice = p.old_price && p.old_price > p.price ? `<span class="product-old">₹${p.old_price.toFixed(2)}</span>` : '';
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
              <img src="${p.image}" class="product-img" alt="${p.name}" />
              <div class="p-3">
                <h3 class="product-title">${p.name}</h3>
                <div class="rating">
                  <span>${starsHTML}</span>
                  <span class="text-secondary ms-2">(${p.reviews})</span>
                </div>
                <div class="mt-2">
                  <span class="product-price">₹${p.price.toFixed(2)}</span>
                  ${oldPrice}
                </div>
                <div class="mt-2 mb-2 small">Sizes: <strong>${sizes}</strong></div>
                <div class="button-group d-flex gap-2">
                  <button class="btn btn-outline-primary btn-sm flex-grow-1" onclick="viewDetails(${p.id})">Details</button>
                  <button class="btn btn-primary btn-sm flex-grow-1" onclick="addToCart(${p.id})">Add to Cart</button>
                </div>
              </div>
            </div>
          </article>
        `;
      });
      
      document.getElementById('resultCount').textContent = `Showing 1-${productList.length} of ${productList.length} results`;
    }

    function viewDetails(productId) {
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
                    <img src="${product.image}" class="img-fluid rounded" alt="${product.name}">
                  </div>
                  <div class="col-md-6">
                    <h4 class="text-primary">₹${product.price.toLocaleString()}</h4>
                    ${product.old_price ? `<p class="text-muted"><s>₹${product.old_price.toLocaleString()}</s></p>` : ''}
                    <p><strong>Brand:</strong> ${product.brand}</p>
                    <p><strong>Available Sizes:</strong> ${product.size.join(', ')}</p>
                    <p><strong>Rating:</strong> ${product.rating} (${product.reviews} reviews)</p>
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

    function buyNow() {
      if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
      }
      alert('Proceeding to checkout...');
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
      if (filterState.priceLimit < 1000) activeFilters.push(`Max Price: ₹${filterState.priceLimit}`);
      if (filterState.sizes.length > 0) activeFilters.push(`Sizes: ${filterState.sizes.join(', ')}`);
      if (filterState.minRating > 0) activeFilters.push(`Min Rating: ${filterState.minRating}+ stars`);
      
      summary.textContent = activeFilters.length === 0 ? 'No filters applied' : 'Active filters: ' + activeFilters.join(' • ');
    }

    function applyFilters() {
      filterState.keyword = document.getElementById('searchInput').value.trim().toLowerCase();
      filterState.priceLimit = parseFloat(document.getElementById('priceRange').value);
      filterState.sizes = Array.from(document.querySelectorAll('.size-filter:checked')).map(cb => cb.value);
      
      const ratingCheckboxes = document.querySelectorAll('.rating-filter:checked');
      filterState.minRating = ratingCheckboxes.length > 0 ? Math.max(...Array.from(ratingCheckboxes).map(cb => parseInt(cb.value))) : 0;
      
      currentFilteredProducts = products.filter(p => {
        const matchKeyword = filterState.keyword === '' || p.name.toLowerCase().includes(filterState.keyword) || p.brand.toLowerCase().includes(filterState.keyword);
        const matchPrice = p.price <= filterState.priceLimit;
        const matchSize = filterState.sizes.length === 0 || filterState.sizes.some(sz => p.size.includes(sz));
        const matchRating = filterState.minRating === 0 || p.rating >= filterState.minRating;
        
        return matchKeyword && matchPrice && matchSize && matchRating;
      });
      
      displayProducts(currentFilteredProducts);
      updateFilterSummary();
    }

    function resetFilters() {
      document.getElementById('searchInput').value = '';
      document.getElementById('priceRange').value = 1000;
      document.getElementById('priceValue').innerText = '₹1000';
      document.querySelectorAll('.size-filter').forEach(cb => cb.checked = false);
      document.querySelectorAll('.rating-filter').forEach(cb => cb.checked = false);
      
      filterState = { keyword: '', priceLimit: 1000, sizes: [], minRating: 0 };
      currentFilteredProducts = [...products];
      displayProducts(products);
      updateFilterSummary();
    }

    function sortProducts(sortValue) {
      let sortedProducts = [...currentFilteredProducts];
      if (sortValue === 'lowToHigh') sortedProducts.sort((a, b) => a.price - b.price);
      else if (sortValue === 'highToLow') sortedProducts.sort((a, b) => b.price - a.price);
      displayProducts(sortedProducts);
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('priceRange').addEventListener('input', function() {
        document.getElementById('priceValue').innerText = '₹' + this.value;
      });
      
      document.getElementById('applyBtn').addEventListener('click', applyFilters);
      document.getElementById('resetBtn').addEventListener('click', resetFilters);
      
      document.querySelectorAll('.size-filter, .rating-filter').forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
      });
      
      document.getElementById('priceRange').addEventListener('change', applyFilters);
      
      displayProducts(products);
      updateCartUI();
    });
  </script>
</body>
</html>