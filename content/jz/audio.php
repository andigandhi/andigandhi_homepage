<?php

function telegram($msg) {
    global $telegrambot,$telegramchatid;
    $url="https://api.telegram.org/bot".$telegrambot."/sendMessage";$data=array("chat_id"=>$telegramchatid,"text"=>$msg);
    $options=array("http"=>array("method"=>"POST","header"=>"Content-Type:application/x-www-form-urlencoded\r\n","content"=>http_build_query($data),),);
    $context=stream_context_create($options);
    $result=file_get_contents($url,false,$context);
    return $result;
}

function getIpAddr() {
	$ip = $_SERVER['REMOTE_ADDR'];
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	return $details->city;	
}

include('telegramVar.php');

if ( (time() - strtotime(file_get_contents("lastVisit.txt"))) > 300 ) {
    file_put_contents("lastVisit.txt", date("Y-m-d h:i:sa"));
	$hash = (crc32 ($_SERVER['REMOTE_ADDR'].date("Y-m-d")) % 9000) + 1000;
    telegram(date("H:i")." Uhr: Sichtung im Jugge, ID" . $hash . " (" . getIpAddr() . ")");
}

header("HTTP/1.1 302 Found");
header("location: " . file_get_contents("audio_link.txt"));
?>