<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Edit</title>
</head>

<body>

  <?php
  include_once("dbconnection.php");
  session_start();

  $productTitle = $productDescription = $productPrice = '';
  $productId = isset($_GET['product_id']) ? $_GET['product_id'] : null;

 if ($_SERVER['REQUEST_METHOD'] == 'POST' && $productId !== null) {
      //edit exiting product with the product_id selected from admin.php page
      $productTitle = $_POST['product_title'] ?? '';
      $productDescription = $_POST['product_description'] ?? '';
      $productPrice = $_POST['product_price'] ?? '';

      //update product in db
      $sql = "UPDATE products SET product_title=?, product_description=?, product_price=? WHERE product_id=?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$productTitle, $productDescription, $productPrice, $productId]);
      header("Location: admin.php");
      // echo "Product updated successfully";
    } 
  
  if ($_SERVER['REQUEST_METHOD'] == "GET" && $productId !== null) 
  {
      //fetch product data for editing
      $sql = "SELECT * FROM products WHERE product_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$productId]);
      $productData = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($productData) 
      {
        $productTitle = $productData['product_title'];
        $productDescription = $productData['product_description'];
        $productPrice = $productData['product_price'];
      }
    }
  ?>
  <!-- Display the form with the product data for editing -->

  <form action="admin_edit.php<?php if (isset($productId)) echo '?product_id=' . $productId; ?>" method="POST" enctype="multipart/form-data">
    <div class="add-products-container">

      <label for="title">Title:</label><br>
      <input type="text" name="product_title" value="<?php echo $productTitle ?? ''; ?>" required><br>

      <label for="description">Description:</label><br>
      <textarea name="product_description" required><?php echo $productDescription ?? ''; ?></textarea><br>

      <label for="price">Price:</label><br>
      <input type="number" name="product_price" step="0.01" value="<?php echo $productPrice ?? ''; ?>" required><br>

    </div>

    <input type="submit" value="Update Product" name="submit-edit-product">
  </form>

</body>

</html>