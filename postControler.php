<?php
require 'vendor/autoload.php'; // Ensure correct path to Composer's autoload
use Abraham\TwitterOAuth\TwitterOAuth;

// Discord Webhook URLs for each channel
$discord_channels_info = [
    'nifty-vip' => ['webhook_url' => 'https://discord.com/api/webhooks/1302566999188312096/9VQ4_9u0RO-sxxSNXa8uwmoEg1c-DOu1tK5qBzomuwhHR_mhD6X4Kuzs9wysKt4egtCU', 'username' => 'Spidey Bot'],
    'forex-vip' => ['webhook_url' => 'https://discord.com/api/webhooks/1302928821736964097/LtP8Hbw8c6RF4M5u2r5CJ-eetcFJrO8PexjSLMV5rdjRcuX1aFzopXx2ol5ePUu-saia', 'username' => 'Captain Hook'],
    'crypto-vip' => ['webhook_url' => 'https://discord.com/api/webhooks/1302939797274234880/xEEOq6HSrMOIO7MdJsdfd66ZrPdj6CvXlqgEoaC5AiNEjGF1QSBjfZFe9Se0lu4euPas', 'username' => 'Captain Hook'],
    'vip-chat' => ['webhook_url' => 'https://discord.com/api/webhooks/1302940019958353970/A9hHiFRLAa87S1_cnFRMEWDjxcnm_ZC7tmDCtmq1XGZ-1JnrON8RXh1AcSRYsyDDqNKi', 'username' => 'Spidey Bot'],
    'nifty-market-updates' => ['webhook_url' => 'https://discord.com/api/webhooks/1302940410208849920/lhAiWyyC5pLbFnP1L1lRk3RJH_G1VTxvF_YGyK4Ck4LcE7Ydg0giDImIE0EwrSuDAiy5', 'username' => 'Captain Hook'],
    'crypto-market-updates' => ['webhook_url' => 'https://discord.com/api/webhooks/1302940638546759740/ZtwdjX5pimLuvXM_Jd5HTXfkRtzMSgmvYAwcB7Pf4a06bz_vnt6uDdPMqao-aPTYb7PB', 'username' => 'Spidey Bot'],
    'forex-market-updates' => ['webhook_url' => 'https://discord.com/api/webhooks/1302941008849403934/CID_MU2euWGnm6LH46gP6sxnnzJPoGKKGspb8938C5Dp9SUfU2tURwQOb93vgicTaRyG', 'username' => 'Spidey Bot'],
    'strategies' => ['webhook_url' => 'https://discord.com/api/webhooks/1302941196552896562/bpyuo2c4Kqr8Nvf-hQBET8CLAf3gCDJsLWwoMmFGeg9J6napXjw3yOamRmDYZrhhFbCQ', 'username' => 'Spidey Bot'],
    'learning-centre' => ['webhook_url' => 'https://discord.com/api/webhooks/1302941390874869790/MRPfOs_mZnCCrkKsCzFBkOzMemgBsSC2rKT452f1dNIM0Nw7ZLuQ5YG4rui_24kYvQ2f', 'username' => 'Spidey Bot'],
    'risk-management-in-a-nutshell' => ['webhook_url' => 'https://discord.com/api/webhooks/1302941564770848768/pgezFhkT92Zc7tnngUAOFzp6NB9dNXJ2Xug7HDnKY3svUVYHwI5auXrmhLEEsfwvX14J', 'username' => 'Captain Hook'],
    'all-in-1-journal' => ['webhook_url' => 'https://discord.com/api/webhooks/1302941750087647293/QoIeQD-omGp9gBARM4bA3W7dckcwXKP9F1FZvmv0kiKs8aPlqeSSJGCmd1-A0EWQsGCp', 'username' => 'Captain Hook'],
    'active-trades' => ['webhook_url' => 'https://discord.com/api/webhooks/1302941899216392193/0FnRsaeqhtWhIcynE5TiwKc1M09ustP6Zz3a6BVHrAXI9WKlsq-6PW7dFJ5KutclI4m2', 'username' => 'Captain Hook'],
    // Add additional channels as needed
];

// Discord Message Function
function sendDiscordMessage($webhook_url, $username, $content, $embed_title = '', $embed_description = '', $embed_color = 'FF0000') {
    $message = [
        'username' => $username,
        'content' => $content,
        'embeds' => [
            [
                'title' => $embed_title,
                'description' => $embed_description,
                'color' => hexdec($embed_color)
            ]
        ]
    ];
    $json_data = json_encode($message);
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_message = 'Failed to send message to Discord. Error: ' . curl_error($ch);
        curl_close($ch);
        return $error_message;
    }
    curl_close($ch);
    return $response ? "Message sent to Discord successfully!" : "Failed to send message to Discord.";
}

// Telegram Message Function
function sendTelegramMessage($bot_token, $channel_id, $content) {
    $url = "https://api.telegram.org/bot$bot_token/sendMessage";
    $message = [
        'chat_id' => $channel_id,
        'text' => $content,
        'parse_mode' => 'HTML'
    ];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($message));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_message = 'Failed to send message to Telegram. Error: ' . curl_error($ch);
        curl_close($ch);
        return $error_message;
    }
    curl_close($ch);
    return $response ? "Message sent to Telegram successfully!" : "Failed to send message to Telegram.";
}

// Twitter Message Function
function sendTwitterMessage($content) {
    $twitter_api_key = 'oCDPP1MOzc2qnIECICjytfcbZ';
    $twitter_api_secret_key = '5edl5wEr68aolIH3tJwJ9kmDhbj3ucaWkf6sNjrshPiBSVIPY6';
    $twitter_access_token = '1850953512244367360-7i0ZVmrdUhlFJrAHk9CtXTTWkMxd6l';
    $twitter_access_token_secret = 'N2zhE4BecmZUdgW2SjlfzRMOIwEiRh1si7aB7M0FANzHq';

    $connection = new TwitterOAuth($twitter_api_key, $twitter_api_secret_key, $twitter_access_token, $twitter_access_token_secret);
    $status = $connection->post("statuses/update", ["status" => $content]);
    
    if ($connection->getLastHttpCode() == 200) {
        return "Message sent to Twitter successfully!";
    } else {
        return "Failed to send message to Twitter.";
    }
}

// Check if the form is submitted

// Process the selected platforms
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $platforms = isset($_POST['platforms']) ? $_POST['platforms'] : [];
    $selected_discord_channels = isset($_POST['discord_channels']) ? $_POST['discord_channels'] : [];

    // Send messages based on the selected platforms
    foreach ($platforms as $platform) {
        switch ($platform) {
            case 'Discord':
                foreach ($selected_discord_channels as $channel) {
                    if (isset($discord_channels_info[$channel])) {
                        $webhook_url = $discord_channels_info[$channel]['webhook_url'];
                        $username = $discord_channels_info[$channel]['username'];
                        $response = sendDiscordMessage($webhook_url, $username, $message, $title, 'Admin.', 'FF0000');
                        echo "Channel $channel: $response<br>";
                    } else {
                        echo "Invalid Discord channel selected for $channel.<br>";
                    }
                }
                break;
            case 'Telegram':
                // Telegram code (as before)
                echo sendTelegramMessage($telegram_bot_token, $telegram_channel_id, "Title: $title\nMessage: $message");
                break;
            case 'Twitter':
                // Twitter code (as before)
                echo sendTwitterMessage("Title: $title\nMessage: $message");
                break;
            default:
                echo "Invalid platform selected.<br>";
                break;
        }
    }
} else {
    echo "No data received.";
}