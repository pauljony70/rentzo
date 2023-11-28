const chatOffcanvas = new bootstrap.Offcanvas(document.getElementById('chatOffcanvas'));
const messageInput = document.getElementById('message');
const sendMessageBtn = document.getElementById('send-message-btn');
const order_id = document.getElementById('order_id');
const product = document.getElementById('prod_id');
const seller_id = document.getElementById('seller_id');
let lastMessageId = 0;
let updateSeenStatusValue = 0;

function isOffcanvasOpen() {
    return chatOffcanvas._element.classList.contains('show');
}

messageInput.addEventListener('input', () => {
    // Enable or disable the button based on the content of the input field
    sendMessageBtn.disabled = !messageInput.value.trim();
});

document.getElementById('send-message-form').addEventListener('submit', (event) => {
    event.preventDefault();
    sendMessageBtn.disabled = true;
    sendMessageBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';

    $.ajax({
        method: "post",
        url: site_url + "send-chat-message",
        data: {
            order_id: order_id.value,
            product: product.value,
            user_id: user_id,
            seller_id: seller_id.value,
            send_by: 'user',
            message: messageInput.value,
            [csrfName]: csrfHash,
        },
        success: function (response) {

            if (response.status) {
                lastMessageId = response.id;

                var container = document.getElementById("messageContainer");

                // Create a new message div
                var newMessageDiv = document.createElement("div");
                newMessageDiv.className = "d-flex justify-content-end user-message ms-5 mb-3";

                var newMessageContent = document.createElement("div");
                newMessageContent.className = "message py-1 px-2";
                newMessageContent.textContent = messageInput.value;

                newMessageDiv.appendChild(newMessageContent);

                container.insertBefore(newMessageDiv, container.firstChild);

                messageInput.value = '';
                sendMessageBtn.innerHTML = `<img src="${site_url.concat('assets_web/images/icons/send-message.svg')}" class="pe-0" alt="Send">`;
            } else {
                sendMessageBtn.disabled = false;
                sendMessageBtn.innerHTML = `<img src="${site_url.concat('assets_web/images/icons/send-message.svg')}" class="pe-0" alt="Send">`;
                /* Swal.fire({
                    type: "error",
                    text: response.message,
                    showCancelButton: true,
                    showCloseButton: true,
                    timer: 3000,
                }); */
                window.location = site_url + "login";
            }
        },
    });
});

function getMessagesOnLoad() {
    $.ajax({
        method: "get",
        url: site_url + 'get-chat-messages',
        data: {
            order_id: order_id.value,
            product: product.value,
            user_id: user_id,
            seller_id: seller_id.value,
            lastMessageId: lastMessageId,
        },
        success: function (response) {
            if (response.status) {
                displayMessages(response.data.messages);
                
                // Update the last received message ID
                if (response.data.messages.length > 0) {
                    lastMessageId = response.data.messages[response.data.messages.length - 1].message_id;
                    updateSeenStatusValue = 0;
                }
                if (isOffcanvasOpen() && updateSeenStatusValue == 0) {
                    updateSeenStatus();
                    updateSeenStatusValue = 1;
                } else {
                    document.getElementById('unseen-message-count').innerText = response.data.unseen_message_count;
                }
            } else {
                console.error("Error fetching messages:", response.message);
                Swal.fire({
                    type: "error",
                    text: response.message,
                    showCancelButton: true,
                    showCloseButton: true,
                    timer: 3000,
                    onClose: function () {
                        window.location.href = site_url + "login";
                    }
                });

            }
        },
    });
}

function updateSeenStatus() {
    $.ajax({
        method: "post",
        url: site_url + "update-seen-status",
        data: {
            order_id: order_id.value,
            product: product.value,
            user_id: user_id,
            seller_id: seller_id.value,
            lastMessageId: lastMessageId,
            [csrfName]: csrfHash
        },
        success: function (response) {
            document.getElementById('unseen-message-count').innerText = data.data.unseen_message_count;
        },
    });
}


function displayMessages(messages) {
    var container = document.getElementById("messageContainer");

    // Iterate through the messages and append them to the container
    messages.forEach(function (message) {
        var messageDiv;
        if (message.send_by === 'seller') {
            messageDiv =
                `<div class="d-flex justify-content-start seller-message mr-5 mb-3">
                    <div class="message py-1 px-2">${message.message}</div>
                </div>`;
        } else if (message.send_by === 'user') {
            messageDiv =
                `<div class="d-flex justify-content-end user-message ml-5 mb-3">
                    <div class="message py-1 px-2">${message.message}</div>
                </div>`;
        }

        // Insert the messageDiv at the beginning of the container
        container.insertAdjacentHTML('afterbegin', messageDiv);
    });
}

function checkForNewMessages() {
    setInterval(function () {
        getMessagesOnLoad();
    }, 2000);
}

window.onload = function () {
    getMessagesOnLoad();
    checkForNewMessages();
};