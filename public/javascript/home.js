
// Pobranie wszystkich przycisków nawigacyjnych
const navLinks = document.querySelectorAll('.nav-link');
const mobileLinks = document.querySelectorAll('.mobile-link');

// Dla każdego przycisku nawigacyjnego dodaj obsługę zdarzenia kliknięcia
navLinks.forEach(link => {
    link.addEventListener('click', scrollToSection);
});
mobileLinks.forEach(link => {
    link.addEventListener('click', scrollToSection);
});

// Obsługa zdarzenia kliknięcia na przycisk nawigacyjny
function scrollToSection(event) {
    event.preventDefault();

    // Pobranie atrybutu href przycisku nawigacyjnego
    const targetId = this.getAttribute('href').substring(1); // Usunięcie znaku #

    // Pobranie elementu docelowego
    const targetElement = document.getElementById(targetId);

    // Płynne przewinięcie do elementu docelowego
    if (targetElement) {
        window.scrollTo({
            top: targetElement.offsetTop,
            behavior: 'smooth'
        });
    }
}
// Pobranie ikony "scroll down"
const scrollDownIcon = document.getElementById('scroll-down-icon');

// Obsługa zdarzenia kliknięcia na ikonę "scroll down"
scrollDownIcon.addEventListener('click', scrollToInformacje);

// Funkcja przewijania do sekcji "Informacje"
function scrollToInformacje() {
    const informacjeSection = document.getElementById('informacje');
    if (informacjeSection) {
        window.scrollTo({
            top: informacjeSection.offsetTop,
            behavior: 'smooth'
        });
    }
}


// Pobranie przycisku "Sklep"
const shopButton = document.querySelector('.nav-link[href="shop.php"]');

// Obsługa zdarzenia kliknięcia na przycisk "Sklep"
shopButton.addEventListener('click', () => {
    // Dodaj efekt rozwijania przy opuszczaniu strony
    document.querySelector('#home').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'shop'; // Przekierowanie do strony "shop.html"
    }, 300); // Czas animacji (0.3s)
});

// Pobranie przycisku "Sklep"
const shopMobileButton = document.querySelector('.mobile-link[href="shop.php"]');

// Obsługa zdarzenia kliknięcia na przycisk "Sklep"
shopMobileButton.addEventListener('click', () => {
    // Dodaj efekt rozwijania przy opuszczaniu strony
    document.querySelector('#home').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'shop'; // Przekierowanie do strony "shop.html"
    }, 300); // Czas animacji (0.3s)
});

const userIcon = document.querySelector('.user-icon');
const userMenu = document.getElementById('user-menu');

let isUserMenuVisible = false;

userIcon.addEventListener('click', () => {
    if (isUserMenuVisible) {
        userMenu.style.opacity = 0; // Schowaj menu
        setTimeout(() => {
            userMenu.style.display = 'none'; // Ukryj menu
        }, 300); // Czas animacji (0.3s)
    } else {
        userMenu.style.display = 'block'; // Pokaż menu
        setTimeout(() => {
            userMenu.style.opacity = 1; // Ustal przeźroczystość na 1
        }, 0);
    }

    isUserMenuVisible = !isUserMenuVisible;
});

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('.login-form');
    const errorPopup = document.getElementById('error-popup');
    const errorMessage = document.getElementById('error-message');
    const closeErrorPopup = document.getElementById('close-error-popup');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(loginForm);

        fetch('login', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Jeśli logowanie powiodło się, możesz przekierować użytkownika na inną stronę lub wykonać inne operacje
                    window.location.href = 'shop';
                } else {
                    // Jeśli logowanie nie powiodło się, wyświetl odpowiedni komunikat
                    errorMessage.textContent = data.message;
                    errorPopup.style.display = 'block';
                }
            });
    });

    // Obsługa zamknięcia komunikatu o błędzie
    closeErrorPopup.addEventListener('click', function() {
        errorPopup.style.display = 'none';
    });
});

