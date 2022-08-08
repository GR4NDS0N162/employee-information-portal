let currentPhoneIndex = $('#edit-phone-form > div > div > div').length;
const phoneTemplate = $('#edit-phone-form > div > div > span').data('template');

let currentEmailIndex = $('#edit-email-form > div > div > div').length;
const emailTemplate = $('#edit-email-form > div > div > span').data('template');

const phoneNotification = document.createElement('div');
phoneNotification.classList.add('col-12', 'notification', 'd-block');
phoneNotification.innerText = 'Список телефонов пуст.';

$('#edit-phone-form > div > .collection-list').append(phoneNotification);

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
}

function delete_item(element)
{
    let formName = $(element).closest('form')[0].getAttribute('name');
    let currentCount = $('#' + formName + ' > div > .collection-list > .item').length;

    if (currentCount > 1)
        $(element).closest('.col-12').remove();
    else {
        if (formName == 'edit-phone-form') {
            $('#edit-phone-form > div > div > div.notification')[0].classList.replace('d-none', 'd-block');
            $(element).closest('.col-12').remove();
        }
    }
}
