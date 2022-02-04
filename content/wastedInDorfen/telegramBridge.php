<?php

include('telegramVar.php');

$update = json_decode(file_get_contents("php://input"), TRUE);


// Test if user is in channel
$botAction = "/getChatMember";

$params=[
    'chat_id' => $telegramchatid,
    'user_id' => $update["message"]["from"]["id"],
];

// Ask the API if user is member of channel

//---- SEND TO API ----
$ch = curl_init($path . $botAction);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
//---- END API ----

$user_status = json_decode($result, TRUE)["result"]["status"];

if ($user_status == "left" || $user_status == "kicked") {
    $botAction = "/sendmessage";
    $params=[
        'chat_id' => $update["message"]["chat"]["id"],
        'text' => $user_status."Du musst Mitglied von Wasted In Dorfen sein um schreiben zu können!",
    ];
	
	//---- SEND TO API ----
    $ch = curl_init($path . $botAction);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	curl_close($ch);
	//---- END API ----
	exit;
}


// If message contains Photo --> send photo
if ($update["message"]["photo"] != []) {
    $botAction = "/sendphoto";

    $params=[
        'chat_id' => $telegramchatid,
        'caption' => $update["message"]["caption"],
        'photo' => $update["message"]["photo"][0]["file_id"],
    ];
}

// If message contains video --> send video
else if ($update["message"]["video"] != []) {
    $botAction = "/sendvideo";
    
    $params=[
        'chat_id' => $telegramchatid,
        'caption' => $update["message"]["caption"],
        'video' => $update["message"]["video"][0]["file_id"],
    ];
}

// If message contains prerecorded audio --> send audio
else if ($update["message"]["audio"] != []) {
    $botAction = "/sendaudio";
    
    $params=[
        'chat_id' => $telegramchatid,
        'caption' => $update["message"]["caption"],
        'audio' => $update["message"]["audio"]["file_id"],
    ];
}

// If message contains voice message --> send voice
else if ($update["message"]["voice"] != []) {
    $botAction = "/sendvoice";
    
    $params=[
        'chat_id' => $telegramchatid,
        'voice' => $update["message"]["voice"]["file_id"],
    ];
}

// If message contains sticker --> send sticker
else if ($update["message"]["sticker"] != []) {
    $botAction = "/sendsticker";
    
    $params=[
        'chat_id' => $telegramchatid,
        'sticker' => $update["message"]["sticker"]["file_id"],
    ];
}

// Else send text message
else {
	$botAction = "/sendmessage";

    if ($update["message"]["text"] == "/start") {
        exit;
    }

	$params=[
		'chat_id' => $telegramchatid,
		'text' => $update["message"]["text"], //json_encode($update, JSON_PRETTY_PRINT) <-- for debugging!
	];
}


//---- SEND TO API ----
$ch = curl_init($path . $botAction);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
//---- END API ----

?>