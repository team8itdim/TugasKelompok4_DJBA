<?php
class ProductModel extends Connection
{
    protected $name;
    protected $price;
    protected $stock;
    protected $cost;

    protected function findOne($id)
    {
        $sql = "SELECT * FROM products WHERE id = {$id}";
        $result = $this->connect()->query($sql);
        return $result->fetch_assoc();
    }

    protected function allProducts()
    {
        $sql = "SELECT * FROM products";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $product[] = $data;
            }
            return $product;
        }
    }

    protected function addProduct($data)
    {
        $name = $this->connect()->real_escape_string($data['name']);
        $stock = $this->connect()->real_escape_string($data['stock']);
        $price = $this->connect()->real_escape_string($data['price']);
        $cost = $this->connect()->real_escape_string($data['cost']);

        $sql = "INSERT INTO products (name, stock, price, cost) VALUES ('{$name}', '{$stock}', '{$price}', '{$cost}')";
        $result = $this->connect()->query($sql);

        if (!$result) {
            die("Execute failed: " . $this->connect()->error);
        }

        return true;
    }

    protected function updateProduct($data)
    {
        $name = $this->connect()->real_escape_string($data['name']);
        $stock = $this->connect()->real_escape_string($data['stock']);
        $price = $this->connect()->real_escape_string($data['price']);
        $cost = $this->connect()->real_escape_string($data['cost']);
        $id = $this->connect()->real_escape_string($data['id']);

        $sql = "UPDATE products SET name = '{$name}', stock = '{$stock}', price = '{$price}', cost = '{$cost}' WHERE id = {$id}";
        $result = $this->connect()->query($sql);

        if (!$result) {
            die("Execute failed: " . $this->connect()->error);
        }

        return true;
    }

    protected function deleteProduct($id)
    {
        $id = $this->connect()->real_escape_string($id);

        $sql = "DELETE FROM products WHERE id = {$id}";
        $result = $this->connect()->query($sql);

        if (!$result) {
            die("Execute failed: " . $this->connect()->error);
        }

        return true;
    }
}
