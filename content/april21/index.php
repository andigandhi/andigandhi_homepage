<?php
if (new DateTime() > new DateTime("2021-04-02 15:20:00")) {
    $act = $_GET["action"];
    if ($act == "gallery") {
        include("galerie.html");
    } else if ($act == "paint") {
        include("paint.html");
    } else {
        include("choice.html");
    }
}else{
    include("paint.html");
}
?>
