<?php
include('header.php');
include('db.php');

/**
  * @author  (Morvin Shah)
  * @version  v3.0
  * @date     (2-May-2014)
  * @Description  query to display all public and liked boards to the user
  */
$result = mysql_query("SELECT * FROM boards WHERE privacy=0 OR uid=$user_id") or die(mysql_error());
?>
<html>
	
	<head>
		<title>
			Home
		</title>
<!--
  * @author  (Pratik Gaglani)
  * @version  v1.0
  * @date     (20-April-2014)
  * @Description  including css files, js plugins and js code for setting size of tacks
  -->		
		<link rel="stylesheet" href="css/main.css" type="text/css">
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/pinterest_grid.js"></script>
		
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
/**
  * @author  (Morvin Shah and Archit Agarwal)
  * @version  v3.0
  * @date     (2-May-2014)
  * @Description  display all the boards on home page
*/
			while($row = mysql_fetch_array( $result )) {
			//Print out the contents of each row
			$board_id = $row['id'];
			$boardCreator = $row['uid'];
			
			$result6 = mysql_query("SELECT * FROM login WHERE id=$boardCreator") or die(mysql_error());
			$row6 = mysql_fetch_array($result6);
			
			echo"<article class='white-panel'> <a href='".$row['board_url']."?board_id=".$row['id']."'><img src='".$row['board_image']."' alt='ALT'></a>";
			if(mysql_num_rows($result6)==0){
				echo"<h1><p><b><a href='".$row['board_url']."?board_id=".$row['id']."'>".$row['board_title']."</a></b></p><p align='right' style='font-size:11px;'>by : CodeStack</p></h1>";
			}
			else{
				echo"<h1><p><b><a href='".$row['board_url']."?board_id=".$row['id']."'>".$row['board_title']."</a></b></p><p align='right' style='font-size:11px;'>by : <a href='userprofile.php?user_id=".$boardCreator."'>".$row6['first_name']."</a></p></h1>";
			}
			echo"<p>".$row['board_description']."</p>";
			
			/*get info if the user is following a specific board and show 'unfollow' link*/
			$result2 = mysql_query("SELECT * FROM follow_board WHERE uid=$user_id AND bid=$board_id") or die(mysql_error());
			$row2 = mysql_fetch_array($result2);
			
			if(mysql_num_rows($result2)==1){
				echo"<p style='float:left;font-size:11px;'><a href='unfollow_board.php?board_id=".$row['id']."' style='color:#48649F;;text-decoration:none;'><b>Unfollow</b></a></p>";
			}
			
			/*if user not following the board show the 'follow' link*/
			elseif($user_id != $row['uid']){
				echo"<p style='float:left;font-size:11px;'><a href='follow_board.php?board_id=".$row['id']."' style='color:#000;text-decoration:none;'><b>Follow</b></a></p>";
			}
			echo"</article>";
			}
			
			$result3 = mysql_query("SELECT * FROM follow_user WHERE uid=$user_id") or die(mysql_error());
			while($row3 = mysql_fetch_array($result3)){
				$followed_user = $row3['following_uid'];
				$result4 = mysql_query("SELECT * FROM boards WHERE uid=$followed_user AND privacy=1") or die(mysql_error());
				
				while($row4 = mysql_fetch_array($result4)){
					$followedUserPrivateBoardId = $row4['id'];
					
					$result7 = mysql_query("SELECT * FROM login WHERE id=$followed_user") or die(mysql_error());
					$row7 = mysql_fetch_array($result7);
					
					echo"<article class='white-panel'> <a href='".$row4['board_url']."?board_id=".$row4['id']."'><img src='".$row4['board_image']."' alt='ALT'></a>";
					echo"<h1><p><b><a href='".$row4['board_url']."?board_id=".$row4['id']."'>".$row4['board_title']."</a></b></p><p align='right' style='font-size:11px;'>by : <a href='userprofile.php?user_id=".$followed_user."'>".$row7['first_name']."</a></p></h1>";
					echo"<p>".$row4['board_description']."</p>";
					
					$result5 = mysql_query("SELECT * FROM follow_board WHERE uid=$user_id AND bid=$followedUserPrivateBoardId") or die(mysql_error());
					$row5 = mysql_fetch_array($result5);
					
					if(mysql_num_rows($result5)==1){
						echo"<p style='float:left;font-size:11px;'><a href='unfollow_board.php?board_id=".$row4['id']."' style='color:#48649F;;text-decoration:none;'><b>Unfollow</b></a></p>";
					}
					else{
						echo"<p style='float:left;font-size:11px;'><a href='follow_board.php?board_id=".$row4['id']."' style='color:#000;text-decoration:none;'><b>Follow</b></a></p>";
					}
					
					echo"</article>";
				}
			}
		?>
		
		</section>
	</body>

</html>