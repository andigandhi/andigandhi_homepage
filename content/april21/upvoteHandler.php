<?php

	function CheckUpvoted($string) {
		return exec('grep '.escapeshellarg($string).' bildergalerie/votes.txt');
	}

	function upvote($pic) {
		$pictures = json_decode(file_get_contents('bildergalerie/pictures.txt'), true);
		
		$pic = intval($pic);
		$pictures[$pic]["points"] = $pictures[$pic]["points"]+1;
		
		file_put_contents('bildergalerie/pictures.txt', json_encode($pictures));
	}

	$pic = $_POST["picNo"];
	$ip = hash('md5', $_SERVER['REMOTE_ADDR']);
	$string = $pic.$ip;
		
	if (CheckUpvoted($string)) {
		echo("Bereits abgestimmt.");
		exit();
	}

	upvote($pic);
	file_put_contents('bildergalerie/votes.txt', $string, FILE_APPEND | LOCK_EX);
	echo("OK.");
?>