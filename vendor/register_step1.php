<?php
// Start the session at the very beginning to track the vendor's progress
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Registration - Step 1</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f1f3f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-container { background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        .stepper { display: flex; justify-content: center; align-items: center; margin-bottom: 30px; color: #878787; font-size: 14px; }
        .step { display: flex; align-items: center; font-weight: 600; color: #212121; }
        .step.inactive { color: #878787; font-weight: 400; }
        .line { width: 40px; height: 1px; background: #dbdbdb; margin: 0 15px; }
        
        .input-group { position: relative; margin-bottom: 20px; }
        input { width: 100%; padding: 15px; border: 1px solid #dbdbdb; border-radius: 6px; font-size: 16px; box-sizing: border-box; }
        .otp-btn { position: absolute; right: 15px; top: 15px; color: #2874f0; font-weight: 600; cursor: pointer; background: none; border: none; }
        .otp-btn:disabled { color: #ccc; cursor: not-allowed; }
        
        .btn-continue { width: 100%; padding: 15px; background: #2874f0; color: #fff; border: none; border-radius: 4px; font-size: 16px; font-weight: 600; cursor: pointer; display: flex; justify-content: center; align-items: center; }
        .terms { font-size: 12px; color: #878787; margin: 20px 0; line-height: 1.5; }
        .terms a { color: #2874f0; text-decoration: none; }
    </style>
</head>
<body>

<div class="form-container">
    <div class="stepper">
        <div class="step">✓ EMAIL & PASSWORD</div>
        <div class="line"></div>
        <div class="step inactive">BUSINESS DETAILS</div>
    </div>

    <form action="register_step2.php" method="POST" id="regForm">
        <div class="input-group">
            <input type="tel" name="phone" placeholder="Enter Mobile Number *" required pattern="[0-9]{10}">
            <button type="button" class="otp-btn" onclick="sendOTP(this, 'Phone')">Send OTP</button>
        </div>
        <div class="input-group">
            <input type="text" name="phone_otp" placeholder="Enter Phone OTP *" required>
        </div>
        
        <div class="input-group">
            <input type="email" name="email" placeholder="Email ID *" required>
            <button type="button" class="otp-btn" onclick="sendOTP(this, 'Email')">Send OTP</button>
        </div>
        <div class="input-group">
            <input type="text" name="email_otp" placeholder="Enter Email OTP *" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" id="pass" placeholder="Create Password *" required minlength="8">
        </div>
        <div class="input-group">
            <input type="password" name="confirm_password" id="confirm_pass" placeholder="Confirm Password *" required>
        </div>

        <p class="terms">By continuing, I agree to the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a></p>
        <button type="submit" class="btn-continue">Register & Continue →</button>
    </form>
</div>

<script>
    // Simple visual feedback for OTP buttons
    function sendOTP(btn, type) {
        alert(type + " OTP sent successfully!"); // Placeholder for your OTP logic
        btn.innerHTML = "Resend";
        btn.style.color = "#878787";
    }

    // Basic Password Matching Validation
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