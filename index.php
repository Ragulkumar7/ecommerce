<?php
// database connection
$host = 'localhost';
$dbname = 'electro_store';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ecommerce Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="./assest/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./assest/css/style.css" rel="stylesheet">
</head>

<body>

    
    <!-- Custom cursor -->
    <div class="cursor-dot"></div>
    <div class="cursor-outline"></div>

    <!-- Topbar Start -->
    <div class="container-fluid px-5 d-none border-bottom d-lg-block">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-4 text-center text-lg-start mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a href="#!" class="text-muted me-2"> Help</a><small> / </small>
                    <a href="#!" class="text-muted mx-2"> Support</a><small> / </small>
                    <a href="#!" class="text-muted ms-2"> Contact</a>

                </div>
            </div>
            <div class="col-lg-4 text-center d-flex align-items-center justify-content-center">
                <small class="text-dark">Call Us:</small>
                <a href="#!" class="text-muted">(+012) 1234 567890</a>
            </div>

            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">

                    <div class="dropdown">
                        <a href="#!" class="dropdown-toggle text-muted mx-2" data-bs-toggle="dropdown"><small>
                                English</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#!" class="dropdown-item"> English</a>
                            <a href="#!" class="dropdown-item"> Turkish</a>
                            <a href="#!" class="dropdown-item"> Spanol</a>
                            <a href="#!" class="dropdown-item"> Italiano</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#!" class="dropdown-toggle text-muted ms-2" data-bs-toggle="dropdown"><small><i
                                    class="fa fa-home me-2"></i> My Dashboard</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#!" class="dropdown-item"> Login</a>
                            <a href="#!" class="dropdown-item"> Wishlist</a>
                            <a href="#!" class="dropdown-item"> My Card</a>
                            <a href="#!" class="dropdown-item"> Notifications</a>
                            <a href="#!" class="dropdown-item"> Account Settings</a>
                            <a href="#!" class="dropdown-item"> My Account</a>
                            <a href="#!" class="dropdown-item"> Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-5 py-4 d-none d-lg-block">
        <div class="row gx-0 align-items-center text-center">
            <div class="col-md-4 col-lg-3 text-center text-lg-start">
                <div class="d-inline-flex align-items-center">
                    <a href="" class="navbar-brand p-0">
                        <h1 class="display-5 text-primary m-0"><i
                                class="fas fa-shopping-bag text-secondary me-2"></i>E-Commerce</h1>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-lg-6 text-center">
                <div class="position-relative ps-4">
                    <div class="d-flex border rounded-pill">
                        <input class="form-control border-0 rounded-pill w-100 py-3" type="text"
                            data-bs-target="#!dropdownToggle123" placeholder="Search Looking For?">
                        <select class="form-select text-dark border-0 border-start rounded-0 p-3" style="width: 200px;">
                            <option value="All Category">All Category</option>
                            <option value="Pest Control-2">Category 1</option>
                            <option value="Pest Control-3">Category 2</option>
                            <option value="Pest Control-4">Category 3</option>
                            <option value="Pest Control-5">Category 4</option>
                        </select>
                        <button type="button" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
           <div class="col-md-4 col-lg-3 text-center text-lg-end">
  <div class="d-inline-flex align-items-center">
    <!-- Compare -->
    <a href="#!" class="text-muted d-flex align-items-center justify-content-center me-3">
      <span class="rounded-circle btn-md-square border">
        <i class="fas fa-random"></i>
      </span>
    </a>

    <!-- Wishlist -->
    <a href="#!" class="text-muted d-flex align-items-center justify-content-center me-3">
      <span class="rounded-circle btn-md-square border">
        <i class="fas fa-heart"></i>
      </span>
    </a>

    <!-- Cart -->
    <a href="./cart.php" class="text-muted d-flex align-items-center justify-content-center">
      <span class="rounded-circle btn-md-square border position-relative">
        <i class="fas fa-shopping-cart"></i>
        <!-- Badge for number of items -->
        <span id="header-cart-count" 
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
          0
        </span>
      </span>
      <!-- Total -->
      <span class="text-dark ms-2" id="header-total">₹0.00</span>
    </a>
  </div>
