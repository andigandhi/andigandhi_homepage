<?php 
	function combine_images() {
		$bg_img = imagecreatefrompng('paint.png');
		$fr_img = imagecreatefrompng('paint_temp.png');
		
		imagealphablending($bg_img, true);
		imagesavealpha($bg_img, true);

		imagecopy($bg_img, $fr_img, 0, 0, 0, 0, imagesx($bg_img), imagesy($bg_img));
		
		header('Content-Type: image/png');
		imagepng($bg_img, 'paint.png');
		//unlink('paint/paint.png');
		//rename('paint/paint1.png', 'paint/paint.png');
	}

	// move_uploaded_file($_FILES["imgData"]["tmp_name"], 'paint/paint.png');
	
	define('UPLOAD_DIR', '');
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	// echo($data);
	$file = UPLOAD_DIR . 'paint_temp.png';
	if(!is_file(UPLOAD_DIR . 'paint.png')){
		$file = UPLOAD_DIR . 'paint.png';
		$success = file_put_contents($file, $data);
		return;
	}

	$success = file_put_contents($file, $data);
	combine_images();

	echo("Erfolgreich!");
?>
