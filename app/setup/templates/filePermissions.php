<h3>File permissions</h3>

<?php if (!$goToNextStep) { ?>
	<div class="error">The Installer has insufficient file permissions on this server! Please check your chmod permissions or contact support to get this issue resolved.</div>
<?php } ?>

<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Real Path</th>
			<th>Required</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($showPermissions as $filename => $permissions): ?>
		<tr>
			<td><?php echo $filename; ?></td>
			<td><?php echo $permissions['realpath']; ?></td>
			<td><?php echo $permissions['showRequired']; ?></td>
			<td><?php if ($permissions['error'] == "") { ?><img src="img/icons/accept.png"> OK <?php } else { ?><img src="img/icons/cancel.png"><?php echo $permissions['error']; ?> <?php } ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<hr>

<?php if ($goToNextStep) { ?>
<form method="post">
	<input type="hidden" name="nextStep" value="appconfig">
			<a href="index.php" class="btn btn-danger">
	<img src="css/blueprint/plugins/buttons/icons/cross.png" alt=""/> Cancel
</a>

		<button type="submit" class="btn btn-success">
			<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Next
		</button>
</form>
<?php } else { ?>
	<form method="post">
		<input type="hidden" name="nextStep" value="filePermissions">
		<a href="index.php" class="btn btn-danger">
	<img src="css/blueprint/plugins/buttons/icons/cross.png" alt=""/> Cancel
</a>

		<button type="submit" class="btn btn-warning">
			<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Retry
		</button>
	</form>
<?php } ?>