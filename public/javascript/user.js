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

