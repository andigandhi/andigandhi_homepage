<?php
if (new DateTime() > new DateTime("2021-04-02 15:20:00")) {
    include("galerie.html");
}else{
    include("paint.html");
}
?>
