
<?php

function logMail() {
    global $emailAddr, $message, $target_dir, $target_file;
    $fp = fopen($target_dir . 'log.txt', 'a');
    fwrite($fp, $_SERVER['REMOTE_ADDR'].'; '.$emailAddr.'; '.$target_file."; ".$message);  
    fwrite($fp, "\r\n");  
    fclose($fp);
}

$emailAddr = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$message = filter_var($_POST["msg"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$target_dir = "uploads/";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
$target_file = $target_dir . md5($emailAddr) . "." . $imageFileType;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
    if($check !== false) {
        echo "Deine Datei ist ein Bild - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "Deine Datei ist kein Bild!<br>";
        $uploadOk = 0;
    }
}

//Check for valid mail
if (filter_var($emailAddr, FILTER_VALIDATE_EMAIL) === false) {
    echo $emailAddr." scheint keine richtige E-Mail Adresse zu sein.<br>";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, diese Datei ist größer als 5Mb.<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, es sind nur JPG, JPEG, PNG & GIF Dateien erlaubt.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Die Datei wurde nicht hochgeladen...<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        logMail();
        echo "The file has been uploaded.<br>";

        echo "<b>Du bekommst dein digitales Schrottwichtel Geschenk am 24. Dezember!</b>";
    } else {
        echo "Es gab irgendeinen serverseitigen Fehler beim Hochladen :(<br>".htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    }
}
?>