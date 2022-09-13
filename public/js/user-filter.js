$.ajax({
    url: '/admin/list/get',
    method: 'post',
    dataType: 'html',
    success: function (data)
    {
        $(`#user-list`).html(data);
    }
});
