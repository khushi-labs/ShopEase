<?php
session_start();
include 'includes/db.php'; 

include 'includes/header.php'; 
?>

<div class="container mt-4">
  <?php if(isset($_SESSION['user'])) { ?>
  <div class="alert alert-success">
    <h4>Welcome back, <?php echo htmlspecialchars($_SESSION['user']['name'] ?? $_SESSION['user']['email']); ?>!</h4>
  </div>
  <?php } ?>

  <div class="hero-section text-center">
    <div class="container py-5">
      <h1 class="display-4 fw-bold">Welcome to ShopEase</h1>
      <p class="lead fs-4 mb-4">Discover amazing products with unbeatable prices and quality</p>
      <a href="shop.php" class="btn btn-light btn-lg px-5 py-3">
        <i class="fas fa-shopping-bag me-2"></i>Start Shopping
      </a>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-12 text-center">
      <h2 class="fw-bold mb-4">Featured Products</h2>
    </div>
  </div>

  <div class="row">
    <?php
    $result = $conn->query("SELECT * FROM products ORDER BY id DESC LIMIT 3");
    
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "
        <div class='col-md-4 mb-4'>
          <div class='card h-100'>
            <img src='images/{$row['image']}' class='card-img-top' alt='{$row['name']}' style='height: 240px; object-fit: cover;'>
            <div class='card-body d-flex flex-column'>
              <h5 class='card-title'>{$row['name']}</h5>
              <p class='price mb-3'>₹{$row['price']}</p>
              <div class='mt-auto d-flex justify-content-between'>
                <a href='product.php?id={$row['id']}' class='btn btn-primary'>
                  <i class='fas fa-eye me-2'></i>View Details
                </a>
                <button onclick='addToCart({$row['id']}, \"{$row['name']}\", {$row['price']}, \"images/{$row['image']}\")' 
                class='btn btn-outline-primary'>
                <i class='fas fa-cart-plus'></i>
                </button>
              </div>
            </div>
          </div>
        </div>";
  }
?>
<div class="row mt-4 mb-5">
  <div class="col-12 text-center">
    <a href="shop.php" class="btn btn-primary btn-lg">
      <i class="fas fa-store me-2"></i>View More Products
    </a>
  </div>
</div>
<?php
} else {
      echo "<div class='col-12 text-center'><p>No products available yet or database connection issue.</p></div>";
    }
    ?>
  </div>

  <div class="row mt-5">
    <div class="col-md-4 mb-4">
      <div class="card text-center h-100 p-4">
        <div class="py-3">
          <i class="fas fa-truck text-primary" style="font-size: 3rem;"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">Fast Delivery</h5>
          <p class="card-text">Free shipping on all orders over $50</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card text-center h-100 p-4">
        <div class="py-3">
          <i class="fas fa-undo text-primary" style="font-size: 3rem;"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">Easy Returns</h5>
          <p class="card-text">30-day money-back guarantee</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card text-center h-100 p-4">
        <div class="py-3">
          <i class="fas fa-headset text-primary" style="font-size: 3rem;"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">24/7 Support</h5>
          <p class="card-text">Dedicated customer service team</p>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="footer mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>ShopEase</h5>
        <p>We offer the best products at competitive prices with excellent customer service.</p>
      </div>
      <div class="col-md-3">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="text-white">Home</a></li>
          <li><a href="shop.php" class="text-white">Shop</a></li>
          <li><a href="cart.php" class="text-white">Cart</a></li>
          <li><a href="contact.php" class="text-white">Contact</a></li>
        </ul>
      </div>
      <div class="col-md-5">
        <h5>Subscribe to our Newsletter</h5>
        <form class="d-flex">
          <input type="email" class="form-control me-2" placeholder="Your email">
          <button class="btn btn-primary">Subscribe</button>
        </form>
      </div>
    </div>
    <hr class="text-white-50">
    <div class="text-center">
      <p>&copy; 2025 ShopEase. All rights reserved.</p>
    </div>
  </div>
</footer>

<script>
  if (!localStorage.getItem('cart')) {
    localStorage.setItem('cart', JSON.stringify([]));
  }
  
  document.addEventListener('DOMContentLoaded', function() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    document.getElementById('cartCount').textContent = cart.length;
  });
  
  function addToCart(productId, name, price, image) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    const existingProductIndex = cart.findIndex(item => item.id === productId);
    
    if (existingProductIndex !== -1) {
      cart[existingProductIndex].quantity += 1;
      window.alert('Product quantity updated in cart!');
    } else {
      cart.push({
        id: productId,
        name: name,
        price: price,
        image: image,
        quantity: 1
      });
      window.alert('Product added to cart!');
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    
    updateCartCount();
  }
  
  function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    document.getElementById('cartCount').textContent = totalItems;
  }
</script>