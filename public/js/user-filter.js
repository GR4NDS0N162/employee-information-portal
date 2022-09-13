$.ajaxSetup({
    url: '/admin/list/get',
    method: 'post',
    dataType: 'html',
});

let options = {};

updateContent();

$(`#page`)[0].addEventListener('change', () =>
{
    updateContent();
});

$(`#sort`)[0].addEventListener('change', () =>
{
    updateContent();
});

function updateContent(type = 'all')
{
    $.ajax({
        data: {
            form: $('#AdminFilterForm').serializeArray(),
            type: type,
        },
    }).done((data) =>
    {
        $(`#user-list`).html(data);
    });
}
