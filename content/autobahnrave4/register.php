<?php
	function telegram($msg) {
		include('../../telegramVar.php');
		$telegramchatid = -338197126; //698532846;
	
		$url="https://api.telegram.org/bot".$telegrambot."/sendMessage";$data=array("chat_id"=>$telegramchatid,"text"=>$msg);
		$options=array("http"=>array("method"=>"POST","header"=>"Content-Type:application/x-www-form-urlencoded\r\n","content"=>http_build_query($data),),);
		$context=stream_context_create($options);
		$result=file_get_contents($url,false,$context);
		return $result;
	}
	
	function getIpAddr() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		return $details->city;	
	}

	$msg = filter_var($_GET["q"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if ($msg != 'undefined') {
		$fp = fopen('../../../andigandhi_files/anmeldung_a94.txt', 'a');
		fwrite($fp, date("Y-m-d H:i").' '.$_SERVER['REMOTE_ADDR'].', '.$msg);  
		fwrite($fp, "\r\n");
		fclose($fp);

		telegram(getIpAddr() . ": " . $msg);
	}
?>