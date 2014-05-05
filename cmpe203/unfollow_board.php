<?php
session_start();

$user_id = $_SESSION['id'];
if($user_id == NULL)
{
	echo"<script type = 'text/javascript'>";
	echo"window.location = 'index.php';";
	echo"</script>";
}
include('db.php');

/*get board id from query string*/
$board_id=$_GET['board_id'];

/*delete row from follow_board table if the user has unfollowed a specific board*/
mysql_query("DELETE FROM follow_board WHERE uid=$user_id AND bid=$board_id") or die(mysql_error());

/*redirect user to home page*/
echo"<script type = 'text/javascript'>";
echo"window.location.href = 'http://itechcareers.com/cmpe203/home.php'";
echo"</script>";
?>