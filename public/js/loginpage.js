document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('register-password');
    const passwordConfirmationField = document.getElementById('register-password2');
    const submitButton = document.getElementById('register-submit');
    const warningAlert = document.getElementById('warning-alert');

    function setCustomValidity(field, message) {
        field.setCustomValidity(message);
        return field.checkValidity();
    }

    function validatePassword() {
        const password = passwordField.value;
        const passwordConfirmation = passwordConfirmationField.value;

        const minLength = 8;
        const requirements = [
            { regex: /[A-Z]/, message: 'Password must contain at least one uppercase letter.' },
            { regex: /[a-z]/, message: 'Password must contain at least one lowercase letter.' },
            { regex: /[0-9]/, message: 'Password must contain at least one number.' }
        ];

        let isValid = true;

        if (password.length < minLength) {
            isValid = setCustomValidity(passwordField, 'Password must be at least ' + minLength + ' characters long.');
        }

        requirements.forEach(function(requirement) {
            if (!requirement.regex.test(password)) {
                isValid = setCustomValidity(passwordField, requirement.message);
            }
        });

        if (password !== passwordConfirmation) {
            isValid = setCustomValidity(passwordConfirmationField, 'Passwords do not match.');
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
