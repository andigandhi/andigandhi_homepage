<?php 
	function delete_first_line($filename) {
		$file = file($filename);
		unset($file[0]);
		file_put_contents($filename, $file);
	}

	function telegram($msg) {
		include('../../telegramVar.php');
		$telegramchatid = -1001696986492;
		$url="https://api.telegram.org/bot".$telegrambot."/sendMessage";$data=array("chat_id"=>$telegramchatid,"text"=>$msg);
		$options=array("http"=>array("method"=>"POST","header"=>"Content-Type:application/x-www-form-urlencoded\r\n","content"=>http_build_query($data),),);
		$context=stream_context_create($options);
		$result=file_get_contents($url,false,$context);
		return $result;
	}


	$username = filter_var(substr($_GET["usr"],0,15), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if ($username != 'undefined') {
		$msg = filter_var(substr($_GET["msg"],0,65), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if ($username != "" and $msg != "") {
			$fp = fopen('chat.txt', 'a');
			fwrite($fp, '<li><strong style="color: #'.abs(crc32($_SERVER['REMOTE_ADDR']) % 1000).'">'.$username.': </strong>'.$msg.' <small>'.date("d.m. H:i").'</small></li>');  
			fwrite($fp, "\r\n");  
			fclose($fp);
			fwrite($fp, date("Y-m-d H:i").' '.$_SERVER['REMOTE_ADDR'].', '.$username.','.$msg);  
			fwrite($fp, "\r\n");  
			fclose($fp);
			
			delete_first_line("chat.txt");

			telegram($username.": ".$msg);
		}
	}

	if ($_GET["refresh"] != "t") {
		if ((time() - filemtime('chat.txt')) > 8) {
			echo("no_msg");
			return;
		}
	}

	echo( file_get_contents('chat.txt') );
?>
