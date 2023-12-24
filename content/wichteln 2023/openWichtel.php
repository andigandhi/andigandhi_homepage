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
<style>
    body {
        background-color: #112;
        color: #CCA;
        padding-left: 5%;
        padding-right: 5%;
    }
    textarea, input, a {
        background-color: #334;
        color: #DDF;
        font-size: 120%;
        width: 80%;

    }
    </style>
	<meta charset="utf-8">
	<title>Cyber-Schrottwichteln</title>

    <?php
    function replaceStr($string) : String {
        return preg_replace('/[\.@]?bsky\.social/i', '', str_replace('@', '', $string));
    }

    function shuffleArray($array) {
        for ($i = 0; $i <3; $i++) {
            $firstElement = array_shift($array); // Remove the first element
            $array[] = $firstElement; // Append the removed element at the end
        }
    
        return $array;
    }

    if ($_POST["email"] == "") {
    echo '
    <h2>Cyber-Schrottwichteln</h2>
	<form action="" method="post" style="text-align: center;">
        <input type="text" id="emailTxt" class="form-control" name="email" placeholder="Dein Benutzername oder E-Mail" required="required" size="63">
        <input type="submit" value="Wichtelbild einsehen" name="submit" id="idSubmit">
    </form>
    ';
    }
    else {
        // $fp = @fopen('wichteln2023.json', 'r');
        $jsonData = file_get_contents('wichteln2023.json');

        $jsonData = substr($jsonData, 0, -1)."]";

        // Decode the JSON data into an associative array
        $arrayData = json_decode($jsonData, true);

        $arrayData2 = shuffleArray($arrayData);

        $user = null;

        // Access the array elements
        if ($arrayData !== null) {
            //foreach ($arrayData as $arrayElem) {
            for ($i=0; $i<count($arrayData);$i++) {
                if (replaceStr($arrayData[$i]["name"]) == replaceStr($_POST["email"])) {
                    $user = $arrayData2[$i];
                    break;
                }
            }
        } else {
            // Handle JSON decoding error
            echo "<h1>Failed to parse JSON.</h1>";
        }

        $text  = "<h2>Hey!</h2><p>Ich bin's der sonnenbrandi, ich wünsche Dir einen wundervollen Heiligabend!</p><p>Danke dass du beim Musikwichteln mitgemacht hast, es hat mir sehr viel Spaß gemacht!</p><br><br>Hier ist dein Wichtelgeschenk:<br><br><br><hr>";
        $text .= "<a href=\"".$user["link"]."\">".$user["link"]."</a><br>";
        $text .= "<p>Zusätzliche Nachricht vom Wichtel:</p><p><b>".$user["msg"]."</b></p><hr>";
        
        echo $text."<br><br>";

        //fclose($fp);
    }
    ?>
</body>
</html>