<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://unpkg.com/98.css" />
	<meta charset="utf-8">
	<title>Unbenanntes Dokument</title>
</head>

<body style="text-align: center; font-size: large;">

<?php
$radios = array(
    "https://radio80k.out.airtime.pro/radio80k_a",
    "https://br-br1-obb.cast.addradio.de/br/br1/obb/mp3/mid?ar-distributor=ffa0",
    "https://edge.mixlr.com/channel/zwtuo",
    "http://andigandhi.ddns.net:8000/mpd.mp3");
$radioNo = $_GET["no"] ?? -1;

if ($radioNo >= 0) {
    $inhalt = '<?php

function telegram($msg) {
    global $telegrambot,$telegramchatid;
    $url="https://api.telegram.org/bot".$telegrambot."/sendMessage";$data=array("chat_id"=>$telegramchatid,"text"=>$msg);
    $options=array("http"=>array("method"=>"POST","header"=>"Content-Type:application/x-www-form-urlencoded\r\n","content"=>http_build_query($data),),);
    $context=stream_context_create($options);
    $result=file_get_contents($url,false,$context);
    return $result;
}

if ( (time() - strtotime(file_get_contents("lastVisit.txt"))) > 900 )
    file_put_contents("lastVisit.txt", date("Y-m-d h:i:sa"));

    $telegrambot = "1560022093:AAHL-JGfo_IXP-_-9e2Ym-CPJUIp4Y8IhOQ";
    $telegramchatid = -1001358400628;

    telegram(time() . "   " . strtotime(file_get_contents("lastVisit.txt")))
    telegram("Sichtung im Jugge (" . substr( md5($_SERVER[\'REMOTE_ADDR\']), -4) .")");

header("HTTP/1.1 302 Found");
header("location: ';
    $inhalt .= $radios[$radioNo];
    $inhalt .= '");
?>';
    file_put_contents("audio.php", $inhalt);
    echo("Der Sender wurde erfolgreich geändert!</body></html>");
    exit;
}
?>

<br><br><b>Wähle die Radiostation aus!</b><br><br>
	<a href="?no=0">Radio 80k</a><br><br>
    <a href="?no=1">Bayern 1</a><br><br>
    <a href="?no=2">res.radio</a><br><br><br><br>
    <a href="?no=3">andigandhi radio</a>
</body>
</html>