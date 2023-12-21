<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sklep - Blitz</title>
    <meta name="description" content="Sklep z produktami Blitz - Chemia Profesjonalna"/>
    <link rel="stylesheet" type="text/css" href="public/css/shop-style.css">
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/effects.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

</head>
<body>
    <section id="shop">
        <div class="main-container">
            <div class="menu-bar">
                <div class="menu-left">
                    <div class="logo-container" id="shop-logo">
                        <img class="logo" src="public/img/logo.png" alt="Logo">
                        <div class="logo-text">
                            <h1 class="logo-title">BLITZ</h1>
                            <p class="logo-subtitle">CHEMIA PROFESJONALNA</p>
                        </div>
                    </div>
                </div>
                <div class="menu-center">
                    <div class="search-bar">
                        <input type="text" placeholder="Wyszukaj...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <div class="menu-right">
                    <div class="user-cart-icons">
                        <img class="user-icon" src="public/img/user.svg" alt="User Icon">
                        <img class="cart-icon" src="public/img/cart.svg" alt="Cart Icon">
                    </div>
                </div>
                <!-- menu rozwijane uzytkownika -->
                <div class="user-menu" id="user-menu">
                    <div class="login-container">
                        <h1>Logowanie</h1>
                        <div class="error-popup" id="error-popup">
                            <div class="error-content">
                                <span id="error-message"></span>
                                <button id="close-error-popup">Zamknij</button>
                            </div>
                        </div>

                        <form action="login" method="post" class="login-form">
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email" required>

                            <label for="password">Hasło:</label>
                            <input type="password" id="password" name="password" required>

                            <button type="submit">Zaloguj</button>
                        </form>

                        <p>Nie masz jeszcze konta? <a href="#" id="showRegister">Zarejestruj się</a></p>
                    </div>

                    <div class="register-container" style="display: none;">
                        <h1>Rejestracja</h1>
                        <div class="error-popup" id="register-error-popup">
                            <div class="error-content">
                                <span id="register-error-message"></span>
                                <button id="close-register-error-popup">Zamknij</button>
                            </div>
                        </div>

                        <form action="register" method="post" class="register-form">
                            <label for="register-name">Imię i nazwisko:</label>
                            <input type="text" id="register-name" name="register-name" required>

                            <label for="register-email">E-mail:</label>
                            <input type="email" id="register-email" name="register-email" required>

                            <label for="register-password">Hasło:</label>
                            <input type="password" id="register-password" name="register-password" required>

                            <label for="confirm-password">Potwierdź hasło:</label>
                            <input type="password" id="confirm-password" name="confirm-password" required>

                            <button type="submit">Zarejestruj</button>
                        </form>

                        <p>Masz już konto? <a href="#" id="showLogin">Zaloguj się</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section id="product-categories">
            <div class="category">
                <h2>Kategorie</h2>
                <ul>
                    <li><a href="#">Środki czystości</a>
                        <ul>
                            <li><a href="#" data-category-id="detergents">Detergenty</a></li>
                            <li><a href="#" data-category-id="disinfectants">Środki do dezynfekcji</a></li>
                            <li><a href="#" data-category-id="dishwashing">Płyny do mycia naczyń</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Kosmetyki</a>
                        <ul>
                            <li><a href="#" data-category-id="handcare">Kosmetyki do rąk</a></li>
                            <li><a href="#" data-category-id="bodycare">Kosmetyki do ciała</a></li>
                            <li><a href="#" data-category-id="perfumes">Perfumy</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Akcesoria</a>
                        <ul>
                            <li><a href="#" data-category-id="mops">Mopy i szczotki</a></li>
                            <li><a href="#" data-category-id="gloves">Rękawiczki ochronne</a></li>
                            <li><a href="#" data-category-id="trashbags">Worki na śmieci</a></li>
                        </ul>
                    </li>
                </ul>
                <button id="addProductButton">Dodaj Produkt</button>
            </div>
        </section>
        <section id="product-sections">
            <div id="product-list">
                <!-- Tutaj będą wyświetlane produkty z wybranej kategorii -->
            </div>

            <!-- dodawanie produktu dla admina -->
            <div id="addProductForm" style="display: none;">
                <h2>Dodaj Produkt</h2>
                <form id="productForm" action="addProduct" method="POST" enctype="multipart/form-data">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                    <label for="productName">Nazwa:</label>
                    <input type="text" id="productName" name="productName" required>

                    <label for="productPrice">Cena:</label>
                    <input type="number" id="productPrice" name="productPrice" required>

                    <label for="productDescription">Opis:</label>
                    <textarea id="productDescription" name="productDescription"></textarea>

                    <label for="productCategory">Kategoria:</label>
                    <select id="productCategory" name="productCategory">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['categoryid'] ?>"><?= $category['categoryname'] ?></option>
                        <?php endforeach; ?>
                        <option value="existingCategory">Twoja stara</option>
                        <option value="newCategory">Dodaj nową kategorię</option>
                    </select>

                    <div id="newCategory" style="display: none;">
                        <label for="newCategoryName">Nowa Kategoria:</label>
                        <input type="text" id="newCategoryName" name="newCategoryName">
                    </div>

                    <label for="newImage">Dodaj zdjęcie:</label>
                    <input type="file" id="newImage" name="newImage">

                    <button type="submit">Dodaj Produkt</button>
                </form>
            </div>

            <div class="product-section">
                <h2>Promocje</h2>
                <div class="product-carousel">
                    <!-- Przykładowe produkty -->
                    <div class="product">
                        <?php
                        if ($product !== null) {
                            // Kod do wykonania, gdy $product nie jest null
                            echo "<h3>{$product->getName()}</h3>";
                            echo "<p>{$product->getDescription()}</p>";
                            echo "<img src='public/uploads/{$product->getImage()}' alt='Produkt 1'>";
                        } else {
                            // Kod do wykonania, gdy $product jest null
                            echo "<p>Brak produktu.</p>";
                        }
                        ?>
                    </div>
                    <div class="product">
                        <h3>Nazwa Produktu 1</h3>
                        <p>Opis produktu 1.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 1">
                    </div>
                    <div class="product">
                        <h3>Nazwa Produktu 1</h3>
                        <p>Opis produktu 1.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 1">
                    </div>
                    <div class="product">
                        <h3>Nazwa Produktu 2</h3>
                        <p>Opis produktu 2.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 2">
                    </div>
                    <!-- Dodaj więcej produktów w tej sekcji -->
                </div>
                <div class="carousel-arrows">
                    <button class="prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
    
            <div class="product-section">
                <h2>Bestsellery</h2>
                <div class="product-carousel">
                    <!-- Przykładowe produkty -->
                    <div class="product">
                        <h3>Nazwa Produktu 3</h3>
                        <p>Opis produktu 3.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 3">
                    </div>
                    <div class="product">
                        <h3>Nazwa Produktu 3</h3>
                        <p>Opis produktu 3.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 3">
                    </div>
                    <div class="product">
                        <h3>Nazwa Produktu 3</h3>
                        <p>Opis produktu 3.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 3">
                    </div>
                    <div class="product">
                        <h3>Nazwa Produktu 4</h3>
                        <p>Opis produktu 4.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 4">
                    </div>
                    <!-- Dodaj więcej produktów w tej sekcji -->
                </div>
                <div class="carousel-arrows">
                    <button class="prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
    
            <div class="product-section">
                <h2>Nowości</h2>
                <div class="product-carousel">
                    <!-- Przykładowe produkty -->
                    <div class="product">
                        <h3>Nazwa Produktu 5</h3>
                        <p>Opis produktu 5.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 5">
                    </div>
                    <div class="product">
                        <h3>Nazwa Produktu 6</h3>
                        <p>Opis produktu 6.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 6">
                    </div>
                    <div class="product">
                        <h3>Nazwa Produktu 6</h3>
                        <p>Opis produktu 6.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 6">
                    </div>
                    <div class="product">
                        <h3>Nazwa Produktu 6</h3>
                        <p>Opis produktu 6.</p>
                        <img src="public/img/placeholder-image1.jpg" alt="Produkt 6">
                    </div>
                    <!-- Dodaj więcej produktów w tej sekcji -->
                </div>
                <div class="carousel-arrows">
                    <button class="prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>
    </main>
    

    <footer>
        <!-- Stopka strony sklepu -->
    </footer>

    <script src="public/javascript/shop.js"></script>
    <script src="public/javascript/menu.js"></script>
    <script src="public/javascript/user.js"></script>
</body>
</html>
