<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Richtgeschwindigkeit 130</title>
	<style>
		body {
			text-align: center;
		}
		th {
			vertical-align: middle;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<?php

	$tokenFile = "tokens.txt";

	function variable($get, $index) {
		if ($get) return isset($_GET[$index]) ? htmlspecialchars($_GET[$index]) : "";
		else return isset($_POST[$index]) ? htmlspecialchars($_POST[$index]) : "";
	}

	function generateToken() {
		global $tokenFile;
		$newToken = random_int(100000,999999);

		$fp = fopen($tokenFile, 'a');
		fwrite($fp, $newToken."\n");  
		fclose($fp);  

		return $newToken;
	}

	function testToken($token) {
		global $tokenFile;
		$contents = file_get_contents($tokenFile);

		return str_contains($contents, $token."\n");
	}

	function useToken($token) {
		global $tokenFile;
		$contents = file_get_contents($tokenFile);
		$contents = str_replace($token."\n", '', $contents);
		file_put_contents($tokenFile, $contents);
	}

	function logToken($token, $generated1, $generated2, $name, $tel) {
		$fp = fopen("TokenLog.txt", 'a');
		fwrite($fp, $name." ".$tel." ".$token." ".$generated1." ".$generated2."\n");
		telegram($name." ".$tel." ".$token." ".$generated1." ".$generated2);
		fclose($fp);  
	}

	function telegram($msg) {
		include('../../telegramVar.php');
		$telegramchatid = -338197126; //698532846;
	
		$url="https://api.telegram.org/bot".$telegrambot."/sendMessage";$data=array("chat_id"=>$telegramchatid,"text"=>$msg);
		$options=array("http"=>array("method"=>"POST","header"=>"Content-Type:application/x-www-form-urlencoded\r\n","content"=>http_build_query($data),),);
		$context=stream_context_create($options);
		$result=file_get_contents($url,false,$context);
		return $result;
	}

	$token = variable(true, "token");
	$name = variable(false, "name");
	$tel = variable(false, "tel");

	if ($token == "") {
		echo('
		<h2>Gib deinen Token ein:</h2>
		<form action="" method="get">
			<input type="text" id="tokenTxt" class="form-control" name="token" placeholder="Token" required="required">
			<br><br><br>
			<input type="submit" value="Token eingeben" name="submitBtn" id="idSubmit">
		</form>
		');	
	} elseif (!testToken($token)) echo (
		'<h2>Dieser Token ist ungültig!</h2>
		Entweder hast du (oder jemand anderes) sich schon mit diesem Link angemeldet oder du hast dich vertippt.<br>
		Sollte nichts von beidem zutreffen dann kannst du mich gerne anschreiben!'
	);
	elseif ($name == "") echo (
		'<h2>Glückwunsch! Du hast eine persönliche Einladung zum 5. Autobahnrave erhalten.</h2>
		<b>Wie funktioniert die Anmeldung dieses Jahr?</b><br>
		Du gibst deinen Namen und deine Handynummer ein, damit kommst du in die Whatsapp-Gruppe.<br>
		Im Anschluss bekommst du zwischen 0 und 3 Einladungslinks, welche du weitergeben kannst.<br>
		<div id="form" class="formDiv">
		<form action="" method="post">
			<input type="text" id="nameTxt" class="form-control" name="name" placeholder="Name" required="required">
			<br>
			<input type="text" id="fonTxt" class="form-control" name="tel" placeholder="Handynummer" required="required">
			<br><br><br>
			<input type="submit" value="Absenden" name="submitBtn" id="idSubmit">
		</form>
		</div>'
	);
	else {
		useToken($token);

		echo(
			'<hr>
			<table style="margin-left:auto;margin-right:auto;">
				<tr>
					<th style="text-align: right;">
						Datum: xx.xx.2022<br>
						Name: '.$name.', Tel: '.$tel.'<br>
						Ticket nicht übertragbar.
					</th>
					<th>
						<img src="https://api.qrserver.com/v1/create-qr-code/?data='.$name.'  '.$tel.'  '.$token.'&amp;size=100x100&amp;color=0000ff&amp;bgcolor=ffffff" alt="" title="" />
					</th>
				</tr>
			  </table> 
			<hr>'
		);

		$token1 = "";
		$token2 = "";

		if (rand(0,100) < 10) echo('
			<h2>Schade!</h2>
			Leider hast du keinen Einladungslink "gewonnen".
		
			<hr>
		');
		elseif (rand(0,100) < 0){
			$token1 = generateToken();
			echo('
			<h2>Gratulation</h2>
			Du hast einen weiteren Einladungslink für eine*n Freund*in gewonnen! Schicke einfach folgenden Link oder QR-Code.<br><br><br>
			<table style="margin-left:auto;margin-right:auto;">
				<tr>
				<th style="text-align: right;">
					<h1>'.$token1.'</h1>
					<a href="https://andigandhi.ga/content/autobahnrave5/?token='.$token1.'">https://andigandhi.ga/content/autobahnrave5/?token='.$token1.'</a>
				</th>
				<th>
				<img src="https://api.qrserver.com/v1/create-qr-code/?data=https://andigandhi.ga/content/autobahnrave5/?token='.$token1.'&amp;size=100x100" alt="" title="" />
				</th>
				</tr>
			</table> 
			<hr>
			');
		} else {
			$token1 = generateToken();
			$token2 = generateToken();
			echo('
			<h2>Gratulation!</h2>
			Du hast sogar zwei weitere Einladungslinks für deine Freund*innen gewonnen! Schicke ihnen einfach folgende Links oder QR-Codes.<br><br><br>
			<table style="margin-left:auto;margin-right:auto;">
				<tr>
				<th style="text-align: right;">
					<h1>'.$token1.'</h1>
					<a href="https://andigandhi.ga/content/autobahnrave5/?token='.$token1.'">https://andigandhi.ga/content/autobahnrave5/?token='.$token1.'</a>
				</th>
				<th>
				<img src="https://api.qrserver.com/v1/create-qr-code/?data=https://andigandhi.ga/content/autobahnrave5/?token='.$token1.'&amp;size=100x100" alt="" title="" />
				</th>
				</tr>
			</table> 
			<br><hr><br>
			<table style="margin-left:auto;margin-right:auto;">
				<tr>
				<th style="text-align: right;">
					<h1>'.$token2.'</h1>
					<a href="https://andigandhi.ga/content/autobahnrave5/?token='.$token2.'">https://andigandhi.ga/content/autobahnrave5/?token='.$token2.'</a>
				</th>
				<th>
				<img src="https://api.qrserver.com/v1/create-qr-code/?data=https://andigandhi.ga/content/autobahnrave5/?token='.$token2.'&amp;size=100x100" alt="" title="" />
				</th>
				</tr>
			</table> 
			<hr>
			');
		}

		logToken($token, $token1, $token2, $name, $tel);
	}
?>
</body>
</html>
