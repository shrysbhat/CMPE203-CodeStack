<?php
include('header.php');
include('db.php');

/*query to get all values from login table for the specified user*/
$query = "SELECT * FROM login WHERE id=$user_id";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);

/*On button press*/
if(isset($_POST['submit'])) {
	
	/*Store textfield values in variables*/
	$first_name = $_POST['fname'];
	$last_name = $_POST['lname'];
	$email = $_POST['email'];
	$file = $_FILES["file"]["name"];
	$profilepic = $row['user_image'];
	
	/*save profile image to specified folder with validations*/
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 2000000)
	&& in_array($extension, $allowedExts)) {
	  if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	  } else {
		//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		if (file_exists("images/user_images/" . $_FILES["file"]["name"])) {
			echo "<script type = 'text/javascript'>";
			echo "alert('Image already exists!')";
			echo "</script>";
		} else {
		  move_uploaded_file($_FILES["file"]["tmp_name"],
		  "images/user_images/" . $_FILES["file"]["name"]);
		}
	  }
	} else {
	  echo "Invalid file";
	}
	
	/*update user info including new profile image*/
	if(($first_name != null) && ($last_name != null) && ($email != null) && ($file != null)) {
	$result2 = mysql_query("UPDATE `login` SET `first_name`='$first_name', `last_name`='$last_name', `email`='$email', `user_image`='images/user_images/$file' WHERE id='$user_id'")or die(mysql_error());
	
	/*redirect user to profile page*/
	echo"<script type = 'text/javascript'>";
	echo"window.location.href = 'http://itechcareers.com/cmpe203/profile.php'";
	echo"</script>";
	}
	
	/*update user info including previous profile image*/
	else if(($first_name != null) && ($last_name != null) && ($email != null) && ($file == null)) {
	$result2 = mysql_query("UPDATE `login` SET `first_name`='$first_name', `last_name`='$last_name', `email`='$email', `user_image`='$profilepic' WHERE id='$user_id'")or die(mysql_error());
	
	/*redirect user to profile page*/
	echo"<script type = 'text/javascript'>";
	echo"window.location.href = 'http://itechcareers.com/cmpe203/profile.php'";
	echo"</script>";
	}
	
	/*error message*/
	else{
	echo "<script type = 'text/javascript'>";
	echo "alert('Please enter values in all fields!')";
	echo "</script>";
	}
}

?>

<html>
	
	<head>
		<title>
			Edit Profile
		</title>
		<link rel="stylesheet" href="css/main.css" type="text/css">
	</head>
	
	<body style="background-color:#000000">
		<section id="demo" style="margin-top:5%;">
			<center>
				<div style="color:#fff;background-color: #363636; width: 75%; height: 55%;border-radius: 70px;box-shadow: 10px 10px 5px #fff;">
				<form action="" method="post" enctype="multipart/form-data">
					<table style="color:#fff;">
						<tr>
							<td style="height:50px;"></td>
							<td></td>
						</tr>
						<tr>
							<td><b>First Name : </b></td>
							<td><input type="text" name="fname" id="fname" value="<?php echo $row['first_name'] ?>" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Last Name : </b></td>
							<td><input type="text" name="lname" id="lname" value="<?php echo $row['last_name'] ?>" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Email : </b></td>
							<td><input type="text" name="email" id="email" value="<?php echo $row['email'] ?>" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td>
								<label for="file">Profile Picture :</label>
							</td>
							<td>
								<input type="file" name="file" id="file"><br>
							</td>
						</tr>
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
