<?php require 'bootstrap.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" width="device-width" initial-scale="1.0">
	<link rel="stylesheet" href="<?php echo CSS; ?>bootstrap.css">
	<link rel="stylesheet" href="<?php echo CSS; ?>main.css" media="screen">
</head>
<body>

	<div class="container">
		
		<div class="row header">
			<div class="col col-lg-12">
				<h1 class="text-center">Linkoo : A URL Shortener</h1>
				<hr>
			</div>
		</div>
		<!-- /.header -->

		<div class="form-controls">
			<div class="row">
				<div class="col col-lg-12">
					<label for="url-box">URL</label>
					<input type="text" name="urlBox" class="urlBox">
				</div>
			</div>
			<!-- /.row -->

			<div class="row button-row mt10">
				<div class="col col-lg-12">
					<input type="button" name="shortenBtn" class="btn shortenBtn btn-primary" value="Shorten">
				</div>
			</div>
			<!-- /.button-row -->
		</div>
		<!-- /.form-controls -->

	</div>
	<!-- /.container -->

	<script src="<?php echo JS; ?>jquery.js"></script>
	<script src="<?php echo JS; ?>shortener.js"></script>

</body>
</html>
