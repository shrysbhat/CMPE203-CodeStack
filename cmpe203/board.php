<?php
include('header.php');
include('db.php');

/*Get board id from query string*/
$board_id = $_GET['board_id'];

/*Query to get board id, to display associated tacks*/
$query = "SELECT * FROM boards WHERE id=$board_id";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);
?>

<html>
	<head>
		<title>
			<?php echo"Board - ".$row['board_title']; ?>
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
	
	<body style="background-image:url('<?php echo $row['board_image']; ?>'); background-repeat:no-repeat;">
		<section id="demo" style = "margin-top:5%;">
			<?php
			
				/*query to display all tacks of specific board*/
				$query2 = "SELECT * FROM tacks WHERE bid=$board_id";
				$result2 = mysql_query($query2) or die(mysql_error());
				
				while($row2 = mysql_fetch_array( $result2 )) {
				//Print out the contents of each row
				
				/*query to check if the tack is liked by the user*/
				$tack_id = $row2['id'];
				$query3 = "SELECT * FROM like_tack WHERE uid=$user_id AND tid=$tack_id";
				$result3 = mysql_query($query3) or die(mysql_error());
				$row3 = mysql_fetch_array($result3);
				
				if(mysql_num_rows($result3)>=1){
					echo"<article class='white-panel' style='background-color: rgba(255,255,255,0.6);'> <a href='".$row2['tack_url']."' target='_blank'><img src='".$row2['tack_image']."' alt='ALT'></a>";
					echo"<h1><a href='".$row2['tack_url']."' target='_blank'>".$row2['tack_title']."</a></h1>";
					echo"<p>".$row2['tack_description']."</p>";
					echo"<p style='float:left;font-size:11px;'><a href='unlike_tack.php?tack_id=".$row2['id']."&&board_id=".$board_id."' style='color:#48649F;text-decoration:none;'><b>Unlike</b></a></p>";
					echo"</article>";
				}
				else{
					echo"<article class='white-panel' style='background-color: rgba(255,255,255,0.6);'> <a href='".$row2['tack_url']."' target='_blank'><img src='".$row2['tack_image']."' alt='ALT'></a>";
					echo"<h1><a href='".$row2['tack_url']."' target='_blank'>".$row2['tack_title']."</a></h1>";
					echo"<p>".$row2['tack_description']."</p>";
					
					/*if the tack is created by user then show 'edit' and 'delete' link*/
					
						if($user_id == $row['uid']){
							echo"<p style='float:left;font-size:11px;'><a href='deletetack.php?tack_id=".$row2['id']."&&board_id=".$row2['bid']."' style='color:#000;text-decoration:none;'><b>Delete</b></a></p><p align='right' style='font-size:11px;'><a href='edittack.php?tack_id=".$row2['id']."&&board_id=".$row2['bid']."&&ctg=".$row['board_category']."' style='color:#000;text-decoration:none;'><b>Edit</b></a></p>";
						}
						else{
						/*if tack not owned by user and not liked then show 'like' link*/
							echo"<p style='float:left;font-size:11px;'><a href='like_tack.php?tack_id=".$row2['id']."&&board_id=".$board_id."' style='color:#000;text-decoration:none;'><b>Like</b></a></p>";
						}
					echo"</article>";
				}
				}
				
				/*Show 'add tack' link if the tack is owned by user.*/
				if($user_id == $row['uid']){
					echo"<article class='white-panel' style='background-color: rgba(255,255,255,0.6);'> <a href='addtack.php?board_id=".$row['id']."'><img src='images/add.png' alt='ALT'></a>";
					echo"<h1><a href='addtack.php?board_id=".$row['id']."'>Add Tack</a></h1>";
					echo"<p>Add a new Tack to this board.</p>";
					echo"</article>";
				}
			?>
			
		</section>
	</body>
</html>