const chatId = document.getElementById('chat-id') ? document.getElementById('chat-id').value : null;

if (window.Echo) {
    window.Echo.channel(`chat.${chatId}`)
        .listen('.message-sent', res => {
            setMessagesSocket(res);
        });
} else {
    console.error('Echo не знайдений!');
}
document.getElementById('message-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const message = document.getElementById('message-input').value;
    const chatId = document.getElementById('chat-id').value;

    if (!message.trim()) return;

    fetch(`/chats/${chatId}/messages`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            message: message,
        }),
    })
        .then(response => response.json())
        .then(data => {
            setMessages(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
function setMessages(data) {
    document.getElementById('message-input').value = '';
    const messagesList = document.getElementById('messages');
    const newMessage = document.createElement('li');
    newMessage.classList.add('mb-3');
    newMessage.id = `message-${data.id}`;
    newMessage.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <strong>Test</strong>:
                        </div>
                        <div class="message-content bg-light p-2 rounded">
                            ${data.message}
                        </div>
                    </div>
                `;

    messagesList.appendChild(newMessage);

    messagesList.scrollTop = messagesList.scrollHeight;
}
function setMessagesSocket(data) {
    document.getElementById('message-input').value = '';
    const messagesList = document.getElementById('messages');
    const newMessage = document.createElement('li');
    newMessage.classList.add('mb-3');
    newMessage.id = `message-${data.message.id}`;
    newMessage.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <strong>${data.user.name}</strong>:
                        </div>
                        <div class="message-content bg-light p-2 rounded">
                            ${data.message.message}
                        </div>
                    </div>
                `;

    messagesList.appendChild(newMessage);

    messagesList.scrollTop = messagesList.scrollHeight;
}
