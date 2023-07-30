<?php
include "connection.php";
include "./model/product.model.php";
include "./controller/product.controller.php";
include "view/product/product.view.php";
$products = new ProductView();
$messageAdd = $products->handleAddProductForm();
$messageDelete = $products->handleDeleteProduct();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product Management</title>
</head>

<body>
    <h1>Product Management</h1>

    <?php if (isset($messageAdd)) echo "<p>$messageAdd</p>"; ?>

    <?php if (isset($messageDelete)) echo "<p>$messageDelete</p>"; ?>

    <h2>Add New Product</h2>
    <form action="" method="post">
        <label for="name">Product Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" step="0.01" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>
        <br>
        <label for="cost">Cost:</label>
        <input type="number" name="cost" step="0.01" required>
        <br>
        <input type="submit" name="add" value="Add Product">
    </form>

    <h2>Product List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Cost</th>
            <th>Action</th>
        </tr>
        <?php $products->show() ?>
    </table>

    <!-- Button to redirect to the Profit and Loss Report -->
    <button onclick="window.location.href='view/laporan_laba_rugi.view.php';">Go to Profit and Loss Report</button>
</body>

</html>