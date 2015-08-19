<!DOCTYPE html>
<html>
<body>

<?php  
	$name= $email = $website =$gender=$comment="";
	$nameErr=$emailErr=$websiteErr=$genderErr=$commentErr="";

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["name"]))
		{
			$nameErr="Name is required ";
		}else
		{
		$name=test_input($_POST["name"]);
			if(!preg_match("/^[a-zA-Z]*$/",$name))
			{
				$nameErr="Only letters and white space allowed";
			}
		}	
		if(empty($_POST["email"]))
		{
			$emailErr="Email is required ";
		}else{

		$email=test_input($_POST["email"]);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$emailErr="Invalid Email Format";

			}
		}
		if(empty($_POST["website"]))
		{
			$websiteErr=" ";
		}else
		{
		$website=test_input($_POST["website"]);
		if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
			$websiteErr="Invalid URL";
			}
		}	
		if(empty($_POST["comment"]))
		{
			$commentErr=" ";
		}else
		{
		$comment=test_input($_POST["comment"]);
		}
		if(empty($_POST["gender"]))
		{
			$genderErr="Gender is required ";
		}else
		{
		$gender=test_input($_POST["gender"]);
		}	
	}

	function test_input($data)
	{
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
?>
<?php   echo "<h2> Your Form Data is :</h2>";
	echo $name;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $website;
	echo "<br>";
	echo $comment;
	echo "<br>";
	echo $gender;
	echo "<br>";
?>
<h2> PHP Form Validation </h2>
<form method="post" 
action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

Name    : <input type="text" name="name" value="<?php echo $name; ?>">
	  <span class="error">* <?php echo $nameErr;?><br><br> 
Email   : <input type="text" name="email" value="<?php echo $email; ?>">
		<span class="error">* <?php echo $emailErr;?><br><br>

Website : <input type="text" name="website" value="<?php echo $website;?>">
<br><br>
Comment : <textarea name="comment" rows="20" cols="40"><?php echo $comment;?>
</textarea><br><br>
Gender  : <input type="radio" name="gender"
 	<?php if(isset($gender) && $gender=="female") echo "checked";?>
	 value="female">Female
	<input type="radio" name="gender"
	<?php if(isset($gender) && $gender=="male" echo "checked"; ?>
	 value="male">Male
		<span class="error">* <?php echo $genderErr;?><br><br>
<input type="submit" value="Submit">
</form>

</body>
</html>


