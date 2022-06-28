const password_form = document.getElementById('password-form');
const password_current_field = document.getElementById('password-current-field');
const password_current_error = document.getElementById('password-current-error');
const password_new_field = document.getElementById('password-new-field');
const password_new_error = document.getElementById('password-new-error');
const password_check_field = document.getElementById('password-check-field');
const password_check_error = document.getElementById('password-check-error');

const validationEventType = 'input';

password_current_field.addEventListener(validationEventType, function (event)
{
    updateError(password_current_field, password_current_error,
        password_current_field.validity.valueMissing, 'Необходимо ввести текущий пароль.');
});

password_new_field.addEventListener(validationEventType, function (event)
{
    password_check_field.setAttribute('pattern', password_new_field.value);
    updateError(password_new_field, password_new_error,
        password_new_field.validity.valueMissing, 'Необходимо ввести новый пароль.',
        password_new_field.validity.patternMismatch, 'Введённый пароль слишком лёгкий.<br>' +
        'Введённый пароль должен удовлетворять условиям:<br>' +
        '- Цифра должна встречаться хотя бы один раз<br>' +
        '- Строчная буква должна встречаться хотя бы один раз<br>' +
        '- Заглавная буква должна встречаться хотя бы один раз<br>' +
        '- Специальный символ должен встречаться хотя бы один раз (@#$%^&+=)<br>' +
        '- Не допускаются пробелы<br>' +
        '- Количество символов - от 8 до 32)');
    updateError(password_check_field, password_check_error,
        !password_new_field.validity.valueMissing &&
        password_check_field.validity.patternMismatch, 'Пароли не совпадают.');
});

password_check_field.addEventListener(validationEventType, function (event)
{
    password_check_field.setAttribute('pattern', password_new_field.value);
    updateError(password_check_field, password_check_error,
        password_check_field.validity.valueMissing, 'Необходимо подтвердить пароль.',
        password_check_field.validity.patternMismatch, 'Пароли не совпадают.');
});

password_form.addEventListener('submit', function (event)
{
    validateForm(event, password_form,
        password_current_field, password_new_field, password_check_field);
});
