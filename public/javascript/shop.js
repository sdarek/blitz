
// Pobranie elementu i dodanie obsługi zdarzenia
const logoContainer = document.getElementById('shop-logo');

logoContainer.addEventListener('click', () => {
    document.querySelector('#shop').classList.add('page-leave-active');
    setTimeout(() => {
        window.location.href = 'home';
    }, 300);
});
document.addEventListener('DOMContentLoaded', function () {
    let categorySelect = document.getElementById('productCategory');
    let newCategory = document.getElementById('newCategory');

    categorySelect.addEventListener('change', function () {
        if (categorySelect.value === 'newCategory') {
            newCategory.style.display = 'block';
        } else {
            newCategory.style.display = 'none';
        }
    });
});
// Pobranie wszystkich linków do podkategorii
const subcategoryLinks = document.querySelectorAll('.category ul ul a');

// Pobranie miejsca, w którym produkty zostaną wyświetlone
const productList = document.getElementById('product-sections');

// Obsługa kliknięcia na linki podkategorii
subcategoryLinks.forEach(link => {
    link.addEventListener('click', event => {
        event.preventDefault();

        // Pobranie identyfikatora kategorii z atrybutu data-category-id
        const categoryId = link.getAttribute('data-category-id');

        // Tutaj możesz wykonać odpowiednie zapytanie do serwera lub użyć zdefiniowanych danych
        // w zależności od categoryId, aby pobrać produkty z danej kategorii.

        // Następnie wyświetl produkty na stronie w miejscu przeznaczonym dla nich.
        // Przykład: Wstawienie przykładowego tekstu na potrzeby demonstracji.
        productList.innerHTML = `<p>Wybrane produkty z kategorii ${categoryId}</p>`;
    });
});

// dodawanie produktu
document.getElementById('addProductButton').addEventListener('click', function () {
    document.getElementById('addProductForm').style.display = 'block';
});

function addProduct() {
    // Tutaj możesz dodać kod obsługujący dodawanie produktu
    // Pobierz dane z formularza: productName, productPrice, productDescription, productCategory, newCategoryName
    // Wyślij te dane do serwera lub przetwórz w dowolny sposób
    // Następnie możesz ukryć formularz lub wyczyścić pola
    // Na potrzeby przykładu, ukryję formularz
    document.getElementById('addProductForm').style.display = 'none';
}

