<?php
	function addJSON($pictures, $name) {
		$newData['user'] = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['user']);
		$newData['title'] = substr(preg_replace("/[^a-zA-Z0-9]+/", " ", $_POST['title']), 0, 25);
		$newData['name'] = $name;
		$newData['points'] = 0;
		
		array_push($pictures, $newData);
		
		file_put_contents('bildergalerie/pictures.txt', json_encode($pictures));
		file_put_contents('../../../andigandhi_files/aprilBak/pictures.txt', json_encode($pictures));
	}

	define('UPLOAD_DIR', 'bildergalerie/');
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	
	$pictures = json_decode(file_get_contents('bildergalerie/pictures.txt'), true);
	$lineNo = count($pictures);

	$file = UPLOAD_DIR . $lineNo .'.png';
	file_put_contents('../../../andigandhi_files/aprilBak/'.$lineNo.'.png', $data);
	$success = file_put_contents($file, $data);

	addJSON($pictures, $lineNo);

	echo("Erfolgreich!");
?>
