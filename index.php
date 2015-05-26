<?php
require_once('params.php');
require_once('libs/file_manager.php');
require_once('genetic/ImageGoal.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>IA - Genetic Algorithm</title>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href="css/main.css" rel="stylesheet">
	</head>
	<body>

		<div class="jumbotron">
			<div class="text-center">
				<h1>Supervised learning with neural network</h1>
			</div>
		</div>
		
		<div class="container">
			<?php require_once('block_upload.php'); ?>
			
<?php
	if (isset($_SESSION['message_danger']))
	{
?>
			<?php require_once('block_error_msg.php'); ?>
<?php
	} 
	else if(isset($_SESSION['upload_file']))
	{
?>
			<?php require_once('block_results.php'); ?>
<?php
	}
?>
		</div>
	
		<div class="footer">
			<div class="text-center">
				<p>
					Arthur LAMBERT && Kim SAVAROCHE
				</p>
				<p>
					Date : 24/05/2015
				</p>
			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

<?php
	session_destroy();
?>