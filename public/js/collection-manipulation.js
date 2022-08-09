let currentPhoneIndex = $('#edit-phone-form > div > div > div').length;
const phoneTemplate = $('#edit-phone-form > div > div > span').data('template');

let currentEmailIndex = $('#edit-email-form > div > div > div').length;
const emailTemplate = $('#edit-email-form > div > div > span').data('template');

let currentPositionIndex = $('#edit-position-form > div > div > div').length;
const positionTemplate = $('#edit-position-form > div > div > span').data('template');

const phoneNotification = document.createElement('div');
phoneNotification.classList.add('col-12', 'notification', 'd-block');
phoneNotification.innerText = 'Список телефонов пуст.';

const positionNotification = document.createElement('div');
positionNotification.classList.add('col-12', 'notification', 'd-block');
positionNotification.innerText = 'Список должностей пуст.';

$('#edit-phone-form > div > .collection-list').append(phoneNotification);
$('#edit-position-form > div > .collection-list').append(positionNotification);

function add_phone()
{
    $('#edit-phone-form > div > div').append(phoneTemplate.replace(/__index__/g, currentPhoneIndex));
    let item = $('input[name=\'phones[' + currentPhoneIndex++ + ']\']')[0];
    item.focus();

    $('#edit-phone-form > div > div > div.notification')[0].classList.replace('d-block', 'd-none');
}

function add_email()
{
    $('#edit-email-form > div > div').append(emailTemplate.replace(/__index__/g, currentEmailIndex));
    let item = $('input[name=\'emails[' + currentEmailIndex++ + ']\']')[0];
    item.focus();
}

function add_position()
{
    $('#edit-position-form > div > div').append(positionTemplate.replace(/__index__/g, currentPositionIndex));
    let item = $('input[name=\'positions[' + currentPositionIndex++ + ']\']')[0];
    item.focus();

    $('#edit-position-form > div > div > div.notification')[0].classList.replace('d-block', 'd-none');
}

function delete_item(element)
{
    let formName = $(element).closest('form')[0].getAttribute('name');
    let currentCount = $('#' + formName + ' > div > div > .item').length;

    if (currentCount > 1)
        $(element).closest('.item').remove();
    else {
        if (formName != 'edit-email-form') {
            $('#' + formName + ' > div > div > .notification')[0].classList.replace('d-none', 'd-block');
            $(element).closest('.item').remove();
        }
    }
}
