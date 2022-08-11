function add_item(button)
{
    let formId = button.closest('form').getAttribute('id');
    let template = $(`#${formId} > div > div > span`).data('template');
    let container = $(`#${formId} > div > [name="list"]`);

    let lastInput = $(`#${formId} > div > [name="list"] > .item > div > input`).last()[0];
    let newIndex = (lastInput) ? parseInt(lastInput.getAttribute('name').match(/[0-9]+(?=])/)[0]) + 1 : 0;
    container.append(template.replace(/__index__/g, newIndex));

    $(`#${formId} > div > [name="list"] > .item:last-child > div > input`).focus();
}

function delete_item(button)
{
    let formId = button.closest('form').getAttribute('id');
    let currentCount = $(`#${formId} > div > div > .item`).length;

    if (!(currentCount === 1 && formId === 'edit-email-form'))
        button.closest('.item').remove();
}
