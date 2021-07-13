<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if($_FILES["templates"]["name"]) {
		$filename = $_FILES["templates"]["name"];
		$source = $_FILES["templates"]["tmp_name"];
		$type = $_FILES["templates"]["type"];
		
		$name = explode(".", $filename);
		$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
		foreach($accepted_types as $mime_type) {
			if($mime_type == $type) {
				$okay = true;
				break;
			} 
		}
		$continue = strtolower($name[1]) == 'zip' ? true : false;
		if(!$continue) {
			echo "The file you are trying to upload is not a .zip file. Please try again.";
		}
		$target_path = '../wp-content/plugins/rimplenet-templates/public'.$filename;  // change this to the correct site
		if(move_uploaded_file($source, $target_path)) {
			$zip = new ZipArchive();
			$x = $zip->open($target_path);
			if ($x === true) {
				$zip->extractTo('../wp-content/plugins/rimplenet-templates/public'); // change this to the correct
				$zip->close();
		
				unlink($target_path);
			}
			echo "Your .zip file was uploaded and unpacked.";
		} else {	
			echo "There was a problem with the upload. Please try again.";
		}
	}
}

 ?>

<form action="" method="post" enctype="multipart/form-data">
	<h4>Upload Your File Here</h4>
	<input type="file" name="templates"><br><br>
	
	<button type="submit">Upload</button>
</form>


