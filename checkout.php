<?php
// Database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all products
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
// Fetch cart items
$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    header('Location: cart.php');
    exit;
}

// Calculate totals
$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = $subtotal > 0 ? 49 : 0;
$tax = round($subtotal * 0.05, 2);
$total = $subtotal + $shipping + $tax;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Your Brand</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="cart.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
  <header class="main-header px-3 py-2 mb-4">
    <div class="d-flex align-items-center">
      <span class="brand-icon"><i class="bi bi-bag"></i></span>
      <span class="brand-logo">Your Store</span>
    </div>
  </header>

  <div class="container checkout-container">
    <!-- Progress -->
    <div class="checkout-progress mb-4">
      <div class="progress-step completed">
        <div class="step-number">1</div>
        <span class="step-text">Sign-In</span>
      </div>
      <span>&rarr;</span>
      <div class="progress-step completed">
        <div class="step-number">2</div>
        <span class="step-text">Shipping</span>
      </div>
      <span>&rarr;</span>
      <div class="progress-step active">
        <div class="step-number">3</div>
        <span class="step-text">Payment</span>
      </div>
      <span>&rarr;</span>
      <div class="progress-step">
        <div class="step-number">4</div>
        <span class="step-text">Review</span>
      </div>
    </div>

    <div class="row">
      <!-- Left: Shipping & Payment -->
      <div class="col-lg-8">
        <form id="checkoutForm" class="checkout-form" action="place_order.php" method="POST">
          <!-- Shipping Address -->
          <h4>Shipping Address</h4>
          <?php foreach ($addresses as $addr): ?>
            <div class="payment-method address-method <?= $addr['is_default'] ? 'active' : '' ?>">
              <input type="radio" name="address_id" value="<?= $addr['id'] ?>" <?= $addr['is_default'] ? 'checked' : '' ?>>
              <strong><?= htmlspecialchars($addr['label']) ?></strong><br>
              <?= htmlspecialchars($addr['line1']) ?>, <?= htmlspecialchars($addr['city']) ?>, <?= htmlspecialchars($addr['state']) ?> <?= htmlspecialchars($addr['zip']) ?>
            </div>
          <?php endforeach; ?>
          <div class="mb-4">
            <a href="add_address.php" class="btn btn-outline-primary">Add New Address</a>
          </div>

          <!-- Payment Method -->
          <h4>Payment Method</h4>
          <div class="payment-method <?= !isset($_SESSION['use_card']) ? 'active' : '' ?>">
            <input type="radio" name="payment" value="cod" <?= !isset($_SESSION['use_card']) ? 'checked' : '' ?>>
            Cash on Delivery
          </div>
          <div class="payment-method <?= isset($_SESSION['use_card']) ? 'active' : '' ?>">
            <input type="radio" name="payment" value="card" <?= isset($_SESSION['use_card']) ? 'checked' : '' ?>>
            Credit/Debit Card
          </div>
          <div id="cardFields" class="mt-3" style="display: <?= isset($_SESSION['use_card']) ? 'block' : 'none' ?>">
            <div class="mb-3">
              <label class="form-label">Card Number</label>
              <input type="text" name="card_number" class="form-control" maxlength="16">
            </div>
            <div class="mb-3">
              <label class="form-label">Expiration</label>
              <input type="month" name="exp_date" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">CVV</label>
              <input type="text" name="cvv" class="form-control" maxlength="4">
            </div>
          </div>

          <!-- Review & Place Order -->
          <button type="submit" class="btn btn-place-order">Continue to Review</button>
        </form>
      </div>

      <!-- Right: Order Summary -->
      <div class="col-lg-4">
        <div class="order-summary">
          <h4>Order Summary</h4>
          <?php foreach ($cart as $item): ?>
            <div class="cart-item">
              <img src="<?= htmlspecialchars($item['image']) ?>" alt="">
              <div class="cart-item-details">
                <div class="cart-item-name"><?= htmlspecialchars($item['name']) ?></div>
                <div class="cart-item-price">&#8377; <?= number_format($item['price'], 2) ?></div>
                <div class="cart-item-quantity">Qty: <?= $item['quantity'] ?></div>
              </div>
              <div class="cart-item-total">&#8377; <?= number_format($item['price'] * $item['quantity'], 2) ?></div>
            </div>
          <?php endforeach; ?>
          <div class="summary-item">
            <span>Subtotal</span>
            <span>&#8377; <?= number_format($subtotal, 2) ?></span>
          </div>
          <div class="summary-item">
            <span>Shipping</span>
            <span>&#8377; <?= number_format($shipping, 2) ?></span>
          </div>
          <div class="summary-item">
            <span>GST (5%)</span>
            <span>&#8377; <?= number_format($tax, 2) ?></span>
          </div>
          <div class="summary-item total">
            <span>Total</span>
            <span>&#8377; <?= number_format($total, 2) ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer-section mt-5 py-4 text-center">
    <div class="container">
      <span class="footer-brand-text">Your Store</span> &copy; <?= date('Y') ?>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="cart.js"></script>
  <script>
    // Toggle card fields
    document.querySelectorAll('input[name="payment"]').forEach(r => {
      r.addEventListener('change', () => {
        document.querySelectorAll('.payment-method').forEach(pm => pm.classList.remove('active'));
        r.closest('.payment-method').classList.add('active');
        document.getElementById('cardFields').style.display = r.value === 'card' ? 'block' : 'none';
      });
    });
  </script>
</body>
</html>
