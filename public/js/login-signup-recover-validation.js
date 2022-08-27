const positionInput = $(`select[name="position"]`)[0];
const positionFeedback = $(`select[name="position"] ~ .invalid-feedback`)[0];

positionInput.addEventListener('focusout', function (e)
{
    onFocusout(positionInput, positionFeedback);
});

const emailInputs = $(`input[name="email"]`);

for (let input of emailInputs) {
    let feedback = input.nextSibling.nextSibling;

    input.addEventListener('focusout', function (e)
    {
        onFocusout(input, feedback);
    });

    input.addEventListener('input', function ()
    {
        if (input.validity.patternMismatch) {
            feedback.childNodes[0].nodeValue = 'Введённое значение - не электронный адрес.';
        }
    });
}

for (let field of $(`input, select`))
    field.dispatchEvent(new Event('focusout'));
