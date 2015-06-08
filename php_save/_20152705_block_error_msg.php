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