const currentPasswordInput = $(`input[name="current-password"]`)[0];
const currentPasswordFeedback = $(`input[name="current-password"] ~ .invalid-feedback`)[0];

const newPasswordInput = $(`input[name="new-password"]`)[0];
const newPasswordFeedback = $(`input[name="new-password"] ~ .invalid-feedback`)[0];

const passwordCheckInput = $(`input[name="password-check"]`)[0];
const passwordCheckFeedback = $(`input[name="password-check"] ~ .invalid-feedback`)[0];

const passwordInput = $(`input[name="user[password]"]`)[0];
const passwordFeedback = $(`input[name="user[password]"] ~ .invalid-feedback`)[0];

if (passwordInput && passwordFeedback) {
    const input = passwordInput;
    const feedback = passwordFeedback;

    hangOnFocusout(input, feedback);
    dispatchOnFocusout(input);

    input.addEventListener('input', () =>
    {
        validateOnInputPasswordInput(input, feedback);
    });

    hangOnKeydown(input, feedback);
}

if (currentPasswordInput && currentPasswordFeedback) {
    hangOnFocusout(currentPasswordInput, currentPasswordFeedback);
    dispatchOnFocusout(currentPasswordInput);
}

if ((newPasswordInput && newPasswordFeedback) &&
    (passwordCheckInput && passwordCheckFeedback)) {
    hangOnFocusout(newPasswordInput, newPasswordFeedback);
    dispatchOnFocusout(newPasswordInput);

    hangOnKeydown(newPasswordInput, newPasswordFeedback);

    newPasswordInput.addEventListener('input', () =>
    {
        passwordCheckInput.setAttribute('pattern', newPasswordInput.value);
        dispatchOnInput(passwordCheckInput);

        validateOnInputPasswordInput(newPasswordInput, newPasswordFeedback);
    });


    hangOnFocusout(passwordCheckInput, passwordCheckFeedback);
    dispatchOnFocusout(passwordCheckInput);

    passwordCheckInput.addEventListener('input', () =>
    {
        if (
            !newPasswordInput.validity.valueMissing &&
            passwordCheckInput.validity.patternMismatch
        ) {
            passwordCheckFeedback.childNodes[0].nodeValue = 'Пароли не совпадают.';
        }
    });
}

function hangOnFocusout(input, feedback)
{
    input.addEventListener('focusout', () =>
    {
        if (input.validity.valueMissing) {
            feedback.childNodes[0].nodeValue = 'Поле не должно оставаться пустым.';
        }
    });
}

function hangOnKeydown(input, feedback)
{
    input.addEventListener('keydown', () =>
    {
        const maxlength = parseInt(input.getAttribute('maxlength'));

        if (input.value.length >= maxlength) {
            feedback.childNodes[0].nodeValue = `Максимальная длина - ${maxlength}.`;
        }
    });
}

function dispatchOnFocusout(input)
{
    input.dispatchEvent(new Event('focusout'));
}

function dispatchOnInput(input)
{
    input.dispatchEvent(new Event('input'));
}

function validateOnInputPasswordInput(input, feedback)
{
    const minlength = input.getAttribute('minlength');
    const maxlength = input.getAttribute('maxlength');

    if (input.validity.tooShort) {
        feedback.childNodes[0].nodeValue = `Минимальная длина - ${minlength}.`;
    } else if (input.validity.tooLong) {
        feedback.childNodes[0].nodeValue = `Максимальная длина - ${maxlength}.`;
    } else if (input.validity.patternMismatch) {
        feedback.childNodes[0].nodeValue = 'Введённый пароль слишком лёгкий.';
    }
}
