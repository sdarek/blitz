
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

    const targetId = this.getAttribute('href').substring(1); // Usunięcie znaku #
    const targetElement = document.getElementById(targetId);
    if (targetElement) {
        window.scrollTo({
            top: targetElement.offsetTop,
            behavior: 'smooth'
        });
    }
}
const scrollDownIcon = document.getElementById('scroll-down-icon');
scrollDownIcon.addEventListener('click', scrollToInformacje);
function scrollToInformacje() {
    const informacjeSection = document.getElementById('informacje');
    if (informacjeSection) {
        window.scrollTo({
            top: informacjeSection.offsetTop,
            behavior: 'smooth'
        });
    }
}


const shopButton = document.querySelector('.nav-link[href="shop.php"]');
shopButton.addEventListener('click', leaveHome);

const shopMobileButton = document.querySelector('.mobile-link[href="shop.php"]');
shopMobileButton.addEventListener('click', leaveHome);

function leaveHome() {
    document.querySelector('#home').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'shop'; // Przekierowanie do strony ""
    }, 300); // Czas animacji
}

const cartIcon = document.querySelector(".cart-icon");

cartIcon.addEventListener('click', function(event) {
    // Dodaj efekt rozwijania przy opuszczaniu strony
    document.querySelector('.homeall').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'cart'; // Przekierowanie do strony "shop.html"
    }, 600); // Czas animacji (0.3s)
});