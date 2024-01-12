
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