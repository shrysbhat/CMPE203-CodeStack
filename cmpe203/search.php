<?php
include('header.php');
include('db.php');

/*get the keyword user wants to search*/
$value=$_POST['search_bar'];

/**
  * @author  (Amod Rege and Morvin Shah)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  query to search user typed keyword in login, boards and tacks table
  */
$result1 = mysql_query("SELECT * FROM login WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%'") or die(mysql_error());
$result2 = mysql_query("SELECT * FROM boards WHERE board_title LIKE '%$value%' AND privacy=0") or die(mysql_error());
$result3 = mysql_query("SELECT * FROM tacks WHERE tack_title LIKE '%$value%'") or die(mysql_error());
?>
<html>
	
	<head>
		<title>
			Search Result
		</title>
<!--
  * @author  (Pratik Gaglani)
  * @version  v2.0
  * @date     (21-April-2014)
  * @Description  including css files, js plugins and js code for setting size of tacks, boards and user profiles
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
  * @author  (Amod Rege and Morvin Shah)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  if no result found in any table
  */
			if((mysql_num_rows($result1)==0) && (mysql_num_rows($result2)==0) && (mysql_num_rows($result3)==0)){
				echo "<h1 style='color:#fff;width:500px;'>Sorry! No results found.</h1>";
			}
			else{
				/*display values found from login table*/
				while($row1 = mysql_fetch_array( $result1 )) {
				echo"<article class='white-panel'> <a href='userprofile.php?user_id=".$row1['id']."'><img src='".$row1['user_image']."' alt='ALT'></a>";
				echo"<h1><a href='userprofile.php?user_id=".$row1['id']."'>".$row1['first_name']."&nbsp;&nbsp;".$row1['last_name']."</a></h1>";
				echo"<p></p>";
				echo"</article>";
				}
				
				/*display values found from boards table*/
				while($row2 = mysql_fetch_array( $result2 )) {
				echo"<article class='white-panel'> <a href='".$row2['board_url']."?board_id=".$row2['id']."'><img src='".$row2['board_image']."' alt='ALT'></a>";
				echo"<h1><a href='".$row2['board_url']."?board_id=".$row2['id']."'>".$row2['board_title']."</a></h1>";
				echo"<p>".$row2['board_description']."</p>";
				echo"</article>";
				}
				
				/*display values found from tacks table*/
				while($row3 = mysql_fetch_array( $result3 )) {
				echo"<article class='white-panel'> <a href='".$row3['tack_url']."' target='_blank'><img src='".$row3['tack_image']."' alt='ALT'></a>";
				echo"<h1><a href='".$row3['tack_url']."' target='_blank'>".$row3['tack_title']."</a></h1>";
				echo"<p>".$row3['tack_description']."</p>";
				echo"</article>";
				}
			}
			
		?>
		
		</section>
	</body>

</html>