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
	
/**
  * @author  (Archit Agarwal)
  * @version  v1.0
  * @date     (25-April-2014)
  * @Description  Store textfield values in variables
  */	
	$title = $_POST['b_title'];
	$description1 = $_POST['b_description'];
	$description = htmlspecialchars($description1,ENT_QUOTES);
	$category = $_POST['b_category'];
	$privacy = $_POST['b_privacy'];
	$file = $_FILES["file"]["name"];
	
	if($privacy=='public') {
		$privacy_value = 0;
	}
	else {
		$privacy_value = 1;
	}
	
/**
  * @author  (Archit Agarwal)
  * @version  v2.0
  * @date     (25-April-2014)
  * @Description  save board image to specified folder with validations
  */	
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

/**
  * @author  (Amod Rege)
  * @version  v1.0
  * @date     (25-April-2014)
  * @Description  Insert values in boards table
  */	
		  
			if(($title != null) && ($description != null) && ($category != null) && ($privacy != null) && ($file != null)) {
			mysql_query("INSERT INTO boards(uid, board_title, board_description, board_category, privacy, board_url, board_image) VALUES('$user_id', '$title', '$description', '$category', '$privacy_value', 'board.php', 'images/board_images/$file')") or die(mysql_error());
			
			move_uploaded_file($_FILES["file"]["tmp_name"],
		  "images/board_images/" . $_FILES["file"]["name"]);
	
/**
  * @author  (Archit Agarwal)
  * @version  v1.0
  * @date     (25-April-2014)
  * @Description  redirect user to home page
  */	
				echo"<script type = 'text/javascript'>";
				echo"window.location.href = 'http://itechcareers.com/cmpe203/home.php'";
				echo"</script>";
			}
	
			/*error message*/
			else
			{
				echo "<script type = 'text/javascript'>";
				echo "alert('Please enter value in all fields!')";
				echo "</script>";
			}
		  }
	  }
	} else {
	  echo "<script type = 'text/javascript'>";
	  echo "alert('Invalid Image!')";
	  echo "</script>";
	}
}
?>

<html>
<!--
  * @author  (Pratik Gaglani)
  * @version  v2.0
  * @date     (17-April-2014)
  * @Description  add board page UI
  -->
	<head>
		<title>
			Add Board
		</title>
		<link rel="stylesheet" href="css/main.css" type="text/css">
	</head>
	
	<body style="background-color:#000000">
		<section id="demo" style="margin-top:5%;">
			<center>
				<div style="color:#fff;background-color: #363636; width: 75%; height: 55%;border-radius: 70px;box-shadow: 10px 10px 5px #fff;">
					<h1>Add New Board</h1>
					<form action="addboard.php" method="post" enctype="multipart/form-data">
					<table style="color:#fff;">
						<tr>
							<td><b>Title : </b></td>
							<td><input type="text" name="b_title" id="b_title" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Description : </b></td>
							<td><textarea rows="4" columns="50" name="b_description" id="b_description" style="width:270px; color:#000;border-radius:7px;"></textarea></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Category : </b></td>
							<td><select name="b_category" id="b_category" style = "height:28px; width:270px; color:#000;border-radius:7px;">
									<option value="">---Select---</option>
									<option value="Automobile">Automobile</option>
									<option value="Books">Books</option>
									<option value="Movies">Movies</option>
									<option value="Nature">Nature</option>
									<option value="Sports">Sports</option>
									<option value="TV">TV</option>
									<option value="Other">Other</option>
								</select>
							</td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Privacy : </b></td>
							<td><select name="b_privacy" id="b_privacy" style = "height:28px; width:270px; color:#000;border-radius:7px;">
									<option value="">---Select---</option>
									<option value="public">Public</option>
									<option value="private">Private</option>
								</select>
							</td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td>
								<label for="file">Image :</label>
							</td>
							<td>
								<input type="file" name="file" id="file"><br>
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<input type="submit" id="submit" name="submit" value="Add" style="color:#000;">
							</td>
						</tr>
					</table>
					</form>
				</div>
				</center>
		</section>
	</body>
</html>
