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