</div>

        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid nav-bar p-0">
        <div class="row gx-0 bg-primary px-5 align-items-center">
            <div class="col-lg-3 d-none d-lg-block">
                <nav class="navbar navbar-light position-relative" style="width: 250px;">
                    <button class="navbar-toggler border-0 fs-4 w-100 px-0 text-start" type="button"
                        data-bs-toggle="collapse" data-bs-target="#!allCat">
                        <h4 class="m-0"><i class="fa fa-bars me-2"></i>All Categories</h4>
                    </button>
                    <div class="collapse navbar-collapse rounded-bottom" id="allCat">
                        <div class="navbar-nav ms-auto py-0">
                            <ul class="list-unstyled categories-bars">
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#!">Accessories</a>
                                        <span>(3)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#!">E-Commercenics & Computer</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#!">Laptops & Desktops</a>
                                        <span>(2)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#!">Mobiles & Tablets</a>
                                        <span>(8)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#!">SmartPhone & Smart TV</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-12 col-lg-9">
                <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
                    <a href="" class="navbar-brand d-block d-lg-none">
                        <h1 class="display-5 text-secondary m-0"><i
                                class="fas fa-shopping-bag text-white me-2"></i>E-Commerce</h1>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
                    </a>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#!navbarCollapse">
                        <span class="fa fa-bars fa-1x"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <a href="single.html" class="nav-item nav-link">Single Page</a>
                            <div class="nav-item dropdown">
                                <a href="#!" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0">
                                    <a href="gold.php" class="dropdown-item">Gold</a>
                                    <a href="women-wear.php" class="dropdown-item">women-wear</a>
                                    <a href="coffee.php" class="dropdown-item">Coffee</a>
                                    <a href="electronics.php" class="dropdown-item">Electronics</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link me-2">Contact</a>
                            <div class="nav-item dropdown d-block d-lg-none mb-3">
                                <a href="#!" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">All Category</a>
                                <div class="dropdown-menu m-0">
                                    <ul class="list-unstyled categories-bars">
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#!">Accessories</a>
                                                <span>(3)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#!">E-Commercenics & Computer</a>
                                                <span>(5)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#!">Laptops & Desktops</a>
                                                <span>(2)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#!">Mobiles & Tablets</a>
                                                <span>(8)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#!">SmartPhone & Smart TV</a>
                                                <span>(5)</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="" class="btn btn-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0"><i
                                class="fa fa-mobile-alt me-2"></i> +0123 456 7890</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Carousel Start -->
    <div class="container-fluid carousel bg-light px-0">
        <div class="row g-0 justify-content-end">
            <div class="col-12 col-lg-7 col-xl-9">
                <div class="header-carousel owl-carousel bg-light py-5">
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assest/img/header-img.jpeg" class="img-fluid w-100" alt="Modern blue laptop open on a desk displaying the Windows 11 home screen with application icons and a blue abstract background. The environment is clean and minimal, evoking a sense of productivity and calm. The screen shows the Windows Start menu centered with icons such as Edge, Mail, and Store.">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A ₹1000</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Gold Products</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="gold.php">Shop Now</a>
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assest/img/womenproduct2.jpg" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A ₹200</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Women's Products</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="women-wear.php">Shop Now</a>
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assest/img/layacofee.jpeg" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A ₹100</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On 
                                Coffee Products</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="coffee.php">Shop Now</a>
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assest/img/1-cover.png" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up to 5%</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Camera and Accerssories</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="electronics.php">Shop Now</a>
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assest/img/product-1.png" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A ₹200</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Stationary Items</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="stationary.php">Shop Now</a>
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assest/img/product-10.png" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A ₹200</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Gift items</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="#!">Shop Now</a>
                        </div>
                    </div>
                    
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assest/img/product-15.png" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A ₹200</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Laptops & Desktop Or Smartphone</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="#!">Shop Now</a>
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assest/img/product-2.png" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A ₹200</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Laptops & Desktop Or Smartphone</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="#!">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay="0.1s">
                <div class="carousel-header-banner h-100">
                    <img src="assest/img/header-img.jpeg" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Image">
                    <div class="carousel-banner-offer">
                        <p class="bg-primary text-white rounded fs-5 py-2 px-4 mb-0 me-3">Save ₹5000.00</p>
                        <p class="text-primary fs-5 fw-bold mb-0">Special Offer</p>
                    </div>
                    <div class="carousel-banner">
                        <div class="carousel-banner-content text-center p-4">
                            <a href="#!" class="d-block mb-2">Gold Coin</a>
                            <a href="#!" class="d-block text-white fs-3">1 Gram<br> Max</a>
                            <del class="me-2 text-white fs-5">₹15,000.00</del>
                            <span class="text-primary fs-5">₹20,000.00</span>
                        </div>
                        <a href="#!" class="btn btn-primary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Searvices Start -->
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-6 col-md-4 col-lg-2 border-start border-end wow fadeInUp" data-wow-delay="0.1s">
                <div class="p-4">
                    <div class="d-inline-flex align-items-center">
                        <i class="fa fa-sync-alt fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Free Return</h6>
                            <p class="mb-0">30 days money back guarantee!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.2s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-telegram-plane fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Free Shipping</h6>
                            <p class="mb-0">Free shipping on all order</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.3s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-life-ring fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Support 24/7</h6>
                            <p class="mb-0">We support online 24 hrs a day</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.4s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Receive Gift Card</h6>
                            <p class="mb-0">Recieve gift all over oder ₹50</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.5s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Secure Payment</h6>
                            <p class="mb-0">We Value Your Security</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.6s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-blog fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Online Service</h6>
                            <p class="mb-0">Free return products in 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Searvices End -->
    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="mens-wear.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="assest/img/cat-1.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Men's dresses</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="women-wear.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="assest/img/cat-2.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Women's dresses</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="gold.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="assest/img/header-img-.png" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Gold </h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="electronics.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="assest/img/cat-4.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Accerssories</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="assest/img/cat-5.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Bags</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="stationary.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="assest/img/cat-6.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Shoes</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->

    <!-- Products Offer Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <a href="electronics.php" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                        <div>
                            <p class="text-muted mb-3">Find The Best Camera for You!</p>
                            <h3 class="text-primary">Savithri Photo House</h3>
                            <h1 class="display-3 text-secondary mb-0">40% <span
                                    class="text-primary fw-normal">Off</span></h1>
                        </div>
                        <img src="assest/img/product-1.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <a href="#!" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                        <div>
                            <p class="text-muted mb-3">Find The Best Whatches for You!</p>
                            <h3 class="text-primary">Smart Whatch</h3>
                            <h1 class="display-3 text-secondary mb-0">20% <span
                                    class="text-primary fw-normal">Off</span></h1>
                        </div>
                        <img src="assest/img/product-2.png" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Products Offer End -->


    <!-- Our Products Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="tab-class">
                <div class="row g-4">
                    <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                        <h1>Our Products</h1>
                    </div>
                    <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                    href="#!tab-1">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="d-flex py-2 mx-2 bg-light rounded-pill" data-bs-toggle="pill" href="#!tab-2">
                                    <span class="text-dark" style="width: 130px;">New Arrivals</span>
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#!tab-3">
                                    <span class="text-dark" style="width: 130px;">Featured</span>
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#!tab-4">
                                    <span class="text-dark" style="width: 130px;">Top Selling</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-3.png" class="img-fluid w-100 rounded-top" alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple i Phone 15 <br> G2356</a>
                                            <del class="me-2 fs-5">₹72,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-4.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-sale">sale</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">Camera</a>
                                            <a href="#!" class="d-block h4">Canon Camera <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,00,250.00</del>
                                            <span class="text-primary fs-5">₹90,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-5.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">Lens</a>
                                            <a href="#!" class="d-block h4">Lens <br> G2356</a>
                                            <del class="me-2 fs-5">₹50,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-6.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Mic <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-7.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-sale">Sale</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">Camera</a>
                                            <a href="#!" class="d-block h4">Polaroid camera <br> G2356</a>
                                            <del class="me-2 fs-5">₹10,250.00</del>
                                            <span class="text-primary fs-5">₹7,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-8.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">Head Phones</a>
                                            <a href="#!" class="d-block h4">Bass Headphones <br> G2356</a>
                                            <del class="me-2 fs-5">₹2,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-9.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">Computer</a>
                                            <a href="#!" class="d-block h4">Mac PC <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,30,250.00</del>
                                            <span class="text-primary fs-5">₹1,10,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-10.png" class="img-fluid w-100 rounded-top" alt="">
                                            <div class="product-sale">Sale</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple 14 Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹80,250.00</del>
                                            <span class="text-primary fs-5">₹60,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-3.png" class="img-fluid rounded-top" alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-4.png" class="img-fluid w-100 rounded-top" alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-5.png" class="img-fluid w-100 rounded-top" alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-6.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-9.png" class="img-fluid w-100 rounded-top" alt="">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-10.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-11.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-12.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-14.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-15.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-17.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="assest/img/product-16.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#!"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#!" class="d-block mb-2">SmartPhone</a>
                                            <a href="#!" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">₹1,250.00</del>
                                            <span class="text-primary fs-5">₹1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#!"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#!"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Products End -->

    <!-- Product Banner Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <a href="#!">
                        <div class="bg-primary rounded position-relative">
                            <img src="assest/img/product-banner.jpg" class="img-fluid w-100 rounded" alt="">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                style="background: rgba(255, 255, 255, 0.5);">
                                <h3 class="display-5 text-primary">EOS Rebel <br> <span>T7i Kit</span></h3>
                                <p class="fs-4 text-muted">₹1,20,000</p>
                                <a href="#!" class="btn btn-primary rounded-pill align-self-start py-2 px-4">Shop
                                    Now</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <a href="#!">
                        <div class="text-center bg-primary rounded position-relative">
                            <img src="assest/img/product-banner-2.jpg" class="img-fluid w-100" alt="">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                style="background: rgba(242, 139, 0, 0.5);">
                                <h2 class="display-2 text-secondary">SALE</h2>
                                <h4 class="display-5 text-white mb-4">Get UP To 50% Off</h4>
                                <a href="#!" class="btn btn-secondary rounded-pill align-self-center py-2 px-4">Shop
                                    Now</a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Banner End -->

    <!-- Product List Start -->
