const formSelector = $('#AdminFilterForm');
const sort = $(`#sort`);
const page = $(`#page`);

updateContent();

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

function updateContent()
{
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