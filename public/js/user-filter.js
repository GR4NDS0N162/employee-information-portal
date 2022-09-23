const formSelector = $('#AdminFilterForm, #UserFilterForm');
const sortSelector = $(`#sort`);
const pageSelector = $(`#page`);
const shownEl = $(`#shown`)[0];

let oldWhere = formSelector.serialize();
let count;
let maxPageCount;

formSelector[0].addEventListener('submit', (e) =>
{
    e.preventDefault();

    oldWhere = formSelector.serialize();

    console.log(getData(true));

    $.ajax({
        url: '/admin/list/get',
        method: 'post',
        dataType: 'html',
        async: false,
        data: getData(true),
    }).done((data) =>
    {
        pageSelector.html(data);
    });

    updateContent();
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
    };

    if (updatePage) {
        data.updatePage = true;
    }

    return data;
}

function updateContent()
{
    console.log(getData());

    $.ajax({
        url: '/admin/list/get',
        method: 'post',
        dataType: 'html',
        data: getData(),
    }).done((data) =>
    {
        $(`#user-list`).html(data);
    });
}