<h3>Database connection</h3>

<p>
	We need some information on the database. In all likelihood, these items were supplied to you by your Web Host. If you do not have this information, then you will need to contact them before you can continue.<br><br>
	Below you should enter your database connection details.
</p>
<hr>

<?php if ($error) { ?>
	<div class="alert alert-danger">
		<b>Error establishing a database connection: <?php echo $error; ?></b><br><br>
		This either means that the username and password information is incorrect or we can't contact the database server at <?php echo $host; ?>. Maybe your host's database server is down.<br><br>
		
		<ul>
			<li>Are you sure you have the correct username and password?</li>
    		<li>Are you sure that you have typed the correct hostname?</li>
    		<li>Are you sure that the database server is running?</li>
		</ul>
		
		If you're unsure what these terms mean you should probably contact your host. 
	</div>
<?php } ?>
<?php if ($goToNextStep) { ?>
<div class="alert alert-success">Everything is ok! Go to next step...</div>
<?php } ?>

<form method="post" class="form-horizontal">
	<?php if (!$goToNextStep) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Prefix </label>
		<div class="col-sm-6"><input class="form-control"  type="text" name="prefix" value="<?php echo $prefix; ?>">
			<span class="help-block">(The prefix for table)</span>
		 	</div>
	 </div>
	 <div class="form-group">
		<label class="col-sm-2 control-label">Database name </label>
		<div class="col-sm-6"><input class="form-control"  type="text" name="database" value="<?php echo $database; ?>">
			<span class="help-block">(The name of the database)</span>
		 	</div>
	 </div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Username</label>
		<div class="col-sm-6"><input class="form-control"  type="text" name="username" value="<?php echo $username; ?>">
			<span class="help-block">(Your MySQL username)</span>
		 	</div>
	 </div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Password</label>
		<div class="col-sm-6"><input class="form-control"  type="password" name="password" value="<?php echo $password; ?>">
			<span class="help-block">(...and MySQL password)</span>
		 	</div>
	 </div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Host</label>
		<div class="col-sm-6">
			<input class="form-control"   type="text" name="host" value="<?php echo $host; ?>">
			<span class="help-block">(You should be able to get this info from your web host, if "localhost" does not work.)</span>
	 	</div>
	 </div>
	
	<hr>
	<?php } ?>
	<?php if ($goToNextStep) { ?>
		<input type="hidden" name="nextStep" value="importSQL">
		<a href="index.php" class="btn btn-danger">
			<img src="css/blueprint/plugins/buttons/icons/cross.png" alt=""/> Cancel
</a>
		<button type="submit" class="btn btn-success">
			<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Next
		</button>
	<?php } else { ?>
		
		<input type="hidden" name="nextStep" value="database">
<a href="index.php" class="btn btn-danger">
	<img src="css/blueprint/plugins/buttons/icons/cross.png" alt=""/> Cancel
</a>

		<button type="submit" class="btn btn-warning">
			<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Retry
		</button>
	<?php } ?>
</form>