<?php
// Start the session at the very beginning to track the vendor's progress
session_start();

// Database connection details
$host = 'localhost';
$dbname = 'ecommerce';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetching only Accessories for Laptops and Mobiles
    $stmt = $pdo->prepare("SELECT * FROM product_list WHERE all_category = :cat");
    $stmt->execute(['cat' => 'Accessories']);
    $products_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Capture data from Step 1 and store in Session (if submitted via POST)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['phone'])) {
    $_SESSION['vendor_phone'] = $_POST['phone'];
    $_SESSION['vendor_email'] = $_POST['email'];
    $_SESSION['vendor_password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub | Vendor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        :root {
            --primary-purple: #6F4AA2;
            --hover-purple: #5a3a80;
            --primary-orange: #d16d08f2;
            --bg-light: #f5f7fa;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-light); 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
        }

        .form-container { 
            background: #fff; 
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            width: 100%; 
            max-width: 500px; 
        }

        .brand-logo { 
            color: var(--primary-purple); 
            font-weight: 700; 
            font-size: 1.8rem; 
            text-align: center; 
            margin-bottom: 20px; 
        }

        .stepper { 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            margin-bottom: 30px; 
            font-size: 13px; 
            letter-spacing: 0.5px;
        }

        .step { 
            display: flex; 
            align-items: center; 
            font-weight: 700; 
            color: var(--primary-purple); 
        }

        .step.inactive { 
            color: #ccc; 
            font-weight: 500; 
        }

        .line { 
            width: 30px; 
            height: 2px; 
            background: #eee; 
            margin: 0 10px; 
        }

        .input-group-custom { 
            position: relative; 
            margin-bottom: 20px; 
        }

        .form-control-custom { 
            width: 100%; 
            padding: 14px 15px; 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            font-size: 15px; 
            transition: 0.3s;
        }

        .form-control-custom:focus { 
            border-color: var(--primary-purple); 
            outline: none; 
            box-shadow: 0 0 0 3px rgba(111, 74, 162, 0.1);
        }

        .otp-btn { 
            position: absolute; 
            right: 15px; 
            top: 50%; 
            transform: translateY(-50%);
            color: var(--primary-purple); 
            font-weight: 700; 
            cursor: pointer; 
            background: none; 
            border: none; 
            font-size: 14px;
            z-index: 5;
        }

        .btn-continue { 
            width: 100%; 
            padding: 14px; 
            background: var(--primary-purple); 
            color: #fff; 
            border: none; 
            border-radius: 10px; 
            font-size: 16px; 
            font-weight: 600; 
            cursor: pointer; 
            transition: 0.3s;
        }

        .btn-continue:hover { 
            background: var(--hover-purple); 
            transform: translateY(-2px);
        }

        .terms { 
            font-size: 12px; 
            color: #777; 
            margin: 20px 0; 
            text-align: center;
        }

        .terms a { 
            color: var(--primary-purple); 
            text-decoration: none; 
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="brand-logo"><i class="bi bi-shop me-2"></i>StyleHub</div>
    
    <div class="stepper">
        <div class="step"><i class="bi bi-check-circle-fill me-1"></i> STEP 1</div>
        <div class="line"></div>
        <div class="step inactive">STEP 2</div>
    </div>

    <form action="register_step2.php" method="POST" id="regForm">
        <div class="input-group-custom">
            <input type="tel" name="phone" class="form-control-custom" placeholder="Enter Mobile Number *" required pattern="[0-9]{10}">
            <button type="button" class="otp-btn" onclick="sendOTP(this, 'Phone')">Send OTP</button>
        </div>
        <div class="input-group-custom">
            <input type="text" name="phone_otp" class="form-control-custom" placeholder="Enter Phone OTP *" required>
        </div>
        
        <div class="input-group-custom">
            <input type="email" name="email" class="form-control-custom" placeholder="Email ID *" required>
            <button type="button" class="otp-btn" onclick="sendOTP(this, 'Email')">Send OTP</button>
        </div>
        <div class="input-group-custom">
            <input type="text" name="email_otp" class="form-control-custom" placeholder="Enter Email OTP *" required>
        </div>

        <div class="input-group-custom">
            <input type="password" name="password" id="pass" class="form-control-custom" placeholder="Create Password *" required minlength="8">
        </div>
        <div class="input-group-custom">
            <input type="password" name="confirm_password" id="confirm_pass" class="form-control-custom" placeholder="Confirm Password *" required>
        </div>

        <p class="terms">By continuing, I agree to the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a></p>
        
        <button type="submit" class="btn-continue">Register & Continue <i class="bi bi-arrow-right ms-2"></i></button>
    </form>
</div>

<script>
    function sendOTP(btn, type) {
        alert(type + " OTP sent successfully!"); 
        btn.innerHTML = "Resend";
        btn.style.color = "#888";
    }

    document.getElementById('regForm').onsubmit = function() {
        if (document.getElementById('pass').value !== document.getElementById('confirm_pass').value) {
            alert("Passwords do not match!");
            return false;
        }
        return true;
    };
</script>

</body>
</html>