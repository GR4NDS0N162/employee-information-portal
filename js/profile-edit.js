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

const new_phone_form = document.getElementById('new-phone-form');
const new_phone_input = document.getElementById('new-phone-input');
const new_phone_submit = document.getElementById('new-phone-submit');
const new_phone_error = document.getElementById('new-phone-error');
const phones = document.getElementById('phones');

const phonePattern = '^\\+7([0-9]){10}$';
new_phone_input.setAttribute("pattern", phonePattern);

new_phone_input.addEventListener(validationEventType, function (event)
{
    updateError(new_phone_input, new_phone_error,
        new_phone_input.validity.valueMissing, 'Необходимо ввести телефонный номер.',
        new_phone_input.validity.patternMismatch, 'Введённая строка - не телефон');
});

new_phone_form.addEventListener('submit', function (event)
{
    event.preventDefault();
    new_phone_submit.blur();

    if (!new_phone_input.validity.valid) {
        new_phone_input.focus();
        return;
    }

    const phone_el = document.createElement('div');
    const phone_row_el = document.createElement('div');
    const phone_content_el = document.createElement('div');
    const phone_input_el = document.createElement('input');
    const phone_actions_el = document.createElement('div');
    const phone_edit_el = document.createElement('button');
    const phone_delete_el = document.createElement('button');
    const phone_error_el = document.createElement('div');

    phone_el.appendChild(phone_row_el);

    phone_row_el.appendChild(phone_content_el);
    phone_row_el.appendChild(phone_actions_el);
    phone_row_el.appendChild(phone_error_el);

    phone_content_el.appendChild(phone_input_el);
    phone_actions_el.appendChild(phone_edit_el);
    phone_actions_el.appendChild(phone_delete_el);

    phone_el.classList.add('col-12');
    phone_row_el.classList.add('row', 'gx-3');
    phone_content_el.classList.add('col');
    phone_actions_el.classList.add('col-auto', 'btn-group');
    phone_error_el.classList.add('col-12', 'invalid-feedback', 'd-none');
    phone_input_el.classList.add('form-control');
    phone_edit_el.classList.add('btn', 'btn-outline-warning');
    phone_delete_el.classList.add('btn', 'btn-outline-danger');

    phone_input_el.type = 'tel';
    phone_input_el.value = new_phone_input.value;
    phone_input_el.setAttribute('readonly', 'readonly');
    phone_input_el.setAttribute('required', 'required');
    phone_input_el.setAttribute("pattern", phonePattern);

    phone_edit_el.type = 'button';
    phone_edit_el.innerText = 'Edit';

    phone_delete_el.type = 'button';
    phone_delete_el.innerText = 'Del';

    phones.appendChild(phone_el);

    new_phone_input.value = '';

    phone_input_el.addEventListener(validationEventType, function (event)
    {
        updateError(phone_input_el, phone_error_el,
            phone_input_el.validity.valueMissing, 'Нельзя оставлять поле пустым.',
            phone_input_el.validity.patternMismatch, 'Введённая строка - не телефон');
    });

    phone_edit_el.addEventListener('click', function (event)
    {
        if (phone_edit_el.innerText.toLowerCase() == 'edit') {
            phone_input_el.removeAttribute('readonly');
            phone_input_el.focus();
            phone_edit_el.classList.replace('btn-outline-warning', 'btn-outline-success');
            phone_edit_el.innerText = 'Save';
        } else if (phone_input_el.validity.valid) {
            phone_input_el.setAttribute('readonly', 'readonly');
            phone_edit_el.classList.replace('btn-outline-success', 'btn-outline-warning');
            phone_edit_el.innerText = 'Edit';
            phone_edit_el.blur();
        }
    });
});
