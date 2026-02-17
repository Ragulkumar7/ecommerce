document.addEventListener('DOMContentLoaded', () => {
    // --- 1. EXPANDED PRODUCT DATA ---
    const products = [
      {
        id: 1, name: "Premium Men's Dress Series 7", brand: 'LEVIS', price: 249.99, old_price: 299.99, rating: 4.5,
        ratingCount: '1,420', reviewCount: '142', isAssured: true,
        description: "A classic and versatile shirt, perfect for both office and evening wear, tailored for a sharp, modern fit.",
        images: [
            'https://i.pinimg.com/736x/76/0f/aa/760faa8086afb8c9d2d5c93715db4ec0.jpg',
            'https://i.pinimg.com/736x/77/10/52/7710525232ffc1e816ead33d6e42d774.jpg',
            'https://i.pinimg.com/736x/83/0b/5f/830b5fa86c2d6c8975adc064d9ca6748.jpg'
        ],
        offers: [ { type: 'Bank Offer', text: '5% Cashback on StyleHub Axis Bank Card', tnc: '#' } ],
        specifications: { 'Fit': 'Slim', 'Fabric': 'Cotton Blend', 'Sleeve': 'Full Sleeve' }
      },
      {
        id: 2, name: "Premium Men's Dress Series 5", brand: 'Peter England', price: 179.99, old_price: 249.99, rating: 4.0,
        ratingCount: '870', reviewCount: '87', isAssured: true,
        description: "A modern slim-fit shirt from Peter England that offers a sharp, tailored look for any formal or casual occasion.",
        images: [ 'https://i.pinimg.com/736x/83/20/77/8320778b243c6ba85310486acad071dc.jpg' ],
        offers: [ { type: 'Bank Offer', text: '5% Cashback on StyleHub Axis Bank Card', tnc: '#' } ],
        specifications: { 'Fit': 'Regular', 'Fabric': 'Pure Cotton', 'Sleeve': 'Full Sleeve' }
      },
      {
        id: 3, name: "Luxury shirt", brand: 'LEVIS', price: 349.99, old_price: 399.99, rating: 5.0,
        ratingCount: '2,150', reviewCount: '215', isAssured: true,
        description: "Experience unparalleled comfort and style with this luxury shirt, crafted from the finest materials for a premium feel.",
        images: [ 'https://i.pinimg.com/736x/c0/d8/28/c0d828a20dabf18765790f22fd2bd23b.jpg' ],
        offers: [ { type: 'Bank Offer', text: '10% off on HDFC Bank Credit Card', tnc: '#' } ],
        specifications: { 'Fit': 'Slim', 'Fabric': 'Linen Blend', 'Sleeve': 'Full Sleeve' }
      },
      {
        id: 4, name: "Premium Men's Dress Series 3", brand: 'LEVIS', price: 399.99, old_price: 499.99, rating: 5.0,
        ratingCount: '2,150', reviewCount: '215', isAssured: true,
        description: "A bold statement piece, this premium shirt combines a unique modern design with timeless elegance and comfort.",
        images: [ 'https://i.pinimg.com/736x/77/10/52/7710525232ffc1e816ead33d6e42d774.jpg' ],
        offers: [ { type: 'Combo Offer', text: 'Buy 2 get 10% off', tnc: '#' } ],
        specifications: { 'Fit': 'Slim', 'Fabric': 'Cotton Blend', 'Sleeve': 'Full Sleeve' }
      },
      {
        id: 5, name: "Premium Men's Dress Series 8", brand: 'LEVIS', price: 299.99, old_price: 369.99, rating: 5.0,
        ratingCount: '2,150', reviewCount: '215', isAssured: false,
        description: "The perfect blend of casual comfort and formal style, this shirt is an ideal choice for the modern man on the go.",
        images: [ 'https://i.pinimg.com/736x/0f/94/96/0f9496deadaff29c0fb556fbdced4a27.jpg' ],
        offers: [ { type: 'Bank Offer', text: '5% Cashback on StyleHub Axis Bank Card', tnc: '#' } ],
        specifications: { 'Fit': 'Slim', 'Fabric': 'Cotton Blend', 'Sleeve': 'Full Sleeve' }
      },
      {
        id: 6, name: "Premium Men's Dress Series 2", brand: 'LEVIS', price: 399.99, old_price: 479.99, rating: 5.0,
        ratingCount: '2,150', reviewCount: '215', isAssured: true,
        description: "A sophisticated shirt designed for those who appreciate fine tailoring, quality fabric, and a distinguished look.",
        images: [ 'https://i.pinimg.com/736x/0c/7e/55/0c7e55546c747e433ee53455189dfcab.jpg' ],
        offers: [ { type: 'Bank Offer', text: '5% Cashback on StyleHub Axis Bank Card', tnc: '#' } ],
        specifications: { 'Fit': 'Slim', 'Fabric': 'Cotton Blend', 'Sleeve': 'Full Sleeve' }
      },
      {
        id: 7, name: "Premium Men's Dress Series 5", brand: 'LEVIS', price: 449.99, old_price: 599.99, rating: 5.0,
        ratingCount: '2,150', reviewCount: '215', isAssured: true,
        description: "This premium shirt offers a clean, crisp look that is effortlessly stylish and comfortable for all-day wear.",
        images: [ 'https://i.pinimg.com/736x/83/0b/5f/830b5fa86c2d6c8975adc064d9ca6748.jpg' ],
        offers: [ { type: 'Bank Offer', text: '5% Cashback on StyleHub Axis Bank Card', tnc: '#' } ],
        specifications: { 'Fit': 'Slim', 'Fabric': 'Cotton Blend', 'Sleeve': 'Full Sleeve' }
      },
      {
        id: 8, name: "Premium Men's Dress Series 8", brand: 'LEVIS', price: 649.99, old_price: 799.99, rating: 5.0,
        ratingCount: '2,150', reviewCount: '215', isAssured: false,
        description: "Make a lasting impression with this impeccably designed shirt, featuring a unique texture and perfect for special events.",
        images: [ 'https://i.pinimg.com/736x/2e/a6/fe/2ea6fe61dd9411fc5ac5380dabd2139e.jpg' ],
        offers: [ { type: 'Bank Offer', text: '5% Cashback on StyleHub Axis Bank Card', tnc: '#' } ],
        specifications: { 'Fit': 'Slim', 'Fabric': 'Cotton Blend', 'Sleeve': 'Full Sleeve' }
      },
      {
        id: 9, name: "Premium Men's Dress Series 9", brand: 'LEVIS', price: 649.99, old_price: 699.99, rating: 5.0,
        ratingCount: '2,150', reviewCount: '215', isAssured: true,
        description: "The epitome of modern menswear, this shirt combines a sleek, minimalist design with superior comfort and craftsmanship.",
        images: [ 'https://i.pinimg.com/736x/01/14/ac/0114ac8082112da2e1efc45c389a8e9a.jpg' ],
        offers: [ { type: 'Bank Offer', text: '5% Cashback on StyleHub Axis Bank Card', tnc: '#' } ],
        specifications: { 'Fit': 'Slim', 'Fabric': 'Cotton Blend', 'Sleeve': 'Full Sleeve' }
      }
    ];

    // --- 2. GLOBAL STATE ---
    let cart = JSON.parse(localStorage.getItem('stylehubCart')) || [];

    // --- 3. CART & NAVIGATION (Global) ---
    const updateCartUI = () => {
        localStorage.setItem('stylehubCart', JSON.stringify(cart));
        const totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);
        document.getElementById('cartCount').textContent = totalQuantity;
        const total = cart.reduce((sum, item) => sum + (item.product.price * item.quantity), 0);
        document.getElementById('cartTotal').textContent = total.toFixed(2);
    };
    
    window.showCartModal = () => {
        const modal = new bootstrap.Modal(document.getElementById('cartModal'));
        const cartItemsDiv = document.getElementById('cartItems');
        if (cart.length === 0) {
            cartItemsDiv.innerHTML = '<p>Your cart is empty.</p>';
        } else {
            cartItemsDiv.innerHTML = cart.map(item => `<div class="d-flex justify-content-between align-items-center border-bottom py-2"><div><strong>${item.product.name}</strong> x ${item.quantity}</div><div>₹${(item.product.price * item.quantity).toFixed(2)}</div></div>`).join('');
        }
        const total = cart.reduce((sum, item) => sum + (item.product.price * item.quantity), 0);
        document.getElementById('modalCartTotal').textContent = total.toFixed(2);
        modal.show();
    };
    
    window.buyNow = () => {
        if (cart.length === 0) { alert("Your cart is empty!"); return; }
        alert("Thank you for your purchase!\nTotal: ₹" + document.getElementById('modalCartTotal').textContent);
        cart = [];
        updateCartUI();
        bootstrap.Modal.getInstance(document.getElementById('cartModal')).hide();
    };

    // --- 4. PAGE-SPECIFIC LOGIC ---
    const urlParams = new URLSearchParams(window.location.search);
    const productId = parseInt(urlParams.get('id'));
    const product = products.find(p => p.id === productId);

    if (product) {
        renderProductDetails(product);
        setupEventListeners(product);
    } else {
        document.getElementById('productDetailContainer').style.display = 'none';
        document.getElementById('productNotFound').style.display = 'block';
    }
    updateCartUI();

    function renderProductDetails(p) {
        const container = document.getElementById('productDetailContainer');
        const discount = Math.round(((p.old_price - p.price) / p.old_price) * 100);

        container.innerHTML = `
        <div class="row g-4">
            <!-- LEFT COLUMN -->
            <div class="col-lg-5">
                <div class="gallery-column">
                    <div class="image-previews">
                        <div class="thumbnail-list">
                            ${p.images.map((img, index) => `<img src="${img}" class="thumbnail ${index === 0 ? 'active' : ''}" alt="Thumbnail ${index+1}">`).join('')}
                        </div>
                        <div class="main-image-wrapper">
                            <img src="${p.images[0]}" id="main-product-image" class="main-image" alt="${p.name}">
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-add-to-cart" id="add-to-cart-btn"><i class="bi bi-cart-fill me-2"></i>ADD TO CART</button>
                        <button class="btn btn-buy-now" id="buy-now-btn"><i class="bi bi-lightning-fill me-2"></i>BUY NOW</button>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-lg-7">
                <nav class="breadcrumb-nav">Home > Fashion > Men's Fashion > ${p.brand}</nav>
                <h6 class="product-brand mt-2">${p.brand}</h6>
                <h1 class="product-title">${p.name}</h1>
                <p class="product-description text-secondary mt-2">${p.description}</p>
                
                <div class="price-info mt-2">
                    <span class="special-price">₹${p.price.toLocaleString('en-IN')}</span>
                    <span class="old-price">₹${p.old_price.toLocaleString('en-IN')}</span>
                    <span class="discount fw-bold">${discount}% off</span>
                </div>

                <div class="rating-section mt-2">
                    <div class="rating-box">${p.rating} <i class="bi bi-star-fill"></i></div>
                    <div class="text-light fw-bold">${p.ratingCount} Ratings & ${p.reviewCount} Reviews</div>
                    ${p.isAssured ? `<img src="https://rukminim1.flixcart.com/www/36/36/promos/06/09/2016/c22c9fc4-0555-4460-8401-bf5c28d7ba29.png?q=90" class="assured-badge" alt="Assured">` : ''}
                </div>

                <div class="offers-list my-4">
                    <h6 class="fw-bold">Available offers</h6>
                    ${p.offers.map(o => `
                        <div class="offer-item">
                            <i class="bi bi-tag-fill"></i>
                            <p class="mb-0"><span>${o.type}</span> ${o.text} <a href="${o.tnc}">T&C</a></p>
                        </div>
                    `).join('')}
                </div>

                <div class="delivery-section d-flex align-items-center gap-4 border-top border-bottom py-3">
                    <div class="text-light fw-bold">Deliver to</div>
                    <div class="pincode-wrapper">
                        <input type="text" placeholder="Enter delivery pincode" maxlength="6">
                        <a href="#" class="ms-2">Check</a>
                    </div>
                </div>
                <div class="delivery-details py-2">Delivery by Monday, Sep 29 | <span class="text-success">FREE</span></div>
                
                <div class="specifications mt-4">
                    <h6 class="fw-bold">Specifications</h6>
                    <table class="table table-borderless specs-table">
                        <tbody>
                        ${Object.entries(p.specifications).map(([key, value]) => `
                            <tr><td class="spec-label col-4">${key}</td><td>${value}</td></tr>
                        `).join('')}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>`;
    }

    function setupEventListeners(product) {
        document.querySelector('.thumbnail-list').addEventListener('mouseover', e => {
            if (e.target.classList.contains('thumbnail')) {
                document.getElementById('main-product-image').src = e.target.src;
                document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                e.target.classList.add('active');
            }
        });

        document.getElementById('add-to-cart-btn').addEventListener('click', () => {
            const cartItem = cart.find(item => item.product.id === product.id);
            if (cartItem) cartItem.quantity++;
            else cart.push({ product, quantity: 1 });
            updateCartUI();
            alert(`${product.name} added to cart!`);
        });

        document.getElementById('buy-now-btn').addEventListener('click', () => {
            const cartItem = cart.find(item => item.product.id === product.id);
            if (!cartItem) cart.push({ product, quantity: 1 });
            updateCartUI();
            showCartModal();
        });
    }
});
