<!DOCTYPE HTML>
<html>
<head>
	<title>Student Page</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
ini_set('display_errors', 1);
require('const.php');
$con = mysqli_connect(HOST,USER,PASWD,DB);

if (mysqli_connect_errno()) 
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query = "SELECT * from preference where rollno = $_POST[roll] and proj_id = '$_POST[proj]'";
$result = mysqli_query($con,$query);
$count = mysqli_num_rows($result);
if($count == 0)
{
	$facidq = "select fac_id from project where proj_id = '$_POST[proj]'";
	$result = mysqli_query($con,$facidq) or die("unable to insert");
	while ($row=mysqli_fetch_row($result)) {
		$facid = $row[0];
    }
	
	$query1 = "insert into preference(rollno, stud_pref, proj_id, fac_id) values('$_POST[roll]','$_POST[pref]','$_POST[proj]','$facid')";
	mysqli_query($con,$query1) or die("unable to insert");
	echo "Project preference inserted.<br />";
	echo "<a href='home.php'>Go Home</a>";
}
else
{
	$query1 = "update preference set stud_pref = $_POST[pref] where rollno = $_POST[roll] and proj_id = '$_POST[proj]'";
	mysqli_query($con,$query1) or die("unable to update");
	echo "Project preference updated.<br />";
	echo "<a href='home.php'>Go Home</a>";
}
?>
</body>
</html>
