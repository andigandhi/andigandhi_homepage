<?php

include('telegramVar.php');

$update = json_decode(file_get_contents("php://input"), TRUE);
$chatId = $update["message"]["chat"]["id"];
$data = $update["message"]["text"];
$message = explode(" ", $data);

if ($message[0] === "/add") {
    addConn($message, $chatId);
} else if ($message[0] === "/newMember") {
    addPerson($message, $chatId);
    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$message[1]." ist jetzt in der Bubble dabei. Herzlich Willkommen!");
}


function addConn($message, $chatId)
{
    include('telegramVar.php');

    $rawJson = file_get_contents('menschen.json');
    $jsonData = json_decode($rawJson, true);
    
    $id1 = getID($jsonData, $message[1]);
    $id2 = getID($jsonData, $message[2]);

    if ($id1 == 0) {
        file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Unbekannter Name: ".$message[1]);
        return;
    }

    if ($id2 == 0) {
        file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Unbekannter Name: ".$message[2]);
        return;
    }

    $jsonData["links"][] = ['source' => $id1, 'target' => $id2];

    file_put_contents('menschen.json', json_encode($jsonData));

    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Alles klaro, Verbindung zwischen ".$message[1]." (ID:".$id1.") und ".$message[2]." (ID:".$id2.") hergestellt!");
}

function getID($json, $name) {
    foreach ($json["nodes"] as $element) {
        if ($element["name"] === $name) return $element["id"];
    }
    return 0;
}


function addPerson($message, $chatId)
{
    $rawJson = file_get_contents('menschen.json');
    $jsonData = json_decode($rawJson, true);

    $newId = count($jsonData["nodes"]) + 1;

    if ($message[2] === "m") $group = 1;
    else $group = 2;

    $jsonData["nodes"][] = ['name' => $message[1], 'id' => (string)$newId, 'group' => $group];

    file_put_contents('menschen.json', json_encode($jsonData));
}

?>