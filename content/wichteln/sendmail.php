<?php
function sendMail($empfaenger, $link, $msg) {
    $betreff = "Cyber-SchrottWichteln";
    $from  = "From: sonnenbrandi <sonnenbrandi@andigandhi.ga>\r\n";
    $from .= "Content-Type: text/html\r\n";
    $text  = "Hey!<br>Ich bin's der sonnenbrandi! Ich wünsche Dir einen wundervollen Heiligabend!<br>Danke fürs mitmachen!<br><br>Hier ist dein Schrottwichtel-Bild:<br><br>";
    $text .= "<img src=\"https://andigandhi.ga/content/wichteln/".$link."\" alt=\"Wichtelbild\"><br><br>";
    $text .= "Zusätzliche Nachricht vom Wichtel: ".$msg."<br><br>";
    
    echo $text."<br><br><br><br><br>";
    //mail($empfaenger, $betreff, $text, $from);
}

include("login.php");
if ($_GET["pw"] != $passwd) exit;

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
// remove dublicates
for ($i = 0; $i < count($mixer); $i++) {
    if ($i == $mixer[$i]) {
        $mixer[$i] = $mixer[($i+1)%count($mixer)];
        $mixer[($i+1)%count($mixer)] = $i;
    }
}

for ($i = 0; $i < count($array); $i++) {
    $curr = explode("; ", $array[$i]);
    $from = explode("; ", $array[$mixer[$i]]);
    sendMail($curr[1], $from[2], $from[3]);
    echo $i.": Bild von " . $from[1] . " an <b>" . $curr[1] . "</b> gesendet!<br>";
}

?>