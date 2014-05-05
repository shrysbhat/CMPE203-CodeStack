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

/*delete board row containing specific board id*/
mysql_query("DELETE FROM boards WHERE id=$board_id") or die(mysql_error());

/*redirect user to profile page*/
echo"<script type = 'text/javascript'>";
echo"window.location.href = 'http://itechcareers.com/cmpe203/profile.php'";
echo"</script>";
?>