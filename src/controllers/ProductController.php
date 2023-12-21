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
            $newCategoryName = $_POST['newCategoryName'];

            $categoryId = $this->productRepository->getCategoryIdByName($categoryName);

            if (!$categoryId) {
                // Kategoria nie istnieje, więc dodaj ją do bazy danych
                $categoryId = $this->productRepository->addCategory($newCategoryName);
            }


            $product = new Product(
                $productName,
                #$_POST['productPrice'],
                22.3,
                $productDescription,
                #$_POST['productCategory'],
                $categoryId,
                1,
                $imageFileName
            );

            $this->productRepository->addProduct($product);


            return $this->render('shop', ['messages' => $this->messages, 'product' => $product]);
        }
        // Jeśli nie udało się dodać produktu, wyświetl widok dodawania produktu z ewentualnymi komunikatami
        return $this->render('addproduct', ['messages' => $this->messages]);
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