<div class="row">
	<div class="col-md-12">

		<form method="post" action="upload_image.php" enctype="multipart/form-data">
			<div class="form-group">
				<label for="user_file">Image :</label>
				<input type="file" name="user_file" id="user_file">
				<p class="help-block">Accepted extension : png only</p>
				<p class="help-block">Size max : 1Mo max</p>
			</div>
			<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
			<div class="text-left">
				<input type="submit" name="submit" value="Upload" class="btn btn-primary" />
			</div>
		</form>
		
	</div>
</div>