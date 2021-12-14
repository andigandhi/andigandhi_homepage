<?php
function sendMail($empfaenger) {
    $betreff = "Cyber-SchrottWichteln";
    $from = "From: sonnenbrandi <sonnenbrandi@andigandhi.ga>\r\n";
    $from .= "Reply-To: antwort@domain.de\r\n";
    $from .= "Content-Type: text/html\r\n";
    $text = "Hey!<br>Ich wünsche Dir einen wundervollen Heiligabend! Hier ist dein Schrottwichtel-Bild:";
    
    mail($empfaenger, $betreff, $text, $from);
}

sendMail("andigrasser13@gmail.com");

?>