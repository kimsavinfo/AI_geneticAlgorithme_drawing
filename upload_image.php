<?php
require_once('params.php');

if(isset($_FILES['user_file']))
{	
	

	// Only accept png
	if($_FILES['user_file']['type'] == "image/png")
	{
		$upload_file = $_SESSION['upload_dir']."/".basename($_FILES['user_file']['name']);

		if (move_uploaded_file($_FILES['user_file']['tmp_name'], $upload_file)) 
		{
			print_r($_FILES['user_file']);
			$_SESSION['upload_file'] = $upload_file;
		} 
		else 
		{
			$_SESSION['message_danger'] = "Error server, can you try latter again pleaser ?";
			$_SESSION['file'] = $_FILES;
		}
	}
	else
	{
		$_SESSION['message_danger'] = "Error, the file is not a png";
		$_SESSION['file'] = $_FILES;
	}	
}
else
{	
	$_SESSION['message_danger'] = "Empty file, we'll use the french flag instead ;)";
}

header('Location: index.php');