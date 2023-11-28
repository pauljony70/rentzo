<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Seller Chat</title>
	    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #chat-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        #messages {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
        }

        #message-input {
            width: 80%;
            padding: 8px;
            margin-right: 5px;
        }

        #send-btn {
            padding: 8px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<div id="chat-container">
    <div id="messages"></div>
    <input type="text" id="message-input" placeholder="Type your message...">
    <button id="send-btn">Send</button>
</div>

<script>
    $(document).ready(function () {
        var senderId = 1; // User ID
        var receiverId = 2; // Seller ID

        // Function to load messages
        function loadMessages() {
            $.ajax({
                type: 'POST',
                url: 'chat_data.php',
                data: {
                    action: 'getMessages',
                    senderId: senderId,
                    receiverId: receiverId
                },
                success: function (response) {
                    var messages = JSON.parse(response);
                    var messageHtml = '';
                    messages.forEach(function (message) {
                        messageHtml += '<div>' + message.message + '</div>';
                    });
                    $('#messages').html(messageHtml);
                }
            });
        }

        // Load initial messages
        loadMessages();

        // Function to send a message
        function sendMessage(message) {
            $.ajax({
                type: 'POST',
                url: 'chat_data.php',
                data: {
                    action: 'sendMessage',
                    senderId: senderId,
                    receiverId: receiverId,
                    message: message
                },
                success: function () {
                    loadMessages(); // Reload messages after sending a new one
                    $('#message-input').val(''); // Clear the input field
                }
            });
        }

        // Send message on button click
        $('#send-btn').click(function () {
            var message = $('#message-input').val();
            sendMessage(message);
        });

        // Send message on Enter key press
        $('#message-input').keypress(function (e) {
            if (e.which === 13) {
                var message = $(this).val();
                sendMessage(message);
            }
        });
    });
</script>

</body>
</html>
