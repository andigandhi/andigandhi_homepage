
<?php

function logMail() {
    global $username, $message, $target_dir, $songLink;

    $fileName = '../../../andigandhi_files/wichtel2022.txt';
    #$fileName = 'wichteln2022.json';

    // full log
    $fp = fopen($fileName.'.log', 'a');
    fwrite($fp, $_SERVER['REMOTE_ADDR'].'; '.$username.'; '.$songLink.'; '.$message);  
    fwrite($fp, "\r\n");  
    fclose($fp);

    //small log
    $fp = fopen($target_dir . $fileName, 'a');
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

echo "
<html>
<head>
	
    <style>
        body {
            background-color: #112;
            color: #CCA;
            padding-left: 5%;
            padding-right: 5%;
        }
        textarea, input {
            background-color: #334;
            color: #DDF;
            font-size: 120%;
            width: 80%;

        }
    </style>
	<meta charset=\"utf-8\">
	<title>Cyber-Schrottwichteln</title>
</head>
<body>
Danke fürs Mitmachen!<br>
<b>Du bekommst dein digitales Wichtel-Geschenk am 24. Dezember!</b><br><br>
<pre>
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
    </pre>
    </body>";
?>