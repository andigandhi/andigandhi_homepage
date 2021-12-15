<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://unpkg.com/98.css" />
	<meta charset="utf-8">
	<title>Cyber-Schrottwichteln</title>
</head>

<body>
    <h2>Cyber-Schrottwichteln</h2>
    <?php
    if ($_POST["email"] == "") {
    echo '
	<form action="" method="post" style="text-align: center;">
        <input type="text" id="emailTxt" class="form-control" name="email" placeholder="Dein Benutzername oder E-Mail" required="required" size="63">
        <input type="submit" value="Wichtelgeschenk absenden" name="submit" id="idSubmit">
    </form>
    ';
    }
    else {
        // TODO
        $text  = "<h2>Hey!</h2><p>Ich bin's der sonnenbrandi, ich wünsche Dir einen wundervollen Heiligabend!</p><p>Danke dass du beim Cyber-Schrottwichteln mitgemacht hast, ich bin begeistert von der Resonanz haha!</p><br><br>Hier ist dein Schrottwichtel-Bild:<br><br>";
        $text .= "<img src=\"https://andigandhi.ga/content/wichteln/".md5($_POST["email"]).".jpg\" alt=\"Wichtelbild\" style=\"width: 50%; height: auto;\"><br>";
        $text .= "<p>Zusätzliche Nachricht vom Wichtel:</p><p>--</p>";
        
        echo $text."<br><br>";
    }
    ?>
</body>
</html>