<div class="container-fluid products productList overflow-hidden">
    <div class="container products-mini py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h4 class="text-primary border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                data-wow-delay="0.1s">Products</h4>
            <h1 class="mb-0 display-3 wow fadeInUp" data-wow-delay="0.3s">All Product Items</h1>
        </div>
        <div class="productList-carousel owl-carousel pt-4 wow fadeInUp" data-wow-delay="0.3s">
            <!-- Coffee Products -->
            <div class="productImg-carousel owl-carousel productList-item">
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/coffee-arabica.png" class="img-fluid w-100 h-100" alt="Arabica Coffee">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Coffee</a>
                                <a href="#!" class="d-block h4">Arabica Coffee <br> Premium Blend</a>
                                <del class="me-2 fs-5">₹850.00</del>
                                <span class="text-primary fs-5">₹750.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/coffee-robusta.png" class="img-fluid w-100 h-100" alt="Robusta Coffee">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Coffee</a>
                                <a href="#!" class="d-block h4">Robusta Coffee <br> Strong Blend</a>
                                <del class="me-2 fs-5">₹780.00</del>
                                <span class="text-primary fs-5">₹680.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/coffee-espresso.png" class="img-fluid w-100 h-100" alt="Espresso Coffee">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Coffee</a>
                                <a href="#!" class="d-block h4">Espresso Coffee <br> Dark Roast</a>
                                <del class="me-2 fs-5">₹920.00</del>
                                <span class="text-primary fs-5">₹820.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/coffee-decaf.png" class="img-fluid w-100 h-100" alt="Decaf Coffee">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Coffee</a>
                                <a href="#!" class="d-block h4">Decaf Coffee <br> Caffeine Free</a>
                                <del class="me-2 fs-5">₹950.00</del>
                                <span class="text-primary fs-5">₹850.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Photography Products -->
            <div class="productImg-carousel owl-carousel productList-item">
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/camera-dslr.png" class="img-fluid w-100 h-100" alt="DSLR Camera">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Photography</a>
                                <a href="#!" class="d-block h4">Professional DSLR <br> Camera</a>
                                <del class="me-2 fs-5">₹45,000.00</del>
                                <span class="text-primary fs-5">₹42,500.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/camera-lens.png" class="img-fluid w-100 h-100" alt="Camera Lens">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Photography</a>
                                <a href="#!" class="d-block h4">Telephoto Lens <br> 70-200mm</a>
                                <del class="me-2 fs-5">₹28,500.00</del>
                                <span class="text-primary fs-5">₹25,000.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/tripod.png" class="img-fluid w-100 h-100" alt="Camera Tripod">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Photography</a>
                                <a href="#!" class="d-block h4">Professional Tripod <br> Aluminum</a>
                                <del class="me-2 fs-5">₹8,500.00</del>
                                <span class="text-primary fs-5">₹7,200.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/camera-bag.png" class="img-fluid w-100 h-100" alt="Camera Bag">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Photography</a>
                                <a href="#!" class="d-block h4">Camera Bag <br> Waterproof</a>
                                <del class="me-2 fs-5">₹4,200.00</del>
                                <span class="text-primary fs-5">₹3,500.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Silent Parrot Products -->
            <div class="productImg-carousel owl-carousel productList-item">
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/parrot-toy.png" class="img-fluid w-100 h-100" alt="Parrot Toy">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Pet Accessories</a>
                                <a href="#!" class="d-block h4">Interactive Parrot <br> Toy Set</a>
                                <del class="me-2 fs-5">₹1,850.00</del>
                                <span class="text-primary fs-5">₹1,550.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/bird-cage.png" class="img-fluid w-100 h-100" alt="Bird Cage">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Pet Accessories</a>
                                <a href="#!" class="d-block h4">Large Bird Cage <br> With Stand</a>
                                <del class="me-2 fs-5">₹6,500.00</del>
                                <span class="text-primary fs-5">₹5,800.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/bird-food.png" class="img-fluid w-100 h-100" alt="Bird Food">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Pet Accessories</a>
                                <a href="#!" class="d-block h4">Premium Bird Food <br> 5kg Pack</a>
                                <del class="me-2 fs-5">₹1,200.00</del>
                                <span class="text-primary fs-5">₹950.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/bird-perch.png" class="img-fluid w-100 h-100" alt="Bird Perch">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Pet Accessories</a>
                                <a href="#!" class="d-block h4">Natural Wood <br> Bird Perch</a>
                                <del class="me-2 fs-5">₹850.00</del>
                                <span class="text-primary fs-5">₹650.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gold Coins -->
            <div class="productImg-carousel owl-carousel productList-item">
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/gold-coin-1g.png" class="img-fluid w-100 h-100" alt="1g Gold Coin">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Gold Investment</a>
                                <a href="#!" class="d-block h4">24K Gold Coin <br> 1 Gram</a>
                                <del class="me-2 fs-5">₹6,800.00</del>
                                <span class="text-primary fs-5">₹6,500.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/gold-coin-5g.png" class="img-fluid w-100 h-100" alt="5g Gold Coin">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Gold Investment</a>
                                <a href="#!" class="d-block h4">24K Gold Coin <br> 5 Grams</a>
                                <del class="me-2 fs-5">₹32,500.00</del>
                                <span class="text-primary fs-5">₹31,000.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/gold-coin-10g.png" class="img-fluid w-100 h-100" alt="10g Gold Coin">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Gold Investment</a>
                                <a href="#!" class="d-block h4">24K Gold Coin <br> 10 Grams</a>
                                <del class="me-2 fs-5">₹65,000.00</del>
                                <span class="text-primary fs-5">₹62,000.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/gold-bar.png" class="img-fluid w-100 h-100" alt="Gold Bar">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Gold Investment</a>
                                <a href="#!" class="d-block h4">24K Gold Bar <br> 20 Grams</a>
                                <del class="me-2 fs-5">₹1,25,000.00</del>
                                <span class="text-primary fs-5">₹1,20,000.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product List End -->

    <!-- Bestseller Products Start -->
