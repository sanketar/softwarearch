<!DOCTYPE HTML>
<html>
<head>
	<title>Faculty Page</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<form method="post" >
	<table>
		<tr>
			<td>Declare Project:</td> 
			<td>
				<input class='tbox' type="text" name="declareproject" required="required" > <br>
			</td>
		</tr>
		<tr>
			<td>Project ID:</td>
			<td>
				<input class='tbox' type="text" name="projid" required="required"><br>
			</td>
		</tr>
		</tr>
			<td>Faculty ID:</td> 
			<td>
				<input class='tbox' type="text" name="facultyid" required="required" ><br>
			</td>
		</tr>
		<tr>
			<td>
				<input class='sbut' type="submit" name="sub1" value="Submit" formaction="faculty1.php"> <br>
			</td>
		</tr>
	</table>
</form>
<form method="post" >
	<table>
		<tr colspan=2>
			<td>
				<h3>See Students Preferences </h2>
			</td>
		</tr>
			<td>Faculty ID:</td> 
			<td>
				<input class='tbox' type="text" name="facultyid2" required="required" ><br>
			</td>
		</tr>
		<tr>
			<td>
				<input class='sbut' type="submit" name="sub2" value="Submit" formaction="faculty1.php"> <br>
			</td>
		</tr>
	</table>
</form>
</body>
</html>
