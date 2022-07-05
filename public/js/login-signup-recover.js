$('.signup-show').click(function ()
{
    $('#signup-card').show();
    $('#login-card').hide();
});

$('.recover-show').click(function ()
{
    $('#recover-card').show();
    $('#login-card').hide();
});

$('.login-show').click(function ()
{
    $('#login-card').show();
    $('#signup-card').hide();
    $('#recover-card').hide();
});

const login_form = document.getElementById('login-form');
const email_field_login = document.getElementById('email-field-login');
const email_error_login = document.getElementById('email-error-login');
const password_field_login = document.getElementById('password-field-login');
const password_error_login = document.getElementById('password-error-login');

const signup_form = document.getElementById('signup-form');
const email_field_signup = document.getElementById('email-field-signup');
const email_error_signup = document.getElementById('email-error-signup');
const position_field_signup = document.getElementById('position-field-signup');
const position_error_signup = document.getElementById('position-error-signup');
const password_field_signup = document.getElementById('password-field-signup');
const password_error_signup = document.getElementById('password-error-signup');
const password_check_field_signup = document.getElementById('password-check-field-signup');
const password_check_error_signup = document.getElementById('password-check-error-signup');

const recover_form = document.getElementById('recover-form');
const email_field_recover = document.getElementById('email-field-recover');
const email_error_recover = document.getElementById('email-error-recover');

const validationEventType = 'input';

email_field_login.addEventListener(validationEventType, function (event)
{
    updateError(email_field_login, email_error_login,
        email_field_login.validity.valueMissing, 'Необходимо ввести адрес электронной почты.',
        email_field_login.validity.patternMismatch, 'Введенное значение должно быть адресом электронной почты.');
});

password_field_login.addEventListener(validationEventType, function (event)
{
    updateError(password_field_login, password_error_login,
        password_field_login.validity.valueMissing, 'Необходимо ввести пароль.');
});

login_form.addEventListener('submit', function (event)
{
    validateForm(event, login_form,
        email_field_login, password_field_login);
});

email_field_signup.addEventListener(validationEventType, function (event)
{
    updateError(email_field_signup, email_error_signup,
        email_field_signup.validity.valueMissing, 'Необходимо ввести адрес электронной почты.',
        email_field_signup.validity.patternMismatch, 'Введенное значение должно быть адресом электронной почты.');
});

position_field_signup.addEventListener(validationEventType, function (event)
{
    updateError(position_field_signup, position_error_signup,
        position_field_signup.validity.valueMissing, 'Необходимо выбрать должность.');
});

password_field_signup.addEventListener(validationEventType, function (event)
{
    password_check_field_signup.setAttribute('pattern', password_field_signup.value);
    updateError(password_field_signup, password_error_signup,
        password_field_signup.validity.valueMissing, 'Необходимо ввести пароль.',
        password_field_signup.validity.patternMismatch, 'Введённый пароль слишком лёгкий.<br>' +
        'Введённый пароль должен удовлетворять условиям:<br>' +
        '- Цифра должна встречаться хотя бы один раз<br>' +
        '- Строчная буква должна встречаться хотя бы один раз<br>' +
        '- Заглавная буква должна встречаться хотя бы один раз<br>' +
        '- Специальный символ должен встречаться хотя бы один раз (@#$%^&+=)<br>' +
        '- Не допускаются пробелы<br>' +
        '- Количество символов - от 8 до 32)');
    updateError(password_check_field_signup, password_check_error_signup,
        !password_check_field_signup.validity.valueMissing &&
        password_check_field_signup.validity.patternMismatch, 'Пароли не совпадают.');
});

password_check_field_signup.addEventListener(validationEventType, function (event)
{
    updateError(password_check_field_signup, password_check_error_signup,
        password_check_field_signup.validity.valueMissing, 'Необходимо подтвердить пароль.',
        password_check_field_signup.validity.patternMismatch, 'Пароли не совпадают.');
});

signup_form.addEventListener('submit', function (event)
{
    validateForm(event, signup_form,
        email_field_signup, position_field_signup, password_field_signup, password_check_field_signup);
});

email_field_recover.addEventListener(validationEventType, function (event)
{
    updateError(email_field_recover, email_error_recover,
        email_field_recover.validity.valueMissing, 'Необходимо ввести адрес электронной почты.',
        email_field_recover.validity.patternMismatch, 'Введенное значение должно быть адресом электронной почты.');
});

recover_form.addEventListener('submit', function (event)
{
    validateForm(event, recover_form,
        email_field_recover);
});
