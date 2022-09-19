const loadBtn = $(`#load`);

let lastMessageId;

function loadMessages()
{
    $.ajax({
        url: '/user/im/load',
        method: 'post',
        dataType: 'html',
        async: false,
        data: {
            lastMessageId: lastMessageId,
            buddyId: buddyId,
        },
    }).done((data) =>
    {
        $(`#message-list`)[0].innerHTML += data;

        let lastMessage = $(`#message-list > [message_id]:last-child`);

        if (lastMessage.length) {
            lastMessageId = parseInt(lastMessage[0].getAttribute('message_id'));
        }
    });
}
