<?php

$bot = "YAHAN_APNA_BOT_TOKEN_DALEIN";
$chat = "YAHAN_APNA_CHAT_ID_DALEIN";

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['img'])){

$img = $data['img'];
$img = str_replace('data:image/png;base64,','',$img);
$img = str_replace(' ','+',$img);

file_put_contents("photo.png", base64_decode($img));

$url = "https://api.telegram.org/bot$bot/sendPhoto";

$post = [
'chat_id' => $chat,
'photo' => new CURLFile("photo.png")
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_exec($ch);

}

?>