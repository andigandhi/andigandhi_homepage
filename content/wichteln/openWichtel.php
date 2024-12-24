<html>
<head>

    <style>
        body {
            background-color: #112;
            color: #CCA;
            padding-left: 5%;
            padding-right: 5%;
            text-align: center;
            font-size: 120%;
        }
        input {
            background-color: #334;
            color: #ddf;
            font-size: 200%;
            width: 80%;
        }
        input[type="submit"] {
            height: 150px;
        }
    </style>
	<meta charset=\"utf-8\">
	<title>Cyber-Schrottwichteln</title>
</head>

<body>
    <?php
    // Function to search in the Array
    function getArrayElement($array, $element)
    {
        $length = count($array);
        $elem_reg = preg_replace("/\W/", "", $element);
        for ($i = 0; $i < $length; $i++) {
            if (preg_replace("/\W/", "", $array[$i]["name"]) == $elem_reg) {
                return ($i + 1) % $length;
            }
        }
        return null;
    }

    $wichtelFile = "files/wichtel2024.txt";

    if ($_POST["email"] == "") {
        echo '
            <h2>Cyber-Schrottwichteln</h2>
           	<form action="" method="post" style="text-align: center;">
                <input type="text" id="emailTxt" class="form-control" name="email" placeholder="Dein Benutzername oder E-Mail" required="required" size="63"><br><br>
                <input type="submit" value="Wichtelbild einsehen" name="submit" id="idSubmit">
            </form>
        ';
    } else {
        $json = file_get_contents($wichtelFile);

        $json = "[" . $json . "]";

        if ($json === false) {
            die("Error reading the JSON file");
        }

        $json_data = json_decode($json, true);

        if ($json_data === null) {
            die("Error decoding the JSON file");
        }

        $elementNo = getArrayElement($json_data, $_POST["email"]);

        if ($elementNo == "") {
            die("Nutzer nicht gefunden :(");
        }

        $element = $json_data[$elementNo];

        $text =
            "<h2>Hey!</h2><p>Ich bin's der sonnenbrandi, ich wünsche Dir einen wundervollen Heiligabend!</p><p>Danke dass du beim Musikwichteln mitgemacht hast, es hat mir sehr viel Spaß gemacht!</p><br><br>Hier ist dein Song:<br><br><b>";
        if (str_starts_with($element["link"], "http")) {
            $text .=
                "<a href=\"" .
                $element["link"] .
                "\">" .
                $element["link"] .
                "</a>";
        } else {
            $text .= $element["link"];
        }
        $text .=
            "</b><p>Zusätzliche Nachricht vom Wichtel:</p><p>" .
            $element["msg"] .
            "</p>";

        echo $text . "<br><br>";
    }
    ?>
</body>
</html>
