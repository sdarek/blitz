<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blitz - Strona Główna</title>
    <meta name="description" content="Opis...................."/>
    <link rel="stylesheet" type="text/css" href="public/css/cart-style.css">
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/effects.css">
    <script src="public/javascript/menu.js" defer></script>
    <script src="public/javascript/user.js" defer></script>
    <script src="public/javascript/cart.js" defer></script>
    <script type="text/javascript" src="./public/javascript/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

</head>
<body class="cart">
<section id="home">
    <div class="main-container">
        <div class="menu-bar">
            <div class="menu-button" id="menu-button" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </div>
            <div class="menu-left">
                <div class="logo-container" id="home-logo">
                    <img class="logo" src="public/img/logo.png" alt="Logo">
                    <div class="logo-text">
                        <h1 class="logo-title">BLITZ</h1>
                        <p class="logo-subtitle">CHEMIA PROFESJONALNA</p>
                    </div>
                </div>
            </div>
            <div class="menu-center">
                <div class="nav-links">
                    <a class="nav-link" href="#home">HOME</a>
                    <a class="nav-link" href="shop">SKLEP</a>
                    <a class="nav-link" href="#informacje">INFORMACJE</a>
                    <a class="nav-link" href="#kontakt">KONTAKT</a>
                </div>
            </div>
            <div class="menu-right">
                <div class="user-cart-icons">
                    <img class="user-icon" src="public/img/user.svg" alt="User Icon">
                    <img class="cart-icon" src="public/img/cart.svg" alt="Cart Icon">
                </div>
            </div>
        </div>

        <!-- menu rozwijane uzytkownika -->
        <div class="user-menu" id="user-menu">

            <?php session_start(); ?>
            <div class="user-container" style="display: none;">
                <h1>Witaj, <?php echo $_SESSION['name']; ?>!</h1>
                <div class="user-info">
                    <p>Email:  <?php echo $_SESSION['email']; ?></p>
                    <p>Rola: <?php echo $_SESSION['role']; ?></p>
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


        <nav class="mobile-menu" id="mobile-menu">
            <a class="mobile-link" href="#home">HOME</a>
            <a class="mobile-link" href="shop.php">SKLEP</a>
            <a class="mobile-link" href="#informacje">INFORMACJE</a>
            <a class="mobile-link" href="#kontakt">KONTAKT</a>
        </nav>
    </div>
</section>
<section id="cart" class="background-container">
    <div class="cart-container">

        <!-- Kontener dla produktów w koszyku (po lewej) -->
        <div class="cart-items-container">

            <h1>Koszyk Zakupowy</h1>
            <div class="cart-items">
                <?php foreach ($cartItems as $cartItem): ?>
                <div class="cart-item">
                    <img src="public/uploads/<?= $cartItem['product']->getImage();?>" alt="Product 1">
                    <div class="item-details">
                        <p><?= $cartItem['product']->getName();?></p>
                        <p>Ilość: <?= $cartItem['quantity']?></p>
                        <p>Cena: <?= $cartItem['product']->getPrice() * $cartItem['quantity'];?>zł</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Kontener dla podsumowania koszyka (po prawej) -->
        <div class="cart-summary-container">
            <h2>Podsumowanie</h2>
            <div class="container">
                <?php
                // Obliczenia dotyczące liczby produktów i łącznej kwoty
                $totalProducts = count($cartItems);
                $totalPrice = 0;

                foreach ($cartItems as $cartItem) {
                    $totalPrice += $cartItem['product']->getPrice() * $cartItem['quantity'];
                }
                ?>

                <p>Liczba produktów: <?= $totalProducts; ?></p>
                <p>Łączna kwota: <?= $totalPrice; ?>zł</p>

                <!-- Przycisk do zapłaty -->
                <button id="checkout-button">Zapłać</button>
            </div>
        </div>
    </div>
</section>
</body>
</html>
