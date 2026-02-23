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
  <title>StyleHub | Product Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="./assest/css/beauty-products.css" />
  <style>
    /* Styling for the clay-red navbar */
    .main-navbar { background-color: var(--primary) !important; padding: 10px 0; }
    .main-navbar .nav-link { color: white !important; font-weight: 500; border-bottom: 3px solid transparent; }
    .main-navbar .nav-link.active { border-bottom: 3px solid #ffcc66; }

    /* Product Detail UI specific styles */
    .detail-card { background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 5px 25px rgba(0,0,0,0.08); }
    .product-img-main { width: 100%; border-radius: 15px; max-height: 500px; object-fit: contain; background: #f9f9f9; }
    .price-large { font-size: 2.2rem; color: var(--primary); font-weight: 800; }
    .btn-buy-now { background-color: var(--primary); color: white; padding: 12px 30px; border-radius: 50px; font-weight: 600; width: 100%; border: none; }
    .btn-buy-now:hover { background-color: var(--primary-dark); color: white; }
    .breadcrumb-item a { color: var(--primary); text-decoration: none; }
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
            <input class="form-control search-input" type="search" placeholder="Search StyleHub..." aria-label="Search">
            <button class="search-btn" type="button"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
          <div class="d-flex align-items-center justify-content-end header-actions">
            <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-heart"></i></a>
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
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house me-1"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link active" href="#">Product Details</a></li>
            <li class="nav-item"><a class="nav-link" href="beauty-products.php">Beauty</a></li>
            <li class="nav-item"><a class="nav-link" href="stationary.php">Stationary</a></li>
            <li class="nav-item"><a class="nav-link" href="mens-wear.php">Fashion</a></li>
        </ul>
    </div>
</nav>

<main class="container py-5">
    <div id="product-detail-loader" class="text-center py-5">
        <div class="spinner-border text-primary" role="status"></div>
    </div>

    <div id="product-content" class="row g-4 d-none">
        <div class="col-lg-6">
            <div class="detail-card text-center">
                <img id="main-img" src="" class="product-img-main" alt="Product Image">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="detail-card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li id="breadcrumb-cat" class="breadcrumb-item active">Category</li>
                    </ol>
                </nav>
                
                <h1 id="prod-name" class="fw-bold mb-2">Product Name</h1>
                <div class="mb-3">
                    <span class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></span>
                    <span id="prod-reviews" class="text-muted ms-2">(0 reviews)</span>
                </div>

                <div id="prod-price" class="price-large mb-4">₹0.00</div>
                
                <hr>
                <h5 class="fw-bold">Description</h5>
                <p id="prod-desc" class="text-secondary mb-4">Quality product from StyleHub collection. Perfect for your daily needs.</p>

                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" id="hidden-id">
                    <input type="hidden" name="product_name" id="hidden-name">
                    <input type="hidden" name="product_price" id="hidden-price">
                    <input type="hidden" name="product_image" id="hidden-image">

                    <div class="row g-2 mt-4">
                        <div class="col-4">
                            <select name="qty" class="form-select py-2 border-0 bg-light rounded-pill">
                                <option value="1">Qty: 1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <button type="submit" name="add_to_cart" id="add-to-cart-btn" class="btn btn-buy-now">
                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </form>
                <div class="mt-5 p-3 border rounded-4 bg-light d-flex align-items-center">
                    <i class="bi bi-shield-check fs-2 text-success me-3"></i>
                    <div>
                        <p class="mb-0 fw-bold">1 Year StyleHub Warranty</p>
                        <p class="mb-0 small text-muted">100% Original and Verified Product</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer-section">
    <div class="container text-center">
        <h2 class="footer-brand-text mb-3">StyleHub</h2>
        <p>&copy; 2023 StyleHub. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const allProducts = [
    // --- MAKEUP PRODUCTS ---
    { id: 4, name: "Matte Red Lipstick", price: 600, category: "Makeup", reviews: 130, rating: 4.8, image: "https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400&q=80", desc: "Long-lasting matte finish lipstick with intense color payoff." },
    { id: 6, name: "Liquid Foundation", price: 850, category: "Makeup", reviews: 210, rating: 4.6, image: "./assest/img/foundation.jpg", desc: "Full coverage lightweight foundation for a flawless look." },
    { id: 7, name: "Volume Mascara", price: 450, category: "Makeup", reviews: 95, rating: 4.3, image: "./assest/img/mascara.jpg", desc: "Volumizing mascara for thicker, longer looking lashes." },
    { id: 8, name: "Black Eyeliner", price: 300, category: "Makeup", reviews: 320, rating: 4.5, image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&q=80", desc: "Smudge-proof, waterproof liquid black eyeliner." },

    // --- GOLD & JEWELRY ---
    { id: 10, name: "High Gold plated bangle with Ruby Stones", price: 24999, category: "Jewelry", reviews: 142, rating: 4.5, brand: 'GoldCraft', image: './assest/img/IMG_20250818_165443.png', desc: "Elegant high gold plated bangles adorned with premium ruby stones." },
    { id: 11, name: "High Gold plated bangle with AD Stones", price: 17999, category: "Jewelry", reviews: 87, rating: 4.0, brand: 'Heritage Gold', image: './assest/img/IMG_20250818_171359.png', desc: "Beautifully crafted gold plated bangles featuring sparkling AD stones." },
    { id: 12, name: "Premium Quality Meganthi Polish Jhumka", price: 34999, category: "Jewelry", reviews: 215, rating: 5.0, brand: 'DiamondLuxe', image: './ASSEST/img/IMG_20250829_123319.png', desc: "Traditional Meganthi polish jhumkas perfect for festive occasions." },
    { id: 13, name: "Premium Quality Meganthi Polish Necklace", price: 19999, category: "Jewelry", reviews: 163, rating: 4.5, brand: 'SilverEssence', image: './ASSEST/img/IMG_20250829_123828.png', desc: "Stunning Meganthi polish necklace to complete your ethnic look." },
    { id: 14, name: "Necklace with Ear rings", price: 12999, category: "Jewelry", reviews: 94, rating: 4.0, brand: 'DiamondLuxe', image: './ASSEST/img/IMG_20250829_124455.png', desc: "Matching necklace and earring set with intricate detailing." },
    { id: 15, name: "High Gold Plated 24 Rope chain", price: 15999, category: "Jewelry", reviews: 201, rating: 5.0, brand: 'GoldCraft', image: './ASSEST/img/IMG-20250811-WA0153.png', desc: "Durable and shiny 24-inch gold plated rope chain." },
    { id: 16, name: "2 layer White & Ruby stones Necklace", price: 17999, category: "Jewelry", reviews: 87, rating: 4.0, brand: 'Heritage Gold', image: './assest/img/IMG-20250717-WA0068.png', desc: "Two-layer necklace featuring a gorgeous mix of white and ruby stones." },
    { id: 17, name: "Three layer Necklace with Ear rings", price: 34999, category: "Jewelry", reviews: 215, rating: 5.0, brand: 'DiamondLuxe', image: './ASSEST/img/IMG-20250811-WA0153.png', desc: "Luxurious three-layer necklace set accompanied by matching earrings." },
    { id: 18, name: "High Gold plated White & Ruby Stones Haram set", price: 19999, category: "Jewelry", reviews: 163, rating: 4.5, brand: 'SilverEssence', image: './ASSEST/img/IMG-20250826-WA0026.jpg', desc: "Complete bridal Haram and necklace set with white and ruby stones." },
    { id: 19, name: "High Gold plated Peacock design Haram set", price: 12999, category: "Jewelry", reviews: 94, rating: 4.0, brand: 'DiamondLuxe', image: './ASSEST/img/IMG-20250903-WA0054.png', desc: "Traditional peacock motif necklace and Haram set." },
    { id: 20, name: "High Gold plated Red, Green & Gold Necklace", price: 15999, category: "Jewelry", reviews: 201, rating: 5.0, brand: 'GoldCraft', image: './ASSEST/img/IMG-20250903-WA0060.png', desc: "Multi-colored stone studded gold plated necklace." },

    // --- TEA & COFFEE ---
    { id: 101, name: "Earl Grey Premium Tea", price: 850, category: "Tea", rating: 4.7, reviews: 120, image: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Classic black tea infused with bergamot oil." },
    { id: 102, name: "Ethiopian Yirgacheffe Coffee", price: 1200, category: "Coffee", rating: 4.8, reviews: 95, image: "https://images.unsplash.com/photo-1587734195503-904fca47e0e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Premium medium roast coffee beans with floral notes." },
    { id: 103, name: "Ceramic Teapot Set", price: 1800, category: "Accessories", rating: 4.5, reviews: 65, image: "https://images.unsplash.com/photo-1594736797933-d0b1d0bf8d78?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Beautifully glazed ceramic teapot with two matching cups." },
    { id: 104, name: "Japanese Matcha Green Tea", price: 950, category: "Tea", rating: 4.9, reviews: 150, image: "https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Authentic premium matcha powder from Japan." },
    { id: 105, name: "French Press Coffee Maker", price: 2200, category: "Accessories", rating: 4.6, reviews: 80, image: "https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "High-quality glass french press for the perfect brew." },
    { id: 106, name: "Colombian Supremo Coffee", price: 1100, category: "Coffee", rating: 4.7, reviews: 110, image: "https://images.unsplash.com/photo-1587734195503-904fca47e0e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Rich and smooth Colombian coffee beans." },

    // --- ACCESSORIES ---
    { id: 301, name: "Wireless Gaming Mouse", price: 2500, category: "Accessories", reviews: 45, rating: 4.5, brand: "Logitech", image: "https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500", desc: "High-speed wireless mouse with customizable DPI and RGB lighting." },
    { id: 302, name: "Fast Charging Type-C Cable", price: 499, category: "Accessories", reviews: 112, rating: 4.2, brand: "Samsung", image: "https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=500", desc: "Durable braided cable for ultra-fast charging and data sync." },

    // --- ELECTRONICS ---
    { id: 601, name: "iPhone 14 Pro", price: 80000, category: "Mobile Phones", rating: 4.2, reviews: 70, brand: 'Apple', image: 'https://i.pinimg.com/736x/f5/c1/66/f5c16671a90ff6094847c3a765d26147.jpg', desc: "Features the dynamic island, 48MP camera, and A16 chip." }
  ];

  function loadProduct() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = parseInt(urlParams.get('id'));
    const product = allProducts.find(p => p.id === id);

    if (product) {
        document.getElementById('main-img').src = product.image;
        document.getElementById('prod-name').innerText = product.name;
        document.getElementById('prod-price').innerText = "₹" + product.price.toLocaleString();
        document.getElementById('prod-reviews').innerText = `(${product.reviews} reviews)`;
        document.getElementById('breadcrumb-cat').innerText = product.category;
        if(product.desc) document.getElementById('prod-desc').innerText = product.desc;

        // POPULATE HIDDEN INPUTS FOR PHP PROCESSING
        document.getElementById('hidden-id').value = product.id;
        document.getElementById('hidden-name').value = product.name;
        document.getElementById('hidden-price').value = product.price;
        document.getElementById('hidden-image').value = product.image;

        document.getElementById('product-detail-loader').classList.add('d-none');
        document.getElementById('product-content').classList.remove('d-none');
    } else {
        document.querySelector('main').innerHTML = `<div class="text-center py-5"><h2>Product not found</h2><a href="index.php">Go Home</a></div>`;
    }
  }

  function updateCartUI() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const countEl = document.getElementById('header-cart-count');
    const totalEl = document.getElementById('header-total');
    
    if(countEl) countEl.textContent = cart.length;
    const total = cart.reduce((sum, p) => sum + p.price, 0);
    if(totalEl) totalEl.textContent = total.toFixed(2);
  }

  window.onload = () => {
    loadProduct();
    updateCartUI();
  };
</script>
</body>
</html>