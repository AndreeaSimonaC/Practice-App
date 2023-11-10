<?php
include_once 'dbconnection.php';

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) 
{
    // Loop through the products and display them
    foreach ($results as $row) 
    {
        $productId = $row['product_id'];
        $productTitle = $row['product_title'];
        $productDescription = $row['product_description'];
        $productPrice = $row['product_price'];
?>
        <div>
            <h2><?= $productTitle ?></h2>
            <p><?= $productDescription ?></p>
            <p>Price: $<?= $productPrice ?></p>
            
            <form method="GET" action="admin_edit.php" name="admin-edit">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="submit" name="edit" value="Edit product">
            </form>
            <form method="post" action="admin.php" name="admin-delete">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="submit" name="delete" value="Delete product">
            </form>
        </div>


<?php
    }
} else 
{
    echo 'No products available.';
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) 
{
    $productId = $_POST['product_id'];

    // Delete the product from the database
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$productId]);
}  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products</title>
</head>

<body>
    <form method="post" action="admin_add.php" name="admin-add">
        <input type="submit" name="add" value="Add new product">
    </form>

    <a href="index.php">Go to Index</a>

</body>

</html>