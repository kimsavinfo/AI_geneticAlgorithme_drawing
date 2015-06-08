<?php

session_start();

$_SESSION['upload_dir'] = "uploaded";
// Set a default image
if(!isset($_SESSION['upload_file']))
{
	$_SESSION['upload_file'] = $_SESSION['upload_dir']."/france.png";
	// $_SESSION['upload_file'] = $_SESSION['upload_dir']."/mario-pixelise.png";
}