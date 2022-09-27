const formSelector = $('#AdminFilterForm, #UserFilterForm');
const sortSelector = $(`#sort`);
const pageSelector = $(`#page`);
const shownEl = $(`#shown`)[0];
const listSelector = $(`#user-list`);
const isAdminPage = formSelector[0].getAttribute('name') === 'AdminFilterForm';

let oldWhere = formSelector.serialize();
let count;
let maxPageCount;

formSelector[0].addEventListener('submit', (e) =>
{
    e.preventDefault();

    oldWhere = formSelector.serialize();

    updateContent(true);
});

pageSelector[0].addEventListener('change', () =>
{
    updateContent();
});

sortSelector[0].addEventListener('change', () =>
{
    updateContent();
});

formSelector[0].dispatchEvent(new Event('submit'));

function getData(updatePage = false)
{
    let data = {
        where: oldWhere,
        page: pageSelector[0].value || 1,
        order: sortSelector[0].value || 'fullname',
        formName: formSelector[0].getAttribute('name'),
    };

    if (updatePage) {
        data.updatePage = true;
    }

    return data;
}

function updateContent(updatePage = false)
{
    $.ajax({
        url: '/admin/list/get',
        method: 'post',
        dataType: 'html',
        data: getData(updatePage),
    }).done((data) =>
    {
        $(`#user-list`).html(data);
    });
}