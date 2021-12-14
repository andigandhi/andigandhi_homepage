<?php
function sendMail($empfaenger, $link, $msg) {
    $betreff = "Cyber-SchrottWichteln";
    $from  = "From: sonnenbrandi <sonnenbrandi@andigandhi.ga>\r\n";
    $from .= "Reply-To: antwort@domain.de\r\n";
    $from .= "Content-Type: text/html\r\n";
    $text  = "Hey!<br>Ich wünsche Dir einen wundervollen Heiligabend! Hier ist dein Schrottwichtel-Bild:\r\n";
    $text .= "<img src=\"https://andigandhi.ga/content/wichteln/uploads/".$link."\" alt=\"Wichtelbild\">";
    
    mail($empfaenger, $betreff, $text, $from);
}

$filename = "uploads/log.txt";
// Open the file
$fp = @fopen($filename, 'r'); 

// Add each line to an array
if ($fp) {
   $array = explode("\n", fread($fp, filesize($filename)));
}

for ($i = 0; $i < count($array); $i++) {
    $curr = explode("; ", $array[$i]);
    sendMail($curr[1], $curr[2], $curr[3]);
	echo "Mail an " . $curr[1] . " gesendet!";
}

?>