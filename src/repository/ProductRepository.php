<?php

require_once __DIR__.'/../models/Product.php';
require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/../models/ShoppingCart.php';
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
            $product['image'],
            $product['productid']

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
                $product['image'],
                $product['productid']
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
        $existingCategoryId = $this->getCategoryIdByName($categoryName);
        if ($existingCategoryId !== null) {
            return $existingCategoryId;
        }

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

    public function getProductByTitle(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM products WHERE LOWER(productname) LIKE :search OR LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductsByCategory($id)
    {
        if($id === 27) {
            $stmt = $this->database->connect()->prepare('
            SELECT * FROM products
        ');
        }
        else {
            $stmt = $this->database->connect()->prepare('
            SELECT * FROM products WHERE products.categoryid = :id
        ');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addToShoppingCart(int $customerId, int $productId, int $quantity = 1)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.shoppingcart (customerid, productid, quantity, isordered)
            VALUES (?, ?, ?, FALSE)
        ');
        $stmt->execute([$customerId, $productId, $quantity]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['cartid'] : null;
    }

    public function getShoppingCart(int $customerId): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM shoppingcart WHERE customerid = ?
        ');
        $stmt->execute([$customerId]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cartItems as $cartItem) {
            $result[] = new ShoppingCart(
                $cartItem['cartid'],
                $cartItem['customerid'],
                $cartItem['productid'],
                $cartItem['quantity'],
                $cartItem['isordered']
            );
        }

        return $result;
    }
    public function updateShoppingCartItem(int $cartId, int $quantity = 1)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.shoppingcart
            SET quantity = ?
            WHERE cartid = ?
        ');
        $stmt->execute([$quantity, $cartId]);
    }
    public function removeShoppingCartItem(int $cartId)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM public.shoppingcart
            WHERE cartid = ?
        ');
        $stmt->execute([$cartId]);
    }

}