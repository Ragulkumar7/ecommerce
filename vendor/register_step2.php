<?php
session_start();

// Capture data from Step 1 and store in Session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['vendor_phone'] = $_POST['phone'];
    $_SESSION['vendor_email'] = $_POST['email'];
    $_SESSION['vendor_password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Registration - Step 2</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root { --blue: #2874f0; --orange: #ff9f00; --text: #212121; --gray: #878787; }
        body { font-family: 'Inter', sans-serif; background: #f1f3f6; margin: 0; display: flex; }
        
        /* Sidebar Status Area */
        .sidebar { width: 320px; background: #fff; padding: 30px; border-right: 1px solid #dbdbdb; height: 100vh; position: fixed; }
        .status-box { background: #fff9ec; border: 1px solid #fbd99d; padding: 20px; border-radius: 8px; margin-bottom: 25px; }
        .progress-container { width: 100%; background: #e0e0e0; height: 8px; border-radius: 4px; margin: 10px 0; }
        .progress-bar { width: 40%; background: var(--orange); height: 100%; border-radius: 4px; }
        
        .step-list { list-style: none; padding: 0; font-size: 14px; }
        .step-item { display: flex; align-items: center; margin-bottom: 20px; color: var(--gray); }
        .step-item.done { color: #388e3c; font-weight: 600; }
        .step-item.active { color: var(--text); font-weight: 600; }
        .icon { margin-right: 12px; }

        /* Content Area */
        .content { margin-left: 350px; padding: 40px; width: 100%; max-width: 800px; }
        .card { background: #fff; padding: 30px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 25px; }
        h2 { font-size: 18px; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 15px; }

        .cat-toggle { display: flex; gap: 15px; margin-bottom: 25px; }
        .cat-box { flex: 1; border: 1px solid var(--blue); padding: 15px; border-radius: 8px; text-align: center; cursor: pointer; background: #f0f5ff; }
        .cat-box.alt { border-color: #dbdbdb; background: #fff; }

        .form-group { margin-bottom: 20px; position: relative; }
        label { display: block; font-size: 13px; color: var(--gray); margin-bottom: 8px; }
        input, textarea { width: 100%; padding: 12px; border: 1px solid #dbdbdb; border-radius: 4px; box-sizing: border-box; }
        .verify-link { position: absolute; right: 15px; top: 35px; color: var(--blue); font-weight: 600; cursor: pointer; font-size: 13px; }

        .sig-options { display: flex; gap: 10px; margin-top: 10px; }
        .btn-sig { flex: 1; padding: 12px; border: 1px solid var(--blue); background: #fff; color: var(--blue); border-radius: 4px; cursor: pointer; font-weight: 600; }

        .btn-live { background: var(--blue); color: #fff; padding: 15px 40px; border: none; border-radius: 4px; font-weight: 600; cursor: pointer; float: right; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="status-box">
        <strong>Your onboarding completion status</strong>
        <div class="progress-container"><div class="progress-bar"></div></div>
        <span style="color:var(--orange); font-weight:bold;">40%</span>
    </div>
    <div class="step-list">
        <div class="step-item done"><span class="icon">✓</span> Mobile & Email Verification</div>
        <div class="step-item active"><span class="icon">○</span> ID & Signature Verification</div>
        <div class="step-item"><span class="icon">○</span> Store & Pickup Details</div>
        <div class="step-item"><span class="icon">○</span> Listing & Stock Availability</div>
    </div>
</div>

<div class="content">
    <form action="complete_onboarding.php" method="POST">
        
        <div class="card">
            <h2>ID & Signature Verification</h2>
            <label>What are you looking to sell?</label>
            <div class="cat-toggle">
                <div class="cat-box">All Categories</div>
                <div class="cat-box alt">Only Books</div>
            </div>
            <div class="form-group">
                <label>Enter GSTIN *</label>
                <input type="text" name="gstin" placeholder="Enter 15-digit GST number">
                <span class="verify-link">Verify GSTIN</span>
            </div>
            <label>Add Your e-Signature</label>
            <div class="sig-options">
                <button type="button" class="btn-sig">Draw your signature</button>
                <button type="button" class="btn-sig">Choose your signature</button>
            </div>
        </div>

        <div class="card">
            <h2>Store & Pickup Details</h2>
            <div class="form-group">
                <label>Enter Your Full Name *</label>
                <input type="text" name="full_name" required>
            </div>
            <div class="form-group">
                <label>Enter Display Name *</label>
                <input type="text" name="display_name" required>
            </div>
            <div class="form-group">
                <label>Enter Store Description</label>
                <textarea name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Add Pickup Address</label>
                <input type="text" placeholder="Search Pickup Area or Pincode">
                <p style="text-align:center; margin:10px 0;">or</p>
                <button type="button" class="btn-sig" style="width:100%">Use Current Location</button>
            </div>
        </div>

        <div class="card">
            <h2>Listing & Stock Availability</h2>
            <div class="form-group">
                <button type="button" class="btn-sig" style="width:100%; margin-bottom:10px;">List your own products</button>
                <button type="button" class="btn-sig" style="width:100%; border-color:var(--orange); color:var(--orange);">Go to Dhamaka Selection</button>
            </div>
        </div>

        <button type="submit" class="btn-live">GO LIVE NOW</button>
    </form>
</div>

</body>
</html>