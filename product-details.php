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
    .main-navbar { background-color: #cd7d73 !important; padding: 10px 0; }
    .main-navbar .nav-link { color: white !important; font-weight: 500; border-bottom: 3px solid transparent; }
    .main-navbar .nav-link.active { border-bottom: 3px solid #ffcc66; }

    /* Product Detail UI specific styles */
    .detail-card { background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 5px 25px rgba(0,0,0,0.08); }
    .product-img-main { width: 100%; border-radius: 15px; max-height: 500px; object-fit: contain; background: #f9f9f9; }
    .price-large { font-size: 2.2rem; color: #cd7d73; font-weight: 800; }
    .btn-buy-now { background-color: #0d6efd; color: white; padding: 12px 30px; border-radius: 50px; font-weight: 600; width: 100%; }
    .btn-buy-now:hover { background-color: #0b5ed7; color: white; }
    .breadcrumb-item a { color: #cd7d73; text-decoration: none; }
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

                <div class="row g-2 mt-4">
                    <div class="col-4">
                        <select class="form-select py-2 border-0 bg-light rounded-pill">
                            <option>Qty: 1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <button id="add-to-cart-btn" class="btn btn-buy-now">
                            <i class="bi bi-cart-plus me-2"></i>Add to Cart
                        </button>
                    </div>
                </div>

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
  // Combine products from your various pages here
  // Combine ALL products from your various pages here with UNIQUE IDs
  const allProducts = [
    // --- MAKEUP PRODUCTS (IDs under 100) ---
    { id: 4, name: "Matte Red Lipstick", price: 600, category: "Makeup", reviews: 130, rating: 4.8, image: "https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400&q=80", desc: "Long-lasting matte finish lipstick with intense color payoff." },
    { id: 6, name: "Liquid Foundation", price: 850, category: "Makeup", reviews: 210, rating: 4.6, image: "./assest/img/foundation.jpg", desc: "Full coverage lightweight foundation for a flawless look." },
    { id: 7, name: "Volume Mascara", price: 450, category: "Makeup", reviews: 95, rating: 4.3, image: "./assest/img/mascara.jpg", desc: "Volumizing mascara for thicker, longer looking lashes." },
    { id: 8, name: "Black Eyeliner", price: 300, category: "Makeup", reviews: 320, rating: 4.5, image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&q=80", desc: "Smudge-proof, waterproof liquid black eyeliner." },

    // --- GOLD & JEWELRY (IDs under 100) ---
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

    // --- TEA & COFFEE (100s) ---
    { id: 101, name: "Earl Grey Premium Tea", price: 850, category: "Tea", rating: 4.7, reviews: 120, image: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Classic black tea infused with bergamot oil." },
    { id: 102, name: "Ethiopian Yirgacheffe Coffee", price: 1200, category: "Coffee", rating: 4.8, reviews: 95, image: "https://images.unsplash.com/photo-1587734195503-904fca47e0e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Premium medium roast coffee beans with floral notes." },
    { id: 103, name: "Ceramic Teapot Set", price: 1800, category: "Accessories", rating: 4.5, reviews: 65, image: "./ASSEST/img/teapot.jpg", desc: "Beautifully glazed ceramic teapot with two matching cups." },
    { id: 104, name: "Japanese Matcha Green Tea", price: 950, category: "Tea", rating: 4.9, reviews: 150, image: "https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Authentic premium matcha powder from Japan." },
    { id: 105, name: "French Press Coffee Maker", price: 2200, category: "Accessories", rating: 4.6, reviews: 80, image: "https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "High-quality glass french press for the perfect brew." },
    { id: 106, name: "Colombian Supremo Coffee", price: 1100, category: "Coffee", rating: 4.7, reviews: 110, image: "https://images.unsplash.com/photo-1587734195503-904fca47e0e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Rich and smooth Colombian coffee beans." },
    { id: 107, name: "Chamomile Herbal Tea", price: 650, category: "Tea", rating: 4.4, reviews: 75, image: "./ASSEST/img/herbal.jpg", desc: "Calming chamomile tea for evening relaxation." },
    { id: 108, name: "Coffee Grinder", price: 1500, category: "Accessories", rating: 4.3, reviews: 60, image: "./ASSEST/img/grinder.jpg", desc: "Manual coffee grinder with adjustable settings." },
    { id: 109, name: "Assam Black Tea", price: 750, category: "Tea", rating: 4.6, reviews: 90, image: "https://images.unsplash.com/photo-1571934811356-5cc061b6821f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80", desc: "Strong and malty black tea sourced directly from Assam." },

    // --- WOMEN'S WEAR (200s) ---
    { id: 201, name: "SilentParrot Ladies' Panties - Classic", price: 299.99, category: "Women's Fashion", rating: 4.5, reviews: 142, brand: 'Slient parrot', image: 'https://www.silentparrot.in/wp-content/uploads/2025/06/1.jpg', desc: "Comfortable and breathable classic fit." },
    { id: 202, name: "SilentParrot Multi-Pack Collection", price: 179.99, category: "Women's Fashion", rating: 4.0, reviews: 87, brand: 'Slient parrot', image: 'https://www.silentparrot.in/wp-content/uploads/2025/06/2.jpg', desc: "Convenient 3-pack for everyday wear." },
    { id: 203, name: "SilentParrot Premium Cotton Panties", price: 349.99, category: "Women's Fashion", rating: 5.0, reviews: 215, brand: 'Slient parrot', image: 'https://test.divasprik.in/Silentparrot/frontend/ASSETS/images/womenproduct2.jpg', desc: "High-quality premium cotton with blue patterns." },
    { id: 204, name: "Premium Men's Dress Series 3", price: 399.99, category: "Women's Fashion", rating: 5.0, reviews: 215, brand: 'Levis', image: 'https://i.pinimg.com/736x/f5/a0/4c/f5a04c9dfbcfceb0eebc347d7ffa71b5.jpg', desc: "Premium designer apparel." },
    { id: 205, name: "Premium Men's Dress Series 8", price: 299.99, category: "Women's Fashion", rating: 5.0, reviews: 215, brand: 'Levis', image: 'https://i.pinimg.com/1200x/49/67/15/496715d79127f5bf9b1864625400216b.jpg', desc: "Premium designer apparel." },
    { id: 206, name: "Premium Men's Dress Series 2", price: 399.99, category: "Women's Fashion", rating: 5.0, reviews: 215, brand: 'Levis', image: 'https://i.pinimg.com/1200x/aa/07/19/aa0719404f01f341cbeb2771a489ef81.jpg', desc: "Premium designer apparel." },
    { id: 207, name: "Premium Men's Dress Series 5", price: 449.99, category: "Women's Fashion", rating: 5.0, reviews: 215, brand: 'Levis', image: 'https://i.pinimg.com/736x/b7/af/12/b7af1257268780a1f43495fefd2e6601.jpg', desc: "Premium designer apparel." },
    { id: 208, name: "Premium Men's Dress Series 8", price: 649.99, category: "Women's Fashion", rating: 5.0, reviews: 215, brand: 'Levis', image: 'https://i.pinimg.com/1200x/19/3e/cf/193ecf4993db80e67e9d125adadfe9f3.jpg', desc: "Premium designer apparel." },
    { id: 209, name: "Premium Men's Dress Series 9", price: 649.99, category: "Women's Fashion", rating: 5.0, reviews: 215, brand: 'Levis', image: 'https://i.pinimg.com/736x/5e/64/9b/5e649bad379266840a64a9699fd746d6.jpg', desc: "Premium designer apparel." },

    // --- ACCESSORIES (300s) ---
    { id: 301, name: "Wireless Gaming Mouse", price: 2500, category: "Accessories", reviews: 45, rating: 4.5, brand: "Logitech", image: "https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500", desc: "High-speed wireless mouse with customizable DPI and RGB lighting." },
    { id: 302, name: "Fast Charging Type-C Cable", price: 499, category: "Accessories", reviews: 112, rating: 4.2, brand: "Samsung", image: "https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=500", desc: "Durable braided cable for ultra-fast charging and data sync." },
    { id: 303, name: "Laptop Cooling Pad", price: 1800, category: "Accessories", reviews: 89, rating: 4.0, brand: "Zeb", image: "https://images.unsplash.com/photo-1587202395103-53d748273615?w=500", desc: "Dual fan system to keep your laptop cool during intensive gaming." },
    { id: 304, name: "Bluetooth Selfie Stick", price: 850, category: "Accessories", reviews: 56, rating: 4.1, brand: "Generic", image: "https://images.unsplash.com/photo-1574944985070-8f3ebc6b79d2?w=500", desc: "Extendable selfie stick with integrated Bluetooth shutter and tripod base." },
    { id: 305, name: "65W Laptop Power Adapter", price: 3200, category: "Accessories", reviews: 23, rating: 4.7, brand: "Dell", image: "https://images.unsplash.com/photo-1585338107529-13afc5f02586?w=500", desc: "Compact and efficient 65W power brick compatible with most modern USB-C laptops." },

    // --- SKINCARE (400s) ---
    { id: 401, name: "Hydrating Moisturizer", price: 1200, category: "Skincare", rating: 4.9, reviews: 450, image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&q=80", desc: "Deep hydration formula perfect for dry skin types." },
    { id: 402, name: "Vitamin C Serum", price: 1500, category: "Skincare", rating: 4.7, reviews: 312, image: "./assest/img/serum.jpg", desc: "Brightening serum for a glowing and even complexion." },
    { id: 403, name: "Gentle Cleanser", price: 800, category: "Skincare", rating: 4.5, reviews: 180, image: "https://images.unsplash.com/photo-1556228720-195a672e8a03?w=400&q=80", desc: "Daily facial cleanser that doesn't strip skin of its natural oils." },

    // --- MEN'S WEAR ---
    { id: 501, name: "Premium Men's Dress Series 7", price: 249.99, old_price: 299.99, rating: 4.5, reviews: 142, tag: 'Sale', image: 'https://i.pinimg.com/736x/76/0f/aa/760faa8086afb8c9d2d5c93715db4ec0.jpg', brand: 'Levis', category: "Men's Fashion" },
    { id: 502, name: "Premium Men's Dress Series 5", price: 179.99, old_price: 0, rating: 4, reviews: 87, tag: 'New', image: 'https://i.pinimg.com/736x/83/20/77/8320778b243c6ba85310486acad071dc.jpg', brand: 'Peter England', category: "Men's Fashion" },
    { id: 503, name: "Luxury shirt", price: 349.99, old_price: 399.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/c0/d8/28/c0d828a20dabf18765790f22fd2bd23b.jpg', brand: 'Levis', category: "Men's Fashion" },
    { id: 504, name: "Premium Men's Dress Series 3", price: 399.99, old_price: 499.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/77/10/52/7710525232ffc1e816ead33d6e42d774.jpg', brand: 'Levis', category: "Men's Fashion" },
    { id: 505, name: "Premium Men's Dress Series 8", price: 299.99, old_price: 369.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/0f/94/96/0f9496deadaff29c0fb556fbdced4a27.jpg', brand: 'Levis', category: "Men's Fashion" },
    { id: 506, name: "Premium Men's Dress Series 2", price: 399.99, old_price: 479.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/0c/7e/55/0c7e55546c747e433ee53455189dfcab.jpg', brand: 'Levis', category: "Men's Fashion" },
    { id: 507, name: "Premium Men's Dress Series 5", price: 449.99, old_price: 599.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/83/0b/5f/830b5fa86c2d6c8975adc064d9ca6748.jpg', brand: 'Levis', category: "Men's Fashion" },
    { id: 508, name: "Premium Men's Dress Series 8", price: 649.99, old_price: 799.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/1200x/19/3e/cf/193ecf4993db80e67e9d125adadfe9f3.jpg', brand: 'Levis', category: "Men's Fashion" },
    { id: 509, name: "Premium Men's Dress Series 9", price: 649.99, old_price: 699.99, rating: 5, reviews: 215, tag: '', image: 'https://i.pinimg.com/736x/5e/64/9b/5e649bad379266840a64a9699fd746d6.jpg', brand: 'Levis', category: "Men's Fashion" },

    // --- ELECTRONICS (600s) ---
    { id: 601, name: "iPhone 14 Pro", price: 80000, category: "Mobile Phones", rating: 4.2, reviews: 70, brand: 'Apple', image: 'https://i.pinimg.com/736x/f5/c1/66/f5c16671a90ff6094847c3a765d26147.jpg', desc: "Features the dynamic island, 48MP camera, and A16 chip." },
    { id: 602, name: "Samsung S23", price: 60000, category: "Mobile Phones", rating: 5.0, reviews: 40, brand: 'Samsung', image: 'https://i.pinimg.com/736x/66/c2/3f/66c23f9566266ec63f39b2dac1a56585.jpg', desc: "Compact flagship with powerful performance and excellent cameras." },

    // --- LAPTOPS (800s) ---
    { id: 801, name: "Premium Business Laptop", price: 85000, category: "Laptops", rating: 4.8, reviews: 120, image: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500", brand: "BrandX", desc: "Sleek and powerful laptop for professionals on the go." },
    { id: 802, name: "Ultra Gaming Pro", price: 125000, category: "Laptops", rating: 4.9, reviews: 230, image: "https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500", brand: "BrandY", desc: "Top-tier gaming laptop with dedicated graphics and high refresh rate." },
    { id: 803, name: "Student Slim Note", price: 45000, category: "Laptops", rating: 4.5, reviews: 310, image: "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500", brand: "BrandZ", desc: "Lightweight and affordable laptop perfect for students." },

    // --- STATIONERY (700s) ---
    { id: 701, name: "Gel Pen Set", price: 150, category: "Stationery", rating: 4.5, reviews: 120, image: "https://i.pinimg.com/1200x/18/dd/a7/18dda7156ace505cf245e0d58705a218.jpg", desc: "Smooth writing multi-color gel pen set." },
    { id: 702, name: "Spiral Notebook", price: 80, category: "Stationery", rating: 4.2, reviews: 90, image: "https://i.pinimg.com/736x/ed/8d/16/ed8d1658bb2f25a9ef4688fd6413ab06.jpg", desc: "150-page college-ruled spiral notebook." },
    { id: 703, name: "White Eraser", price: 20, category: "Stationery", rating: 4.0, reviews: 40, image: "https://i.pinimg.com/736x/f2/d1/23/f2d123ab237f8577f87bb10967abfd6a.jpg", desc: "High-quality dust-free white eraser." },
    { id: 704, name: "Permanent Marker", price: 120, category: "Stationery", rating: 4.7, reviews: 140, image: "https://i.pinimg.com/736x/19/0f/ab/190fabd11ddbcbc63dbe23c9478c1d86.jpg", desc: "Bold, long-lasting permanent marker." },
    { id: 705, name: "Ballpoint Pen", price: 100, category: "Stationery", rating: 4.3, reviews: 70, image: "https://i.pinimg.com/1200x/a7/56/23/a75623f1ee5b4059967682858ed4e4cc.jpg", desc: "Comfortable grip ballpoint pen for everyday use." },
    
// --- KIDS' WEAR (IDs mapped to 900s) ---
    { id: 901, name: "Kids Casual Shirt", price: 249.99, old_price: 299.99, rating: 4.5, reviews: 142, brand: 'Levis', size: ['M', 'L'], image: 'https://i.pinimg.com/736x/24/cd/94/24cd940984616cfa0b3402c9392959cc.jpg', desc: "Comfortable kids casual shirt.", category: "Kids' Fashion" },
    { id: 902, name: "Boys Denim Outfit", price: 179.99, old_price: 0, rating: 4, reviews: 87, brand: 'Peter England', size: ['S'], image: 'https://i.pinimg.com/736x/18/6a/5c/186a5cf32acf976d98771bbcfa471d2f.jpg', desc: "Stylish denim outfit for boys.", category: "Kids' Fashion" },
    { id: 903, name: "Kids Party Wear", price: 349.99, old_price: 399.99, rating: 5, reviews: 215, brand: 'Levis', size: ['L', 'XL'], image: 'https://i.pinimg.com/736x/ce/c9/c7/cec9c7d5839d06a8ac8c1e0166d023d0.jpg', desc: "Perfect party wear for kids.", category: "Kids' Fashion" },
    { id: 904, name: "Boys Checked Shirt", price: 199.99, old_price: 319.99, rating: 4.7, reviews: 103, brand: 'Arrow', size: ['XL'], image: 'https://i.pinimg.com/736x/de/18/ce/de18ce9aa032809056a3a3e6426892a3.jpg', desc: "Checked shirt for a smart look.", category: "Kids' Fashion" },
    { id: 905, name: "Kids Blue Casuals", price: 329.99, old_price: 369.99, rating: 4.2, reviews: 70, brand: 'Levis', size: ['XXL'], image: 'https://i.pinimg.com/736x/8e/ff/23/8eff231c8650e4dd9593c9d03aaf9149.jpg', desc: "Blue casuals for everyday wear.", category: "Kids' Fashion" },
    { id: 906, name: "Kids Cotton Tee", price: 149.99, old_price: 179.99, rating: 3.8, reviews: 40, brand: 'Levis', size: ['S', 'M'], image: 'https://i.pinimg.com/736x/b2/08/a6/b208a6d1276f7476e219c187775d3491.jpg', desc: "Soft cotton tee for comfort.", category: "Kids' Fashion" },
    { id: 907, name: "Urban Kids Classic", price: 449.99, old_price: 599.99, rating: 5, reviews: 215, brand: 'Levis', size: ['L', 'XL'], image: 'https://i.pinimg.com/736x/55/f9/25/55f92534185658fd1469ec3c39842254.jpg', desc: "Urban classic styling for kids.", category: "Kids' Fashion" },
    { id: 908, name: "Premium Kids Hoodie", price: 649.99, old_price: 799.99, rating: 5, reviews: 90, brand: 'Levis', size: ['XXL'], image: 'https://i.pinimg.com/1200x/52/a6/69/52a669d90cffe0269fe47f0a669898da.jpg', desc: "Warm and cozy premium hoodie.", category: "Kids' Fashion" },
    { id: 909, name: "Kids Fit Shirt", price: 299.99, old_price: 329.99, rating: 3.5, reviews: 20, brand: 'Levis', size: ['S', 'M', 'L', 'XL', 'XXL'], image: 'https://i.pinimg.com/1200x/ca/c4/7f/cac47f801fe9074c657c97648c59fbec.jpg', desc: "Comfortable fit shirt for kids.", category: "Kids' Fashion" },
    { id: 910, name: "Kids Premium Jacket", price: 399.99, old_price: 459.99, rating: 4.1, reviews: 101, brand: 'Levis', size: ['XL'], image: 'https://i.pinimg.com/1200x/59/89/2f/59892fa010836473215d6cfcce79dc3b.jpg', desc: "Premium jacket for cold weather.", category: "Kids' Fashion" },
    { id: 911, name: "Casual Boys Shirt", price: 189.99, old_price: 229.99, rating: 3.9, reviews: 50, brand: 'Levis', size: ['M'], image: 'https://i.pinimg.com/1200x/fc/c6/57/fcc6579ef8490df930365f9f7e42c205.jpg', desc: "Casual everyday shirt for boys.", category: "Kids' Fashion" },

    // --- MAIN SHOP MIXED ITEMS (IDs mapped to 1000s) ---
    { id: 1001, name: "Premium Men's Dress Series 7", image: "./ASSEST/img/Premium.jpg", category: "Men's Fashion", price: 249.99, originalPrice: 299.99, rating: 4.5, reviews: 142, brand: "premium", desc: "Premium quality men's dress with elegant design and comfortable fit. Perfect for formal occasions and business meetings." },
    { id: 1002, name: "Women Fashion Dress", image: "./ASSEST/img/women.jpg", category: "Women's Fashion", price: 179.99, rating: 4.0, reviews: 87, brand: "modern", desc: "Stylish and comfortable women's fashion dress perfect for casual and semi-formal occasions." },
    { id: 1003, name: "Luxury Smart Watch - Gold Edition", image: "./ASSEST/img/watch.jpg", category: "Electronics", price: 349.99, originalPrice: 399.99, rating: 5.0, reviews: 215, brand: "premium", desc: "Premium luxury smart watch with advanced health monitoring features and elegant gold finish." },
    { id: 1004, name: "Sports Smart Watch - Waterproof", image: "https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?auto=format&fit=crop&w=870&q=80", category: "Electronics", price: 199.99, originalPrice: 249.99, rating: 4.5, reviews: 163, brand: "modern", desc: "Rugged sports smart watch designed for active lifestyle with comprehensive fitness tracking." },
    { id: 1005, name: "Stationery Kit", image: "https://img.freepik.com/free-photo/top-view-wooden-desk-with-notebook-office-supplies_24837-170.jpg?w=740&q=80", category: "Stationery", price: 129.99, rating: 4.0, reviews: 94, brand: "classic", desc: "Complete stationery kit with all essential items for students and professionals." },
    { id: 1006, name: "Premium Brand - Makeup Kit", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkLV-qSVvs5Fr5UNrZ3nb6BrP0QF1k-u8akA&s", category: "Beauty", price: 159.99, originalPrice: 189.99, rating: 5.0, reviews: 201, brand: "premium", desc: "Professional makeup kit with premium quality cosmetics for all skin types." },
    { id: 1007, name: "Homemade Gift Basket", image: "https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=870&q=80", category: "Homemade Gifts", price: 89.99, rating: 4.2, reviews: 76, brand: "artisan", desc: "Beautiful handmade gift basket with artisanal products perfect for any occasion." },
    { id: 1008, name: "Gold Plated Jewelry Set", image: "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&w=870&q=80", category: "Jewelry", price: 299.99, originalPrice: 349.99, rating: 4.8, reviews: 134, brand: "premium", desc: "Elegant gold plated jewelry set including necklace, earrings, and bracelet." },
    { id: 1009, name: "Professional Makeup Brushes", image: "https://images.unsplash.com/photo-1556228578-8c89e6adf883?auto=format&fit=crop&w=870&q=80", category: "Beauty", price: 79.99, rating: 4.6, reviews: 98, brand: "classic", desc: "Complete set of professional makeup brushes for flawless application." }
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

        document.getElementById('add-to-cart-btn').onclick = () => addToCart(product);

        document.getElementById('product-detail-loader').classList.add('d-none');
        document.getElementById('product-content').classList.remove('d-none');
    } else {
        document.querySelector('main').innerHTML = `<div class="text-center py-5"><h2>Product not found</h2><a href="index.php">Go Home</a></div>`;
    }
  }

  function addToCart(product) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(product);
    localStorage.setItem('cart', JSON.stringify(cart));
    alert(product.name + " added to cart!");
    updateCartUI();
  }

  function updateCartUI() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    document.getElementById('header-cart-count').textContent = cart.length;
    const total = cart.reduce((sum, p) => sum + p.price, 0);
    document.getElementById('header-total').textContent = total.toFixed(2);
  }

  window.onload = () => {
    loadProduct();
    updateCartUI();
  };
</script>
</body>
</html>