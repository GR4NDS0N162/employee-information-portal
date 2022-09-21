const positionInput = $(`select[name="positionId"]`)[0];
const positionFeedback = $(`select[name="positionId"] ~ .invalid-feedback`)[0];

hangOnFocusout(positionInput, positionFeedback);

const emailInputs = $(`input[name="email"]`);

for (const input of emailInputs) {
    const feedback = input.nextSibling.nextSibling;

    hangOnFocusout(input, feedback);

    input.addEventListener('input', function ()
    {
        if (input.validity.patternMismatch) {
            feedback.childNodes[0].nodeValue = 'The entered value is not an email address.';
        }
    });
}

for (const field of $(`input, select`)) {
    dispatchOnFocusout(field);
}
