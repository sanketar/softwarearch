<!DOCTYPE HTML>
<html>
<head>
	<title>Student Page</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
<form method="post">
Roll Number: <input class='tbox' type = "text" name = "rollno"><br><br>
<?php
require('const.php');
$con = mysqli_connect(HOST,USER,PASWD,DB);

if (mysqli_connect_errno()) 
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

printf("<input class='sbut' type='submit' value='Submit' formaction='student1.php'>");
//$i = 1;
echo "<br>";
echo "<h3>List of Projects</h3>";
$query = "select * from project";
$result = mysqli_query($con,$query);
echo "<table class='tablecss' border='1'><tr><th>Project ID</th><th>Project Name</th><th>Faculty ID</th></tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['proj_id'] . "</td>";
  echo "<td>" . $row['proj_name'] . "</td>";
  echo "<td>" . $row['fac_id'] . "</td>";
  echo "</tr>";
}
echo "</table>";
//echo "Enter your preference(1...10 -> highest...lowest)";
//echo "<br>";
/*while($row = mysqli_fetch_array($result))
{
	//printf("<input type='checkbox' name='check%d' value='%s%s'>",$i,$row['proj_id'],$row['proj_name']);
	printf("%s %s",$row['proj_id'],$row['proj_name']);
	printf("     <input type='text' name = 'textbox%d'>",$i);
	echo"<br>";
	$i++;
}*/
?>
</form>
</body>
</html>
