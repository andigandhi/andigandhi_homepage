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
file_put_contents("music_log.txt", date("Y-m-d h:i:sa")." ".md5($_SERVER[\'REMOTE_ADDR\'])."\\n", FILE_APPEND);
header("HTTP/1.1 302 Found");
header("location: ';
    $inhalt .= $radios[$radioNo];
    $inhalt .= '");
?>';
    file_put_contents("audio.php", $inhalt);
    file_put_contents("lastVisit.txt", date("m.d.y H:i")."Uhr");
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