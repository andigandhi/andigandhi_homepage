<?php
if (new DateTime() > new DateTime("2021-04-17 01:00:00")) {
    include("jzParty.html");
}else{
    include("wait.html");
}
?>
