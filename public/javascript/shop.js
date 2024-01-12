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

    const dataProductId = clone.querySelector("button");
    dataProductId.setAttribute("data-product-id", product.productid);

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


const addToCartButtons = document.querySelectorAll('.add-to-cart-button');

addToCartButtons.forEach(button => {
    button.addEventListener('click', function () {
        const productId = button.getAttribute('data-product-id');

        // Tutaj możesz dodać logikę dodawania produktu do koszyka
        console.log(`Dodano produkt o ID ${productId} do koszyka.`);
    });
});
