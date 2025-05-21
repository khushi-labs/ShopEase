
<?php
session_start(); 
include 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found.";
    }
}
include 'includes/header.php'; 

?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow border-0">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <i class="fas fa-user-circle text-primary" style="font-size: 3rem;"></i>
            <h3 class="mt-3">Welcome Back</h3>
            <p class="text-muted">Sign in to your account to continue</p>
          </div>
          
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              <div><?= $error ?></div>
            </div>
          <?php endif; ?>
          
          <form method="post" class="needs-validation" novalidate>
            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-envelope me-2"></i>Email Address
              </label>
              <input type="email" name="email" class="form-control form-control-lg" required>
              <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            
            <div class="mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <label class="form-label">
                  <i class="fas fa-lock me-2"></i>Password
              </div>
              <input type="password" name="password" class="form-control form-control-lg" required>
              <div class="invalid-feedback">Please enter your password.</div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
              <i class="fas fa-sign-in-alt me-2"></i>Login
            </button>
          </form>
          
          <div class="text-center">
            <p class="mt-4 mb-0">Don't have an account yet? <a href="register.php" class="text-decoration-none">Create an account</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    'use strict';
    
    var forms = document.querySelectorAll('.needs-validation');
    
    Array.prototype.slice.call(forms).forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>

</body>
</html>