<?php
if (new DateTime() > new DateTime("2021-04-02 11:00:00")) {
    include("galerie.html");
}else{
    include("paint.html");
}
?>
