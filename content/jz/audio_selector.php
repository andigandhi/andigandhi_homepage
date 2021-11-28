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
    "https://dispatcher.rndfnk.com/br/br1/obb/mp3/mid",
    "https://edge.mixlr.com/channel/zwtuo",
    "https://orf-live.ors-shoutcast.at/fm4-q2a",
    "http://andigandhi.ddns.net:8000/mpd.mp3");
$radioNo = $_GET["no"] ?? -1;

if ($radioNo >= 0) {
    file_put_contents("audio_link.txt", $radios[$radioNo]);
    echo("Der Sender wurde erfolgreich geändert!</body></html>");
    exit;
}
?>

<br><br><b>Wähle die Radiostation aus!</b><br><br>
	<a href="?no=0">Radio 80k</a><br><br>
    <a href="?no=1">Bayern 1</a><br><br>
    <a href="?no=2">res.radio</a><br><br>
    <a href="?no=3">FM4</a><br><br><br><br>
    <a href="?no=4">andigandhi radio</a>
</body>
</html>