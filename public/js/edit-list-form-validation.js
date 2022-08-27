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
    let input = item.childNodes[0].childNodes[1];
    let feedback = item.childNodes[0].childNodes[3];
    let button = item.childNodes[0].childNodes[5];

    input.addEventListener('focusout', function ()
    {
        if (input.validity.valueMissing) {
            feedback.childNodes[0].nodeValue = 'Поле не должно оставаться пустым.';
        }
    });

    button.addEventListener('focusout', () => input.dispatchEvent(new Event('focusout')));

    let validationMap = {
        'validation-pattern-email': 'Введённое значение - не электронный адрес.',
        'validation-pattern-phone': 'Введённое значение - не телефон.',
    };

    let possibleAdditionalValidation = input.className.match(/validation[-a-z]+/);

    if (possibleAdditionalValidation) {
        let patternValidationMessage = validationMap[possibleAdditionalValidation[0]];

        input.addEventListener('input', function ()
        {
            if (input.validity.patternMismatch) {
                feedback.childNodes[0].nodeValue = patternValidationMessage;
            }
        });
    }

    input.dispatchEvent(new Event('input'));
    input.dispatchEvent(new Event('focusout'));
}

for (let item of $(`[current-index] > div[class!="notification"]`)) {
    hangHandlers(item);
}

for (let list of $(`[current-index]`)) {
    listObserver.observe(list, {
        subtree: true,
        childList: true,
        attributes: true,
        attributeOldValue: true,
        characterData: true,
        characterDataOldValue: true,
    });
}
