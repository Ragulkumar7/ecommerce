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

// Order processing logic would go here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub | Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <style>
        :root {
            --primary-accent: #d16d08f2;
            --primary-dark: #a35506;
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
        .brand-icon { color: var(--primary-accent); }
        .brand-logo {
            font-weight: 800;
            font-size: 1.6rem;
            color: #333;
            letter-spacing: -0.5px;
        }

        /* Card Styles */
        .checkout-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }
        
        .section-title {
            font-weight: 800;
            font-size: 1.3rem;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f1f1;
            color: #2d3436;
        }

        /* Form Inputs */
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 0.25rem rgba(209, 109, 8, 0.15);
        }
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #636e72;
            margin-bottom: 8px;
        }

        /* Order Summary Items */
        .summary-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f8f9fa;
        }
        .summary-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
            border: 1px solid #eee;
        }
        .summary-item-details { flex-grow: 1; }
        .summary-item-name { font-weight: 700; font-size: 0.95rem; display: block; color: #2d3436;}
        .summary-item-qty { font-size: 0.85rem; color: #636e72; }
        .summary-item-price { font-weight: 800; color: var(--primary-accent); }

        /* Price Calculations */
        .calc-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-weight: 500;
            color: #636e72;
        }
        .calc-total {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed #eee;
            font-weight: 800;
            font-size: 1.4rem;
            color: #2d3436;
        }

        /* Payment Radio Buttons */
        .payment-option {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        .payment-option:hover {
            border-color: var(--primary-accent);
            background-color: #fffaf5;
        }
        .form-check-input:checked {
            background-color: var(--primary-accent);
            border-color: var(--primary-accent);
        }
        .form-check-input:checked + .form-check-label {
            font-weight: 700;
            color: var(--primary-accent);
        }

        /* Button */
        .btn-place-order {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            width: 100%;
            padding: 16px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.1rem;
            margin-top: 15px;
            box-shadow: 0 8px 15px rgba(209, 109, 8, 0.2);
            transition: all 0.3s;
        }
        .btn-place-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(209, 109, 8, 0.3);
            background-color: var(--primary-dark);
            color: white;
        }
        .btn-place-order:active, .btn-place-order:focus {
            background-color: var(--primary-dark) !important;
            color: white !important;
            outline: none !important;
            box-shadow: 0 5px 15px rgba(209, 109, 8, 0.3) !important;
        }

        .back-to-cart {
            color: #636e72;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
            display: inline-block;
            margin-bottom: 20px;
        }
        .back-to-cart:hover {
            color: var(--primary-accent);
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
        <div class="fw-bold text-muted">
            <i class="bi bi-lock-fill text-success me-1"></i> Secure Checkout
        </div>
    </div>
</header>

<div class="container py-5">
    <a href="cart.php" class="back-to-cart"><i class="bi bi-arrow-left me-2"></i>Back to Cart</a>
    
    <form id="checkoutForm" onsubmit="processOrder(event)">
        <div class="row g-4">
            
            <div class="col-lg-7 col-xl-8">
                
                <div class="checkout-card">
                    <h2 class="section-title">Shipping Information</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name *</label>
                            <input type="text" id="firstName" class="form-control" required placeholder="John">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name *</label>
                            <input type="text" id="lastName" class="form-control" required placeholder="Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address *</label>
                            <input type="email" id="email" class="form-control" required placeholder="john@example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" id="phone" class="form-control" required placeholder="9876543210">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Street Address *</label>
                            <input type="text" class="form-control" required placeholder="House number and street name">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Apartment, suite, unit, etc. (optional)</label>
                            <input type="text" class="form-control" placeholder="Apartment, suite, unit, etc.">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">City / Town *</label>
                            <input type="text" class="form-control" required placeholder="City">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">State *</label>
                            <select class="form-select" required>
                                <option value="">Choose...</option>
                                <option value="TN">Tamil Nadu</option>
                                <option value="KL">Kerala</option>
                                <option value="KA">Karnataka</option>
                                <option value="MH">Maharashtra</option>
                                <option value="DL">Delhi</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">PIN Code *</label>
                            <input type="text" class="form-control" required placeholder="123456">
                        </div>
                    </div>
                </div>

                <div class="checkout-card">
                    <h2 class="section-title">Payment Method</h2>
                    
                    <label class="payment-option form-check">
                        <input class="form-check-input me-3" type="radio" name="paymentMethod" id="payCard" value="card" checked required>
                        <span class="form-check-label flex-grow-1">Credit / Debit Card</span>
                        <i class="bi bi-credit-card fs-4 text-muted"></i>
                    </label>
                    
                    <label class="payment-option form-check">
                        <input class="form-check-input me-3" type="radio" name="paymentMethod" id="payUPI" value="upi">
                        <span class="form-check-label flex-grow-1">UPI (GPay, PhonePe, Paytm)</span>
                        <i class="bi bi-phone fs-4 text-muted"></i>
                    </label>
                    
                    <label class="payment-option form-check">
                        <input class="form-check-input me-3" type="radio" name="paymentMethod" id="payCOD" value="cod">
                        <span class="form-check-label flex-grow-1">Cash on Delivery</span>
                        <i class="bi bi-cash-stack fs-4 text-muted"></i>
                    </label>
                </div>
            </div>

            <div class="col-lg-5 col-xl-4">
                <div class="checkout-card" style="position: sticky; top: 20px;">
                    <h2 class="section-title">Order Summary</h2>
                    
                    <div id="checkout-items" class="mb-4">
                        </div>

                    <div class="calc-row">
                        <span>Subtotal</span>
                        <span id="check-subtotal">₹0.00</span>
                    </div>
                    <div class="calc-row">
                        <span>Shipping</span>
                        <span id="check-shipping">₹0.00</span>
                    </div>
                    <div class="calc-row">
                        <span>Tax (12% Est.)</span>
                        <span id="check-tax">₹0.00</span>
                    </div>
                    
                    <div class="calc-total">
                        <span>Total</span>
                        <span id="check-total" style="color: var(--primary-accent);">₹0.00</span>
                    </div>

                    <button type="submit" class="btn btn-place-order" id="rzp-button1">
                        Place Order <i class="bi bi-check-circle-fill ms-2"></i>
                    </button>
                    
                    <p class="text-center text-muted small mt-3 mb-0">
                        <i class="bi bi-shield-lock-fill text-success"></i> Secure payment processed by Razorpay.
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4" style="border-radius: 20px; border: none;">
      <div class="modal-body">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
        <h2 class="fw-bold mt-4 mb-3">Order Confirmed!</h2>
        <p class="text-muted fs-5 mb-4">Thank you for shopping with StyleHub. Your order has been placed successfully and will be shipped soon.</p>
        <button type="button" class="btn btn-place-order w-auto px-5 mt-2" onclick="window.location.href='index.php'">Return to Home</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fetch cart data from localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let finalTotal = 0; // Will store the final total in rupees

    function renderCheckoutSummary() {
        const container = document.getElementById('checkout-items');
        
        // If cart is empty, send them back to cart page
        if (cart.length === 0) {
            window.location.href = 'cart.php';
            return;
        }

        let subtotal = 0;
        container.innerHTML = '';

        cart.forEach(item => {
            const qty = item.quantity || 1;
            const itemSubtotal = item.price * qty;
            subtotal += itemSubtotal;

            container.innerHTML += `
                <div class="summary-item">
                    <img src="${item.image}" alt="${item.name}" onerror="this.src='https://via.placeholder.com/60x60?text=Item'">
                    <div class="summary-item-details">
                        <span class="summary-item-name">${item.name}</span>
                        <span class="summary-item-qty">Qty: ${qty}</span>
                    </div>
                    <div class="summary-item-price">₹${itemSubtotal.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</div>
                </div>
            `;
        });

        // Calculate Totals
        const shipping = subtotal > 0 ? 50 : 0;
        const tax = subtotal * 0.12; 
        finalTotal = subtotal + shipping + tax;

        document.getElementById('check-subtotal').innerText = `₹${subtotal.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        document.getElementById('check-shipping').innerText = `₹${shipping.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        document.getElementById('check-tax').innerText = `₹${tax.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        document.getElementById('check-total').innerText = `₹${finalTotal.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    }

    function processOrder(e) {
        e.preventDefault(); // Stop standard form submission
        
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
        
        // If Cash on Delivery, just show success immediately
        if(paymentMethod === 'cod') {
            showSuccessModal();
            return;
        }

        // --- RAZORPAY INTEGRATION LOGIC ---
        
        // Convert Total to Paise (Razorpay expects amount in paise)
        const amountInPaise = Math.round(finalTotal * 100);
        
        // Get Customer Details from Form
        const fName = document.getElementById('firstName').value;
        const lName = document.getElementById('lastName').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;

        // Configuration Options for Razorpay
        var options = {
            "key": "rzp_test_SFaTJo6zGjYdPp", // TODO: Replace with your actual Razorpay Test Key ID
            "amount": amountInPaise, 
            "currency": "INR",
            "name": "StyleHub",
            "description": "Purchase from StyleHub",
            // "image": "https://yourwebsite.com/logo.png", // Optional: Your logo URL
            "handler": function (response){
                // This function runs when payment is SUCCESSFUL
                console.log("Payment ID: " + response.razorpay_payment_id);
                showSuccessModal();
            },
            "prefill": {
                "name": fName + " " + lName,
                "email": email,
                "contact": phone
            },
            "theme": {
                "color": "#d16d08" // Brand Orange Color
            }
        };

        // Open Razorpay Popup
        var rzp1 = new Razorpay(options);
        
        // Handle Failure
        rzp1.on('payment.failed', function (response){
            alert("Payment Failed. Reason: " + response.error.description);
        });
        
        rzp1.open();
    }

    function showSuccessModal() {
        // Show the success modal
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();

        // Empty the cart
        localStorage.removeItem('cart');
    }

    // Initialize page
    window.onload = renderCheckoutSummary;
</script>
</body>
</html>