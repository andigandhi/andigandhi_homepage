<?php

include('telegramVar.php');

$update = json_decode(file_get_contents("php://input"), TRUE);
$chatId = $update["message"]["chat"]["id"];
$data = $update["message"]["text"];
$message = explode(" ", $data);

file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$data." ist jetzt in der Bubble dabei. Herzlich Willkommen!");

?>