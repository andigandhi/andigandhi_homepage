
<?php

function logMail($target_dir, $target_file) {
    $fp = fopen($target_dir . 'log.txt', 'a');
    fwrite($fp, $_SERVER['REMOTE_ADDR'].'; '.$_POST["email"].'; '.$target_file."; ".$_POST["msg"]);  
    fwrite($fp, "\r\n");  
    fclose($fp);
}

$target_dir = "uploads/";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
$target_file = $target_dir . md5($_POST["email"]) . "." . $imageFileType;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image!<br>";
        $uploadOk = 0;
    }
}

//Check for valid mail
if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) {
    echo "Das scheint keine richtige E-Mail Adresse zu sein.<br>";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        logMail($target_dir, $target_file);
        echo "The file has been uploaded.<br>";

        echo "<b>Du bekommst dein digitales Schrottwichtel Geschenk am 24. Dezember!</b>";
    } else {
        echo "Sorry, there was an error uploading your file.<br>".htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    }
}
?>
