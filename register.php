<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    if ($stmt->execute()) {
        $success = "Registered successfully. <a href='login.php' class='text-decoration-none fw-bold'>Login</a>";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow border-0">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <i class="fas fa-user-plus text-success" style="font-size: 3rem;"></i>
            <h3 class="mt-3">Create Account</h3>
            <p class="text-muted">Join us by creating a new account</p>
          </div>
          
          <?php if (!empty($success)): ?>
            <div class="alert alert-success d-flex align-items-center" role="alert">
              <i class="fas fa-check-circle me-2"></i>
              <div><?= $success ?></div>
            </div>
          <?php elseif (!empty($error)): ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              <div><?= $error ?></div>
            </div>
          <?php endif; ?>
          
          <form method="post" class="needs-validation" novalidate>
            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-user me-2"></i>Full Name
              </label>
              <input type="text" name="name" class="form-control form-control-lg" required>
              <div class="invalid-feedback">Please enter your name.</div>
            </div>
            
            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-envelope me-2"></i>Email Address
              </label>
              <input type="email" name="email" class="form-control form-control-lg" required>
              <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            
            <div class="mb-4">
              <label class="form-label">
                <i class="fas fa-lock me-2"></i>Password
              </label>
              <input type="password" name="password" class="form-control form-control-lg" required>
              <div class="invalid-feedback">Please create a password.</div>
              <div class="form-text small mt-1"><i class="fas fa-info-circle me-1"></i>Password must be at least 8 characters long.</div>
            </div>
            
            <div class="mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms" required>
                <label class="form-check-label" for="terms">
                  I agree to the <a href="terms.php" class="text-decoration-none">Terms of Service</a> and <a href="privacy.php" class="text-decoration-none">Privacy Policy</a>
                </label>
                <div class="invalid-feedback">You must agree before submitting.</div>
              </div>
            </div>
            
            <button type="submit" class="btn btn-success btn-lg w-100 mb-3">
              <i class="fas fa-user-plus me-2"></i>Register
            </button>
          </form>
          
          <div class="text-center">
            <p class="mt-4 mb-0">Already have an account? <a href="login.php" class="text-decoration-none">Sign in</a></p>
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