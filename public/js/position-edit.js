let currentIndex = $('form > fieldset > fieldset').length;

let templateSpan = $('form > fieldset > span');
let template = templateSpan.data('template');
templateSpan.remove();

function add_position()
{
    $('form > fieldset').append(template.replace(/__index__/g, currentIndex++));

    return false;
}

function delete_position(button)
{
    $(button).parent('fieldset').remove();
}
