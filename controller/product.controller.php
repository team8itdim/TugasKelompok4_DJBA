<?php
class ProductController extends ProductModel
{

    public function getProducts()
    {
        return $this->allProducts();
    }

    public function getProductBy()
    {
        if (!isset($_GET['id'])) {
            return;
        }
        $onlyId = preg_replace('/\D/',  '', $_GET['id']);
        if ($onlyId !== "") {
            return $this->findOne($_GET['id']);
        }
    }

    public function addNewProduct($data)
    {
        return $this->addProduct($data);
    }

    public function editProduct($data)
    {
        return $this->updateProduct($data);
    }

    public function removeProduct($id)
    {
        return $this->deleteProduct($id);
    }
}
