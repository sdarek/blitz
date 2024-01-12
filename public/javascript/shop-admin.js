
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
const addProductButton = document.getElementById('addProductButton');
const addProductForm = document.getElementById('addProductForm');
addProductButton.addEventListener('click', function () {

    const isFormVisible = addProductForm.style.display === 'block';
    addProductForm.style.display = isFormVisible ? 'none' : 'block';
});


function addProduct() {
    // Tutaj możesz dodać kod obsługujący dodawanie produktu
    // Pobierz dane z formularza: productName, productPrice, productDescription, productCategory, newCategoryName
    // Wyślij te dane do serwera lub przetwórz w dowolny sposób
    // Następnie możesz ukryć formularz lub wyczyścić pola
    // Na potrzeby przykładu, ukryję formularz
    document.getElementById('addProductForm').style.display = 'none';
}