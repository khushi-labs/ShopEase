<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<h2>All Products</h2>
<div class="container my-4">
  <div class="row">
    <?php
    $result = $conn->query("SELECT * FROM products");
    while ($row = $result->fetch_assoc()) {
      echo "
      <div class='col-md-4 mb-4'>
        <div class='card h-100'>
          <img src='images/{$row['image']}' class='card-img-top' alt='{$row['name']}'>
          <div class='card-body'>
            <h5 class='card-title'>{$row['name']}</h5>
            <p class='card-text'>Price: ₹{$row['price']}</p>
            <a href='product.php?id={$row['id']}' class='btn btn-primary'>View</a>
          </div>
        </div>
      </div>";
    }
    ?>
  </div>
</div>

</body>
</html>
