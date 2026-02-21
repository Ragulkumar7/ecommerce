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
            $mobile = $_POST['mobile'];
            $gender = $_POST['gender'];
            
            $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, mobile = ?, gender = ? WHERE id = ?");
            $stmt->execute([$fname, $lname, $mobile, $gender, $user_id]);
            $_SESSION['name'] = $fname; 
        }

        // 2. Update Email
        if (isset($_POST['update_email'])) {
            $email = $_POST['email'];
            $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            $stmt->execute([$email, $user_id]);
        }

        // 3. Add New Address
        if (isset($_POST['add_address'])) {
            $addr_name = $_POST['address_name'];
            $addr_mobile = $_POST['address_mobile'];
            $locality = $_POST['locality'] ?? '';
            $city = $_POST['city'] ?? '';
            $state = $_POST['state'] ?? '';
            $pincode = $_POST['pincode'] ?? '';
            $address_text = $_POST['address_text'] ?? '';

            $full_address = $address_text . ", " . $locality . ", " . $city . ", " . $state . " - " . $pincode;
            
            $stmt = $pdo->prepare("INSERT INTO user_addresses (user_id, full_name, mobile_number, address_line) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $addr_name, $addr_mobile, $full_address]);
        }

        // 4. Delete Address
        if (isset($_POST['delete_address'])) {
            $addr_id = $_POST['address_id'];
            $stmt = $pdo->prepare("DELETE FROM user_addresses WHERE id = ? AND user_id = ?");
            $stmt->execute([$addr_id, $user_id]);
        }
        
        header("Location: profile.php?tab=" . ($_GET['tab'] ?? 'profile') . "&success=1");
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
    die("Database Error: " . $e->getMessage()); 
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
        :root { --primary-purple: #6F4AA2; --primary: #6F4AA2; --primary-dark: #5a3a80; --primary-blue: #2874f0; --light-bg: #f5f7fa; --text-dark: #2d2d2d; }
        body { background-color: var(--light-bg); font-family: 'Inter', sans-serif; color: var(--text-dark); }
        .main-header { background: #fff; border-bottom: 1px solid #eee; }
        .brand-logo { font-size: 1.5rem; font-weight: 700; color: var(--primary-purple); }
        .main-navbar { background-color: var(--primary-purple) !important; }
        .profile-nav-card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .profile-avatar { width: 50px; height: 50px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: bold; margin-right: 15px; }
        .profile-link { display: flex; align-items: center; padding: 12px 20px; color: var(--text-dark); text-decoration: none; transition: 0.3s; }
        .profile-link:hover, .profile-link.active { background-color: #f0ecf7; color: var(--primary); font-weight: 600; }
        .nav-section-title { font-size: 0.75rem; color: #878787; text-transform: uppercase; font-weight: 700; padding: 15px 20px 5px; }
        .content-card { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 25px; min-height: 450px; }
        .custom-input { border-radius: 8px; padding: 12px; border: 1px solid #ddd; background-color: #f9f9f9; }
        .save-btn { background-color: var(--primary); color: white; border: none; padding: 10px 40px; border-radius: 5px; font-weight: 600; transition: 0.3s; }
        .save-btn:hover { background-color: var(--primary-dark); }
        .edit-link { color: var(--primary-blue); font-weight: 600; cursor: pointer; text-decoration: none; font-size: 14px; }
        .ui-input { border-radius: 2px; padding: 12px; border: 1px solid #ccc; font-size: 14px; width: 100%; margin-bottom: 15px; background: #fff; }
        .btn-save-addr { background: var(--primary-blue); color: white; border: none; padding: 15px 60px; border-radius: 2px; font-weight: 600; text-transform: uppercase; }
        .edit-mode { display: none; }
    </style>
</head>
<body>

<header class="main-header">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-6">
                <span class="brand-logo"><i class="bi bi-shop me-2"></i>StyleHub</span>
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

                <div class="nav-section-title">MY ORDERS</div>
                <a href="?tab=orders" class="profile-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'orders') ? 'active' : '' ?>"><i class="bi bi-box-seam me-2"></i> Orders</a>
                <a href="?tab=returns" class="profile-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'returns') ? 'active' : '' ?>"><i class="bi bi-arrow-left-right me-2"></i> Returns</a>

                <div class="nav-section-title">ACCOUNT SETTINGS</div>
                <a href="?tab=profile" class="profile-link <?= !isset($_GET['tab']) || $_GET['tab'] == 'profile' ? 'active' : '' ?>"><i class="bi bi-person me-2"></i> Personal Information</a>
                <a href="?tab=addresses" class="profile-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'addresses') ? 'active' : '' ?>"><i class="bi bi-geo-alt me-2"></i> Manage Addresses</a>

                <div class="nav-section-title">MY STUFF</div>
                <a href="?tab=wishlist" class="profile-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'wishlist') ? 'active' : '' ?>"><i class="bi bi-heart me-2"></i> Wishlist</a>
                <a href="?tab=reviews" class="profile-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'reviews') ? 'active' : '' ?>"><i class="bi bi-chat-left-text me-2"></i> Reviews & Ratings</a>

                <a href="logout.php" class="profile-link text-danger border-top mt-2"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
            </div>
        </aside>

        <div class="col-lg-9">
            <?php $tab = $_GET['tab'] ?? 'profile'; ?>

            <?php if($tab == 'profile'): ?>
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">Personal Information</h4>
                    <span class="edit-link" onclick="toggleEdit('personal')">Edit</span>
                </div>
                <div id="personal-view-mode">
                    <div class="row mb-4">
                        <div class="col-md-4"><label class="text-muted small d-block">First Name</label><span class="fw-medium"><?= htmlspecialchars($user['first_name'] ?? '') ?></span></div>
                        <div class="col-md-4"><label class="text-muted small d-block">Last Name</label><span class="fw-medium"><?= htmlspecialchars($user['last_name'] ?? '') ?></span></div>
                        <div class="col-md-4"><label class="text-muted small d-block">Mobile</label><span class="fw-medium"><?= htmlspecialchars($user['mobile'] ?? '') ?></span></div>
                    </div>
                    <div class="mb-4"><label class="text-muted small d-block">Gender</label><span class="fw-medium"><?= htmlspecialchars($user['gender'] ?? '') ?></span></div>
                </div>
                <form method="POST" id="personal-edit-mode" class="edit-mode">
                    <div class="row g-3 mb-4">
                        <div class="col-md-4"><input type="text" name="fname" class="form-control custom-input" value="<?= $user['first_name'] ?>"></div>
                        <div class="col-md-4"><input type="text" name="lname" class="form-control custom-input" value="<?= $user['last_name'] ?>"></div>
                        <div class="col-md-4"><input type="text" name="mobile" class="form-control custom-input" value="<?= $user['mobile'] ?>"></div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label d-block small">Gender</label>
                        <input type="radio" name="gender" value="Male" <?= $user['gender']=='Male'?'checked':'' ?>> Male
                        <input type="radio" name="gender" value="Female" <?= $user['gender']=='Female'?'checked':'' ?> class="ms-3"> Female
                    </div>
                    <button type="submit" name="update_personal" class="save-btn">SAVE</button>
                    <button type="button" onclick="toggleEdit('personal')" class="btn btn-link text-muted">Cancel</button>
                </form>

                <hr class="my-5">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">Email Address</h4>
                    <span class="edit-link" onclick="toggleEdit('email')">Edit</span>
                </div>
                <div id="email-view-mode"><p class="fw-medium"><?= htmlspecialchars($user['email'] ?? '') ?></p></div>
                <form method="POST" id="email-edit-mode" class="edit-mode">
                    <div class="row g-3">
                        <div class="col-md-8"><input type="email" name="email" class="form-control custom-input" value="<?= $user['email'] ?>"></div>
                        <div class="col-md-4"><button type="submit" name="update_email" class="save-btn">SAVE</button></div>
                    </div>
                </form>
            </div>

            <?php elseif($tab == 'orders'): ?>
            <div class="content-card text-center py-5">
                <i class="bi bi-box-seam display-1 text-muted"></i>
                <h4 class="fw-bold mt-4">No Orders Yet</h4>
                <p>Looks like you haven't made your first purchase.</p>
                <a href="index.php" class="btn btn-primary mt-2">Start Shopping</a>
            </div>

            <?php elseif($tab == 'returns'): ?>
            <div class="content-card text-center py-5">
                <i class="bi bi-arrow-left-right display-1 text-muted"></i>
                <h4 class="fw-bold mt-4">No Returns</h4>
                <p>You have no ongoing return requests.</p>
            </div>

            <?php elseif($tab == 'addresses'): ?>
            <div class="content-card">
                <h4 class="fw-bold mb-4">Manage Addresses</h4>
                <div class="address-form-box mb-4 p-4 border rounded bg-light">
                    <p class="text-primary fw-bold small mb-3">ADD A NEW ADDRESS</p>
                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-6"><input type="text" name="address_name" class="ui-input" placeholder="Name" required></div>
                            <div class="col-md-6"><input type="text" name="address_mobile" class="ui-input" placeholder="10-digit mobile number" required></div>
                            <div class="col-md-6"><input type="text" name="pincode" class="ui-input" placeholder="Pincode" required></div>
                            <div class="col-md-6"><input type="text" name="locality" class="ui-input" placeholder="Locality" required></div>
                            <div class="col-12"><textarea name="address_text" class="ui-input" placeholder="Address (Area and Street)" rows="3" required></textarea></div>
                            <div class="col-md-6"><input type="text" name="city" class="ui-input" placeholder="City" required></div>
                            <div class="col-md-6">
                                <select name="state" class="ui-input" required>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Kerala">Kerala</option>
                                </select>
                            </div>
                            <div class="col-12"><button type="submit" name="add_address" class="btn-save-addr">SAVE</button></div>
                        </div>
                    </form>
                </div>
                <?php foreach($addresses as $addr): ?>
                    <div class="p-3 border rounded mb-3 d-flex justify-content-between">
                        <div>
                            <h6 class="fw-bold"><?= $addr['full_name'] ?> (<?= $addr['mobile_number'] ?>)</h6>
                            <p class="mb-0 small"><?= $addr['address_line'] ?></p>
                        </div>
                        <form method="POST"><input type="hidden" name="address_id" value="<?= $addr['id'] ?>"><button type="submit" name="delete_address" class="btn text-danger"><i class="bi bi-trash"></i></button></form>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php elseif($tab == 'wishlist'): ?>
            <div class="content-card text-center py-5">
                <i class="bi bi-heart display-1 text-muted"></i>
                <h4 class="fw-bold mt-4">Your Wishlist is Empty</h4>
                <p>Save items you like for later!</p>
            </div>

            <?php elseif($tab == 'reviews'): ?>
            <div class="content-card text-center py-5">
                <i class="bi bi-chat-square-text display-1 text-muted"></i>
                <h4 class="fw-bold mt-4">No Reviews Yet</h4>
                <p>Share your thoughts on products you've bought.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function toggleEdit(section) {
        const view = document.getElementById(section + '-view-mode');
        const edit = document.getElementById(section + '-edit-mode');
        view.style.display = view.style.display === 'none' ? 'block' : 'none';
        edit.style.display = edit.style.display === 'block' ? 'none' : 'block';
    }
</script>
</body>
</html>