<?php include 'includes/header.php'; ?>

<div class="container mt-5">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card shadow">
        <div class="card-header bg-white">
          <h2 class="card-title mb-0 text-center">
            <i class="fas fa-shopping-cart text-primary me-2"></i>Your Shopping Cart
          </h2>
        </div>
        <div class="card-body">
          <div id="cart" class="table-responsive">
            <div class="text-center py-5" id="emptyCart">
              <i class="fas fa-shopping-basket text-muted" style="font-size: 5rem;"></i>
              <p class="lead mt-3">Your cart is empty</p>
              <a href="shop.php" class="btn btn-primary mt-3">Continue Shopping</a>
            </div>
            
            <div id="cartContent" style="display: none;">
              <table class="table align-middle">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="cartItems">
                </tbody>
              </table>
              
              <div class="d-flex justify-content-between mt-4">
                <a href="shop.php" class="btn btn-outline-primary">
                  <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                </a>
                <div>
                  <h4 class="text-end mb-3">Subtotal: <span id="cartTotal" class="fw-bold text-primary">₹0.00</span></h4>
                    <button class="btn btn-secondary" disabled>
                    <i class="fas fa-credit-card me-2"></i>Checkout (Coming Soon)
                    </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    updateCartDisplay(cart);
    
    document.getElementById('cartCount').textContent = cart.length;
  });
  
  function updateCartDisplay(cart) {
    const emptyCart = document.getElementById('emptyCart');
    const cartContent = document.getElementById('cartContent');
    const cartItems = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');
    
    if (cart.length === 0) {
      emptyCart.style.display = 'block';
      cartContent.style.display = 'none';
      return;
    }
    
    emptyCart.style.display = 'none';
    cartContent.style.display = 'block';
    
    cartItems.innerHTML = '';
    
    let total = 0;
    
    cart.forEach(item => {
      const itemTotal = item.price * item.quantity;
      total += itemTotal;
      
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>
          <div class="d-flex align-items-center">
            <img src="${item.image}" alt="${item.name}" class="img-fluid rounded" style="max-width: 60px;">
            <div class="ms-3">
              <h6 class="mb-0">${item.name}</h6>
            </div>
          </div>
        </td>
        <td>₹${item.price.toFixed(2)}</td>
        <td>
          <div class="input-group" style="max-width: 120px;">
            <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
            <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
            <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
          </div>
        </td>
        <td>₹${itemTotal.toFixed(2)}</td>
        <td>
          <button class="btn btn-sm btn-danger" onclick="removeFromCart(${item.id})">
            <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      `;
      
      cartItems.appendChild(tr);
    });
    
    cartTotal.textContent = '₹' + total.toFixed(2);
  }
  
  function updateQuantity(productId, newQuantity) {
    if (newQuantity < 1) return;
    
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const index = cart.findIndex(item => item.id === productId);
    
    if (index !== -1) {
      cart[index].quantity = newQuantity;
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartDisplay(cart);
    }
  }
  
  function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.id !== productId);
    localStorage.setItem('cart', JSON.stringify(cart));
    
    document.getElementById('cartCount').textContent = cart.length;
    
    updateCartDisplay(cart);
  }
</script>

</body>
</html>