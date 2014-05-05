<?php
include('header.php');
include('db.php');

/*query to get info of the current user*/
$result = mysql_query("SELECT * FROM login WHERE id=$user_id") or die(mysql_error());
$row = mysql_fetch_array($result);

/*on button press*/
if(isset($_POST['submit'])) {
	
	/*set the value of textfield in variable*/
	$password = $_POST['u_password'];
	
	/*if variable value matches the actual password the redirect the user to change password page*/
	if($password==$row['password']){
		echo"<script type = 'text/javascript'>";
		echo"window.location.href = 'http://itechcareers.com/cmpe203/changepswd.php'";
		echo"</script>";
	}
	
	/*error message*/
	else{
		echo"<script type = 'text/javascript'>";
		echo"alert('Password does not match. Please enter correct value.')";
		echo"</script>";
	}
}
?>

<html>
	
	<head>
		<title>
			Settings
		</title>
		<link rel="stylesheet" href="css/main.css" type="text/css">
	</head>
	
	<body style="background-color:#000000">
		<section id="demo" style="margin-top:5%;">
			<center>
				<div style="color:#fff;background-color: #363636; width: 75%; height: 55%;border-radius: 70px;box-shadow: 10px 10px 5px #fff;">
					<h1>Change Password</h1>
					<form action="" method="post" enctype="multipart/form-data">
					<table style="color:#fff;">
						<tr>
							<td><b>Enter Current Password : </b></td>
							<td><input type="password" name="u_password" id="u_password" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td>
							</td>
							<td>
								<input type="submit" id="submit" name="submit" value="Next" style="color:#000;">
							</td>
						</tr>
					</table>
					</form>
				</div>
				</center>
		</section>
	</body>
</html>