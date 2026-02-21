<?php

$bot = "8115511840:AAGVUq9oDuh4ut9CHy-vrkCAfnyiFsJMj6I";
$chat = "8115511840";

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
