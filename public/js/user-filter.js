$.ajaxSetup({
    url: '/admin/list/get',
    method: 'post',
    dataType: 'html',
});

let options = {};

const pageSelect = $(`#page`)[0];

options['page'] = pageSelect.value;
updateContent();

pageSelect.addEventListener('change', () =>
{
    options['page'] = pageSelect.value;
    updateContent();
});

function updateContent()
{
    $.ajax({
        data: {
            form: $(`#AdminFilterForm`).serialize(),
            type: 'all',
        },
    }).done((data) =>
    {
        $(`#user-list`).html(data);
    });
}
