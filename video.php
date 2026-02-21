<?php

$bot = "YAHAN_APNA_BOT_TOKEN_DALEIN";
$chat = "YAHAN_APNA_CHAT_ID_DALEIN";

if(isset($_FILES['video'])){

move_uploaded_file(
$_FILES['video']['tmp_name'],
"video.webm"
);

$url = "https://api.telegram.org/bot$bot/sendVideo";

$post = [
'chat_id' => $chat,
'video' => new CURLFile("video.webm")
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_exec($ch);

}

?>