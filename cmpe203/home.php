<?php
include('header.php');
include('db.php');

/*query to display all public and liked boards to the user*/
$result = mysql_query("SELECT * FROM boards WHERE privacy=0 OR uid=$user_id") or die(mysql_error());
?>
<html>
	
	<head>
		<title>
			Home
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
		<section id="demo" style="margin-top:5%;">
		
		<?php
			while($row = mysql_fetch_array( $result )) {
			//Print out the contents of each row
			$board_id = $row['id'];
			
			/*get info if the user is following a specific board and show 'unfollow' link*/
			$result2 = mysql_query("SELECT * FROM follow_board WHERE uid=$user_id AND bid=$board_id") or die(mysql_error());
			$row2 = mysql_fetch_array($result2);
			
			if(mysql_num_rows($result2)>=1){
				echo"<article class='white-panel'> <a href='".$row['board_url']."?board_id=".$row['id']."'><img src='".$row['board_image']."' alt='ALT'></a>";
				echo"<h1><a href='".$row['board_url']."?board_id=".$row['id']."'>".$row['board_title']."</a></h1>";
				echo"<p>".$row['board_description']."</p>";
				echo"<p style='float:left;font-size:11px;'><a href='unfollow_board.php?board_id=".$row['id']."' style='color:#48649F;;text-decoration:none;'><b>Unfollow</b></a></p>";
				echo"</article>";
			}
			
			/*if user not following the board show the 'follow' link*/
			else{
				echo"<article class='white-panel'> <a href='".$row['board_url']."?board_id=".$row['id']."'><img src='".$row['board_image']."' alt='ALT'></a>";
				echo"<h1><a href='".$row['board_url']."?board_id=".$row['id']."'>".$row['board_title']."</a></h1>";
				echo"<p>".$row['board_description']."</p>";
					if($user_id != $row['uid']){
						echo"<p style='float:left;font-size:11px;'><a href='follow_board.php?board_id=".$row['id']."' style='color:#000;text-decoration:none;'><b>Follow</b></a></p>";
					}
				echo"</article>";
				}
			}
			
		?>
		
		</section>
	</body>

</html>