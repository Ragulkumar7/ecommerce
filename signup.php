<?php
session_start();

// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $pass  = $_POST['password'];
        $conf_pass = $_POST['confirm_password']; // New field
        $gender = $_POST['gender'];

        // 1. Check if passwords match
        if ($pass !== $conf_pass) {
            $message = "Passwords do not match!";
            $messageClass = "alert-danger";
        } else {
            // 2. Check if email already exists
            $checkEmail = $pdo->prepare("SELECT email FROM users WHERE email = ?");
            $checkEmail->execute([$email]);

            if ($checkEmail->rowCount() > 0) {
                $message = "Email is already registered!";
                $messageClass = "alert-danger";
            } else {
                // 3. Hash the password
                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

                // 4. Insert into database
                $sql = "INSERT INTO users (first_name, last_name, email, mobile, password, gender) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute([$fname, $lname, $email, $mobile, $hashed_password, $gender])) {
                    $message = "Account created successfully! <a href='login.php' class='alert-link'>Login here</a>";
                    $messageClass = "alert-success";
                }
            }
        }

    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        $messageClass = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub | Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        :root {
            --primary-purple: #6F4AA2;
            --hover-purple: #5a3a80;
        }
        body {
            background-color: #f5f7fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .signup-card {
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 550px;
        }
        .brand-logo {
            color: var(--primary-purple);
            font-weight: 700;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 25px;
        }
        .form-label { font-weight: 600; font-size: 0.85rem; color: #555; }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.2rem rgba(111, 74, 162, 0.15);
        }
        .btn-signup {
            background-color: var(--primary-purple);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn-signup:hover { background-color: var(--hover-purple); }
        .footer-text { text-align: center; margin-top: 20px; font-size: 0.9rem; }
        .footer-text a { color: var(--primary-purple); text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

<div class="signup-card">
    <div class="brand-logo"><i class="bi bi-shop me-2"></i>StyleHub</div>
    <h5 class="text-center mb-4">Create your account</h5>

    <?php if($message): ?>
        <div class="alert <?= $messageClass ?> alert-dismissible fade show py-2" role="alert" style="font-size: 0.9rem;">
            <?= $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.7rem;"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
            </div>
            <div class="col-md-5">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>

        <label class="form-label">Mobile Number</label>
        <input type="text" name="mobile" class="form-control" placeholder="+91 00000 00000" required>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="••••••••" required>
            </div>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label small text-muted" for="terms">
                I agree to the Terms & Conditions
            </label>
        </div>

        <button type="submit" class="btn btn-signup">Create Account</button>
    </form>

    <div class="footer-text">
        Already have an account? <a href="login.php">Sign In</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>