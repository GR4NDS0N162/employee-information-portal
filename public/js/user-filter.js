const formSelector = $('#AdminFilterForm');
const sort = $(`#sort`);
const page = $(`#page`);

function getData()
{
    return {
        where: formSelector.serialize(),
        page: page[0].value || 1,
        order: sort[0].value || 'fullname',
    };
}

formSelector[0].addEventListener('submit', (e) =>
{
    e.preventDefault();
    page.value = 1;
    updateContent('where');
});