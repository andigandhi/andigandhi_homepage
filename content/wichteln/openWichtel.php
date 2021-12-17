<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://unpkg.com/98.css" />
	<meta charset="utf-8">
    <style>
        body {
            text-align: center;
        }
    </style>
	<title>Cyber-Schrottwichteln</title>
</head>

<body>
    <h2>Cyber-Schrottwichteln</h2>
    <?php
    if ($_POST["email"] == "") {
    echo '
	<form action="" method="post" style="text-align: center;">
        <input type="text" id="emailTxt" class="form-control" name="email" placeholder="Dein Benutzername oder E-Mail" required="required" size="63">
        <input type="submit" value="Wichtelbild einsehen" name="submit" id="idSubmit">
    </form>
    ';
    }
    else {
        $fp = @fopen('../../../andigandhi_files/wichtelConnections.txt', 'r');
        if ($fp) {
            $array = explode("\r", fread($fp, filesize('../../../andigandhi_files/wichtelConnections.txt')));
        }
        $searchMd5 = md5($_POST["email"]);
        
        for ($i = 0; $i < count($array); $i++) {
            $curr = explode("; ", $array[$i]);
            if ($curr[0] == $searchMd5) break;
        }

        $text  = "<h2>Hey!</h2><p>Ich bin's der sonnenbrandi, ich wünsche Dir einen wundervollen Heiligabend!</p><p>Danke dass du beim Cyber-Schrottwichteln mitgemacht hast, ich bin begeistert von der Resonanz haha!</p><br><br>Hier ist dein Schrottwichtel-Bild:<br><br>";
        $text .= "<img src=\"https://andigandhi.ga/content/wichteln/".$curr[1]."\" alt=\"Wichtelbild\" style=\"width: 50%; height: auto;\"><br>";
        $text .= "<p>Zusätzliche Nachricht vom Wichtel:</p><p>".$curr[2]."</p>";
        
        echo $text."<br><br>";

        fclose($fp);
    }
    ?>
</body>
</html>