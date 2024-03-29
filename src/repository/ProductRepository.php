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
    public function getShoppingCartDetails(int $customerId): array
    {
        // Aktualizacja ilości dla produktów w koszyku (zmniejszenie do 0, jeśli quantity == 0)
        $updateStmt = $this->database->connect()->prepare('
        UPDATE shoppingcart 
        SET quantity = CASE WHEN quantity = 0 THEN 0 ELSE quantity END
        WHERE customerid = :customerid;
    ');

        $updateStmt->bindParam(':customerid', $customerId, PDO::PARAM_INT);
        $updateStmt->execute();

        // Usunięcie rekordów, których ilość wynosi 0
        $deleteStmt = $this->database->connect()->prepare('
        DELETE FROM shoppingcart 
        WHERE customerid = :customerid AND quantity = 0;
    ');

        $deleteStmt->bindParam(':customerid', $customerId, PDO::PARAM_INT);
        $deleteStmt->execute();

        // Pobranie danych z koszyka (zaktualizowanych po ewentualnym usunięciu)
        $result = [];
        $stmt = $this->database->connect()->prepare('
        SELECT s.*, p.productname, p.price, p.description, p.categoryid, p.supplierid, p.image
        FROM shoppingcart s
        JOIN products p ON s.productid = p.productid
        WHERE s.customerid = :customerid;
    ');

        $stmt->bindParam(':customerid', $customerId, PDO::PARAM_INT);
        $stmt->execute();
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cartItems as $cartItem) {
            $result[] = [
                'product' => new Product(
                    $cartItem['productname'],
                    $cartItem['price'],
                    $cartItem['description'],
                    $cartItem['categoryid'],
                    $cartItem['supplierid'],
                    $cartItem['image'],
                    $cartItem['productid']
                ),
                'cart' => new ShoppingCart(
                    $cartItem['cartid'],
                    $cartItem['customerid'],
                    $cartItem['productid'],
                    $cartItem['quantity'],
                    $cartItem['isordered']
                )
            ];
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
    public function addToShoppingCart(int $productId, int $userId, int $quantity, bool $isOrdered = false)
    {
        try {
            $connection = $this->database->connect();

            // Sprawdzenie, czy produkt już istnieje w koszyku
            $checkStmt = $connection->prepare('
            SELECT cartid, quantity FROM public.shoppingcart 
            WHERE customerid = :userId AND productid = :productId;
        ');

            $checkStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $checkStmt->bindParam(':productId', $productId, PDO::PARAM_INT);
            $checkStmt->execute();
            $existingCartItem = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if ($existingCartItem) {
                // Produkt istnieje w koszyku, zaktualizuj ilość
                $updateStmt = $connection->prepare('
                UPDATE public.shoppingcart 
                SET quantity = quantity + :quantity 
                WHERE cartid = :cartId;
            ');

                $updateStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $updateStmt->bindParam(':cartId', $existingCartItem['cartid'], PDO::PARAM_INT);
                $updateStmt->execute();
            } else {
                // Produkt nie istnieje w koszyku, dodaj nowy
                $insertStmt = $connection->prepare('
                INSERT INTO public.shoppingcart (customerid, productid, quantity, isordered)
                VALUES (:userId, :productId, :quantity, :isOrdered);
            ');

                $insertStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $insertStmt->bindParam(':productId', $productId, PDO::PARAM_INT);
                $insertStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $insertStmt->bindParam(':isOrdered', $isOrdered, PDO::PARAM_BOOL);
                $insertStmt->execute();
            }

            // Pobranie zaktualizowanych danych z koszyka
            $selectStmt = $connection->prepare('
            SELECT * FROM public.shoppingcart WHERE customerid = :userId;
        ');

            $selectStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $selectStmt->execute();
            $cartProducts = $selectStmt->fetchAll(PDO::FETCH_ASSOC);

            $result = [];
            foreach ($cartProducts as $cartProduct) {
                $result[] = new ShoppingCart(
                    $cartProduct['cartid'],
                    $cartProduct['customerid'],
                    $cartProduct['productid'],
                    $cartProduct['quantity'],
                    $cartProduct['isordered']
                );
            }

            return $result ? $result : null;
        } catch (PDOException $e) {
            echo 'Wystąpił błąd podczas dodawania do koszyka: ' . $e->getMessage();
            return null;
        }
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
    public function updateShoppingCartItem(int $cartId, int $quantity)
    {
        $updateStmt = $this->database->connect()->prepare('
            UPDATE public.shoppingcart 
            SET quantity = CASE WHEN quantity + :quantity >= 0 THEN quantity + :quantity ELSE 0 END
            WHERE cartid = :cartId;
        ');


        $updateStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $updateStmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
        $updateStmt->execute();
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