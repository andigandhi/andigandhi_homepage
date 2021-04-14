<?php
header("HTTP/1.1 302 Found");
if (new DateTime() < new DateTime("2021-04-18 04:00:00")) {
	header("location: http://andigandhi.ddns.net:8000/mpd.mp3"); 
} else {
	header("location: https://radio80k.out.airtime.pro/radio80k_a");
}
?>