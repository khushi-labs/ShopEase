<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .product-container {
        max-width: 800px;
        margin: 50px auto;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        border-radius: 10px;
        background: #fff;
    }
    .product-image {
        max-width: 30%;
        height: auto;
        border-radius: 8px;
    }
    .product-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .product-price {
        color: #28a745;
        font-size: 1.5rem;
        margin-top: 20px;
    }
    .back-btn {
        margin-top: 30px;
    }
</style>

<div class="container product-container">
    <div class="text-center">
        <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image mb-4">
    </div>
    <h2 class="product-title text-center"><?php echo htmlspecialchars($product['name']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
    <p class="product-price">Price: ₹<?php echo number_format($product['price'], 2); ?></p>

    <div class="text-center back-btn">
        <a href="index.php" class="btn btn-outline-primary">Back to Products</a>
    </div>
</div>

<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
