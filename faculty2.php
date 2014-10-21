<!DOCTYPE HTML>
<html>
<head>
	<title>Faculty Page</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('const.php');

$con = mysqli_connect(HOST,USER,PASWD,DB);
if (mysqli_connect_errno()) 
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT * from preference where fac_id = '$_POST[fac]' and proj_id = '$_POST[proj]' and rollno = '$_POST[stud]'";

//$facid = "select fac_id from project where proj_id = '$_POST[proj]'";
$result = mysqli_query($con,$query) or die("unable to execute query");

$count = mysqli_num_rows($result);

if($count == 1)
{
	$query1 = "update preference set fac_pref = $_POST[pref] where fac_id = $_POST[fac] and proj_id = '$_POST[proj]' and rollno = $_POST[stud]";
	mysqli_query($con,$query1);
	echo "Your preference is updated.<br />";
	echo "<a href='home.php'>Go Home</a>";	
}
else
{
	echo "Faculty ID does not match with project ID.<br />";
	echo "<a href='home.php'>Go Home</a>";
}
?>
</body>
</html>
