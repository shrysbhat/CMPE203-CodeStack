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

/*insert user id and tack id in like_tack table*/
mysql_query("INSERT INTO like_tack(uid, tid) VALUES('$user_id', '$tack_id')") or die(mysql_error());

/*redirect user to board page*/
echo"<script type = 'text/javascript'>";
echo"window.location.href = 'http://itechcareers.com/cmpe203/board.php?board_id=".$board_id."'";
echo"</script>";
?>