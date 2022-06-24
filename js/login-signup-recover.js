$('.signup-show').click(function ()
{
    $('#signup-card').show();
    $('#login-card').hide();
});

$('.recover-show').click(function ()
{
    $('#recover-card').show();
    $('#login-card').hide();
});

$('.login-show').click(function ()
{
    $('#login-card').show();
    $('#signup-card').hide();
    $('#recover-card').hide();
});
