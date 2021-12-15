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

$filename = '../../../andigandhi_files/wichtelLog.txt';
// Open the file
$fp = @fopen($filename, 'r'); 

// Add each line to an array
if ($fp) {
   $array = explode("\n", fread($fp, filesize($filename)));
}

array_pop($array);

$mixer = range(0, count($array)-1);
//shuffle the array
shuffle($mixer);

for ($i = 0; $i < count($array); $i++) {
    $curr = explode("; ", $array[$i]);
    $from = explode("; ", $array[$mixer[$i]]);
    //sendMail($curr[1], $from[2], $from[3]);
    echo $i.": Bild von " . $from[1] . " an <b>" . $curr[1] . "</b> gesendet!<br>";
}

?>