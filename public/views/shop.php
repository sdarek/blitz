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
    <script src="public/javascript/shop.js" defer></script>
    <script src="public/javascript/menu.js" defer></script>
    <script src="public/javascript/user.js" defer></script>
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

                    <div class="user-container" style="display: none;">
                        <h1>Witaj, <?php echo $_SESSION['name']; ?>!</h1>
                        <div class="user-info">
                            <p>Email:  <?php echo $_SESSION['email']; ?></p>
                            <p>Rola: <?php echo $_SESSION['role']; ?></p>
                            <!-- Dodaj inne informacje o użytkowniku, które chcesz wyświetlić -->
                        </div>
                        <button class="logout-btn" onclick="logout()">Wyloguj</button>
                    </div>

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
                            <label for="register-name">Imię</label>
                            <input type="text" id="register-name" name="register-name" required>

                            <label for="register-surname">Nazwisko:</label>
                            <input type="text" id="register-surname" name="register-surname" required>

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

                <?php foreach ($categories as $category): ?>
                    <li><a href="#" data-category-id="<?= $category->getId(); ?>"><?= $category->getName(); ?></a></li>
                <?php endforeach; ?>
            </div>
        </section>
        <section id="product-sections">
            <div class="product-section">
                <h2 class="product-header">WSZYSTKIE PRODUKTY</h2>
                <div class="product-carousel">
                    <?php foreach ($products as $product): ?>
                        <div class="product", id="<?= $product->getId(); ?>">
                            <h3><?= $product->getName(); ?></h3>
                            <p class="description"><?= $product->getDescription(); ?></p>
                            <img src="public/uploads/<?= $product->getImage(); ?>" alt="Produkt 1">
                            <p class="product-price">Cena: <?= $product->getPrice(); ?>zł</p>
                            <button class="add-to-cart-button" data-product-id="<?= $product->getId(); ?>">
                                Dodaj do koszyka
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>


    <footer>
        <!-- Stopka strony sklepu -->
    </footer>

</body>
</html>

<template id="product-template">
    <div class="product">
        <h3>nazwa</h3>
        <p class="description">opis</p>
        <img src="" alt="Produkt">
        <p class="product-price">Cena</p>
        <button class="add-to-cart-button" data-product-id="">
            Dodaj do koszyka
        </button>
    </div>
</template>