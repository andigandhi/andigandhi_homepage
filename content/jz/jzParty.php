<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://unpkg.com/98.css" />
	<meta charset="utf-8">
	<title>Unbenanntes Dokument</title>
</head>

<body style="text-align: center; font-size: large;">
    <h3>Letzte Sichtung im JZ:<br/>
        <?php
            echo(file_get_contents("lastVisit.txt"));
        ?>
    </h3>
    <hr>
    <br><br><b>Die Links zur digitalen Juggeparty, los geht's um 21:00 Uhr</b><br><br>
	<a href="https://jz.andigandhi.ga" target="_blank" rel="noopener noreferrer">Digitales Jugge</a><br><br>
    <a href="https://meet.ffmuc.net/globalpauligeburtstag180421" target="_blank" rel="noopener noreferrer">Für schwache PCs: Nur der Dancefloor-Meetingraum</a><br><br><br>
    <b><a href="audio.php">Der Musik-Livestream</a></b><br><br><br><br>
</body>
</html>
