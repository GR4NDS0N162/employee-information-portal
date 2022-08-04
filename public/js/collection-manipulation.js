let currentPhoneIndex = $('#edit-phone-form > div > div > div').length;
const phoneTemplate = $('#edit-phone-form > div > div > span').data('template');

let currentEmailIndex = $('#edit-email-form > div > div > div').length;
const emailTemplate = $('#edit-email-form > div > div > span').data('template');

const phoneNotification = document.createElement('div');
phoneNotification.classList.add('col-12', 'notification', 'd-block');
phoneNotification.innerText = 'Список телефонов пуст.';

const emailNotification = document.createElement('div');
emailNotification.classList.add('col-12', 'notification', 'd-block');
emailNotification.innerText = 'Список e-mail-ов пуст.';

$('#edit-phone-form > div > .collection-list').append(phoneNotification);
$('#edit-email-form > div > .collection-list').append(emailNotification);

function add_phone()
{
    $('#edit-phone-form > div > div').append(phoneTemplate.replace(/__index__/g, currentPhoneIndex));
    $('input[name=\'phones[' + currentPhoneIndex++ + ']\']').focus();

    $('#edit-phone-form > div > div > div.notification')[0].classList.replace('d-block', 'd-none');
}

function add_email()
{
    $('#edit-email-form > div > div').append(emailTemplate.replace(/__index__/g, currentEmailIndex));
    $('input[name=\'emails[' + currentEmailIndex++ + ']\']').focus();

    $('#edit-email-form > div > div > div.notification')[0].classList.replace('d-block', 'd-none');
}

function delete_item(element)
{
    if ($(element).closest('.collection-list')[0].childElementCount < 4)
        $('#' + $(element).closest('form')[0].getAttribute('name') + ' > div > div > div.notification')[0].classList.replace('d-none', 'd-block');

    $(element).closest('.col-12').remove();
}
