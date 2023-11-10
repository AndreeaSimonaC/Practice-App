<?php
include_once 'dbconnection.php';

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) 
{
    // Loop through the products and display them
    foreach ($results as $product) 
    {
        $productTitle = $product['product_title'];
        $productDescription = $product['product_description'];
        $productPrice = $product['product_price'];
?>
        <div>
            <h2><?= $productTitle ?></h2>
            <p><?= $productDescription ?></p>
            <p>Price: $<?= $productPrice ?></p>

            <!-- Add to Cart form -->
            <form method="post" action="cart.php">
                <input type="hidden" name="add-to-cart" value="1">
                <input type="hidden" name="product_title" value="<?= $productTitle ?>">
                <input type="hidden" name="product_description" value="<?= $productDescription ?>">
                <input type="hidden" name="product_price" value="<?= $productPrice ?>">
                <input type="submit" value="Add to Cart">
            </form>
        </div>
<?php
    }
} else 
{
    echo 'No products available.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>

<body>
<a href="index.php">Go to Index</a>

</body>

</html>