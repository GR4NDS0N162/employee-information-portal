const loadBtn = $(`#load`);
const newMessageForm = $(`#NewMessageForm`);
const messageContent = $(`#NewMessageForm input[name="message"]`);
const $messageList = $(`#message-list`);

let lastMessageId;

loadBtn[0].addEventListener('click', () => loadMessages());

newMessageForm[0].addEventListener('submit', (e) =>
{
    e.preventDefault();

    sendMessage(messageContent[0].value);

    messageContent[0].value = '';
});

loadMessages();

function loadMessages()
{
    $.ajax({
        url: '/user/im/load',
        method: 'post',
        dataType: 'html',
        async: false,
        data: {
            lastMessageId: lastMessageId,
        },
    }).done((data) =>
    {
        data = data.trim();

        if (data) {
            $messageList[0].innerHTML += data;
            let lastMessage = $(`#message-list > [message_id]:last-child`);

            if (lastMessage.length) {
                lastMessageId = parseInt(lastMessage[0].getAttribute('message_id'));
            }
        } else {
            $messageList[0].innerHTML += `<div class="notification">The latest messages have been loaded.</div>`
        }
    });
}

function sendMessage(content)
{
    $.ajax({
        url: '/user/im/send',
        method: 'post',
        dataType: 'json',
        data: {
            content: content,
        },
    });
}
