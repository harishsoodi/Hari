<?php

echo "<html>
<head><title>Form Fields</title></head>
<body>";

echo "<form action='process_form.php'
method='POST'>\n
<input type='text' name='fullname' />\n
<input type='submit' value='Submit Name' />\n
</form>\n";

echo "<ol>";
foreach($_POST as $field => $value)
{
echo "<li> $field = $value</li>";
}
echo "</ol>";
?>

</body></html>
<form action="process_form.php" method="POST">
<input type="text" name="fullname"><br>
<input type="submit" value="Submit">
</form>