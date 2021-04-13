<?php
header("HTTP/1.1 302 Found"); 
header("location: http://andigandhi.ddns.net:8000/mpd.mp3?" . strval( random_int(0,10000) ) ); 
?>
