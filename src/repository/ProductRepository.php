<?php

require_once __DIR__.'/../models/Product.php';
require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/Repository.php';


class ProductRepository extends Repository
{
    public function getProduct(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM products WHERE productid = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product == false) {
            return false;
        }

        return new Product(
            $product['productname'],
            $product['price'],
            $product['description'],
            $product['categoryid'],
            $product['supplierid'],
            $product['image']

        );
    }
    public function getProducts(): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM products
        ');
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product) {
            $result[] = new Product(
                $product['productname'],
                $product['price'],
                $product['description'],
                $product['categoryid'],
                $product['supplierid'],
                $product['image']
            );
        }

        return $result;
    }


    public function addProduct(Product $product) {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.products (productid, productname, price, description, categoryid, supplierid, image)
            VALUES (DEFAULT, ?, ?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $product->getName(),
            $product->getPrice(),
            $product->getDescription(),
            $product->getCategory(),
            $product->getSupplier(),
            $product->getImage()
        ]);
    }

    public function getCategoryIdByName($categoryName) {
        $stmt = $this->database->connect()->prepare('
            SELECT categoryid FROM public.productcategories WHERE categoryname = ?
        ');
        $stmt->execute([$categoryName]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['categoryid'] : null;
    }
    public function addCategory($categoryName) {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.productcategories (categoryid, categoryname)
            VALUES (DEFAULT, ?)
            RETURNING categoryid
        ');
        $stmt->execute([$categoryName]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['categoryid'] : null;
    }

    public function getCategories(): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM productcategories
        ');
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $category) {
            $result[] = new Category(
                $category['categoryid'],
                $category['categoryname'],
                $category['categorydescription']
            );
        }

        return $result;
    }
}