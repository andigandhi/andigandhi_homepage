<?php

include('telegramVar.php');

$update = json_decode(file_get_contents("php://input"), TRUE);
$chatId = $update["message"]["chat"]["id"];
//$chatId = "-1001681561214";
$data = $update["message"]["text"];
$message = explode(" ", $data);

if (strcasecmp($message[0], "add") == 0) {
    addConn($message, $chatId);
} else if (strcasecmp($message[0], "new") == 0) {
    addPerson($message, $chatId);
    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$message[1]." ist jetzt in der Bubble dabei. Herzlich Willkommen!");
} else if (strcasecmp($message[0], "rem") == 0) {
    remConn($message, $chatId);
} else if (strcasecmp($message[0], "link") == 0) {
    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=https://andigandhi.ga/content/rummachen/index.html?clearname=YES");
} else if (strcasecmp($message[0], "help") == 0) {
    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".urlencode(
    "\"add name1 name2\" fügt eine neue Verbindung zwischen name1 und name2 hinzu\n
    \"new name\" fügt eine neue Person zum Circle hinzu\n
    \"rem name1 name2\" entfernt eine neue Verbindung zwischen name1 und name2 \n
    \"link\" zeigt den direkten Link zur Bubble\n
    \"help\" zeigt diese Nachricht\n
     https://andigandhi.ga/content/rummachen/index.html?clearname=YES"));
}


function remConn($message, $chatId)
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

    for($i = 0; $i < count($jsonData["links"]); ++$i) {
        if ( ($jsonData["links"][$i]["source"] === $id1 and $jsonData["links"][$i]["target"] === $id2) or 
             ($jsonData["links"][$i]["source"] === $id2 and $jsonData["links"][$i]["target"] === $id1)) {
            unset($jsonData["links"][$i]);
            $jsonData["links"] = array_values($jsonData["links"]);
            file_put_contents('menschen.json', json_encode($jsonData));
            file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Alles klaro, Verbindung zwischen ".$message[1]." (ID:".$id1.") und ".$message[2]." (ID:".$id2.") entfernt!");        
            return;
        }
    }
    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Diese Verbindung besteht anscheinend nicht!");        

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

    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Alles klaro, Verbindung zwischen ".$message[1]." (ID:".$id1.") und ".$message[2]." (ID:".$id2.") hinzugefügt!");
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