<div class="container-fluid products pb-5">
    <div class="container products-mini py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 700px;">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                data-wow-delay="0.1s">Bestseller Products</h4>
            <p class="mb-0 wow fadeInUp" data-wow-delay="0.2s">Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Modi, asperiores ducimus sint quos tempore officia similique quia? Libero, pariatur
                consectetur?
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/product-3.png" class="img-fluid w-100 h-100" alt="Image">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Camera</a>
                                <a href="#!" class="d-block h4">Canon EOS R6 Mark II <br> 24-105 STM Kit</a>
                                <del class="me-2 fs-5">₹1,250.00</del>
                                <span class="text-primary fs-5">₹1,050.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/laya filter cofee.jpeg" class="img-fluid w-100 h-100" alt="Image">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Coffee</a>
                                <a href="#!" class="d-block h4">Layaa Filter Coffee Powder <br> 200g Packet</a>
                                <del class="me-2 fs-5">₹1,250.00</del>
                                <span class="text-primary fs-5">₹1,050.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <img src="assest/img/1gram.jpeg" class="img-fluid w-100 h-100" alt="Image">
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="#!"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="#!" class="d-block mb-2">Gold Coin</a>
                                <a href="#!" class="d-block h4">24K 999.9 Gold Coin <br> 1 Gram</a>
                                <del class="me-2 fs-5">₹1,250.00</del>
                                <span class="text-primary fs-5">₹1,050.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#!" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i
                                        class="fas fa-random"></i></i></a>
                            <a href="#!"
                                class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repeat your other cards if needed, updating only product names as above -->
        </div>
    </div>
