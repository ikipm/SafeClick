document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('register-password');
    const passwordConfirmationField = document.getElementById('register-password2');
    const submitButton = document.getElementById('register-submit');
    const warningAlert = document.getElementById('warning-alert-r');

    function setCustomValidity(field, message) {
        field.setCustomValidity(message);
        return field.checkValidity();
    }

    function validatePassword() {
        Lang.setLocale(currentLocale);

        const password = passwordField.value;
        const passwordConfirmation = passwordConfirmationField.value;

        const minLength = 8;
        const requirements = [
            { regex: /[A-Z]/, message: Lang.get("loginPage.passwordUpper") },
            { regex: /[a-z]/, message: Lang.get("loginPage.passwordLower") },
            { regex: /[0-9]/, message: Lang.get("loginPage.passwordNumbers") }
        ];

        let isValid = true;

        if (password.length < minLength) {
            isValid = setCustomValidity(passwordField, Lang.get('loginPage.passwordLong', { characters: minLength }));
        }

        requirements.forEach(function(requirement) {
            if (!requirement.regex.test(password)) {
                isValid = setCustomValidity(passwordField, requirement.message);
            }
        });

        if (password !== passwordConfirmation) {
            isValid = setCustomValidity(passwordConfirmationField, Lang.get("loginPage.passwordMatch"));
        }

        if (isValid) {
            document.forms[0].submit();
        } else {
            warningAlert.style.display = 'block';
            warningAlert.textContent = passwordField.validationMessage || passwordConfirmationField.validationMessage;
        }
    }

    submitButton.addEventListener('click', function(event) {
        event.preventDefault();
        validatePassword();
    });
});
