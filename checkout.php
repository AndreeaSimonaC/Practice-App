<?php
session_start();

// Check if the cart is set in the session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo 'No products in the cart.';
} else {
    // Display the products in the cart
    foreach ($_SESSION['cart'] as $product) {
        $productTitle = $product['product_title'];
        $productPrice = $product['product_price'];
?>
        <div>
            <h2><?= $productTitle ?></h2>
            <p>Price: $<?= $productPrice ?></p>
        </div>
<?php
    }
}

?>

<form method="post" action="checkout.php">
    <label for="email">Enter your email address:</label>
    <input type="email" id="email" name="email" required>
    <input type="submit" name="finalize-order" value="Finalize Order">
</form>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {

    header("Location: finalize_order.php");
    exit();
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>



</body>

</html>