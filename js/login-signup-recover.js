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

function hideError(error)
{
    error.innerHTML = '';
    error.className = 'invalid-feedback';
}

function showError(error, warnings)
{
    for (let i = 0; i < warnings.length; ++i)
        if (warnings[i++]) {
            error.innerHTML = warnings[i];
            break;
        }
    error.className = 'invalid-feedback d-block';
}

function updateError(field, error, ...warnings)
{
    if (field.validity.valid)
        hideError(error);
    else
        showError(error, warnings);
}

function validateForm(event, form, ...fields)
{
    let isFormValid = true;
    for (let i = 0; i < fields.length; ++i) {
        isFormValid = isFormValid && fields[i].validity.valid;
        fields[i].dispatchEvent(new Event(validationEventType));
    }
    if (!isFormValid)
        event.preventDefault();
}
