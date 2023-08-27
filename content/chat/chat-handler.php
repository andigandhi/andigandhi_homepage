<?php 
	// Deletes the first line of the chat.txt file
	function delete_first_line($filename) {
		$file = file($filename);
		unset($file[0]);
		file_put_contents($filename, $file);
	}

	// Sends Matrix message to the channel
	function matrixSend($msg) {
		require '../../matrix/MatrixTexter.php';
		include('../../matrix/matrixVar.php');

		$accessToken = \MatrixTexter\login($homeserver, $username, $password);

		\MatrixTexter\sendMessage($homeserver, $accessToken, $roomID, $msg);
	}

	function sendMessage($username, $msg) {
		if ($username != "" and $msg != "") {
			// Send the message to the chat.txt file
			$fp = fopen('chat.txt', 'a');
			fwrite($fp, '<li><strong style="color: #'.abs(crc32($_SERVER['REMOTE_ADDR']) % 1000).'">'.$username.': </strong>'.$msg.' <small>'.date("d.m. H:i").'</small></li>');  
			fwrite($fp, "\r\n");  
			fclose($fp);
			delete_first_line("chat.txt");

			// Log the message
			$fp = fopen('../../../andigandhi_files/chatlog.txt', 'a');
			fwrite($fp, date("Y-m-d H:i").' '.$_SERVER['REMOTE_ADDR'].', '.$username.','.$msg);  
			fwrite($fp, "\r\n");  
			fclose($fp);
			
			// Send the message via telegram
			matrixSend($username.": ".$msg);
		}
	}


	$username = filter_var(substr($_GET["usr"],0,15), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if ($username != 'undefined') {
		$msg = filter_var(substr($_GET["msg"],0,65), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		sendMessage($username, $msg);
		// If the message is to long, split it
		$msg = filter_var(substr($_GET["msg"],65,65), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if ($msg != "") sendMessage($username, $msg);
	}

	// if file wasn't manipulated the last 8s the send no update
	if ($_GET["refresh"] != "t") {
		if ((time() - filemtime('chat.txt')) > 8) {
			echo("no_msg");
			return;
		}
	}
	// Else: send the new chat.txt
	echo( file_get_contents('chat.txt') );
?>
