<!DOCTYPE HTML>
<html>
<head>
	<title>Result</title>
</head>
<body>

<?php

ini_set('display_errors', 1);

require('const.php');


/**********ADD STUDENT**********/
if((isset($_POST['sub1'])) && !(isset($_POST['sub2'])) && !(isset($_POST['sub3']))) {
	if(isset($_POST['sname'])) {
		$sname= htmlspecialchars($_POST['sname']);
	}
	if(isset($_POST['rollno'])) {
		$rollno= htmlspecialchars($_POST['rollno']);
	}
	//echo $sname ." and ".$rollno;

	try {
		$conn = new mysqli(HOST, USER, PASWD, DB, DB_PORT);

		if($conn->connect_errno > 0){
			die('Unable to connect to database [' . $conn->connect_error . ']');
		}
		$flag=0;

		if ($result = $conn->query("SELECT rollno, name FROM student WHERE student.rollno = '".$rollno."'")) {
			$rowcount = $result->num_rows;
			if ($rowcount > 0) {
				$flag=1; // Record already exists. mark flag=1
			}
		}
		else {
			echo "<p>Could not fetch row</p>";
			//conn->close();
			//exit();
		}

		if($flag==1) {
			echo "<p>Record already exists</p><br /><a href='admin.php'>Go Back</a>";
		}

		if($flag==0) {
			$stmt = $conn->prepare("INSERT INTO student (rollno,name) VALUES (?,?)");


			$r1=$rollno;
			$n1=$sname;		
			if($stmt->bind_param('is',$r1,$n1)) {
			//	echo "Record Bind done";
			}
			else
				die("unable to Bind parameters");

			//echo $r1, $n1;

			if($stmt->execute()) {
			//	echo "REcord Inserted";
			}
			else
				die("unable to execute");
			$stmt->close();
		}

		$query = "SELECT rollno, name FROM student WHERE rollno = '$rollno'";
		if ($result = $conn->query($query)) {
			while ($row = $result->fetch_row()) {
  				//printf("%s (%s,%s)\n", $row[0], $row[1], $row[2]);
  				echo "<br /> RECORD: ".$row[0].", ".$row[1] ;
			}
		}
		$conn->close();
	}
	catch(Exception $e) {
		echo $e->getMessage();
		$conn->close();
	}
	
}

/**********ADD FACULTY**********/
if(!(isset($_POST['sub1'])) && (isset($_POST['sub2'])) && !(isset($_POST['sub3']))) {
	if(isset($_POST['fname'])) {
		$fname= htmlspecialchars($_POST['fname']);
	}
	if(isset($_POST['fac_id'])) {
		$fac_id= htmlspecialchars($_POST['fac_id']);
	}
	//echo $fname ." and ".$fac_id;

	try {
		$conn = new mysqli(HOST, USER, PASWD, DB, DB_PORT);

		if($conn->connect_errno > 0){
			die('Unable to connect to database [' . $conn->connect_error . ']');
		}
		$fflag=0;

		if ($result = $conn->query("SELECT fac_id, name FROM faculty WHERE faculty.fac_id = '".$fac_id."'")) {
			$rowcount = $result->num_rows;
			if ($rowcount > 0) {
				$fflag=1; // Record already exists. mark flag=1
			}
		}
		else {
			echo "<p>Fac: could not fetch row</p>";
			//conn->close();
			//exit();
		}

		if($fflag==1) {
			echo "<p>Fac record already exists</p><br /><a href='admin.php'>Go Back</a>";
		}

		if($fflag==0) {
			$stmt2 = $conn->prepare("INSERT INTO faculty (fac_id,name) VALUES (?,?)");

			$r1=$fac_id;
			$n1=$fname;		
			if($stmt2->bind_param('is',$r1,$n1)) {
			//	echo "Record Bind done";
			}
			else
				die("unable to Bind parameters");

			//echo $r1, $n1;

			if($stmt2->execute()) {
				echo "<p>New Record Inserted</p><br /><a href='admin.php'>Go Back</a>";
			}
			else
				die("unable to execute");
			$stmt2->close();
		}

		$query = "SELECT fac_id, name FROM faculty WHERE fac_id = '$fac_id'";
		if ($result = $conn->query($query)) {
			while ($row = $result->fetch_row()) {
  				//printf("%s (%s,%s)\n", $row[0], $row[1], $row[2]);
  				echo "<br />RECORD:".$row[0].",".$row[1];
			}
		}
		$conn->close();
	}
	catch(Exception $e) {
		echo $e->getMessage();
		$conn->close();
	}	
}


/**********ADD FACULTY**********/
if(!(isset($_POST['sub1'])) && !(isset($_POST['sub2'])) && (isset($_POST['sub3']))) {
	if(isset($_POST['adnam'])) {
		$adnam= htmlspecialchars($_POST['adnam']);
	}
	if(isset($_POST['adpas'])) {
		$adpas= htmlspecialchars($_POST['adpas']);
	}
	//echo $adnam ." and ".$adpas;

	try {
		$conn = new mysqli(HOST, USER, PASWD, DB, DB_PORT);

		if($conn->connect_errno > 0){
			die('Unable to connect to database [' . $conn->connect_error . ']');
		}
		$fflag=0;

		if ($result = $conn->query("SELECT username, passwd FROM admin WHERE admin.username = '".$adnam."'")) {
			$rowcount = $result->num_rows;
			if ($rowcount > 0) {
				$fflag=1; // Record already exists. mark flag=1
			}
		}
		else {
			echo "<p>Fac: could not fetch row</p><br /><a href='admin.php'>Go Back</a>";
			//conn->close();
			//exit();
		}

		if($fflag==1) {
			echo "<p>Fac record already exists</p><br /><a href='admin.php'>Go Back</a>";
		}

		if($fflag==0) {
			$stmt2 = $conn->prepare("INSERT INTO admin (username, passwd) VALUES (?,?)");

			$r1=$adnam;
			$n1=$adpas;		
			if($stmt2->bind_param('ss',$r1,$n1)) {
			//	echo "Record Bind done";
			}
			else
				die("unable to Bind parameters");

			//echo $r1, $n1;

			if($stmt2->execute()) {
				echo "<p>New Record Inserted</p><br /><a href='admin.php'>Go Back</a>";
			}
			else
				die("unable to execute");
			$stmt2->close();
		}

		$query = "SELECT username, passwd FROM admin WHERE username = '$adnam'";
		if ($result = $conn->query($query)) {
			while ($row = $result->fetch_row()) {
  				//printf("%s (%s,%s)\n", $row[0], $row[1], $row[2]);
  				echo "<br />RECORD:".$row[0].",".$row[1];
			}
		}
		$conn->close();
	}
	catch(Exception $e) {
		echo $e->getMessage();
		$conn->close();
	}	
}

?>

</body>
</html>