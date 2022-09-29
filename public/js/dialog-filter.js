const formSelector = $('#DialogFilterForm');

formSelector[0].addEventListener('submit', (e) =>
{
    e.preventDefault();

    $.ajax({
        url: '/user/im/get',
        method: 'post',
        dataType: 'html',
        data: formSelector.serialize(),
    }).done((data) =>
    {
        $(`#dialog-list`).html(data);
    });
});

formSelector[0].dispatchEvent(new Event('submit'));
