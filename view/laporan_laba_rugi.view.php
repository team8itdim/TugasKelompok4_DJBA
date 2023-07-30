<?php
include "../connection.php";
include "../model/product.model.php";
include "../controller/product.controller.php";
include "product/product.view.php";

$products = new ProductView();
$allProducts = $products->getProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Profit and Loss Dashboard</title>
</head>

<body>
   <h1>Profit and Loss Dashboard</h1>

   <!-- Table to display product information -->
   <table border="1">
      <tr>
         <th>Product Name</th>
         <th>Stock</th>
         <th>Price</th>
         <th>Cost</th>
         <th>Profit or Loss</th>
      </tr>
      <?php
      $totalProfitLoss = 0;
      foreach ($allProducts as $product) {
         $profitLoss = ($product['price'] - $product['cost']) * $product['stock'];
         $totalProfitLoss += $profitLoss; ?>
         <tr>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['stock']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['cost']; ?></td>
            <td><?php echo $profitLoss; ?></td>
         </tr>
      <?php } ?>
   </table>

   <h2>Total Profit or Loss: <?php echo $totalProfitLoss; ?></h2>
</body>

</html>