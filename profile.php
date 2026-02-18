<?php
// Database connection (using your existing settings)
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mock user data for UI (In a real app, fetch where user_id = session_id)
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

        /* Profile Sidebar Style */
        .profile-nav-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .profile-header-box {
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .profile-avatar {
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
            margin-right: 15px;
        }

        .nav-section-title {
            font-size: 0.85rem;
            color: #999;
            text-transform: uppercase;
            font-weight: 700;
            padding: 20px 20px 10px;
        }

        .profile-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-dark);
            text-decoration: none;
            transition: 0.3s;
        }

        .profile-link i {
            margin-right: 15px;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .profile-link:hover, .profile-link.active {
            background-color: #f0ecf7;
            color: var(--primary);
            font-weight: 600;
        }

        /* Main Content Card */
        .content-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-header h4 {
            font-weight: 700;
            margin: 0;
        }

        .edit-btn {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .form-label {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 5px;
        }

        .custom-input {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        .custom-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(111, 74, 162, 0.1);
            background-color: white;
        }

        .save-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px 40px;
            border-radius: 5px;
            font-weight: 600;
            transition: 0.3s;
        }

        .save-btn:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .radio-group label {
            margin-right: 25px;
            cursor: pointer;
        }

        /* Address Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 0;
        }

        .empty-state img {
            width: 150px;
            margin-bottom: 20px;
        }

        .add-address-btn {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: white;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 600;
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>

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
                <a href="?tab=addresses" class="profile-link <?= $_GET['tab'] == 'addresses' ? 'active' : '' ?>">
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
                        <button class="save-btn btn-sm mb-4"><i class="bi bi-crosshair"></i> Use my current location</button>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control custom-input" placeholder="Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control custom-input" placeholder="10-digit mobile number">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control custom-input" placeholder="Pincode">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control custom-input" placeholder="Locality">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control custom-input" rows="3" placeholder="Address (Area and Street)"></textarea>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control custom-input" placeholder="City/District/Town">
                            </div>
                            <div class="col-md-6">
                                <select class="form-select custom-input">
                                    <option selected>--Select State--</option>
                                    <option>Tamil Nadu</option>
                                    <option>Karnataka</option>
                                    <option>Kerala</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control custom-input" placeholder="Landmark (Optional)">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control custom-input" placeholder="Alternate Phone (Optional)">
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label d-block">Address Type</label>
                                <div class="radio-group">
                                    <input type="radio" name="addr_type" id="home_addr"> <label for="home_addr">Home</label>
                                    <input type="radio" name="addr_type" id="work_addr"> <label for="work_addr">Work</label>
                                </div>
                            </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>