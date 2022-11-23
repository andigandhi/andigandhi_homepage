
<?php

function logMail() {
    global $username, $message, $target_dir, $songLink;

    // full log
    $fp = fopen('wichtelLog.txt', 'a');
    fwrite($fp, $_SERVER['REMOTE_ADDR'].'; '.$username.'; '.$songLink.'; '.$message);  
    fwrite($fp, "\r\n");  
    fclose($fp);

    //small log
    $fp = fopen($target_dir . 'out.json', 'a');
    fwrite($fp, '{"name": "'.$username.'", "link": "'.$songLink.'", "msg": "'.$message.'"},');  
    fwrite($fp, "\r\n");  
    fclose($fp);
}

$username = filter_var($_POST["username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
str_replace(";",",",$username);
$message = filter_var(substr($_POST["msg"],0,500), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
str_replace(";",",",$message);
//Remove new lines
$message = trim(preg_replace('/\s+/', ' ', $message));
$songLink = filter_var($_POST["songLink"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//Check for valid mail
//if (filter_var($username, FILTER_VALIDATE_EMAIL) === false) {
//    echo "-- <b>" . $username . " scheint keine E-Mail Adresse zu sein. Mit diesem Namen hast du am 24. auf dieser Homepage Zugang zu deinem Wichtelgeschenk.</b><br>";
//}

logMail();
echo "Danke fürs Mitmachen!<br>";
echo "<b>Du bekommst dein digitales Schrottwichtel Geschenk am 24. Dezember!</b><br><br>";

echo "<pre style=\"color: darkgreen;\">
      .
   __/ \__
   \     /
   /.'o'.\
    .o.'.
   .'.'o'.
  o'.o.'.o.
 .'.o.'.'.o.
.o.'.o.'.o.'.
   [_____]
    \___/
    </pre>";
?>