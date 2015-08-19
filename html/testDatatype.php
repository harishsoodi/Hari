<!DOCTYPE html>
<html>
<body>

<?php

	$x=5895;
	var_dump($x);

echo "<br>";

	$cars=array("volvo","BMW","Toyato");
	var_dump($cars);
 	
echo "<br>";

class car
{
	function car()
{
 $this->model="VW";

}
}
 $herbie=new car();
echo $herbie->model;

?>

</body>
</html>

