<!DOCTYPE html>
<html>
<body>

	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	Name : <input type="text" name="fname">
	<input type="Submit">
	</form>

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$name=$_REQUEST['fname'];
		if(empty($name))
		{
			echo "Name is empty";
		}else{
			echo $name;
			}
	}
?>
</body>
</html>

