const logoContainer = document.getElementById('shop-logo');

logoContainer.addEventListener('click', () => {
    document.querySelector('#shop').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'home';
    }, 300);
});

const search = document.querySelector('input[placeholder="Wyszukaj..."]');
const productContainer = document.querySelector('.product-carousel');
search.addEventListener("keyup", function(event) {
    if(event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};
        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function(response) {
            return response.json();
        }).then(function(products) {
            productContainer.innerHTML = "";
            productContainer.innerHTML = '<div id="message-container"><p>mhm</p></div>'
            loadProducts(products);
        });
    }
});

function loadProducts(products) {
    products.forEach(product => {
        // console.log(product);
        createProduct(product);
    })
}

function createProduct(product) {
    const template = document.querySelector("#product-template");
    const clone = template.content.cloneNode(true);
    const image = clone.querySelector("img");
    image.src = `/public/uploads/${product.image}`;

    const name = clone.querySelector("h3");
    name.innerHTML = product.productname;

    const description = clone.querySelector(".description");
    description.innerHTML = product.description;

    const productPrice = clone.querySelector(".product-price");
    productPrice.innerHTML = "Cena: " + product.price + 'zł';

    const divProductId = clone.querySelector(".add-to-cart");
    divProductId.setAttribute("product_id", product.productid);
    console.log(divProductId.getAttribute("product_id"))

    productContainer.appendChild(clone);
}


const categoryLinks = document.querySelectorAll('.category li a');
const productHeader = document.querySelector('.product-header');
categoryLinks.forEach(link => {
    link.addEventListener('click', event => {
        event.preventDefault();
        const categoryId = link.getAttribute('data-category-id');
        const categoryName = link.innerText;
        // Wywołaj fetch
        fetch(`/searchByCategory/${categoryId}`, {
            method: "GET"
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Błąd HTTP: ${response.status}`);
                }
                return response.json();
            })
            .then(products => {
                productContainer.innerHTML = "";
                productHeader.innerHTML = categoryName.toUpperCase();
                loadProducts(products);
            })
            .catch(error => {
                console.error("Błąd pobierania produktów:", error);
            });
    });
});



const messageDiv = document.getElementById('message-container');
productContainer.addEventListener('click', function(event) {
    const target = event.target;

    // Szukaj rodzica .add-to-cart, który zawiera kliknięty przycisk
    const div = target.closest('.add-to-cart');
    console.log(target);
    if (div && target.classList.contains('add-to-cart-button')) {
        const button = div.querySelector('button');
        const input = div.querySelector('input');
        const productId = div.getAttribute('product_id');
        const quantity = input.value;

        console.log(productId + " " + quantity);

        fetch(`/addToCart/${productId}/${quantity}`, {
            method: "POST"
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Błąd HTTP: ${response.status}`);
                }
                return response.json();
            })
            .then(response => {
                displayMessage('Dodano produkt do koszyka!');
                console.log(response[0].getCustomerId());
            })
            .catch(error => {
                console.error("Błąd dodawania do koszyka:", error);
            });
    }
});

function displayMessage(message) {
    const messageParagraph = messageDiv.querySelector('p');
    messageParagraph.innerText = message;
    messageDiv.style.display = 'block';
    console.log(messageDiv.style.display);

    // Schowaj komunikat po pewnym czasie (np. 3 sekundy)
    setTimeout(() => {
        messageDiv.style.display = 'none';
    }, 2000);
}