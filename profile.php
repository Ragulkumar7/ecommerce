<?php
// Database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mock user data for UI
    $user = [
        'first_name' => 'Shruthi',
        'last_name' => 'M',
        'gender' => 'Female',
        'email' => '',
        'mobile' => '+917904945599'
    ];

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub | My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        :root {
            --primary-purple: #6F4AA2;
            --primary-orange: #d16d08f2;
            --hover-purple: #5a3a80;
            --primary: #6F4AA2;
            --primary-dark: #5a3a80;
            --light-bg: #f5f7fa;
            --text-dark: #2d2d2d;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
        }

        /* --- Global Header, Navbar & Footer Styles --- */
        .main-header { background: #fff; border-bottom: 1px solid #eee; }
        .brand-logo { font-size: 1.5rem; font-weight: 700; color: var(--primary-purple); }
        .brand-icon { font-size: 1.5rem; color: var(--primary-purple); margin-right: 8px; }
        .search-form { position: relative; }
        .search-btn { position: absolute; right: 5px; top: 5px; border-radius: 20px; padding: 2px 15px; border: none; }
        .action-icon { font-size: 1.4rem; color: #333; text-decoration: none; }
        .cart-badge { font-size: 0.7rem; padding: 2px 5px; border-radius: 50%; top: -5px; right: -10px; }

        .main-navbar { background-color: var(--primary-purple) !important; }
        .nav-link { font-weight: 500; transition: opacity 0.2s; }
        .nav-link:hover { opacity: 0.8; }
        .dropdown-item.active { background-color: var(--primary-purple); }

        .footer-section { background-color: #212529; }
        .footer-brand-text { font-weight: 700; font-size: 1.8rem; }
        .footer-links a { transition: color 0.3s ease; }
        .footer-links a:hover { color: white !important; text-decoration: underline !important; }

        /* --- Profile Specific Styles --- */
        .profile-nav-card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .profile-header-box { padding: 20px; display: flex; align-items: center; border-bottom: 1px solid #eee; }
        .profile-avatar { width: 50px; height: 50px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: bold; margin-right: 15px; }
        .nav-section-title { font-size: 0.85rem; color: #999; text-transform: uppercase; font-weight: 700; padding: 20px 20px 10px; }
        .profile-link { display: flex; align-items: center; padding: 12px 20px; color: var(--text-dark); text-decoration: none; transition: 0.3s; }
        .profile-link i { margin-right: 15px; color: var(--primary); font-size: 1.1rem; }
        .profile-link:hover, .profile-link.active { background-color: #f0ecf7; color: var(--primary); font-weight: 600; }
        .content-card { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 25px; }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .section-header h4 { font-weight: 700; margin: 0; }
        .edit-btn { color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.9rem; }
        .form-label { font-size: 0.85rem; color: #666; margin-bottom: 5px; }
        .custom-input { border-radius: 8px; padding: 12px; border: 1px solid #ddd; background-color: #f9f9f9; }
        .custom-input:focus { border-color: var(--primary); box-shadow: 0 0 0 0.2rem rgba(111, 74, 162, 0.1); background-color: white; }
        .save-btn { background-color: var(--primary); color: white; border: none; padding: 10px 40px; border-radius: 5px; font-weight: 600; transition: 0.3s; }
        .save-btn:hover { background-color: var(--primary-dark); box-shadow: 0 4px 8px rgba(0,0,0,0.15); }
        .radio-group label { margin-right: 25px; cursor: pointer; }
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
                <form class="search-form" id="searchForm">
                    <input class="form-control rounded-pill ps-3" type="search" id="searchInput" placeholder="Search for products...">
                    <button class="search-btn" type="submit" style="background-color: #6F4AA2;"><i class="bi bi-search text-white"></i></button>
                </form>
            </div>
            <div class="col-lg-3 col-md-3 col-6">
                <div class="d-flex align-items-center justify-content-end">
                    <a href="#" class="action-icon me-3 position-relative"><i class="bi bi-heart"></i><span class="cart-badge bg-dark position-absolute" id="favCount">0</span></a>
                    <a href="./cart.php" class="action-icon position-relative"><i class="bi bi-cart3"></i><span class="cart-badge bg-dark position-absolute" id="header-cart-count">0</span></a>
                    <span class="fs-5 ms-2 fw-bold d-none d-lg-block">₹<span id="header-total">0.00</span></span>
                </div>
            </div>
        </div>
    </div>
</header>

<nav class="main-navbar">
    <div class="container">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link text-white" href="index.php"><i class="bi bi-house me-1"></i> Home</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">Beauty & Jewelry</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="beauty-products.php">Makeup</a></li>
                    <li><a class="dropdown-item" href="skincare.php">Skincare</a></li>
                    <li><a class="dropdown-item" href="gold.php">Gold Jewelry</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">Fashion</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="mens-wear.php">Men's Wear</a></li>
                    <li><a class="dropdown-item" href="women-wear.php">Women's Wear</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link text-white" href="deals.php">Deals</a></li>
        </ul>
    </div>
</nav>

<div class="container py-5">
    <div class="row">
        <aside class="col-lg-3">
            <div class="profile-nav-card">
                <div class="profile-header-box">
                    <div class="profile-avatar">S</div>
                    <div>
                        <small class="text-muted">Hello,</small>
                        <div class="fw-bold">Shruthi </div>
                    </div>
                </div>
                
                <div class="nav-section-title">Account Settings</div>
                <a href="?tab=profile" class="profile-link <?= !isset($_GET['tab']) || $_GET['tab'] == 'profile' ? 'active' : '' ?>">
                    <i class="bi bi-person-fill"></i> Personal Information
                </a>
                <a href="?tab=addresses" class="profile-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'addresses') ? 'active' : '' ?>">
                    <i class="bi bi-geo-alt-fill"></i> Manage Addresses
                </a>
                
                <div class="border-top mt-3">
                    <a href="logout.php" class="profile-link text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </div>
            </div>
        </aside>

        <div class="col-lg-9">
            <?php if(!isset($_GET['tab']) || $_GET['tab'] == 'profile'): ?>
            <div class="content-card">
                <div class="section-header">
                    <h4>Personal Information</h4>
                    <a href="#" class="edit-btn">Edit</a>
                </div>
                
                <form action="update_profile.php" method="POST">
                    <div class="row mb-4">
                        <div class="col-md-5">
                            <label class="form-label">First Name</label>
                            <input type="text" name="fname" class="form-control custom-input" value="<?= $user['first_name'] ?>">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lname" class="form-control custom-input" value="<?= $user['last_name'] ?>">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="save-btn w-100">SAVE</button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label d-block mb-3">Your Gender</label>
                        <div class="radio-group">
                            <input type="radio" name="gender" id="male" value="Male" <?= $user['gender'] == 'Male' ? 'checked' : '' ?>>
                            <label for="male">Male</label>
                            
                            <input type="radio" name="gender" id="female" value="Female" <?= $user['gender'] == 'Female' ? 'checked' : '' ?>>
                            <label for="female">Female</label>
                        </div>
                    </div>
                </form>

                <div class="section-header mt-5">
                    <h4>Email Address</h4>
                    <a href="#" class="edit-btn">Edit</a>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <input type="email" class="form-control custom-input" placeholder="Enter Email Address" value="<?= $user['email'] ?>">
                    </div>
                    <div class="col-md-2">
                        <button class="save-btn">SAVE</button>
                    </div>
                </div>

                <div class="section-header mt-5">
                    <h4>Mobile Number</h4>
                    <a href="#" class="edit-btn">Edit</a>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <input type="text" class="form-control custom-input" value="<?= $user['mobile'] ?>" disabled>
                    </div>
                </div>
            </div>

            <?php elseif($_GET['tab'] == 'addresses'): ?>
            <div class="content-card">
                <div class="section-header">
                    <h4>Manage Addresses</h4>
                </div>
                
                <div class="empty-state">
                    <img src="https://cdn-icons-png.flaticon.com/512/854/854878.png" style="opacity: 0.5" alt="No address">
                    <h5>No Addresses found in your account!</h5>
                    <p class="text-muted">Add a delivery address.</p>
                    <button class="save-btn mt-3" data-bs-toggle="collapse" data-bs-target="#addressForm">
                        ADD ADDRESSES
                    </button>
                </div>

                <div class="collapse mt-4" id="addressForm">
                    <div class="p-4 border rounded" style="background: #fcfcfc;">
                        <h6 class="text-primary fw-bold mb-3">ADD A NEW ADDRESS</h6>
                        <div class="row g-3">
                            <div class="col-md-6"><input type="text" class="form-control custom-input" placeholder="Name"></div>
                            <div class="col-md-6"><input type="text" class="form-control custom-input" placeholder="10-digit mobile number"></div>
                            <div class="col-12"><textarea class="form-control custom-input" rows="3" placeholder="Address (Area and Street)"></textarea></div>
                            <div class="col-12 mt-4">
                                <button class="save-btn">SAVE</button>
                                <button class="btn btn-link text-decoration-none" data-bs-toggle="collapse" data-bs-target="#addressForm">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="footer-section bg-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h2 class="footer-brand-text mb-3 text-white">StyleHub</h2>
                <p class="mb-4 text-white-50">We offer the best products at competitive prices with fast shipping and excellent customer service.</p>
                <div class="d-flex">
                    <a href="#" class="text-light me-3"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-twitter fs-4"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-linkedin fs-4"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0 footer-links">
                <h5 class="text-white">Shop</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50 text-decoration-none">Beauty & Jewelry</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Homemade Gifts</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Stationery</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Men's Fashion</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Women's Fashion</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0 footer-links">
                <h5 class="text-white">Customer Service</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50 text-decoration-none">Contact Us</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Returns & Exchanges</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Shipping & Delivery</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <h5 class="mb-3 text-white">Newsletter</h5>
                <p class="text-white-50">Subscribe to get special offers, free giveaways, and new product alerts.</p>
                <form class="d-flex gap-2">
                    <input type="email" class="form-control mb-3" placeholder="Your email address">
                    <button type="submit" class="btn btn-primary rounded-pill h-100" style="background-color: #d16d08f2 !important; border:none; padding: 10px 20px;">Subscribe</button>
                </form>
            </div>
        </div>
        <hr class="my-4 border-secondary">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <p class="mb-0 text-white-50">&copy; 2026 StyleHub. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex justify-content-md-end footer-links">
                    <a href="#" class="text-white-50 me-3 text-decoration-none">Privacy Policy</a>
                    <a href="#" class="text-white-50 me-3 text-decoration-none">Terms of Service</a>
                    <a href="#" class="text-white-50 text-decoration-none">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>