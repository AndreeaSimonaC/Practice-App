<?php
include_once 'dbconnection.php';
session_start();

//check if form was submitted with post method and name add-to-cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-to-cart'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productTitle = $_POST['product_title'];
    $productDescription =  $_POST['product_description'];
    $productPrice =  $_POST['product_price'];

    // Add the product to the cart array
    $_SESSION['cart'][] = [
        'product_title' => $productTitle,
        'product_description' => $productDescription,
        'product_price' => $productPrice
    ];
} else {
    echo 'Missing product details in form submission.';
}

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    // Loop through the products and display them
    foreach ($_SESSION['cart'] as $key => $row) {
        $productTitle = $row['product_title'];
        $productDescription = $row['product_description'];
        $productPrice = $row['product_price'];

?>
        <div>
            <h2><?= $productTitle ?></h2>
            <p><?= $productDescription ?></p>
            <p>Price: $<?= $productPrice ?></p>
            <form method="post" action="cart.php">
                <input type="hidden" name="remove-from-cart" value="<?= $key ?>">
                <input type="submit" value="Remove">
            </form>

        </div>
<?php

    }
//check if remove-from-cart form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove-from-cart'])) {
    $productToRemove = $_POST['remove-from-cart'];
    if (isset($_SESSION['cart'][$productToRemove])) {
        unset($_SESSION['cart'][$productToRemove]);
        // Re-index the array to prevent gaps in the keys
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}



} else {
    echo 'No products available.';
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>
    <h3>Items added to cart:</h3>


    <a href="shop.php">Continue Shopping</a>
    <a href="checkout.php">Checkout</a>


</body>

</html>