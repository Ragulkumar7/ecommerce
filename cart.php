<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Logic to handle item removal could go here if handling server-side
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub | Your Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-accent: #d16d08f2;
            --soft-bg: #f8f9fa;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--soft-bg);
            color: #2d3436;
        }

        /* Header Styling */
        .main-header {
            background: white;
            border-bottom: 1px solid #eee;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }
        .brand-icon {
            color: var(--primary-accent);
        }
        .brand-logo {
            font-weight: 800;
            font-size: 1.6rem;
            color: #333;
            letter-spacing: -0.5px;
        }
        .nav-link-custom {
            color: #2d3436;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        .nav-link-custom:hover {
            color: var(--primary-accent);
        }
        .nav-link-active {
            color: var(--primary-accent) !important;
            font-weight: 800;
        }

        /* Cart Table Styling */
        .cart-container {
            margin-top: 50px;
            margin-bottom: 80px;
        }
        .cart-card {
            background: white;
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead {
            background-color: #2d3436;
            color: white;
        }
        .table thead th {
            padding: 15px;
            font-weight: 600;
            border: none;
        }
        .table tbody td {
            padding: 20px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f1f1;
        }

        /* Summary Sidebar */
        .summary-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid #f1f1f1;
        }
        .summary-title {
            font-weight: 800;
            margin-bottom: 25px;
            font-size: 1.4rem;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: #636e72;
            font-weight: 500;
        }
        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed #eee;
            font-weight: 800;
            font-size: 1.3rem;
            color: #2d3436;
        }

        /* Buttons */
        .btn-remove {
            background-color: #ff7675;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-remove:hover {
            background-color: #d63031;
            color: white;
        }
        .btn-continue {
            background-color: white;
            color: #2d3436;
            border: 2px solid #ddd;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-continue:hover {
            border-color: var(--primary-accent);
            color: var(--primary-accent);
        }
        .btn-checkout {
            background-color: var(--primary-accent);
            border: none;
            width: 100%;
            padding: 15px;
            border-radius: 50px;
            font-weight: 700;
            margin-top: 25px;
            box-shadow: 0 8px 15px rgba(209, 109, 8, 0.2);
            transition: 0.3s;
        }
        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(209, 109, 8, 0.3);
            color: white;
        }
        .btn-checkout:focus, .btn-checkout:active {
    background-color: #a35506 !important; /* Darker orange */
    color: white !important;
    outline: none !important;
    box-shadow: 0 5px 15px rgba(209, 109, 8, 0.3) !important;
}

        .qty-input {
            width: 70px;
            border-radius: 8px;
            border: 1px solid #ddd;
            text-align: center;
            padding: 6px;
            font-weight: 600;
        }
        .qty-input:focus {
            outline: none;
            border-color: var(--primary-accent);
        }
    </style>
</head>
<body>

<header class="main-header py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <span class="brand-icon"><i class="bi bi-shop fs-3"></i></span>
            <span class="brand-logo ms-2">StyleHub</span>
        </div>
        <nav>
            <a href="index.php" class="nav-link-custom me-4">Home</a>
            <a href="shop.php" class="nav-link-custom me-4">Shop</a>
            <a href="cart.php" class="nav-link-custom nav-link-active">Cart</a>
        </nav>
    </div>
</header>

<div class="container cart-container">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="cart-card">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Product Details</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="cart-table-body">
                            </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                <a href="shop.php" class="btn-continue">
                    <i class="bi bi-arrow-left me-2"></i> Continue Shopping
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="summary-card">
                <h3 class="summary-title text-center">Order Summary</h3>
                <div class="summary-item">
                    <span>Subtotal</span>
                    <span id="summary-subtotal">₹0.00</span>
                </div>
                <div class="summary-item">
                    <span>Shipping</span>
                    <span id="summary-shipping">₹0.00</span>
                </div>
                <div class="summary-item">
                    <span>Tax (12% Est.)</span>
                    <span id="summary-tax">₹0.00</span>
                </div>
                <div class="summary-total">
                    <span>Total Amount</span>
                    <span id="summary-total" style="color: var(--primary-accent);">₹0.00</span>
                </div>
                <button onclick="proceedToCheckout()" id="checkoutBtn" class="btn btn-checkout">
                    Proceed to Checkout <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Fetch cart data from localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function renderCart() {
        const tbody = document.getElementById('cart-table-body');
        tbody.innerHTML = '';
        let subtotal = 0;

        if(cart.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 fw-bold text-muted">Your cart is currently empty.</h5>
                        <p class="text-muted mb-0">Looks like you haven't added anything yet.</p>
                    </td>
                </tr>
            `;
            updateSummary(0);
            document.getElementById('checkoutBtn').disabled = true;
            document.getElementById('checkoutBtn').style.opacity = '0.5';
            return;
        }

        document.getElementById('checkoutBtn').disabled = false;
        document.getElementById('checkoutBtn').style.opacity = '1';

        cart.forEach((item, index) => {
            const qty = item.quantity || 1;
            const itemSubtotal = item.price * qty;
            subtotal += itemSubtotal;

            tbody.innerHTML += `
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${item.image}" alt="${item.name}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 12px; border: 1px solid #eee;" class="me-3 shadow-sm" onerror="this.src='https://via.placeholder.com/70x70?text=Item'">
                            <div>
                                <span class="fw-bold d-block text-dark" style="font-size: 1.05rem;">${item.name}</span>
                                ${item.category ? `<small class="text-muted">${item.category}</small>` : ''}
                            </div>
                        </div>
                    </td>
                    <td class="fw-medium text-muted">₹${item.price.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                    <td>
                        <input type="number" class="qty-input" value="${qty}" min="1" onchange="updateQty(${index}, this.value)">
                    </td>
                    <td class="fw-bold" style="color: var(--primary-accent);">₹${itemSubtotal.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                    <td class="text-center">
                        <button class="btn btn-remove" onclick="removeItem(${index})"><i class="bi bi-trash3"></i></button>
                    </td>
                </tr>
            `;
        });

        updateSummary(subtotal);
    }

    function updateQty(index, val) {
        if(val < 1) val = 1;
        cart[index].quantity = parseInt(val);
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    }

    function removeItem(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    }

    function updateSummary(subtotal) {
        const shipping = subtotal > 0 ? 50 : 0;
        const tax = subtotal * 0.12; // 12% tax calculation
        const total = subtotal + shipping + tax;

        document.getElementById('summary-subtotal').innerText = `₹${subtotal.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        document.getElementById('summary-shipping').innerText = `₹${shipping.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        document.getElementById('summary-tax').innerText = `₹${tax.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        document.getElementById('summary-total').innerText = `₹${total.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    }

    function proceedToCheckout() {
        if(cart.length > 0) {
            window.location.href = 'checkout.php';
        }
    }

    window.onload = renderCart;
</script>

</body>
</html>