<?php
/* Program: Login_reg.php
* Desc:
Main application script for the User Login
*
application. It provides two options: (1) login
*
using an existing User Name and (2) register
*
a new user name. User Names and passwords are
*
stored in a MySQL database.
*/
session_start();
switch (@$_POST['Button'])
 {
	case 'Login':
		include('dbstuff.inc');
		$cxn=mysqli_connect($host,$user,$dbpassword,$database)
					or die("Query died: Could't connect to server" );
		$sql="Select user_name from Customer where user_name='$_POST[fusername]'";
		$result=mysqli_query($cxn,$sql) or die("Query Died: fusername");
		$num=mysqli_num_rows($result);

		if($num>0)
		{
			$sql="select user_name from Customer where user_name='$_POST[fusername]' and password=md5('$_POST[fpassword]')";
			$result2=mysqli_query($cxn,$sql) or die("Query died : fpassword");
			$num2=mysqli_num_rows($result2);

			if ($num2>0)
			{
				$_SESSION['auth']="Yes";
				$_SESSION['logname']=$_POST['fusername'];
				header("Location :SecretPage.php");
			}
			else
			{
				$message_1="The Login name, '$_POST[fusername]' exists, but you have entered the wrong Password! Please Try Again";
				$fusername=strip_tags(trim($_POST['fusername']));
				include('login_reg_form.php');
			}

		}
		elseif ($num==0)
		{
			$message_1="The User Name you have entered does not exist! Please Try Again";
			include('login_reg_form.php');
		}
		break;

	case 'Register':
		# check for blanks
		foreach ($_POST as $field => $value) 
		{
			if ($field!='fax') 
			{
				if ($value=="") 
				{
					$blanks[]=$field;
				}
				else
				{
					$good_data[$field]=strip_tags(trim($field));
				}	
			}
		}
		if (isset($blanks)) 
		{
			$message_2="The followinf fields are blank Please enter the required information :";
			foreach ($blanks as $value) 
			{
				$message_2.="$value,";
			}
			extract($good_data);
			include('login_reg_form.php');
			exit();
			
		}
		/*validate the data */
		foreach ($_POST as $field => $value) 
		{
			if (!empty($value)) 
			{
				if (preg_match("/name/i", $field) and !preg_match("/user/i", $field) and !preg_match("/log/i", $field) )
				{
					if (!preg_match("/^[A-Za-z' -]{1,50}$/",$value))
					{
						$errors[] = "$value is not a valid name. ";
					}
				}
				if(preg_match("/street/i",$field) or preg_match("/addr/i",$field) or preg_match("/city/i",$field))
				{
					if(!preg_match("/^[A-Za-z0-9.,' -]{1,50}$/",$value))
					{
						$errors[] = "$value is not a valid address or city. ";
					}
				}
				if(preg_match("/state/i",$field))
				{
					if(!preg_match("/^[A-Z][A-Z]$/",$value))
					{
						$errors[] = "$value is not a valid state code. ";
					}
				}
				if(preg_match("/email/i",$field))
				{
					if(!preg_match("/^.+@.+\\..+$/",$value))
					{
						$errors[] = "$value is not a valid email address.";
					}
				}
				if(preg_match("/zip/i",$field))
				{
					if(!preg_match("/^[0-9]{5,5}(\-[0-9]{4,4})?$/",$value))
					{
						$errors[] = "$value is not a valid zipcode. ";
					}
				}
				if(preg_match("/phone/i",$field) or preg_match("/fax/i",$field))
				{
					if(!preg_match("/^[0-9)(xX -]{7,20}$/",$value))
					{
						$errors[] = "$value is not a valid phone number. ";
					}
				}
			}
		}
		foreach($_POST as $field => $value)
		{
			$$field = strip_tags(trim($value));
		}
		if(@is_array($errors))
		{
			$message_2 = "";
			foreach($errors as $value)
			{
				$message_2 .= $value." Please try again<br />";
			}
			include("login_reg_form.php");
			exit();
		} // end if errors are found
		/* check to see if user name already exists */
		include("dbstuff.inc");
		$cxn = mysqli_connect($host,$user,$dbpassword,$database) or die("Couldn't connect to server");
		$sql = "SELECT user_name FROM Customer WHERE user_name='$user_name'";
		$result = mysqli_query($cxn,$sql) or die("Query died: user_name.");
		$num = mysqli_num_rows($result);
		if($num > 0)
		{
			$message_2 = "$user_name already used. Select another User Name.";
			include("login_reg_form.php");
			exit();
		} // end if user name already exists
		else
		{
			$today = date("Y-m-d");
			$sql = "INSERT INTO Customer (user_name,create_date, password,first_name,last_name,street,city,
					state,zip,phone,fax,email) VALUES ('$user_name','$today',md5('$password'), '$first_name', '$last_name','$street',
					'$city', '$state','$zip','$phone','$fax','$email')";
			mysqli_query($cxn,$sql);
			$_SESSION['auth']="yes";
			$_SESSION['logname'] = $user_name;
			/* send email to new Customer */
			$emess = "You have successfully registered. ";
			$emess .= "Your new user name and password are: ";
			$emess .= "\n\n\t$user_name\n\t";
			$emess .= "$password\n\n";
			$emess .= "We appreciate your interest. \n\n";
			$emess .= "If you have any questions or problems,";
			$emess .= " email service@ourstore.com";
			$subj = "Your new customer registration";
			$mailsend=mail("$email","$subj","$emess");
			header("Location: SecretPage.php");
		} // end else no errors found
		break;
	default:
		include('login_reg_form.php');
		break;
}

?>