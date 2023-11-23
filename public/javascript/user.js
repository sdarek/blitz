

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('.login-form');
    const errorPopup = document.getElementById('error-popup');
    const errorMessage = document.getElementById('error-message');
    const closeErrorPopup = document.getElementById('close-error-popup');
    
    const registerForm = document.querySelector('.register-form');
    const showRegisterLink = document.getElementById('showRegister');
    const loginContainer = document.querySelector('.login-container');
    const registerContainer = document.querySelector('.register-container');
    
    const userMenu = document.getElementById('user-menu');
    const showLogin = document.querySelector("#showLogin");
    const userIcon = document.querySelector(".user-icon");
    
        
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
    // Obsługa kliknięcia "Zarejestruj się" - przełączenie do formularza rejestracji
    showRegisterLink.addEventListener('click', function(event){
        event.preventDefault();
        registerContainer.style.display = "block";
        loginContainer.style.display = "none";
    });

    // Obsługa kliknięcia "Zaloguj się" - przełączenie do formularza logowania
    showLogin.addEventListener("click", function(event) {
        event.preventDefault()
        registerContainer.style.display = "none";
        loginContainer.style.display = "block";
    })

    // Obsługa formularza logowania
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
    // Obsługa formularza rejestracji
    registerForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(registerForm);

        fetch('register', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Tutaj możesz wykonać operacje po udanej rejestracji
                    window.location.href = 'shop'; // Przekierowanie na stronę logowania po rejestracji
                } else {
                    registerErrorMessage.textContent = data.message;
                    registerErrorPopup.style.display = 'block'; // Wyświetlenie komunikatu o błędzie rejestracji
                }
            });
    });
    // Obsługa zamknięcia komunikatu o błędzie logowania
    closeErrorPopup.addEventListener('click', function() {
        errorPopup.style.display = 'none';
    });
});

