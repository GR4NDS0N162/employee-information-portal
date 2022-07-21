let currentIndex = $('form > div > div').length;

let templateSpan = $('form > div > span');
let template = templateSpan.data('template');
templateSpan.remove();

function add_position()
{
    let regexp = /[a-z]*&#x5B;__index__&#x5D;&#x5B;name&#x5D;/;

    let positionName = regexp.exec(template).toString()
        .replace(/&#x5B;/g, '[')
        .replace(/&#x5D;/g, ']')
        .replace(/__index__/g, currentIndex);
    $('form > div').append(template.replace(/__index__/g, currentIndex++));
    $('input[name="' + positionName + '"]').focus();
}

function delete_position(button)
{
    let regexp = /[A-Za-z]*\[[0-9]*]/;
    let buttonName = button.getAttribute('name');
    let positionName = regexp.exec(buttonName);

    $('div[name="' + positionName + '"]').parent().remove();
}
