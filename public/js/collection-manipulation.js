for (const button of $(`button[name="add"]`)) {
    button.addEventListener('click', () => add_item(button));

    let container = button.previousSibling;
    let count = container.childNodes.length;

    let currentIndex = (count <= 2) ? 0 : count - 2;

    container.setAttribute('current-index', currentIndex);
}

function add_item(button)
{
    let container = button.previousSibling;
    let template = container.childNodes[0];
    template = template.getAttribute('data-template');

    let currentIndex = container.getAttribute('current-index');
    container.appendChild(new DOMParser().parseFromString(
        template.replace(/__index__/g, currentIndex),
        "text/html").body.firstElementChild);

    container.setAttribute('current-index', parseInt(currentIndex, 10) + 1);
}

function delete_item(button)
{
    let btnName = button.getAttribute('name');
    let container = button.closest(`[current-index]`);
    let element = container.querySelector(
        `[name="${btnName.slice(0, btnName.length - '[delete]'.length)}"]`
    ).parentNode;

    if (!container.classList.contains('non-empty-collection')
        || container.childElementCount > 3) {
        container.removeChild(element);
    } else {
        // TODO: Обработать попытку очистки не пустой коллекции.
    }
}
