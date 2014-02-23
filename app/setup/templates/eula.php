<h3>License</h3>

<div class="info">You must accept the License to continue!</div>

<textarea style="height: 300px; width: 98%;"><?php echo $eula; ?></textarea>
<hr>



<form method="post">
	<input type="hidden" name="nextStep" value="requirements">
	<a href="index.php" class="btn btn-danger">
	<img src="css/blueprint/plugins/buttons/icons/cross.png" alt=""/> Cancel
</a>
	<button type="submit" class="btn btn-success">
		<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> I accept the License
	</button>
</form>