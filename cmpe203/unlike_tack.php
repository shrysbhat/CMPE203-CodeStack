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

/*get tack id and board id from query string*/
$tack_id=$_GET['tack_id'];
$board_id=$_GET['board_id'];

/*delete info from like_tack table if the user has unliked any tack*/
mysql_query("DELETE FROM like_tack WHERE uid=$user_id AND tid=$tack_id") or die(mysql_error());

/*redirect user to board page*/
echo"<script type = 'text/javascript'>";
echo"window.location.href = 'http://itechcareers.com/cmpe203/board.php?board_id=".$board_id."'";
echo"</script>";
?>