<!DOCTYPE HTML>
<html>
<head>
	<title>Student Page</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>	
<form method="post">
<?php
ini_set('display_errors', 1);
require('const.php');
$con = mysqli_connect(HOST,USER,PASWD,DB);

if (mysqli_connect_errno()) 
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "Roll Number: <input class='tbox' type='text' name='roll' value='$_POST[rollno]' readonly>";

echo "<h3>Your Given Preference</h3>";
$query = "select * from preference where rollno = $_POST[rollno] ";
$result = mysqli_query($con,$query);
echo "<table class='tablecss'  border='1'><tr><th>Project ID</th><th>Preference</th></tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['proj_id'] . "</td>";
  echo "<td>" . $row['stud_pref'] . "</td>";
  echo "</tr>";
}
echo "</table><br>";
echo "<h3>Give/Update your preference</h3>";
echo "Project ID: <input class='tbox' type='text' name='proj'>";
echo "Preference: <input class='tbox' type='text' name='pref'>";echo "<br>";
echo "<input class='sbut' type='submit' value='Submit' formaction='student2.php'>";
?>
</form>
</body>
</html>
