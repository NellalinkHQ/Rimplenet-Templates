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
		$target_path_dir =  plugin_dir_path(dirname(__DIR__ ))."public/templates";
		$target_path =  $target_path_dir."/$filename";
		if(move_uploaded_file($source, $target_path)) {
			$zip = new ZipArchive();
			$x = $zip->open($target_path);
			if ($x === true) {
				$zip->extractTo($target_path_dir); // extract zip to the directory
				$zip->close();
		
				unlink($target_path);
			}
			echo "Your .zip template was uploaded and extracted successfully.";
		} else {	
			echo "There was a problem with the upload. Please try again.";
		}
	}
}
 ?>

<form action="" method="post" accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed" enctype="multipart/form-data">
	<h4>Upload Your File Here</h4>
	<input type="file" name="templates"><br><br>
	
	<button type="submit">Upload</button>
</form>


