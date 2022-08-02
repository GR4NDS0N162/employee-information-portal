let currentCount = $('form > div > div > div').length;
const template = $('form > div > div > span').data('template');

function add_item()
{
    $('form > div > div.row').append(template.replace(/__index__/g, currentCount++));
}

function delete_item(element)
{
    $(element).closest('.item').remove();
}
