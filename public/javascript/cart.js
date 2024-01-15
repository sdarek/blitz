const logoContainer = document.querySelector('.logo-container');
const shopButton = document.querySelector('.nav-link[href="shop"]');
const homeButton = document.querySelector('.nav-link[href="#home"]');
const infoButton = document.querySelector('.nav-link[href="#informacje"]');
const contactButton = document.querySelector('.nav-link[href="#informacje"]');

logoContainer.addEventListener('click', () => {
    document.querySelector('.cart').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'home';
    }, 300);
});

shopButton.addEventListener('click', () => {
    // Dodaj efekt rozwijania przy opuszczaniu strony
    document.querySelector('.cart').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'shop';
    }, 300);
});
homeButton.addEventListener('click', () => {
    // Dodaj efekt rozwijania przy opuszczaniu strony
    document.querySelector('.cart').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'home';
    }, 300);
});
infoButton.addEventListener('click', () => {
    // Dodaj efekt rozwijania przy opuszczaniu strony
    document.querySelector('.cart').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'home';
        scrollToInformacje();
    }, 300);
});
contactButton.addEventListener('click', () => {
    // Dodaj efekt rozwijania przy opuszczaniu strony
    document.querySelector('.cart').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'home';
        scrollToInformacje();
    }, 300);
});