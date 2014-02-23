<h3>Importing SQL</h3>

<p>Now we are importing the needed data into our database...</p>
<hr>

<?php if (count($errors) > 0) { ?>
	<div class="alert alert-danger">Some errors occured while importing the SQL data!</div>
	
	<ul>
		<?php foreach ($errors as $error): ?>
			<li><?php echo $error; ?></li>
		<?php endforeach; ?>
	</ul>
<?php } else { ?>
	<div class="alert alert-success">Data import succeeded!</div>
<?php } ?>

<hr>

<?php if (count($errors) == 0) { ?>
	<form method="post">
		<input type="hidden" name="nextStep" value="done">
		<a href="index.php" class="btn btn-danger">
			<img src="css/blueprint/plugins/buttons/icons/cross.png" alt=""/> Cancel
</a>
		<button type="submit" class="btn btn-success">
			<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Next
		</button>
	</form>
<?php } else { ?>
	<form method="post">
		<input type="hidden" name="nextStep" value="importSQL">
<a href="index.php" class="btn btn-danger">
	<img src="css/blueprint/plugins/buttons/icons/cross.png" alt=""/> Cancel
</a>

		<button type="submit" class="btn btn-warning">
			<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Retry
		</button>
	</form>
<?php } ?>