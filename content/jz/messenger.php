<html>
<head>
<link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<h1>Dein Musikwunsch beim DJ</h1>
<br><br><br>
<form action="messenger.php" method="post">
    <div class="form-group">
        <label>Dein Name</label> <input type="text" class="form-control" name="name" placeholder="Dein Name (optional)">
    </div>
    <br><br>
    <div class="form-group">
        <label>Nachricht *</label> 
        <textarea class="form-control" name="message" placeholder="Musikwunsch oder was sonst auf dem Herzen liegt" required="required">
        </textarea>
    </div>
    <br><br>
    <input type="submit" class="btn btn-primary" name="button_name" value="Senden">
</form>

<?php

function telegram($msg) {
    include('telegramVar.php');
    $telegramchatid = 698532846;

    $url="https://api.telegram.org/bot".$telegrambot."/sendMessage";$data=array("chat_id"=>$telegramchatid,"text"=>$msg);
    $options=array("http"=>array("method"=>"POST","header"=>"Content-Type:application/x-www-form-urlencoded\r\n","content"=>http_build_query($data),),);
    $context=stream_context_create($options);
    $result=file_get_contents($url,false,$context);
    return $result;
}

if ( ($_POST["message"] ?? "") != "" ) {
    $name = $_POST["name"] ?? "anon";
    telegram($name . ": " . $_POST["message"]);
    echo "<br><br><br><h1>Alles Paletti!</h1>";
}
?>

</body>
</html>