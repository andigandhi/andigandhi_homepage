<?php
function sendMail($empfaenger, $link, $msg) {
    $betreff = "Cyber-Schrottwichteln";
    $from  = "From: sonnenbrandi <sonnenbrandi@andigandhi.ga>\r\n";
    $from .= "Content-Type: text/html\r\n";
    $text  = "<h2>Hey!</h2><p>Ich bin's der sonnenbrandi, ich wünsche Dir einen wundervollen Heiligabend und schöne Feiertage!</p><p>
    Danke dass du beim Cyber-Schrottwichteln mitgemacht hast, es hat mir sehr viel Spaß gemacht!</p><br><br>Hier ist dein Schrottwichtel-Bild:<br><br>";
    $text .= "<img src=\"https://andigandhi.ga/content/wichteln/".$link."\" alt=\"Wichtelbild\" style=\"width: 50%; height: auto;\"><br>";
    $text .= "<p>Zusätzliche Nachricht vom Wichtel:</p><p>".$msg."</p>";
    
    echo $text."<br><br>";
    //mail($empfaenger, $betreff, $text, $from);
}

function isMailAdrr($string) {
    if (filter_var($string, FILTER_VALIDATE_EMAIL) === false) return false;
    return true;
}

include("login.php");
if ($_GET["pw"] != $passwd) exit;

$fp = @fopen('../../../andigandhi_files/wichtelConnections.txt', 'r');
if ($fp) {
    $array = explode("\r", fread($fp, filesize('../../../andigandhi_files/wichtelConnections.txt')));
}

for ($i = 0; $i < count($array); $i++) {
    $curr = explode("; ", $array[$i]);
    $text = "<img src=\"https://andigandhi.ga/content/wichteln/".$curr[1]."\" alt=\"Wichtelbild\" style=\"width: 50%; height: auto;\"><br>";
    $text .= "<p>".$curr[2]."</p>";

    echo $text."<br><br>";
}

fclose($fp);

exit;

/*
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

$fp = fopen('../../../andigandhi_files/wichtelConnections.txt', 'w');

for ($i = 0; $i < count($array); $i++) {
    $curr = explode("; ", $array[$i]);
    $from = explode("; ", $array[$mixer[$i]]);
    if (isMailAdrr($curr[1])) {
        sendMail($curr[1], $from[2], $from[3]);
        echo $i.": Bild von " . $from[1] . " an <b>" . $curr[1] . "</b> gesendet!<br><br><hr><br><br>";
    } else {
        echo "<img src=\"https://andigandhi.ga/content/wichteln/".$from[2]."\" alt=\"Wichtelbild\" style=\"width: 50%; height: auto;\"><br>";
        echo "Nachricht vom Wichtel:<br>".$from[3];
        echo "<br><br>";
        echo $i.": Bild von " . $from[1] . " ist für <b>" . $curr[1] . "</b> bestimmt und kann online eingesehen werden.<br><br><hr><br><br>";
    }

    // Log connections for later
    fwrite($fp, md5($curr[1]).'; '.$from[2].'; '.$from[3]);
}
fclose($fp);
*/
?>