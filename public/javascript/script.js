const form = document.querySelector('form[action="register"]');
const registerEmailInput = form.querySelector('input[name="register-email"]');
const PasswordInput = form.querySelector('input[name="register-password"]');
const confirmedPasswordInput = form.querySelector('input[name="confirm-password"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}
function validateEmail() {
    setTimeout(function() {
        markValidation(registerEmailInput, isEmail(registerEmailInput.value));
    }, 1000);
}
function validatePassword() {
    setTimeout(function() {
        const condition = arePasswordsSame(PasswordInput.value, confirmedPasswordInput.value)
        markValidation(confirmedPasswordInput, condition);
    }, 1000);

}

registerEmailInput.addEventListener('keyup', validateEmail);
confirmedPasswordInput.addEventListener('keyup', validatePassword);