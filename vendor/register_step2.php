<?php
// Start the session at the very beginning to track the vendor's progress
session_start();

// 1. Database connection
$host = 'localhost';
$dbname = 'ecommerce';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetching only Accessories for Laptops and Mobiles from your specific table
    $stmt = $pdo->prepare("SELECT * FROM product_list WHERE all_category = :cat");
    $stmt->execute(['cat' => 'Accessories']);
    $product_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Capture data from Step 1 and store in Session (if coming from Step 1)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['phone'])) {
    $_SESSION['vendor_phone'] = $_POST['phone'];
    $_SESSION['vendor_email'] = $_POST['email'];
    $_SESSION['vendor_password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
}

// 2. Final Form Submission Logic (Step 2 Submit)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['full_name'])) {
    // Collect Data from Session (Step 1)
    $mobile = $_SESSION['vendor_phone'] ?? '';
    $email = $_SESSION['vendor_email'] ?? '';
    $hashed_password = $_SESSION['vendor_password'] ?? '';

    // Collect Data from Form (Step 2)
    $category = $_POST['vendor_category'] ?? 'All Categories';
    $gstin = $_POST['gstin'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $display_name = $_POST['display_name'] ?? '';
    $store_description = $_POST['description'] ?? ''; 
    $pickup_address = $_POST['pickup_address'] ?? ''; 
    $product_list_data = $_POST['product_list'] ?? ''; 

    // Handle Signature Image Upload
    $signature_filename = null;
    if (isset($_FILES['signature_image']) && $_FILES['signature_image']['error'] == 0) {
        $target_dir = "uploads/signatures/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        
        $extension = pathinfo($_FILES["signature_image"]["name"], PATHINFO_EXTENSION);
        $signature_filename = "sig_" . time() . "_" . uniqid() . "." . $extension;
        move_uploaded_file($_FILES["signature_image"]["tmp_name"], $target_dir . $signature_filename);
    }

    // Insert into Database
    try {
        $sql = "INSERT INTO vendors (
                    mobile, email, password, category, gstin, 
                    signature_image, full_name, display_name, 
                    store_description, pickup_address, product_list, status
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
        
        $stmt_insert = $pdo->prepare($sql);
        $stmt_insert->execute([
            $mobile, $email, $hashed_password, $category, $gstin, 
            $signature_filename, $full_name, $display_name, 
            $store_description, $pickup_address, $product_list_data
        ]);

        // Success! Clear session and redirect
        session_destroy();
        echo "<script>alert('Registration Successful! Your account is pending approval.'); window.location.href='login.php';</script>";
        exit;

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { 
            echo "<script>alert('Error: This email or mobile number is already registered.');</script>";
        } else {
            echo "Database Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub | Vendor Onboarding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        :root {
            --primary-purple: #6F4AA2;
            --hover-purple: #5a3a80;
            --primary-orange: #ff9f00;
            --bg-light: #f5f7fa;
            --text-dark: #2d2d2d;
            --primary-blue: #2874f0;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-light); 
            color: var(--text-dark);
            margin: 0;
        }

        .sidebar { 
            width: 320px; 
            background: #fff; 
            padding: 40px 30px; 
            border-right: 1px solid #eee; 
            height: 100vh; 
            position: fixed; 
            display: flex;
            flex-direction: column;
        }

        .brand-logo { 
            color: var(--primary-purple); 
            font-weight: 700; 
            font-size: 1.5rem; 
            margin-bottom: 40px; 
        }

        .status-box { 
            background: #fdf8ff; 
            border: 1px solid #e9dcf5; 
            padding: 20px; 
            border-radius: 12px; 
            margin-bottom: 35px; 
        }

        .progress-container { 
            width: 100%; 
            background: #eee; 
            height: 8px; 
            border-radius: 10px; 
            margin: 12px 0; 
        }

        .progress-bar-custom { 
            width: 40%; 
            background: var(--primary-purple); 
            height: 100%; 
            border-radius: 10px; 
        }

        .step-item { 
            display: flex; 
            align-items: center; 
            margin-bottom: 25px; 
            color: #999; 
            font-size: 14px;
        }

        .step-item.done { color: #28a745; font-weight: 600; }
        .step-item.active { color: var(--primary-purple); font-weight: 700; }
        .icon-circle { 
            width: 24px; 
            height: 24px; 
            border: 2px solid currentColor; 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin-right: 15px; 
            font-size: 12px;
        }

        .main-content { margin-left: 320px; padding: 50px; width: calc(100% - 320px); }
        .card-custom { 
            background: #fff; 
            padding: 35px; 
            border-radius: 20px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.03); 
            margin-bottom: 30px; 
            border: none;
        }

        h2 { 
            font-size: 1.25rem; 
            font-weight: 700; 
            margin-bottom: 25px; 
            color: var(--primary-purple);
            display: flex;
            align-items: center;
        }
        h2 i { margin-right: 10px; }

        .category-dropdown-btn {
            border: 2px solid var(--primary-purple);
            padding: 15px 25px;
            border-radius: 12px;
            background: #f8f5ff;
            font-weight: 600;
            color: var(--text-dark);
            width: 100%;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .category-dropdown-btn:hover, .category-dropdown-btn:focus {
            background: #f0eaff;
            border-color: var(--primary-purple);
            color: var(--text-dark);
        }
        .dropdown-menu { border-radius: 12px; border: 1px solid #eee; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; }
        .dropdown-item { padding: 12px 20px; font-size: 14px; color: #555; white-space: normal; }
        .dropdown-item:hover { background-color: #f8f5ff; color: var(--primary-purple); }

        .form-label { font-weight: 600; font-size: 14px; color: #555; margin-bottom: 10px; }
        .form-control-custom { 
            border-radius: 10px; 
            padding: 12px 15px; 
            border: 1px solid #ddd; 
            background: #fafafa;
        }
        .form-control-custom:focus { 
            background: #fff; 
            border-color: var(--primary-purple); 
            box-shadow: 0 0 0 4px rgba(111, 74, 162, 0.1); 
        }

        .verify-link { 
            position: absolute; 
            right: 15px; 
            bottom: 12px; 
            color: var(--primary-purple); 
            font-weight: 700; 
            cursor: pointer; 
            font-size: 13px; 
        }

        .btn-sig { 
            padding: 12px; 
            border: 1px solid #ddd; 
            background: #fff; 
            color: #555; 
            border-radius: 10px; 
            cursor: pointer; 
            font-weight: 600; 
            font-size: 14px;
            transition: 0.3s;
        }
        .btn-sig:hover { border-color: var(--primary-purple); color: var(--primary-purple); }

        .btn-live { 
            background: var(--primary-purple); 
            color: #fff; 
            padding: 18px 60px; 
            border: none; 
            border-radius: 12px; 
            font-weight: 700; 
            font-size: 16px;
            cursor: pointer; 
            float: right; 
            box-shadow: 0 4px 15px rgba(111, 74, 162, 0.3);
            transition: 0.3s;
        }
        .btn-live:hover { background: var(--hover-purple); transform: translateY(-3px); }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand-logo"><i class="bi bi-shop me-2"></i>StyleHub</div>
    
    <div class="status-box">
        <span class="small fw-bold text-muted">Onboarding Progress</span>
        <div class="progress-container"><div class="progress-bar-custom"></div></div>
        <span style="color:var(--primary-purple); font-weight:800; font-size: 1.2rem;">40%</span>
    </div>

    <div class="step-list">
        <div class="step-item done"><div class="icon-circle"><i class="bi bi-check-lg"></i></div> Mobile & Email</div>
        <div class="step-item active"><div class="icon-circle">2</div> ID & Signature</div>
        <div class="step-item"><div class="icon-circle">3</div> Store & Pickup</div>
        <div class="step-item"><div class="icon-circle">4</div> Listing & Stock</div>
    </div>
</div>

<div class="main-content">
    <form action="" method="POST" enctype="multipart/form-data">
        
        <div class="card-custom">
            <h2><i class="bi bi-person-badge"></i> ID & Signature Verification</h2>
            <label class="form-label">What are you looking to sell?</label>
            
            <div class="dropdown">
                <button class="btn category-dropdown-btn dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span id="selectedCategoryText">All Categories</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="selectCategory('Electronics (smartphones, laptops, cameras, accessories)')">Electronics</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="selectCategory('Home appliances')">Home appliances</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="selectCategory('Fashion')">Fashion</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="selectCategory('Beauty and personal care')">Beauty and personal care</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="selectCategory('Furniture and home decor')">Furniture and home decor</a></li>
                </ul>
                <input type="hidden" name="vendor_category" id="vendor_category_input" value="All Categories">
            </div>
            
            <div class="mb-4 position-relative">
                <label class="form-label">Enter GSTIN *</label>
                <input type="text" name="gstin" class="form-control-custom" placeholder="Enter 15-digit GST number">
                <span class="verify-link">Verify</span>
            </div>

            <label class="form-label">Add Your e-Signature</label>
            <div class="row g-2">
                <div class="col-12">
                    <input type="file" id="sigUpload" name="signature_image" style="display:none;" accept="image/*" onchange="updateSigLabel(this)">
                    <button type="button" class="btn-sig w-100" onclick="document.getElementById('sigUpload').click()" id="uploadBtn">
                        <i class="bi bi-cloud-upload me-2"></i>Upload signature
                    </button>
                    <p id="fileNameDisplay" class="small text-muted mt-2" style="display:none;"></p>
                </div>
            </div>
        </div>

        <div class="card-custom">
            <h2><i class="bi bi-house-heart"></i> Store & Pickup Details</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="full_name" class="form-control-custom" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Store Display Name *</label>
                    <input type="text" name="display_name" class="form-control-custom" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Store Description</label>
                    <textarea name="description" class="form-control-custom" rows="3" placeholder="Tell customers about your shop..."></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Pickup Address</label>
                    <div class="input-group">
                        <input type="text" name="pickup_address" class="form-control form-control-custom" placeholder="Pincode or Area">
                        <button class="btn btn-outline-secondary" type="button" style="border-radius: 0 10px 10px 0;">Use GPS</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom">
            <h2><i class="bi bi-box-seam"></i> Listing & Stock Availability</h2>
            <div class="d-grid gap-2">
                <button type="button" class="btn-sig" onclick="toggleProductInput()">List your own products</button>
                <div id="productListingSection" style="display:none;" class="mt-3">
                    <label class="form-label">List your products (Type products separated by commas)</label>
                    <textarea name="product_list" class="form-control form-control-custom" rows="3" placeholder="Example: Sarees, Jewelry, Cosmetics..."></textarea>
                </div>
                <button type="button" class="btn-sig mt-2" style="color: var(--primary-orange); border-color: var(--primary-orange);">Explore StyleHub Selection</button>
            </div>
        </div>

        <button type="submit" class="btn-live">SUBMIT <i class="bi bi-rocket-takeoff ms-2"></i></button>
    </form>
</div>

<script>
    function selectCategory(category) {
        document.getElementById('selectedCategoryText').innerText = category;
        document.getElementById('vendor_category_input').value = category;
    }

    function updateSigLabel(input) {
        const display = document.getElementById('fileNameDisplay');
        const btn = document.getElementById('uploadBtn');
        if (input.files && input.files[0]) {
            display.style.display = 'block';
            display.innerHTML = '<i class="bi bi-check-circle-fill text-success me-1"></i> Selected: ' + input.files[0].name;
            btn.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i>Change Signature';
        }
    }

    function toggleProductInput() {
        const section = document.getElementById('productListingSection');
        section.style.display = (section.style.display === 'none') ? 'block' : 'none';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>