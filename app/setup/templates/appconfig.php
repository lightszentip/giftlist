<h3>Application Settings</h3>

<p>We need some information for the application. Below you should enter your data for the application.</p>
<hr>

<?php if ($error) { ?>
	<div class="alert alert-danger">
        <ul>
            <?php if($isErrorCodeLength) { ?><li>The code length must be in the range 0 to 25?</li> <?php } ?>
            <?php if($isErrorEmailAddress) { ?><li>Are you sure that you have typed the a correct email address?</li><?php } ?>
            <?php if($isErrorDomainUrl) { ?><li>Are you sure that you have typed the a correct url and this end with '/'?</li><?php } ?>
            <?php if($isErrorAppName) { ?><li>Are you sure that you have typed a application name?</li><?php } ?>
            <?php if($isErrorAppAbbreviation) { ?><li>Are you sure that you have typed a shortcut for the application?</li><?php } ?>
        </ul>
	</div>
<?php } ?>
<?php if ($goToNextStep) { ?>
<div class="alert alert-success">Everything is ok! Go to next step...</div>
<?php } ?>
<form method="post" class="form-horizontal">
	<?php if (!$goToNextStep) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Url </label>
		<div class="col-sm-8">
			<input class="form-control" type="text" name="domainurl" value="<?php echo $domainUrl; ?>">
			<span class="help-block">(The domain for the application. For the example url http://localhost/ it is 'http://localhost/', if you use a subfolder  - you need 'http://localhost/subfolder/')</span>
	 	</div>
	 </div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Email Reply/From</label>
		<div class="col-sm-8">
			<input class="form-control" type="text" name="emailaddress" value="<?php echo $emailAddress; ?>">
			<span class="help-block">(Your email from and reply address)</span>
	 	</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Application Abbreviation</label>
		<div class="col-sm-8">
			<input class="form-control" type="text" name="appabbreviation" value="<?php echo $appabbreviation; ?>">
			<span class="help-block">(Your shortcut name of the application)</span>
	 	</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Application Name</label>
		<div class="col-sm-8">
			<input class="form-control" type="text" name="appname" value="<?php echo $appname; ?>">
			<span class="help-block">(Your application name)</span>
	 	</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Length for code</label>
		<div class="col-sm-2">
			<input class="form-control" type="number" name="codelength" value="<?php echo $codeLength; ?>">
			
	 	</div>
	 	<span class="help-block">(The Length of the code to release a present)</span>
	</div>
	<hr>
	<?php } ?>
	<?php if ($goToNextStep) { ?>

		<input type="hidden" name="nextStep" value="database">
		
		<a href="index.php" class="btn btn-danger">
			<img src="css/blueprint/plugins/buttons/icons/cross.png" alt=""/> Cancel
</a>
		<button type="submit" class="btn btn-success">
			<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Next
		</button>
	<?php } else { ?>
		<input type="hidden" name="nextStep" value="appconfig">
		<a href="index.php" class="btn btn-danger">
	<img src="css/blueprint/plugins/buttons/icons/cross.png" alt=""/> Cancel
</a>

		<button type="submit" class="btn btn-warning">
			<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Retry
		</button>
	<?php } ?>
</form>