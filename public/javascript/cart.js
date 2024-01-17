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

function updateQuantity(cartId, action, price) {
    if (action === "minus") {
        i = -1;
        price *= -1;
    }
    else {
        i = 1;
    }
    fetch(`/updateCartItem/${cartId}/${i}`, {
        method: "POST"
    })
        .then(function() {
            const quantityElement = document.getElementById(`quantity-${cartId}`);
            const priceElement = document.getElementById(`price-${cartId}`);
            const summaryElement = document.getElementById(`summary-price`);

            if (quantityElement) {
                const currentQuantity = parseInt(quantityElement.innerHTML.split(":")[1].trim()) + i;
                const currentPrice = parseFloat(priceElement.innerHTML.split(":")[1].trim()) + price;
                const summaryPrice = parseFloat(summaryElement.innerHTML.split(":")[1].trim()) + price;
                quantityElement.innerHTML = "Ilość: " + (currentQuantity >= 0 ? currentQuantity : 0);
                priceElement.innerHTML = "Cena: " + (currentPrice >= 0 ? currentPrice : 0) + "zł";
                summaryElement.innerHTML = "Łączna kwota: " + (summaryPrice >= 0 ? summaryPrice : 0) + "zł";
                // console.log(productId, action, quantityElement);
            }
        });
}
// <p id="price-<?= $cartItem['cart']->getCartid();?>">Cena: <?= $cartItem['product']->getPrice() * $cartItem['cart']->getCartid();?>zł</p>
