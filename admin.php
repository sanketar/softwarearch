<!DOCTYPE html>
<?php
ini_set('display_errors', 1);

require('const.php');

$login_valid=0;

?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>ADMIN page</title>
    <style type="text/css">
      header, section, footer, aside, nav, article, figure, audio, video, canvas { display:block; }
    </style>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
<?php
if(!isset($_POST['login'])) {
?>
  	<div id="logindiv">
		<form name="lform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off"> 
			<table >
				<tr colspan=2>
					<td><h1> Admin Login </h1> </td>
				</tr>
				<tr>
					<td><label for="uname" > ID</label></td>
					<td><input class="tbox" id="uname" name="uname" required="required" type="text" placeholder="ID" /></td>
				</tr>
				<tr>
					<td><label for="passwd" > PASSWORD</label></td>
					<td><input class="tbox" id="passwd" name="passwd" required="required" type="password" placeholder="PASSWORD"/></td>
				</tr>
				<tr colspan=2>
					<td><input class="sbut" type="submit" name="login" value="Login"/></td>
				</tr>
			</table>
		</form>
  	</div>
<?php
}
if((isset($_POST['login']))) {

	if(isset($_POST['uname'])) {
		$uname= htmlspecialchars($_POST['uname']);
	}
	if(isset($_POST['passwd'])) {
		$passwd= htmlspecialchars($_POST['passwd']);
	}
	try {
		$conn = new mysqli(HOST, USER, PASWD, DB, DB_PORT);

		if($conn->connect_errno > 0){
			die('Unable to connect to database [' . $conn->connect_error . ']');
		}
		$result = $conn->query("SELECT * FROM admin WHERE admin.username = '".$uname."' and admin.passwd = '".$passwd."'");
		$rowcount = $result->num_rows;
		if ($rowcount) {
			if ($rowcount == 1) {
				// Check login credentials
				while($row1 = mysqli_fetch_array($result)) {
					if(($uname == $row1['username']) && ($passwd == $row1['passwd'])) {
						$login_valid=1;
					}
				}
			}
			else
				echo "<br /><h1>ERROR: Multiple ids for admin user</h1><br />";
				echo "<a href='admin.php'> Go to Admin Page</a><br/>";
				echo "<a href='home.php'> Go Home</a>";
		}
		else {
			echo "Could not fetch row for admin user<br/>";
			echo "<a href='admin.php'> Go to Admin Page</a><br/>";
			echo "<a href='home.php'> Go Home</a>";
		}

		$conn->close();
	}
	catch(Exception $e) {
		echo $e->getMessage();
		$conn->close();
	}
}
else
{

}

if ($login_valid) {
?>
    <div id="wrapper">
		<div id="form1">
		<h3>Add Student form:</h3>
		<form id="sform"  method="post" action="instrec.php">
		  <table>
		    <tr>
		      <td>
			<label for="stdname">Student Name:</label>
		      </td>
		      <td>
			<input class="tbox" type="text" name="sname" id="stdname" placeholder="Student Name" required="required"/>
		      </td>
		    </tr>
		    <tr>
		      <td>
			<label for="rolno">Roll No:</label>
		      </td>
		      <td>
			<input class="tbox" type="text" name="rollno" id="rolno" placeholder="Roll No" required="required" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan=2>
			<input class="sbut" type="submit" name="sub1" value="Add" />
		      </td>
		    </tr>
		  </table>
		</form>
		</div>
		<hr />
	    <div id="form2">
		<h3>Add Faculty form:</h3>
		<form id="fform"  method="post" action="instrec.php">
		  <table>
		    <tr>
		      <td>
			<label for="facname">Faculty Name:</label>
		      </td>
		      <td>
			<input class="tbox" type="text" name="fname" id="facname" placeholder="Faculty Name" required="required"/>
		      </td>
		    </tr>
		    <tr>
		      <td>
			<label for="facid">Faculty ID:</label>
		      </td>
		      <td>
			<input class="tbox" type="text" name="fac_id" id="facid" placeholder="Faculty ID" required="required"/>
		      </td>
		    </tr>
		    <tr>
		      <td colspan=2>
			<input class="sbut" type="submit" name="sub2" value="Add"/>
		      </td>
		    </tr>
		  </table>
		</form>
      </div>
      <hr />
      <div id="form3">
		<h3>Add Admin form:</h3>
		<form id="aform"  method="post" action="instrec.php">
		  <table>
		    <tr>
		      <td>
			<label for="adnam">Username:</label>
		      </td>
		      <td>
			<input class="tbox" type="text" name="adnam" id="adnam" placeholder="User Name" required="required"/>
		      </td>
		    </tr>
		    <tr>
		      <td>
			<label for="adpas">Password:</label>
		      </td>
		      <td>
			<input class="tbox" type="password" name="adpas" id="adpas" placeholder="Pasword" required="required" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan=2>
			<input class="sbut" type="submit" name="sub3" value="Add" />
		      </td>
		    </tr>
		  </table>
		</form>
		</div>
    </div>
<?php
}
?>
  </body>
</html>
