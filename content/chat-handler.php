<?php 
	function delete_first_line($filename) {
		$file = file($filename);
		unset($file[0]);
		file_put_contents($filename, $file);
	}

	$username = filter_var(substr($_GET["usr"],0,15), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if ($username != 'undefined') {
		$msg = filter_var(substr($_GET["msg"],0,60), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if ($username != "" and $msg != "") {
			$fp = fopen('chat.txt', 'a');
			fwrite($fp, '<li><strong style="color: #'.abs(crc32($_SERVER['REMOTE_ADDR']) % 1000).'">'.$username.': </strong>'.$msg.'</li>');  
			fwrite($fp, "\r\n");  
			fclose($fp);
			
			$fp = fopen('chatlog.txt', 'a');
			fwrite($fp, date("Y-m-d H:i").' '.$_SERVER['REMOTE_ADDR'].', '.$username.','.$msg);  
			fwrite($fp, "\r\n");  
			fclose($fp);
			
			delete_first_line("chat.txt");
		}
	}

	if ($_GET["refresh"] != "t") {
		if ((time() - filemtime('chat.txt')) > 10) {
			echo("no_msg");
			return;
		}
	}

	echo( file_get_contents('chat.txt') );
?>