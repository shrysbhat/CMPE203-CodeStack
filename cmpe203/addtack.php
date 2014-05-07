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
	$board_id = $_GET['board_id'];
	$title = $_POST['t_title'];
	$description1 = $_POST['t_description'];
	$description = htmlspecialchars($description1,ENT_QUOTES);
	$url1 = $_POST['t_url'];
	$url = htmlspecialchars($url1,ENT_QUOTES);
	$file = $_FILES["file"]["name"];
	
/**
  * @author  (Amod Rege)
  * @version  v1.0
  * @date     (25-April-2014)
  * @Description  Getting board category using query
  */	
	$query = "SELECT * FROM boards WHERE id=$board_id";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_array($result);
	$category_board = $row['board_category'];
	
/**
  * @author  (Archit Agarwal)
  * @version  v2.0
  * @date     (1-May-2014)
  * @Description  save tack image to specified folder with validations
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
		if (file_exists("images/tack_image/" . $_FILES["file"]["name"])) {
			echo "<script type = 'text/javascript'>";
			echo "alert('Image already exists!')";
			echo "</script>";
		  } else {
		  
/**
  * @author  (Morvin Shah)
  * @version  v1.0
  * @date     (25-April-2014)
  * @Description  Insert values in boards table
  */
			if(($title != null) && ($description != null) && ($url != null) && ($file != null)) {
			mysql_query("INSERT INTO tacks(bid, tack_title, tack_description, tack_category, tack_url, tack_image) VALUES('$board_id', '$title', '$description','$category_board', '$url', 'images/tack_image/$file')") or die(mysql_error());
	
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"images/tack_image/" . $_FILES["file"]["name"]);
		  
/**
  * @author  (Archit Agarwal)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  redirect user to board page
  */
			echo"<script type = 'text/javascript'>";
			echo"window.location.href = 'http://itechcareers.com/cmpe203/board.php?board_id=".$board_id."'";
			echo"</script>";
			}
	
/**
  * @author  (Archit Agarwal)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  error message
  */
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
  * @Description  add tack page UI
  -->	
	<head>
		<title>
			Add Tack
		</title>
		<link rel="stylesheet" href="css/main.css" type="text/css">
	</head>
	
	<body style="background-color:#000000">
		<section id="demo" style="margin-top:5%;">
			<center>
				<div style="color:#fff;background-color: #363636; width: 75%; height: 55%;border-radius: 70px;box-shadow: 10px 10px 5px #fff;">
					<h1>Add New Tack</h1>
					<form action="" method="post" enctype="multipart/form-data">
					<table style="color:#fff;">
						<tr>
							<td><b>Title : </b></td>
							<td><input type="text" name="t_title" id="t_title" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Description : </b></td>
							<td><textarea rows="4" columns="50" name="t_description" id="t_description" style="width:270px; color:#000;border-radius:7px;"></textarea></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b>Tack URL : </b></td>
							<td><input type="text" name="t_url" id="t_url" style="height:28px; width:270px; color:#000;border-radius:7px;"></td>
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