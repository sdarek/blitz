<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Product.php';
require_once __DIR__.'/../repository/ProductRepository.php';

class ProductController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];
    private $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = new ProductRepository();
    }

    public function shop() {
        $href = 'shop';
        session_start();
        if(isset($_SESSION['user_id']))
        {
            if($_SESSION['role'] === 'admin') {
                $href = 'shop_admin';
            }
        }
        $products = $this->productRepository->getProducts();
        $categories = $this->productRepository->getCategories();
        $this->render($href, [
            'products' => $products,
            'categories' => $categories
        ]);
    }
    public function shop_admin() {
        $href = 'shop_admin';
        session_start();
        if(isset($_SESSION['user_id']))
        {
            if($_SESSION['role'] !== 'admin') {
                $href = 'shop';
            }
        }
        $products = $this->productRepository->getProducts();
        $categories = $this->productRepository->getCategories();
        $this->render($href, [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function addProduct(){
        if($this->isPost() && is_uploaded_file($_FILES['newImage']['tmp_name']) && $this->validate($_FILES['newImage'])) {
            move_uploaded_file(
                $_FILES['newImage']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['newImage']['name']
            );

            // Pobranie danych z formularza
            $productName = $_POST['productName'];
            $productDescription = $_POST['productDescription'];
            $imageFileName = $_FILES['newImage']['name'];
            $categoryName = $_POST['productCategory'];
            $newCategoryName = $_POST['newCategoryName'] ?? '';
            $productPrice = $_POST['productPrice'];

            if ($categoryName == 'newCategory' && !empty($newCategoryName)) {
                $categoryId = $this->productRepository->addCategory($newCategoryName);
            } else {
                $categoryId = $this->productRepository->getCategoryIdByName($categoryName);
                if (!$categoryId) {
                    $categoryId = $this->productRepository->addCategory($categoryName);
                }
            }

            $product = new Product(
                $productName,
                $productPrice,
                $productDescription,
                $categoryId,
                1,
                $imageFileName
            );



            $this->productRepository->addProduct($product);


            return $this->render('shop', [
                'messages' => $this->messages,
                'products' => $this->productRepository->getProducts(),
                'categories' => $this->productRepository->getCategories()
                ]);
        }
        // Jeśli nie udało się dodać produktu, wyświetl widok dodawania produktu z ewentualnymi komunikatami
        return $this->render('addproduct', ['messages' => $this->messages]);
    }
    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if($contentType === "application/json")
        {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            $result = json_encode($this->productRepository->getProductByTitle($decoded['search']));
            echo $result;
        }
    }
    public function searchByCategory($id)
    {
        $result = $this->productRepository->getProductsByCategory($id);
        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode($result);
    }

    public function addToCart()
    {
        // Pobranie danych z formularza
        $productId = $_POST['productId'];
        $quantity = $_POST['quantity'];
        $customerId = 1; // Zakładamy, że użytkownik o id 1 jest aktualnie zalogowany. Tutaj dostosuj do własnej autentykacji.

        // Dodanie produktu do koszyka
        $this->productRepository->addToShoppingCart($customerId, $productId, $quantity);

        // Przekierowanie z powrotem do sklepu
        header('Location: /shop');
    }

    public function viewCart()
    {
        $customerId = 1; // Zakładamy, że użytkownik o id 1 jest aktualnie zalogowany. Tutaj dostosuj do własnej autentykacji.

        // Pobranie zawartości koszyka
        $cartItems = $this->productRepository->getShoppingCart($customerId);

        $this->render('cart', [
            'cartItems' => $cartItems
        ]);
    }

    public function updateCartItem()
    {
        // Pobranie danych z formularza
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];

        // Aktualizacja ilości w koszyku
        $this->productRepository->updateShoppingCartItem($cartId, $quantity);

        // Przekierowanie z powrotem do widoku koszyka
        header('Location: /cart');
    }

    public function removeCartItem()
    {
        // Pobranie danych z formularza
        $cartId = $_POST['cartId'];

        // Usunięcie pozycji z koszyka
        $this->productRepository->removeShoppingCartItem($cartId);

        // Przekierowanie z powrotem do widoku koszyka
        header('Location: /cart');
    }


    private function validate(array $newImage): bool
    {
        if($newImage['SIZE'] > self::MAX_FILE_SIZE) {
            $this->messages[] = "Za duzy rozmiar pliku";
            return false;
        }
        if(!isset($newImage['type']) && !in_array($newImage['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = "Niedozwolony typ pliku";
            return false;
        }
        return true;
    }

}