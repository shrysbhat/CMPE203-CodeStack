<?php
include('header.php');
include('db.php');

$user = $_GET['user_id'];
/**
  * @author  (Amod Rege)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  get info of user from login table
  */
$query = "SELECT * FROM login WHERE id=$user";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);

/*get all boards created by user*/
$query2 = "SELECT * FROM boards WHERE uid=$user";
$result2 = mysql_query($query2) or die(mysql_error());

/**/
$query3 = "SELECT * FROM follow_user WHERE uid=$user_id AND following_uid=$user";
$result3 = mysql_query($query3) or die(mysql_error());
?>

<html>
	
	<head>
		<title>
			Profile
		</title>
		
		<!--including css files-->
		<link rel="stylesheet" href="css/main.css" type="text/css">
		
		<!--including js plugin files-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/pinterest_grid.js"></script>
		
		<!--js code for setting size of tacks-->
		<script type = "text/javascript">
			$(document).ready(function() {
			$('#demo').pinterest_grid({
			no_columns: 4,
			padding_x: 10,
			padding_y: 10,
			margin_bottom: 50,
			single_column_breakpoint: 700
			});
			});
		</script>
	</head>
	
	<body style="background-color:#000000">
		<section style="margin-top:5%;">
			<center>
				<div style="color:#fff;background-color: #363636; width: 75%; height: 55%;border-radius: 70px;box-shadow: 10px 10px 5px #fff;">
					<div style = "width:20%; height:55%; background-color:#ffffff;float:left;margin-left:10%;margin-top:5%;border-radius:80px;">
						<img src="<?php echo $row['user_image'] ?>" alt='ALT' style='border-radius:80px;'>
					</div>
					<div>
					<table style="color:#fff; width:50%;">
						<tr>
							<td style = "height:50px;"></td>
						</tr>
						<tr>
							<td><b><?php echo $row['first_name']; ?>&nbsp;&nbsp;<?php echo $row['last_name']; ?></b></td>
						</tr>
						<tr style = "height: 10px;"><td></td></tr>
						<tr>
							<td><b><?php echo $row['email']; ?></b></td>
						</tr>
					</table>
					</div>
					<div>
						<?php
							if(mysql_num_rows($result3)==1){
								?>
								<a href="unfollow_user.php?user_id=<?php echo $user; ?>" style="color: #ffffff;text-decoration: none;font-size: 11px;">Unfollow</a>
								<?php
							}
							elseif($user_id==$user){
							}
							else{
								?>
								<a href="follow_user.php?user_id=<?php echo $user; ?>" style="color: #ffffff;text-decoration: none;font-size: 11px;">Follow</a>
								<?php
							}
						?>
					</div>
				</div>
			</center>
		</section>
		<div style="color:#fff; margin-top:5%; margin-left:3%;">
			<h4><b>Boards Created By <?php echo $row['first_name']; ?></b></h4>
		</div>
		<section id="demo" style="margin-top:4%;">
			<?php
			while($row2 = mysql_fetch_array( $result2 )) {
			
/**
  * @author  (Amod Rege and Pratik Gaglani)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  display all boards created by user
  */
			echo"<article class='white-panel'> <a href='".$row2['board_url']."?board_id=".$row2['id']."'><img src='".$row2['board_image']."' alt='ALT'></a>";
			echo"<h1><a href='".$row2['board_url']."?board_id=".$row2['id']."'>".$row2['board_title']."</a></h1>";
			echo"<p>".$row2['board_description']."</p>";
			echo"</article>";
			}
			?>
		</section>
	</body>
</html>