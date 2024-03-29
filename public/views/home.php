<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blitz - Strona Główna</title>
    <meta name="description" content="Opis...................."/>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/effects.css">
    <script src="public/javascript/menu.js"></script>
    <script type="text/javascript" src="./public/javascript/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    </head>
<body class="homeall">
    <section id="home">
        <div class="main-container">
            <div class="menu-bar">
                <div class="menu-button" id="menu-button" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="menu-left">
                    <div class="logo-container" id="home-logo">
                        <a href="home">
                            <img class="logo" src="public/img/logo.png" alt="Logo">
                        </a>
                        <div class="logo-text">
                            <h1 class="logo-title">BLITZ</h1>
                            <p class="logo-subtitle">CHEMIA PROFESJONALNA</p>
                        </div>
                    </div>
                </div>
                <div class="menu-center">
                    <div class="nav-links">
                        <a class="nav-link" href="#home">HOME</a>
                        <a class="nav-link" href="shop.php">SKLEP</a>
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
                <a class="mobile-link" href="#wyszukiwanie">WYSZUKIWANIE</a>
            </nav>
            <div class="overlap-wrapper">
                <div class="overlap-group">
                    <div class="overlap-content">
                        <h1 class="headline">
                            <span class="text-part-1">ŚWIEŻOŚĆ</span>
                            <br>
                            <span class="text-part-2">W JEDNYM KLIKNIĘCIU</span>
                        </h1>
                    </div>
                    <div class="scroll-down-icon" id="scroll-down-icon">
                        <i class="fas fa-chevron-down" ></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="informacje">
        <div class="info-container">
            <h2>POZNAJ WYŻSZĄ JAKOŚĆ CZYSTOŚCI</h2>
            <p>Witaj na naszej stronie, gdzie znajdziesz najlepsze produkty do utrzymania czystości w swoim domu i nie tylko. Nasze produkty gwarantują świeżość w jednym kliknięciu.</p>
            <a href="shop" class="shop-button">Przejdź do witryny sklepowej</a>

            <div class="product-carousel">
                <div class="product-container">
                    <img src="public/img/placeholder-image1.jpg" alt="Produkt 1">
                    <h3>Produkt 1</h3>
                    <p>Opis produktu 1.</p>
                </div>
                <div class="product-container">
                    <img src="public/img/placeholder-image1.jpg" alt="Produkt 1">
                    <h3>Produkt 2</h3>
                    <p>Opis produktu 2.</p>
                </div>
                <div class="product-container">
                    <img src="public/img/placeholder-image1.jpg" alt="Produkt 1">
                    <h3>Produkt 3</h3>
                    <p>Opis produktu 3.</p>
                </div>
            </div>
            <p>Nunc sed convallis nulla, eget viverra sapien. Pellentesque cursus aliquam odio vitae accumsan. Nunc nec molestie nisi. Mauris commodo felis et ante volutpat mattis. Pellentesque nisi arcu, scelerisque ut enim eu, scelerisque faucibus libero. Vestibulum malesuada neque vehicula enim pellentesque, cursus ultrices massa lobortis. Vivamus venenatis eros ut diam sagittis ultrices. Nullam non purus id nulla sodales eleifend eu non mauris.</p>

        </div>
    </section>
    <section id="kontakt">
        <div class="contact-container">
            <h2>Kontakt</h2>
            <p>
                Skontaktuj się z nami:
                <br>
                Email: kontakt@przykladowa-strona.pl
                <br>
                Telefon: (123) 456-7890
            </p>
            <h3>Napisz do nas</h3>
            <form>
                <label for="name">Imię i nazwisko:</label>
                <input type="text" id="name" name="name" required>
                <label for="emailContact">Adres email:</label>
                <input type="email" id="emailContact" name="email" required>
                <label for="message">Wiadomość:</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit">Wyślij</button>
            </form>
        </div>
    </section>
    <footer>
        <div class="footer-container">
            <div class="logo-text">
                <h1 class="logo-title">BLITZ</h1>
                <p class="logo-subtitle">CHEMIA PROFESJONALNA</p>
            </div>
            <ul class="footer-nav">
                <li><a href="#home">Home</a></li>
                <li><a href="shop">Sklep</a></li>
                <li><a href="#informacje">Informacje</a></li>
                <li><a href="#kontakt">Kontakt</a></li>
            </ul>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script src="public/javascript/home.js"></script>
    <script src="public/javascript/user.js"></script>
</body>
</html>
