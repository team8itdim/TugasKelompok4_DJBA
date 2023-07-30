<?php
include "../../connection.php";
include "../../model/product.model.php";
include "../../controller/product.controller.php";
include "product.view.php";

$products = new ProductView();

// check if the product id is set in the URL
if (!isset($_GET['id'])) {
   die("No product id provided.");
}

// sanitize the product id
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// fetch the product data
$product = $products->getProductBy($id);

// handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // sanitize input data
   $name = filter_input(INPUT_POST, 'name');
   $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $cost = filter_input(INPUT_POST, 'cost', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

   // check data validity
   if ($name && $stock && $price && $cost) {
      $productData = [
         'id' => $id,
         'name' => $name,
         'stock' => $stock,
         'price' => $price,
         'cost' => $cost
      ];

      // update the product
      $message = $products->editProduct($productData);
   } else {
      $message = "Invalid data provided.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Edit Product</title>
</head>

<body>
   <h1>Edit Product</h1>

   <?php if (isset($message)) echo "<p>$message</p>"; ?>

   <form action="" method="post">
      <label for="name">Product Name:</label>
      <input type="text" name="name" required value="<?php echo $product['name']; ?>">
      <br>
      <label for="stock">Stock:</label>
      <input type="number" name="stock" step="0.01" required value="<?php echo $product['stock']; ?>">
      <br>
      <label for="price">Price:</label>
      <input type="number" name="price" step="0.01" required value="<?php echo $product['price']; ?>">
      <br>
      <label for="cost">Cost:</label>
      <input type="number" name="cost" step="0.01" required value="<?php echo $product['cost']; ?>">
      <br>
      <input type="submit" name="edit" value="Update Product">
   </form>

   <a href="../../index.php">Back to Product List</a>

</body>

</html>