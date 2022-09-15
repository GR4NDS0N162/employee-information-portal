const formSelector = $('#AdminFilterForm');
const sortSelector = $(`#sort`);
const pageSelector = $(`#page`);

updateContent();

formSelector[0].addEventListener('submit', (e) =>
{
    e.preventDefault();

    updateContent();
});

function getData()
{
    return {
        where: formSelector.serialize() || [
            'positionId=',
            'gender=',
            'age[min]=',
            'age[max]=',
            'fullnamePhoneEmail=',
            'active=1',
            'admin='
        ].join('&'),
        page: pageSelector[0].value || 1,
        order: sortSelector[0].value || 'fullname',
    };
}

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