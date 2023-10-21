function toggleMobileMenu() {
    var mobileMenu = document.getElementById('mobile-menu');
    var menuButton = document.getElementById('menu-button');
    
    mobileMenu.classList.toggle('active');
    
    // Zmień ikonę przycisku na krzyżyk po otwarciu menu
    if (mobileMenu.classList.contains('active')) {
        menuButton.innerHTML = '<i class="fas fa-times"></i>';
    } else {
        menuButton.innerHTML = '<i class="fas fa-bars"></i>';
    }
}

