<?php
$date_now = new DateTime();
$date2    = new DateTime("02/04/2021");

if ($date_now > $date2) {
    include("galerie.html");
}else{
    include("paint.html");
}
?>
