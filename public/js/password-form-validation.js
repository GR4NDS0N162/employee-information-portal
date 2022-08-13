const currentPasswordInput = $(`input[name="current-password"]`)[0];
const currentPasswordFeedback = $(`input[name="current-password"] ~ .invalid-feedback`)[0];

const newPasswordInput = $(`input[name="new-password"]`)[0];
const newPasswordFeedback = $(`input[name="new-password"] ~ .invalid-feedback`)[0];

const passwordCheckInput = $(`input[name="password-check"]`)[0];
const passwordCheckFeedback = $(`input[name="password-check"] ~ .invalid-feedback`)[0];

currentPasswordInput.addEventListener('focusout', function (e)
{
    onFocusout(currentPasswordInput, currentPasswordFeedback);
});

newPasswordInput.addEventListener('focusout', function (e)
{
    onFocusout(newPasswordInput, newPasswordFeedback);
});

passwordCheckInput.addEventListener('focusout', function (e)
{
    onFocusout(passwordCheckInput, passwordCheckFeedback);
});

function onFocusout(input, feedback)
{
    if (input.validity.valueMissing) {
        feedback.childNodes[0].nodeValue = 'Поле не должно оставаться пустым.';
    }
}

currentPasswordInput.dispatchEvent(new Event('focusout'));
newPasswordInput.dispatchEvent(new Event('focusout'));
passwordCheckInput.dispatchEvent(new Event('focusout'));

newPasswordInput.addEventListener('input', function (e)
{
    passwordCheckInput.setAttribute('pattern', newPasswordInput.value);
    passwordCheckInput.dispatchEvent(new Event('input'));

    let minlength = newPasswordInput.getAttribute('minlength');
    let maxlength = newPasswordInput.getAttribute('maxlength');

    if (newPasswordInput.validity.tooShort) {
        newPasswordFeedback.childNodes[0].nodeValue = `Минимальная длина - ${minlength}.`;
    } else if (newPasswordInput.validity.tooLong) {
        newPasswordFeedback.childNodes[0].nodeValue = `Максимальная длина - ${maxlength}.`;
    } else if (newPasswordInput.validity.patternMismatch) {
        newPasswordFeedback.childNodes[0].nodeValue = 'Введённый пароль слишком лёгкий.';
    }
});

newPasswordInput.addEventListener('keydown', function (e)
{
    let maxlength = parseInt(newPasswordInput.getAttribute('maxlength'));

    if (newPasswordInput.value.length >= maxlength) {
        newPasswordFeedback.childNodes[0].nodeValue = `Максимальная длина - ${maxlength}.`;
    }
});

passwordCheckInput.addEventListener('input', function (e)
{
    if (!newPasswordInput.validity.valueMissing &&
        passwordCheckInput.validity.patternMismatch) {
        passwordCheckFeedback.childNodes[0].nodeValue = 'Пароли не совпадают.';
    }
});

for (let form of $(`form[name$="password-form"]`)) {
    form.addEventListener('submit', function (e)
    {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }

        form.classList.add('was-validated');
    }, false);
}
