<!DOCTYPE html>
<html>
<body>

<?php 

	define("GREETING" ,"Welcome to the world" );
	echo GREETING;
	
	echo "<br>";

	define("Greeting" , "Welcome to this world",true);
	echo greeting;
	echo "<br>";

	$colors= array("red","green", "black" , "brown");

	foreach($colors as $value)
	{
		echo "$value <br>";
	}	
	
?>


</body>
</html>
