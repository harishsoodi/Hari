<!DOCTYPE html>
<html>
<body>

<?php

	$x=5;
	
	function myTest()
	{
		
	echo "<p> Variable x inside function is : $x <p>";
	
	}
myTest();

echo "<p> Variable x outside function is : $x <p>";
	
	$p=5;
	$q=10;
	
	function myadd()
	{
	 global $p,$q;
	$q=$p+$q;

	}
	myadd();
	echo $q;
	echo "<br>";

	function mystatic()
	{
	static $s=0;
	echo $s;
	$s++;
	echo "<br>";

	}

mystatic();
mystatic();
mystatic();

?> 

</body>
</html>