</div>



    <!-- Footer & Newsletter Section -->
  <section class="footer-section">
    <div class="container">
      <div class="row g-4">
        <!-- Brand and Info -->
        <div class="col-lg-4 col-md-6 footer-brand">
          <div class="d-flex align-items-center mb-3">
            <div class="bg-white border rounded p-2 me-2">
              <span class="fs-2 fw-bold">E</span>
            </div>
            <span class="fs-2 fw-bold">Shopper</span>
          </div>
          <p>
            Dolore erat dolor sit lorem vero amet.<br />
            Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.
          </p>
          <ul class="list-unstyled mb-0">
            <li><i class="bi bi-geo-alt"></i>123 Street, New York, USA</li>
            <li><i class="bi bi-envelope"></i>info@example.com</li>
            <li><i class="bi bi-telephone"></i>+012 345 67890</li>
          </ul>
        </div>
        <!-- Quick Links #1 -->
        <div class="col-lg-2 col-md-6 footer-links">
          <h5>Quick Links</h5>
          <ul>
            <li><i class="bi bi-chevron-right"></i>Home</li>
            <li><i class="bi bi-chevron-right"></i>Our Shop</li>
            <li><i class="bi bi-chevron-right"></i><a href="#" class="text-dark text-decoration-underline">Shop Detail</a></li>
            <li><i class="bi bi-chevron-right"></i>Shopping Cart</li>
            <li><i class="bi bi-chevron-right"></i>Checkout</li>
            <li><i class="bi bi-chevron-right"></i>Contact Us</li>
          </ul>
        </div>
        <!-- Quick Links #2 -->
        <div class="col-lg-2 col-md-6 footer-links">
          <h5>Quick Links</h5>
          <ul>
            <li><i class="bi bi-chevron-right"></i>Home</li>
            <li><i class="bi bi-chevron-right"></i>Our Shop</li>
            <li><i class="bi bi-chevron-right"></i>Shop Detail</li>
            <li><i class="bi bi-chevron-right"></i>Shopping Cart</li>
            <li><i class="bi bi-chevron-right"></i>Checkout</li>
            <li><i class="bi bi-chevron-right"></i>Contact Us</li>
          </ul>
        </div>
        <!-- Newsletter Form -->
        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h5>Newsletter</h5>
          <form>
            <input type="text" class="form-control form-control-lg mb-3" placeholder="Your Name" />
            <input type="email" class="form-control form-control-lg mb-3" placeholder="Your Email" />
            <button type="submit" class="btn w-100 py-2">Subscribe Now</button>
          </form>
        </div>
      </div>
    </div>
  </section>


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-white"><a href="#!" class="border-bottom text-white"><i
                                class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-white">

                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">HTML Codex</a>.
                    Distributed By <a class="border-bottom text-white" href="https://themewagon.com"
                        target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#!" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="./assest/js/main.js"></script>
      <Script>
  document.addEventListener("DOMContentLoaded", function () {
  // -------------------- Cart Functionality --------------------
  const cart = {
    items: JSON.parse(localStorage.getItem('cart')) || [],
    save() { 
      localStorage.setItem('cart', JSON.stringify(this.items)); 
      this.updateUI(); 
    },
    addItem(product) {
      const existing = this.items.find(i => i.id === product.id);
      if(existing){ existing.quantity += 1; } 
      else { this.items.push({...product, quantity:1}); }
      this.save();
    },
    calculateTotals(){
      const subtotal = this.items.reduce((s,i) => s + i.price * i.quantity, 0);
      const shipping = subtotal > 0 ? 20 : 0;
      const tax = subtotal * 0.08;
      const total = subtotal + shipping + tax;
      return {
        subtotal: subtotal.toFixed(2), 
        shipping: shipping.toFixed(2), 
        tax: tax.toFixed(2), 
        total: total.toFixed(2)
      };
    },
    updateUI(){
      const count = this.items.reduce((s,i) => s + i.quantity, 0);
      const cartCountEl = document.getElementById('header-cart-count');
      const totalEl = document.getElementById('header-total');
      if(cartCountEl) cartCountEl.textContent = count;
      if(totalEl) totalEl.textContent = this.calculateTotals().total;
    }
  };

  // Add to cart buttons
  document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const product = {
        id: btn.dataset.id,
        name: btn.dataset.name,
        price: parseFloat(btn.dataset.price),
        image: btn.dataset.image
      };
      cart.addItem(product);

      // Show toast
      const toast = document.createElement('div');
      toast.className = 'toast toast-visible';
      toast.textContent = 'Added to cart!';
      document.body.appendChild(toast);
      setTimeout(() => toast.remove(), 3000);
    });
  });

  cart.updateUI();

  // -------------------- Filtering --------------------
  const applyBtn = document.getElementById("apply-Filters");
  const resetBtn = document.getElementById("reset-Filters");
  const products = document.querySelectorAll(".product-item");

  const categoryCheckboxes = document.querySelectorAll(".category-filter-check");
  const brandCheckboxes = document.querySelectorAll(".brand-filter");
  const ratingCheckboxes = document.querySelectorAll(".rating-filter");
  const priceRange = document.getElementById("priceRange");
  const priceRangeValue = document.getElementById("priceRangeValue");

  // Price range label update
  priceRange.addEventListener("input", () => {
    priceRangeValue.textContent = `₹${priceRange.value}`;
  });

  function filterProducts() {
    const selectedCategories = Array.from(categoryCheckboxes).filter(c => c.checked).map(c => c.value);
    const selectedBrands = Array.from(brandCheckboxes).filter(c => c.checked).map(c => c.value);
    const selectedRatings = Array.from(ratingCheckboxes).filter(c => c.checked).map(c => parseFloat(c.value));
    const maxPrice = parseFloat(priceRange.value);

    products.forEach(product => {
      const category = product.dataset.category;
      const price = parseFloat(product.dataset.price);
      const rating = parseFloat(product.dataset.rating);
      const brand = product.dataset.brand || "";

      const matchCategory = selectedCategories.length === 0 || selectedCategories.includes(category);
      const matchBrand = selectedBrands.length === 0 || selectedBrands.includes(brand);
      const matchRating = selectedRatings.length === 0 || selectedRatings.some(r => rating >= r);
      const matchPrice = price <= maxPrice;

      product.style.display = (matchCategory && matchBrand && matchRating && matchPrice) ? "block" : "none";
    });

    // Update results count
    const visibleCount = document.querySelectorAll(".product-item[style*='display: block']").length;
    document.getElementById("showing-count").textContent = `1-${visibleCount}`;
    document.getElementById("total-count").textContent = visibleCount;
  }

  if(applyBtn) applyBtn.addEventListener("click", filterProducts);

  if(resetBtn) resetBtn.addEventListener("click", () => {
    [...categoryCheckboxes, ...brandCheckboxes, ...ratingCheckboxes].forEach(c => c.checked = true);
    priceRange.value = priceRange.max;
    priceRangeValue.textContent = `₹${priceRange.max}`;
    products.forEach(p => p.style.display = "block");

    document.getElementById("showing-count").textContent = `1-${products.length}`;
    document.getElementById("total-count").textContent = products.length;
  });

  // -------------------- Sorting --------------------
  const sortSelect = document.getElementById('sortSelect');
  const productsContainer = document.getElementById('products-container');

  if(sortSelect){
    sortSelect.addEventListener('change', function() {
      const sortBy = this.value;
      const productArr = Array.from(products);

      if(sortBy === 'price-low') productArr.sort((a,b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
      else if(sortBy === 'price-high') productArr.sort((a,b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
      else if(sortBy === 'rating') productArr.sort((a,b) => parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating));
      else if(sortBy === 'newest') productArr.reverse();

      productArr.forEach(p => productsContainer.appendChild(p));
    });
  }
});
</Script>
</body>

</html>