<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$host = 'localhost';
$dbname = 'ecommerce'; 
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $user_id = $_SESSION['id'];

    // --- HANDLE FORM SUBMISSIONS ---
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // 1. Update Personal Info
        if (isset($_POST['update_personal'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $gender = $_POST['gender'];
            $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, gender = ? WHERE id = ?");
            $stmt->execute([$fname, $lname, $gender, $user_id]);
            $_SESSION['name'] = $fname; 
        }

        // 2. Update Email
        if (isset($_POST['update_email'])) {
            $email = $_POST['email'];
            $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            $stmt->execute([$email, $user_id]);
        }

        // 3. Add New Address (Supports multiple addresses with New UI fields)
        if (isset($_POST['add_address'])) {
            $addr_name = $_POST['address_name'];
            $addr_mobile = $_POST['address_mobile'];
            // Concatenating the new UI fields into the address_line for your database
            $full_address = $_POST['address_text'] . ", " . $_POST['locality'] . ", " . $_POST['city'] . ", " . $_POST['state'] . " - " . $_POST['pincode'];
            
            $stmt = $pdo->prepare("INSERT INTO user_addresses (user_id, full_name, mobile_number, address_line) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $addr_name, $addr_mobile, $full_address]);
        }

        // 4. Delete Address
        if (isset($_POST['delete_address'])) {
            $addr_id = $_POST['address_id'];
            $stmt = $pdo->prepare("DELETE FROM user_addresses WHERE id = ? AND user_id = ?");
            $stmt->execute([$addr_id, $user_id]);
        }
        
        header("Location: profile.php?tab=" . ($_GET['tab'] ?? 'profile'));
        exit;
    }

    // --- FETCH DATA FOR UI ---
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM user_addresses WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
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
            --primary: #6F4AA2;
            --primary-dark: #5a3a80;
            --primary-blue: #2874f0;
            --light-bg: #f5f7fa;
            --text-dark: #2d2d2d;
        }
        body { background-color: var(--light-bg); font-family: 'Inter', sans-serif; color: var(--text-dark); }
        .main-header { background: #fff; border-bottom: 1px solid #eee; }
        .brand-logo { font-size: 1.5rem; font-weight: 700; color: var(--primary-purple); }
        .main-navbar { background-color: var(--primary-purple) !important; }
        .profile-nav-card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .profile-avatar { width: 50px; height: 50px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: bold; margin-right: 15px; }
        .profile-link { display: flex; align-items: center; padding: 12px 20px; color: var(--text-dark); text-decoration: none; transition: 0.3s; }
        .profile-link:hover, .profile-link.active { background-color: #f0ecf7; color: var(--primary); font-weight: 600; }
        .content-card { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 25px; }
        .custom-input { border-radius: 8px; padding: 12px; border: 1px solid #ddd; background-color: #f9f9f9; }
        .save-btn { background-color: var(--primary); color: white; border: none; padding: 10px 40px; border-radius: 5px; font-weight: 600; transition: 0.3s; }
        .save-btn:hover { background-color: var(--primary-dark); }

        /* --- Manage Address Specific UI --- */
        .address-form-box { background: #f5faff; border: 1px solid #e0e0e0; padding: 25px; border-radius: 4px; }
        .ui-input { border-radius: 2px; padding: 12px; border: 1px solid #ccc; font-size: 14px; width: 100%; margin-bottom: 15px; background: #fff; }
        .ui-input:focus { border-color: var(--primary-blue); outline: none; }
        .btn-location { background: var(--primary-blue); color: white; border: none; padding: 10px 20px; border-radius: 4px; font-weight: 600; margin-bottom: 20px; }
        .btn-save-addr { background: var(--primary-blue); color: white; border: none; padding: 15px 60px; border-radius: 2px; font-weight: 600; text-transform: uppercase; }
        .btn-cancel-addr { color: var(--primary-blue); font-weight: 600; text-decoration: none; margin-left: 30px; cursor: pointer; }
    </style>
</head>
<body>

<header class="main-header">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="d-flex align-items-center">
                    <span class="brand-logo"><i class="bi bi-shop me-2"></i>StyleHub</span>
                </div>
            </div>
            <div class="col-6 text-end">
                <a href="cart.php" class="text-dark fs-4 me-3"><i class="bi bi-cart3"></i></a>
            </div>
        </div>
    </div>
</header>

<nav class="main-navbar py-2">
    <div class="container">
        <a href="index.php" class="text-white text-decoration-none me-3"><i class="bi bi-house"></i> Home</a>
        <a href="deals.php" class="text-white text-decoration-none">Deals</a>
    </div>
</nav>

<div class="container py-5">
    <div class="row">
        <aside class="col-lg-3">
            <div class="profile-nav-card">
                <div class="p-3 d-flex align-items-center border-bottom">
                    <div class="profile-avatar"><?= substr($user['first_name'] ?? 'U', 0, 1) ?></div>
                    <div>
                        <small class="text-muted">Hello,</small>
                        <div class="fw-bold"><?= htmlspecialchars($user['first_name'] ?? 'User') ?></div>
                    </div>
                </div>
                <a href="?tab=profile" class="profile-link <?= !isset($_GET['tab']) || $_GET['tab'] == 'profile' ? 'active' : '' ?>">
                    <i class="bi bi-person me-2"></i> Personal Information
                </a>
                <a href="?tab=addresses" class="profile-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'addresses') ? 'active' : '' ?>">
                    <i class="bi bi-geo-alt me-2"></i> Manage Addresses
                </a>
                <a href="logout.php" class="profile-link text-danger border-top"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
            </div>
        </aside>

        <div class="col-lg-9">
            <?php if(!isset($_GET['tab']) || $_GET['tab'] == 'profile'): ?>
            <div class="content-card">
                <h4 class="fw-bold mb-4">Personal Information</h4>
                <form method="POST">
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label class="form-label small">First Name</label>
                            <input type="text" name="fname" class="form-control custom-input" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small">Last Name</label>
                            <input type="text" name="lname" class="form-control custom-input" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" name="update_personal" class="save-btn w-100">SAVE</button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label d-block small">Gender</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="m" value="Male" <?= ($user['gender'] ?? '') == 'Male' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="m">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="f" value="Female" <?= ($user['gender'] ?? '') == 'Female' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="f">Female</label>
                        </div>
                    </div>
                </form>

                <h4 class="fw-bold mt-5 mb-4">Email Address</h4>
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control custom-input" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="update_email" class="save-btn">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>

            <?php elseif($_GET['tab'] == 'addresses'): ?>
            <div class="content-card">
                <h4 class="fw-bold mb-4">Manage Addresses</h4>
                
                <div class="address-form-box mb-4">
                    <p class="text-primary fw-bold small mb-3">ADD A NEW ADDRESS</p>
                    <button class="btn-location"><i class="bi bi-cursor-fill me-2"></i> Use my current location</button>
                    
                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-6"><input type="text" name="address_name" class="ui-input" placeholder="Name" required></div>
                            <div class="col-md-6"><input type="text" name="address_mobile" class="ui-input" placeholder="10-digit mobile number" required></div>
                            <div class="col-md-6"><input type="text" name="pincode" class="ui-input" placeholder="Pincode" required></div>
                            <div class="col-md-6"><input type="text" name="locality" class="ui-input" placeholder="Locality" required></div>
                            <div class="col-12"><textarea name="address_text" class="ui-input" placeholder="Address (Area and Street)" rows="3" required></textarea></div>
                            <div class="col-md-6"><input type="text" name="city" class="ui-input" placeholder="City/District/Town" required></div>
                            <div class="col-md-6">
                                <select name="state" class="ui-input" required>
                                    <option value="">--Select State--</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                </select>
                            </div>
                            <div class="col-md-6"><input type="text" class="ui-input" placeholder="Landmark (Optional)"></div>
                            <div class="col-md-6"><input type="text" class="ui-input" placeholder="Alternate Phone (Optional)"></div>
                            
                            <div class="col-12">
                                <span class="d-block small text-muted mb-2">Address Type</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="addr_type" id="home" value="Home" checked>
                                    <label class="form-check-label" for="home">Home</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="addr_type" id="work" value="Work">
                                    <label class="form-check-label" for="work">Work</label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" name="add_address" class="btn-save-addr">SAVE</button>
                                <span class="btn-cancel-addr" data-bs-toggle="collapse" data-bs-target="#addrForm">CANCEL</span>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if(empty($addresses)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-geo-alt text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2">No addresses found.</p>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach($addresses as $addr): ?>
                            <div class="col-12 mb-3">
                                <div class="p-3 border rounded shadow-sm d-flex justify-content-between align-items-start bg-white">
                                    <div>
                                        <h6 class="fw-bold mb-1"><?= htmlspecialchars($addr['full_name']) ?> <span class="ms-3 text-muted"><?= htmlspecialchars($addr['mobile_number']) ?></span></h6>
                                        <p class="text-muted small mb-0"><?= htmlspecialchars($addr['address_line']) ?></p>
                                    </div>
                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this address?');">
                                        <input type="hidden" name="address_id" value="<?= $addr['id'] ?>">
                                        <button type="submit" name="delete_address" class="btn btn-link text-danger p-0"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>