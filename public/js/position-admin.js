const new_position_form = document.getElementById('new-position-form');
const new_position_input = document.getElementById('new-position-input');
const new_position_submit = document.getElementById('new-position-submit');
const new_position_error = document.getElementById('new-position-error');
const positions = document.getElementById('positions');

const validationEventType = 'input';

new_position_input.addEventListener(validationEventType, function (event)
{
    updateError(new_position_input, new_position_error,
        new_position_input.validity.valueMissing, 'Необходимо ввести электронную почту.');
});

new_position_form.addEventListener('submit', function (event)
{
    event.preventDefault();
    new_position_submit.blur();

    if (!new_position_input.validity.valid) {
        new_position_input.focus();
        return;
    }

    const position_el = document.createElement('div');
    const position_row_el = document.createElement('div');
    const position_content_el = document.createElement('div');
    const position_input_el = document.createElement('input');
    const position_actions_el = document.createElement('div');
    const position_edit_el = document.createElement('button');
    const position_delete_el = document.createElement('button');
    const position_error_el = document.createElement('div');

    position_el.appendChild(position_row_el);

    position_row_el.appendChild(position_content_el);
    position_row_el.appendChild(position_actions_el);
    position_row_el.appendChild(position_error_el);

    position_content_el.appendChild(position_input_el);
    position_actions_el.appendChild(position_edit_el);
    position_actions_el.appendChild(position_delete_el);

    position_el.classList.add('col-12');
    position_row_el.classList.add('row', 'gx-3');
    position_content_el.classList.add('col');
    position_actions_el.classList.add('col-auto', 'btn-group');
    position_error_el.classList.add('col-12', 'invalid-feedback', 'd-none');
    position_input_el.classList.add('form-control', 'position-input');
    position_edit_el.classList.add('btn', 'btn-outline-warning');
    position_delete_el.classList.add('btn', 'btn-outline-danger');

    position_input_el.type = 'tel';
    position_input_el.value = new_position_input.value;
    position_input_el.setAttribute('readonly', 'readonly');
    position_input_el.setAttribute('required', 'required');

    position_edit_el.type = 'button';
    position_edit_el.innerText = 'Edit';

    position_delete_el.type = 'button';
    position_delete_el.innerText = 'Del';

    positions.appendChild(position_el);

    new_position_input.value = '';

    position_input_el.addEventListener(validationEventType, function (event)
    {
        updateError(position_input_el, position_error_el,
            position_input_el.validity.valueMissing, 'Нельзя оставлять поле пустым.',);
    });

    position_edit_el.addEventListener('click', function (event)
    {
        if (position_edit_el.innerText.toLowerCase() == 'edit') {
            position_input_el.removeAttribute('readonly');
            position_input_el.focus();
            position_edit_el.classList.replace('btn-outline-warning', 'btn-outline-success');
            position_edit_el.innerText = 'Save';
        } else if (position_input_el.validity.valid) {
            position_input_el.setAttribute('readonly', 'readonly');
            position_edit_el.classList.replace('btn-outline-success', 'btn-outline-warning');
            position_edit_el.innerText = 'Edit';
            position_edit_el.blur();
        }
    });

    position_delete_el.addEventListener('click', function (event)
    {
        positions.removeChild(position_el);
    });
});

const position_form_error = document.getElementById('position-form-error');

positions.addEventListener('submit', function (event)
{
    let isFormValid = true;
    $('.position-input').each(function ()
    {
        let attr = $(this).attr('readonly');
        isFormValid = isFormValid && (typeof attr !== 'undefined' && attr !== false);
    });
    if (isFormValid) {
        hideError(position_form_error);
    } else {
        event.preventDefault();
        position_form_error.innerHTML = 'Все поля должны быть сохранены.';
        position_form_error.classList.replace('d-none', 'd-block');
    }
});
