<?php 
	$msg = filter_var($_GET["q"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if ($msg != 'undefined') {
		$fp = fopen('../../../andigandhi_files/anmeldung_a94.txt', 'a');
		fwrite($fp, date("Y-m-d H:i").' '.$_SERVER['REMOTE_ADDR'].', '.$msg);  
		fwrite($fp, "\r\n"); 
	}
?>