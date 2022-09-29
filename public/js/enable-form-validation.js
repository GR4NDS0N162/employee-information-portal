(function ()
{
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form)
        {
            form.addEventListener('submit', function (event)
            {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})();

function hangOnFocusout(input, feedback)
{
    input.addEventListener('focusout', () =>
    {
        if (input.validity.valueMissing) {
            feedback.childNodes[0].nodeValue = 'The field should not remain empty.';
        }
    });
}

function hangOnKeydown(input, feedback)
{
    input.addEventListener('keydown', () =>
    {
        const maxlength = parseInt(input.getAttribute('maxlength'));

        if (input.value.length >= maxlength) {
            feedback.childNodes[0].nodeValue = `Maximum length - ${maxlength}.`;
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
