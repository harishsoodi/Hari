<?php

if(isset($_POST['sent']) && $_POST['sent']=="yes")
{
	/* check each field except middle name for blank fields */
	foreach ($_POST as $field => $value) 
	{
		if ($value=="") 
		{
			if($field!="middle_name")
			{
				$blank_array[]=$field;
			}
		}
		else
		{
			$good_data[$field]=strip_tags(trim($value));
		}
	}

	if(@sizeof($blank_array)>0)
	{
		$message = "<p style='color: red; margin-bottom: 0;
					font-weight: bold'>
					You didn’t fill in one or more required fields.
					You must enter:
			<ul style='color: red; margin-top: 0;
					list-style: none' >";

					/* display list of missing information */

					foreach ($blank_array as $value) 
					{
						$message.="<li>$value</li>";
					}
					$message.="</ul>";

					/* redisplay form */
					extract($good_data);
					include('process_form_value.php');
					exit();
	}
	echo "All Required fields contain information";

}
else
{
	include ('process_form_value.php');
}
?>