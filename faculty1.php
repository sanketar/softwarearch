<!DOCTYPE HTML>
<html>
<head>
  <title>Faculty Page</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<form action="post">
<?php
ini_set('display_errors', 1);

require('const.php');

$con = mysqli_connect(HOST,USER,PASWD,DB);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(isset($_POST["facultyid2"]))
  $q1 = "select * from faculty where fac_id = ".$_POST['facultyid2'];
else
  $q1 = "select * from faculty where fac_id = ".$_POST['facultyid'];
$r1 = mysqli_query($con,$q1);
$c1 = mysqli_num_rows($r1);
if($c1 == 0){
	echo "Unregistered faculty ID";
	exit;
}
if(isset($_POST["facultyid2"]))
  echo "Your ID: <input class='tbox' type='text' name='fac' value='$_POST[facultyid2]' readonly>";
else
  echo "Your ID: <input class='tbox' type='text' name='fac' value='$_POST[facultyid]' readonly>";

echo "<br><br>";
echo "Students opted your project:"."<br>";




// if ($_POST["declareproject"] == "" and $_POST["projid"] == ""){
if (isset($_POST["sub2"])){
/*	
	select tbl.* from tbl
inner join (
select max(id) as maxID, number from tbl group by number) maxID
on maxID.maxID = tbl.id
*/	
  $querry = "SELECT * FROM student, preference where student.rollno = preference.rollno and fac_id = $_POST[facultyid2]";
  $result = mysqli_query($con,$querry);
  echo "<table border='1'><tr><th>StudentID</th><th>Student Name</th><th>ProjectID</th><th>Stud_Preference</th><th>Your Preference</th></tr>";
    while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['rollno'] . "</td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['proj_id'] . "</td>";
      echo "<td>" . $row['stud_pref'] . "</td>";
      echo "<td>" . $row['fac_pref'] . "</td>";
      echo "</tr>";
    }
  echo "</table><br>";

  echo "<h3>Give/Update your student preference</h3>";
  echo "Student ID: <input class='tbox' type='text' name='stud'>";
  echo "Project ID: <input class='tbox' type='text' name='proj'>";
  echo "Preference: <input class='tbox' type='text' name='pref'>";echo "<br>";
  echo "<input class='sbut' type='submit' value='Submit' formmethod='post' formaction='faculty2.php'>";

}



if(isset($_POST["sub1"])){
  $querry1 = "INSERT INTO project (proj_id, proj_name, fac_id) VALUES ('$_POST[projid]','$_POST[declareproject]',$_POST[facultyid])";
  mysqli_query($con,$querry1);
  // echo "Your response is registered<br />";

  // DISPLAY Projects for that faculty
  $projquery = "SELECT * FROM project, faculty where project.fac_id = faculty.fac_id and faculty.fac_id = $_POST[facultyid]";
  if(!($result = mysqli_query($con,$projquery))) {
    echo "No data";
  }
  echo "<table border='1'><tr><th>Project ID</th><th>Project Name</th><th>Faculty ID</th><th>Name</th></tr>";

  while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['proj_id'] . "</td>";
    echo "<td>" . $row['proj_name'] . "</td>";
    echo "<td>" . $row['fac_id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "</tr>";
  }
  echo "</table><br>";
  echo "<br>";
  
  $querry = "SELECT * FROM student, preference where student.rollno = preference.rollno and fac_id = $_POST[facultyid]";
  $result = mysqli_query($con,$querry);
  echo "<table border='1'><tr><th>StudentID</th><th>Student Name</th><th>ProjectID</th><th>Stud_Preference</th><th>Your Preference</th></tr>";
  while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['rollno'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['proj_id'] . "</td>";
    echo "<td>" . $row['stud_pref'] . "</td>";
    echo "<td>" . $row['fac_pref'] . "</td>";
    echo "</tr>";
  }
  echo "</table><br>";

  echo "<h3>Give/Update your student preference</h3>";
  echo "Student ID: <input class='tbox' type='text' name='stud'>";
  echo "Project ID: <input class='tbox' type='text' name='proj'>";
  echo "Preference: <input class='tbox' type='text' name='pref'>";echo "<br>";
  echo "<input class='sbut' type='submit' value='Submit' formmethod='post' formaction='faculty2.php'>";

}
mysqli_close($con);
?>
</form>
</body>
</html>
