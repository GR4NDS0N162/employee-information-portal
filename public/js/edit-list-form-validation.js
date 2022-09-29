const listObserver = new MutationObserver(function (mutationsList)
{
    for (let mutation of mutationsList) {
        if (mutation.type === 'childList') {
            for (let addedNode of mutation.addedNodes) {
                if (addedNode.nodeName !== '#text')
                    hangHandlers(addedNode);
            }
        }
    }
});

function hangHandlers(item)
{
    const input = item.childNodes[0].childNodes[1];
    const feedback = item.childNodes[0].childNodes[3];
    const button = item.childNodes[0].childNodes[5];

    hangOnFocusout(input, feedback);
    button.addEventListener('focusout', () =>
    {
        input.classList.remove('is-invalid');

        dispatchOnFocusout(input);
        dispatchOnInput(input);
    });


    const validationMap = {
        'validation-pattern-email': 'The entered value is not an email address.',
        'validation-pattern-phone': 'The entered value is not a phone.',
    };

    const possibleAdditionalValidation = input.className.match(/validation[-a-z]+/);

    if (possibleAdditionalValidation) {
        const patternValidationMessage = validationMap[possibleAdditionalValidation[0]];

        input.addEventListener('input', () =>
        {
            if (input.validity.patternMismatch) {
                feedback.childNodes[0].nodeValue = patternValidationMessage;
            }
        });
    }

    dispatchOnInput(input);
    dispatchOnFocusout(input);
}

for (const item of $(`[current-index] > div[class!="notification"]`)) {
    hangHandlers(item);
}

for (const list of $(`[current-index]`)) {
    listObserver.observe(list, {
        subtree: true,
        childList: true,
        attributes: true,
        attributeOldValue: true,
        characterData: true,
        characterDataOldValue: true,
    });
}
