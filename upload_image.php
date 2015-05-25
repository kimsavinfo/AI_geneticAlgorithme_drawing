<?php

session_start();
$_SESSION = array();

if(isset($_FILES['user_file']))
{
	$upload_dir = 'uploaded/';
	$upload_file = $upload_dir.basename($_FILES['user_file']['name']);

	if (move_uploaded_file($_FILES['user_file']['tmp_name'], $upload_file)) 
	{
		$_SESSION['upload_file'] = $upload_file;
	} 
	else 
	{
		$_SESSION['message_danger'] = "Error, can you try latter again pleaser ?";
		$_SESSION['file'] = $_FILES;
	}
}
else
{
	$_SESSION['message_danger'] = "Empty file, we'll use the french flag instead ;)";
}

header('Location: index.php');