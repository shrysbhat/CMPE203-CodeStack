<?php
include('header.php');
include('db.php');

/*get board id from query string*/
$board_id = $_GET['board_id'];

/*query to get the board image*/
$query = "SELECT * FROM boards WHERE id=$board_id";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);

/*on button press*/
if(isset($_POST['submit'])) {
	
	/*get values of all the textfields in variable*/
	$title = $_POST['b_title'];
	$description = $_POST['b_description'];
	$category = $_POST['b_category'];
	$privacy = $_POST['b_privacy'];
	$file = $_FILES["file"]["name"];
	$boardimage = $row['board_image'];
	
	/*save board image to specified folder with validations*/
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
		if (file_exists("images/board_images/" . $_FILES["file"]["name"])) {
			echo "<script type = 'text/javascript'>";
			echo "alert('Image already exists!')";
			echo "</script>";
		} else {
		  move_uploaded_file($_FILES["file"]["tmp_name"],
		  "images/board_images/" . $_FILES["file"]["name"]);
		}
	  }
	} else {
	  echo "Invalid file";
	}
	
	if($privacy=='public') {
		$privacy_value = 0;
	}
	else {
		$privacy_value = 1;
	}
	
	/*update values in board table when user has choosen a new image*/
	if(($title != null) && ($description != null) && ($category != null) && ($privacy != null) && ($file != null)) {
	$result2 = mysql_query("UPDATE `boards` SET `uid`='$user_id', `board_title`='$title', `board_description`='$description', `board_category`='$category', `privacy`='$privacy_value', `board_url`='board.php', `board_image`='images/board_images/$file' WHERE id='$board_id'")or die(mysql_error());
	
	/*redirect user to profile page*/
	echo"<script type = 'text/javascript'>";
	echo"window.location.href = 'http://itechcareers.com/cmpe203/profile.php'";
	echo"</script>";
	}
	
	/*update values in board table when user has not choosen a new image*/
	else if(($title != null) && ($description != null) && ($category != null) && ($privacy != null) && ($file == null)) {
	$result2 = mysql_query("UPDATE `boards` SET `uid`='$user_id', `board_title`='$title', `board_description`='$description', `board_category`='$category', `privacy`='$privacy_value', `board_url`='board.php', `board_image`='$boardimage' WHERE id='$board_id'")or die(mysql_error());
	
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
			Edit Board
		</title>
		<link rel="stylesheet" href="css/main.css" type="text/css">
	</head>
	
	<body style="background-color:#000000">
		<section id="demo" style="margin-top:5%;">
			<center>
				<div style="color:#fff;background-color: #363636; width: 75%; height: 55%;border-radius: 70px;box-shadow: 10px 10px 5px #fff;">
					<h1>Edit Board</h1>
					<form action="" method="post" enctype="multipart/form-data">
					<table style="color:#fff;">
						<tr>
							<td><b>Title : </b></td>
							<td><input type="text" name="b_title" id="b_title" value="<?php echo $row['board_title'] ?>" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Description : </b></td>
							<td><textarea rows="4" columns="50" name="b_description" id="b_description" style="width:270px; color:#000;border-radius:7px;"><?php echo $row['board_description'] ?></textarea></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Category : </b></td>
							<td><select name="b_category" id="b_category" style = "height:28px; width:270px; color:#000;border-radius:7px;">
									<option value="null">---Select---</option>
									<option value="Automobile" <?php if($row['board_category']=="Automobile") { echo "selected"; } ?>>Automobile</option>
									<option value="Books" <?php if($row['board_category']=="Books") { echo "selected"; } ?>>Books</option>
									<option value="Movies" <?php if($row['board_category']=="Movies") { echo "selected"; } ?>>Movies</option>
									<option value="Nature" <?php if($row['board_category']=="Nature") { echo "selected"; } ?>>Nature</option>
									<option value="Sports" <?php if($row['board_category']=="Sports") { echo "selected"; } ?>>Sports</option>
									<option value="TV" <?php if($row['board_category']=="TV") { echo "selected"; } ?>>TV</option>
									<option value="Other" <?php if($row['board_category']=="Other") { echo "selected"; } ?>>Other</option>
								</select>
							</td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Privacy : </b></td>
							<td><select name="b_privacy" id="b_privacy" style = "height:28px; width:270px; color:#000;border-radius:7px;">
									<option value="null">---Select---</option>
									<option value="public" <?php if($row['privacy']=="0") { echo "selected"; } ?>>Public</option>
									<option value="private" <?php if($row['privacy']=="1") { echo "selected"; } ?>>Private</option>
								</select>
							</td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td>
								<label for="file">Image : </label>
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
