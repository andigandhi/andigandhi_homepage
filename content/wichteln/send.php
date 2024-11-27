
<?php
function logMail()
{
    global $username, $message, $target_dir, $songLink;

    $fileName = "../../../andigandhi_files/wichtel2024.txt";

    // full log
    $fp = fopen($fileName . ".log", "a");
    fwrite(
        $fp,
        $_SERVER["REMOTE_ADDR"] .
            "; " .
            $username .
            "; " .
            $songLink .
            "; " .
            $message
    );
    fwrite($fp, "\r\n");
    fclose($fp);

    //small log
    $fp = fopen($target_dir . $fileName, "a");
    fwrite($fp, ",\r\n");
    fwrite(
        $fp,
        '{"name": "' .
            $username .
            '", "link": "' .
            $songLink .
            '", "msg": "' .
            $message .
            '"}'
    );
    fclose($fp);
}

$username = filter_var($_POST["username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
str_replace(";", "", $username);
str_replace("\"", "", $username);
str_replace("{", "", $username);
$message = filter_var(
    substr($_POST["msg"], 0, 500),
    FILTER_SANITIZE_FULL_SPECIAL_CHARS
);
str_replace(";", "", $message);
str_replace("\"", "", $message);
str_replace("{", "", $message);
//Remove new lines
$message = trim(preg_replace("/\s+/", " ", $message));
$songLink = filter_var($_POST["songLink"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
str_replace(";", "", $songLink);
str_replace("\"", "", $songLink);
str_replace("{", "", $songLink);

logMail();

header("Location: bestaetigung.html");
die();


?>
