<?php

include('telegramVar.php');

$update = json_decode(file_get_contents("php://input"), TRUE);
$chatId = $update["message"]["chat"]["id"];
$data = $update["message"]["text"];
$message[] = explode(" ", $data);

if ($message[0] === "/add") {
    //addConn($message);
    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Alles klaro, Verbindung zwischen ".$message[1]." und ".$message[2]." hergestellt!");
} else if ($message[0] === "/newMember") {
    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$message[1]." ist jetzt in der Bubble dabei. Herzlich Willkommen!");
}

file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=OK");


public function addConn()
{
    $rawJson = file_get_contents('menschen.json');
    $jsonData = json_decode($rawJson);

    
}

public function getID($json, $name) {
    foreach ($json as $element) {
        if ($element["name"] === $name) return $element["id"];
    }
}
/*
$inp = file_get_contents('menschen.json');
$tempArray = json_decode($inp);
array_push($tempArray, $data);
$jsonData = json_encode($tempArray);
file_put_contents('menschen.json', $jsonData);
*/
?>