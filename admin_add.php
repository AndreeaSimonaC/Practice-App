<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Add</title>
</head>

<body>
<form action="admin_add.php" method="POST" enctype="multipart/form-data">
    <div class="add-products-container">
      <div class="add-product-details">
        <label for="title">Title:</label><br>
        <input type="text" name="product_title" value="" required><br>

        <label for="description">Description:</label><br>
        <textarea name="product_description" required></textarea><br>

        <label for="price">Price:</label><br>
        <input type="number" name="product_price" step="0.01" value="" required><br>

      </div>
    </div>
    <input type="submit" value="Add product" class="save-product" name="submit-edit-add-product">
  </form>
</body>

</html>

<?php
include_once 'dbconnection.php';
session_start();

  $productTitle = $productDescription = $productPrice = '';
  $productId = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
        //add a new product
        $productTitle = isset($_POST['product_title']) ? $_POST['product_title'] : '';
        $productDescription = isset($_POST['product_description']) ? $_POST['product_description'] : '';
        $productPrice = isset($_POST['product_price']) ? $_POST['product_price'] : '';
  
        //insert new product into db
        $sql = "INSERT INTO products (product_title, product_description, product_price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$productTitle, $productDescription, $productPrice]);
    
        header("Location: admin.php");
        exit();
    }       
  ?>