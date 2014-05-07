<?php
include('header.php');
include('db.php');

/**
  * @author  (Archit Agarwal)
  * @version  v1.0
  * @date     (25-April-2014)
  * @Description  On button press
  */
if(isset($_POST['submit'])) {

	/*get value of new password and confirm password into variables*/
	$new_password = $_POST['new_password'];
	$conf_password = $_POST['confirm_password'];
	
/**
  * @author  (Amod Rege)
  * @version  v1.0
  * @date     (25-April-2014)
  * @Description  update login table with new password if both values are same
  */
	if($new_password==$conf_password){
		$result = mysql_query("UPDATE `login` SET `password`='$new_password' WHERE id='$user_id'")or die(mysql_error());
		
		/*redirect user to home page*/
		echo"<script type = 'text/javascript'>";
		echo"window.location.href = 'http://itechcareers.com/cmpe203/home.php'";
		echo"</script>";
	}
	
	/*error message*/
	else{
		echo"<script type = 'text/javascript'>";
		echo"alert('Passwords do not match. Please enter same value in both fields.')";
		echo"</script>";
	}
}
?>
<html>
<!--
  * @author  (Pratik Gaglani)
  * @version  v2.0
  * @date     (20-April-2014)
  * @Description  change password page UI
  -->		
	<head>
		<title>
			Change Password
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
							<td><b>Enter New Password : </b></td>
							<td><input type="password" name="new_password" id="new_password" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Confirm New Password : </b></td>
							<td><input type="password" name="confirm_password" id="confirm_password" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td>
							</td>
							<td>
								<input type="submit" id="submit" name="submit" value="Save" style="color:#000;">
							</td>
						</tr>
					</table>
					</form>
				</div>
				</center>
		</section>
	</body>
</html>