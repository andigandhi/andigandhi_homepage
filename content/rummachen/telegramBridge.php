<?php

include('telegramVar.php');

$update = json_decode(file_get_contents("php://input"), TRUE);
$data[] = $update["message"]["text"];

$inp = file_get_contents('debug.txt');
$inp = $inp."\n".$data;
file_put_contents('debug.txt', $jsonData);

file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Alles klaro:".$data);

/*
$inp = file_get_contents('menschen.json');
$tempArray = json_decode($inp);
array_push($tempArray, $data);
$jsonData = json_encode($tempArray);
file_put_contents('menschen.json', $jsonData);
*/
?>