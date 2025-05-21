<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopEase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #3a86ff;
      --secondary-color: #8338ec;
      --accent-color: #ff006e;
      --light-color: #f8f9fa;
      --dark-color: #212529;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--dark-color);
      background-color: #f8f9fa;
      padding-top: 76px;
    }
    
    .navbar {
      background-color: white !important;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 15px 0;
    }
    
    .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--primary-color) !important;
    }
    
    .nav-link {
      font-weight: 500;
      color: var(--dark-color) !important;
      margin: 0 5px;
      transition: all 0.3s ease;
    }
    
    .nav-link:hover {
      color: var(--primary-color) !important;
      transform: translateY(-2px);
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .btn-success {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }
    
    .btn-primary:hover, .btn-success:hover {
      filter: brightness(110%);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    
    .card {
      border: none;
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
    
    .hero-section {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 80px 0;
      margin-bottom: 30px;
      border-radius: 15px;
    }
    
    .hero-title {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }
    
    .price {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--primary-color);
    }
    
    .cart-badge {
      position: relative;
    }
    
    .cart-count {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: var(--accent-color);
      color: white;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      font-size: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .footer {
      background-color: var(--dark-color);
      color: white;
      padding: 40px 0 20px;
      margin-top: 60px;
    }
    
    /* Page-specific styles */
    .product-detail-img {
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">ShopEase</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
          <li class="nav-item">
            <a class="nav-link cart-badge" href="cart.php">
              <i class="fas fa-shopping-cart"></i>
              <span class="cart-count" id="cartCount">0</span>
            </a>
          </li>
          <?php if (isset($_SESSION['user'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i> <?php echo $_SESSION['user']['name']; ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">My Profile</a></li>
                <li><a class="dropdown-item" href="#">My Orders</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            <li class="nav-item"><a class="nav-link" href="register.php"><i class="fas fa-user-plus"></i> Register</a></li>
          <?php endif; ?>
          <li class="nav-item">
          <a class="nav-link" href="admin/admin_login.php"><i class="fas fa-user-shield me-1"></i>Admin Login</a>
            </li>

        </ul>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

          </body>