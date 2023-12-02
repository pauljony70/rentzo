const site_url = document.getElementById('site_url').value;
const messageInput = document.getElementById('message');
const sendMessageBtn = document.getElementById('send-message-btn');
const order_id = document.getElementById('sno_order');
const product = document.getElementById('prod_id');
const user_id = document.getElementById('user_id');
const seller_id = document.getElementById('seller_id');
let lastMessageId = 0;
let updateSeenStatusValue = 0;

function isModalOpen() {
    return $('#chatModal').hasClass('show');
}

function isTabActive() {
    return document.visibilityState === 'visible';
}

messageInput.addEventListener('input', () => {
    sendMessageBtn.disabled = !messageInput.value.trim();
});

document.getElementById('send-message-form').addEventListener('submit', (event) => {
    event.preventDefault();
    sendMessageBtn.disabled = true;
    sendMessageBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';

    $.ajax({
        method: "post",
        url: "chat.php",
        data: {
            action: 'insertMessage',
            order_id: order_id.value,
            product: product.value,
            user_id: user_id.value,
            seller_id: seller_id.value,
            send_by: 'seller',
            message: messageInput.value,
            code: code_ajax
        },
        success: function (response) {
            var data = $.parseJSON(response);
            if (data.status) {
                // lastMessageId = data.id;

                // var container = document.getElementById("messageContainer");

                // // Create a new message div
                // var newMessageDiv = document.createElement("div");
                // newMessageDiv.className = "d-flex justify-content-end user-message ms-5 mb-3";

                // var newMessageContent = document.createElement("div");
                // newMessageContent.className = "message py-1 px-2";
                // newMessageContent.textContent = messageInput.value;

                // newMessageDiv.appendChild(newMessageContent);

                // container.insertBefore(newMessageDiv, container.firstChild);
                getMessagesOnLoad();

                messageInput.value = '';
                sendMessageBtn.innerHTML = `<img src="${site_url.concat('assets_web/images/icons/send-message.svg')}" class="pe-0" alt="Send">`;
            } else {
                sendMessageBtn.disabled = false;
                sendMessageBtn.innerHTML = `<img src="${site_url.concat('assets_web/images/icons/send-message.svg')}" class="pe-0" alt="Send">`;
            }
        },
        // complete: function () {
        //     sendMessageBtn.disabled = false;
        //     messageInput.value = '';
        // }
    });
});

function getMessagesOnLoad() {
    $.ajax({
        method: "post",
        url: "chat.php",
        data: {
            action: 'getMessages',
            order_id: order_id.value,
            product: product.value,
            user_id: user_id.value,
            seller_id: seller_id.value,
            lastMessageId: lastMessageId,
            code: code_ajax
        },
        success: function (response) {
            var data = $.parseJSON(response);
            if (data.status) {
                displayMessages(data.data.messages);

                // Update the last received message ID
                if (data.data.messages.length > 0) {
                    lastMessageId = data.data.messages[data.data.messages.length - 1].message_id;
                    updateSeenStatusValue = 0;
                    if (data.data.unseen_message_count) {
                        playNotificationSound();
                    }
                }
                if (isModalOpen() && updateSeenStatusValue == 0) {
                    updateSeenStatus();
                    updateSeenStatusValue = 1;
                } else {
                    if (data.data.unseen_message_count) {
                        document.getElementById('unseen-message-count').style.cssText = "position: absolute; top: -10px; right: -10px; background: var(--red); height: 24px; border-radius: 50%; color: #fff; width: 24px; display: flex; align-items: center; justify-content: center";
                        document.getElementById('unseen-message-count').innerText = data.data.unseen_message_count;
                    } else {
                        document.getElementById('unseen-message-count').innerText = ""
                    }
                }
            } else {
                console.error("Error fetching messages:", data.message);
            }
        },
    });
}

function updateSeenStatus() {
    $.ajax({
        method: "post",
        url: "chat.php",
        data: {
            action: 'updateSeenStatus',
            order_id: order_id.value,
            product: product.value,
            user_id: user_id.value,
            seller_id: seller_id.value,
            lastMessageId: lastMessageId,
            code: code_ajax
        },
        success: function (response) {
            document.getElementById('unseen-message-count').style.cssText = "";
            document.getElementById('unseen-message-count').innerText = "";
        },
    });
}

function displayMessages(messages) {
    var container = document.getElementById("messageContainer");

    // Iterate through the messages and append them to the container
    messages.forEach(function (message) {
        var messageDiv;
        if (message.send_by === 'user') {
            messageDiv =
                `<div class="d-flex justify-content-start seller-message mr-5 mb-3">
                    <div class="message py-1 px-2">${message.message}</div>
                </div>`;
        } else if (message.send_by === 'seller') {
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

function playNotificationSound() {
    var audio = new Audio(site_url.concat('assets_web/sounds/Notification.mp3'));

    if (!isModalOpen())
        audio.play();
    else if (!isTabActive())
        audio.play();
}

window.onload = function () {
    getMessagesOnLoad();
    checkForNewMessages();
};