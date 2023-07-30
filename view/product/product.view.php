<?php
class ProductView extends ProductController
{
    public function show()
    {
        $products = $this->getProducts();
        if (is_array($products)) {
            foreach ($products as $product) { ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['stock']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['cost']; ?></td>
                    <td>
                        <a href="view/product/edit.view.php?id=<?php echo $product['id']; ?>">Edit</a>
                        <a href="?delete=<?php echo $product['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php
            }
        } else {
            echo "No products available.";
        }
    }

    public function find()
    {
        $detailProduct = $this->getProductBy(); // call function controller product
        if (empty($detailProduct))
            return;
        foreach ($detailProduct as $detail) {   ?>
            <div>
                <h3> <?php echo $detail['name']; ?></h3>
                <p>harga: Rp. <?php echo $detail['price']; ?></p>
                <p>stok: <?php echo $detail['stock']; ?></p>
            </div>
<?php
        }
    }

    public function handleAddProductForm()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = filter_input(INPUT_POST, 'name');
            $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $cost = filter_input(INPUT_POST, 'cost', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            if ($name && $stock && $price && $cost) {
                $productData = [
                    'name' => $name,
                    'stock' => $stock,
                    'price' => $price,
                    'cost' => $cost
                ];

                if ($this->addNewProduct($productData)) {
                    return "Product added successfully.";
                } else {
                    return "There was an error adding the product.";
                }
            } else {
                return "Invalid data provided.";
            }
        }
    }

    public function handleDeleteProduct()
    {
        if (isset($_GET['delete'])) {
            $id = filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT);

            if ($id) {
                if ($this->removeProduct($id)) {
                    return "Product deleted successfully.";
                } else {
                    return "There was an error deleting the product.";
                }
            } else {
                return "Invalid data provided.";
            }
        }
    }
}
?>