<?php
function sendMail($empfaenger, $link, $msg) {
    $betreff = "Cyber-SchrottWichteln";
    $from  = "From: sonnenbrandi <sonnenbrandi@andigandhi.ga>\r\n";
    $from .= "Content-Type: text/html\r\n";
    $text  = "Hey!<br>Ich wünsche Dir einen wundervollen Heiligabend! Hier ist dein Schrottwichtel-Bild:<br>";
    $text .= "<img src=\"https://andigandhi.ga/content/wichteln/".$link."\" alt=\"Wichtelbild\"><br>";
    $text .= "Zusätzliche Nachricht: ".$msg."<br><br>";
    
    mail($empfaenger, $betreff, $text, $from);
}

$filename = "uploads/log.txt";
// Open the file
$fp = @fopen($filename, 'r'); 

// Add each line to an array
if ($fp) {
   $array = explode("\n", fread($fp, filesize($filename)));
}

for ($i = 0; $i < count($array)-1; $i++) {
    $curr = explode("; ", $array[$i]);
    if($curr != "") {
        sendMail($curr[1], $curr[2], $curr[3]);
        echo $i.": Mail an <b>" . $curr[1] . "</b> gesendet!<br>";
    }
}

?>