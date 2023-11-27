<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sklep - Blitz</title>
    <meta name="description" content="Sklep z produktami Blitz - Chemia Profesjonalna"/>
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/shop-style.css">
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
                    <!-- Dodaj to miejsce w kodzie HTML, gdzie chcesz wyświetlić formularz logowania -->
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

                        <p>Nie masz jeszcze konta? <a href="#">Zarejestruj się</a></p>
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
            </div>
        </section>
        <section id="product-sections">
            <div id="product-list">
                <!-- Tutaj będą wyświetlane produkty z wybranej kategorii -->
            </div>
            <div class="product-section">
                <h2>Promocje</h2>
                <div class="product-carousel">
                    <!-- Przykładowe produkty -->
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
