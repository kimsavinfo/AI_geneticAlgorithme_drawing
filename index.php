<?php
	session_start();

	require_once('genetic/Individu.php');

	
	// $individu = new Individu(125,145,231,0.85);
	// echo $individu->to_string()."<br/>";
	// $individu->mutate();
	// echo $individu->to_string()."<br/>";


	// TODO ; déplacer dans /genetic : objet Image avec liste Pixels avec genome similaire à Individu
	if(!isset($_SESSION['upload_file']))
	{
		$_SESSION['upload_file'] = "uploaded/france.png";
	}
	if(isset($_SESSION['upload_file']))
	{
		// Get uploaded image pixels
		$image = imagecreatefrompng($_SESSION['upload_file']);
		$size = getimagesize($_SESSION['upload_file']);
	
		$_SESSION['upload_file_pixels'] = array();
		for ($iLine=0; $iLine < $size[0]; $iLine++) 
		{
			for ($iColumn=0; $iColumn < $size[1]; $iColumn++) 
			{
				$rgb = imagecolorat($image, $iLine, $iColumn);
				$colours = imagecolorsforindex($image, $rgb);

				$_SESSION['upload_file_pixels'][] = $colours;
			}
		}
	}
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
			<!-- Upload image form -->
			<form method="post" action="upload_image.php" enctype="multipart/form-data">
				<div class="form-group">
					<label for="user_file">Image :</label>
					<input type="file" name="user_file" id="user_file">
					<p class="help-block">Accepted extensions : jpg , jpeg , gif ou png)</p>
					<p class="help-block">Size max : 1Mo max</p>
				</div>
				<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
				<div class="text-center">
					<input type="submit" name="submit" value="Envoyer" class="btn btn-primary" />
				</div>
			</form>
			<hr>
<?php
	if (isset($_SESSION['message_danger']))
	{
?>
			<!-- Error zone -->
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-danger" role="alert" class="text-center">
						<?php 
							echo $_SESSION['message_danger']; 
							if(isset($_SESSION['file']))
							{
						?>
								<pre>
									<?php print_r($_SESSION['file']); ?>
								</pre>
						<?php 
							}
						?>
					</div>
				</div>
			</div>
<?php
	} 
	else if(isset($_SESSION['upload_file']))
	{
?>
			<!-- Image uploaded and genetic algorithm results -->
			<div class="row">
				<div class="col-md-12" class="text-center">
					<h2>Uploaded image</h2>
					<img src="<?php echo $_SESSION['upload_file']; ?>" class="img-responsive" alt="Responsive image">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" class="text-center">
					<h2>Main colours</h2>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-6" class="text-center">
					<h2>Pixels</h2>
<?php 
		if(isset($_SESSION['upload_file_pixels']))
		{
?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Red</th>
								<th>Blue</th>
								<th>Green</th>
								<th>Alpha</th>
							</tr>
						</thead>
						<tbody>
<?php
			foreach ($_SESSION['upload_file_pixels'] as $pixel)
			{
?>
							<tr>
								<td><?php echo $pixel["red"]; ?></td>
								<td><?php echo $pixel["green"]; ?></td>
								<td><?php echo $pixel["blue"]; ?></td>
								<td><?php echo $pixel["alpha"]; ?></td>
							</tr>
<?php
			}
?>
						</tbody>
					</table>
<?php
		}
?>
				</div>
				<div class="col-md-6" class="text-center">
					<!-- TODO : Espace pour les pixels générés par algo gen -->
				</div>
			</div>
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
>>>>>>> origin/master
