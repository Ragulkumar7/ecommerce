<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'ecommerce';
$username = 'root';
$password = '';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];
        $pass = $_POST['password'];

        // Check if user exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['password'])) {
            // Password is correct, start session
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['first_name'];
            header("Location: profile.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        :root {
            --primary-purple: #6F4AA2;
            --hover-purple: #5a3a80;
        }
        body {
            background-color: #f5f7fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .brand-logo {
            color: var(--primary-purple);
            font-weight: 700;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.2rem rgba(111, 74, 162, 0.25);
        }
        .btn-login {
            background-color: var(--primary-purple);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-login:hover {
            background-color: var(--hover-purple);
            transform: translateY(-2px);
        }
        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }
        .footer-text a {
            color: var(--primary-purple);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="brand-logo"><i class="bi bi-shop me-2"></i>StyleHub</div>
    
    <?php if($error): ?>
        <div class="alert alert-danger py-2" style="font-size: 0.85rem;"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label class="form-label small fw-bold">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
        
        <label class="form-label small fw-bold">Password</label>
        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        
        <div class="d-flex justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label small" for="remember">Remember me</label>
            </div>
            <a href="#" class="small text-muted">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-login">Sign In</button>
    </form>

    <div class="footer-text">
        Don't have an account? <a href="signup.php">Create Account</a>
    </div>
</div>

</body>
</html>