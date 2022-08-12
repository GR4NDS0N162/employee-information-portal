function add_item(button)
{
    let formId = button.closest('form').getAttribute('id');
    let container = $(`#${formId} .collection-list`);
    let template = $(`#${formId} .collection-list span`).data('template');

    if (!container[0].hasAttribute('current-index'))
        calculateIndex(formId);

    let currentIndex = parseInt(container[0].getAttribute('current-index'));
    container.append(template.replace(/__index__/g, currentIndex));

    container[0].setAttribute('current-index', ++currentIndex);
}

function calculateIndex(...formsId)
{
    for (let formId of formsId) {
        let lastInput = $(`#${formId} .collection-list > .item:last-child input`)[0];
        let currentIndex = (!lastInput) ? 0 : parseInt(lastInput.getAttribute('name').match(/\d+(?=])/)[0]) + 1;
        $(`#${formId} .collection-list`)[0].setAttribute('current-index', currentIndex);
    }
}

const cantBeEmpty = ['edit-email-form'];

function delete_item(button)
{
    let formId = button.closest('form').getAttribute('id');
    let currentCount = $(`#${formId} .collection-list .item`).length;

    if (!(currentCount === 1 && cantBeEmpty.indexOf(formId) !== -1))
        button.closest('.item').remove();
    else {
        let container = $(`#${formId} .collection-list`);
        let feedback = button.previousSibling.previousSibling;
        let input = feedback.previousSibling.previousSibling;

        feedback.childNodes[0].nodeValue = 'Этот список не может быть пустым.';

        if (!container[0].hasAttribute('current-index'))
            calculateIndex(formId);

        let currentIndex = parseInt(container[0].getAttribute('current-index'));

        input.value = '';
        input.setAttribute('name', `list[${currentIndex}]`);

        container[0].setAttribute('current-index', ++currentIndex);
    }
}
