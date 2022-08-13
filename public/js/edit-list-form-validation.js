if ($('#edit-email-form')[0]) {
    calculateIndex('edit-email-form');

    for (let item of $('#edit-email-form .item')) {
        hangHandlers(item);
    }
}

const listObserver = new MutationObserver(function (mutationsList)
{
    for (let mutation of mutationsList) {
        if (mutation.type === 'childList') {
            for (let addedNode of mutation.addedNodes) {
                if (addedNode.nodeName === '#text')
                    continue;

                if (addedNode.classList.contains('item'))
                    hangHandlers(addedNode);
            }
        }
    }
});

function hangHandlers(item)
{
    let input = item.childNodes[1].childNodes[1];
    let feedback = item.childNodes[1].childNodes[3];
    let button = item.childNodes[1].childNodes[5];

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

    let patternValidationMessage = validationMap[input.className.match(/validation[-a-z]+/)[0]];

    if (patternValidationMessage)
        input.addEventListener('input', function ()
        {
            if (input.validity.patternMismatch) {
                feedback.childNodes[0].nodeValue = patternValidationMessage;
            }
        });

    input.dispatchEvent(new Event('focusout'));
}

for (let list of $(`form .collection-list`)) {
    listObserver.observe(list, {
        subtree: true,
        childList: true,
        attributes: true,
        attributeOldValue: true,
        characterData: true,
        characterDataOldValue: true,
    });

    let form = list.closest('form');

    form.addEventListener('submit', function (e)
    {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }

        form.classList.add('was-validated');
    }, false);
}
