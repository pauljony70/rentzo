<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Call</title>
    <!-- Include Agora Web SDK -->
    <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.6.11.js"></script>
</head>
<body>
    <h1>Video Call</h1>

    <div id="localVideo"></div>
    <div id="remoteVideo"></div>

    <script>
        // Replace 'YOUR_APP_ID' and 'YOUR_CHANNEL_NAME' with your actual Agora App ID and Channel Name
        const appId = '2c35bc66b7364b47aefe72415b2f8cd3';
        const channelName = 'rentzo';
        let client;

        // Initialize Agora client
        client = AgoraRTC.createClient({ mode: 'rtc', codec: 'vp8' });

        // Join the channel when the page loads
        client.init(appId, () => {
            client.join(null, channelName, null, (uid) => {
                // Create and display local video stream
                const localStream = AgoraRTC.createStream({ streamID: uid, audio: true, video: true });
                localStream.init(() => {
                    localStream.play('localVideo');
                });

				
                // Subscribe to remote streams
                client.on('stream-added', (evt) => {
                    const remoteStream = evt.stream;
                    client.subscribe(remoteStream, (err) => {
                        console.log('Subscribe stream failed', err);
						
                    });
                });

                client.on('stream-subscribed', (evt) => {
                    const remoteStream = evt.stream;
                    remoteStream.play('remoteVideo');
                });
            });
        });
    </script>
</body>
</html>
<?php /*
<!-- application/views/video_call.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Video Call</title>
    <!-- Include Agora Web SDK -->
    <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.6.11.js"></script>
</head>
<body>
    <h1>Agora Video Call</h1>

    <div id="localVideo"></div>
    <div id="remoteVideo"></div> 

    <script>
        const appId = '2c35bc66b7364b47aefe72415b2f8cd3'; // Replace with your Agora App ID
        const channelName = 'rentzo'; // Replace with your desired channel name
        const uid = Math.floor(Math.random() * 100000); // Random UID for testing

        
            const agoraToken = 'c8a2fe34b88e47c689c571f032940d7e';

            // Initialize Agora client
            const client = AgoraRTC.createClient({ mode: 'rtc', codec: 'vp8' });

            // Join the channel
            client.init(appId, () => {
                client.join(agoraToken, channelName, uid, (uid) => {
                    // Create and display local video stream
                    const localStream = AgoraRTC.createStream({ streamID: uid, audio: true, video: true });
                    localStream.init(() => {
                        localStream.play('localVideo');
                    });

                    // Subscribe to remote streams
                    client.on('stream-added', (evt) => {
                        const remoteStream = evt.stream;
                        client.subscribe(remoteStream, (err) => {
                            console.log('Subscribe stream failed', err);
                        });
                    });

                    client.on('stream-subscribed', (evt) => {
                        const remoteStream = evt.stream;
                        remoteStream.play('remoteVideo');
                    });
                });
            });
       
    </script>
</body>
</html>
*/ ?>


