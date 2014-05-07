<?php
session_start();
/**
  * @author  (Archit Agarwal)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  maintaining session
  */
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

/*insert user and board info in follow_board table*/
mysql_query("INSERT INTO follow_board(uid, bid) VALUES('$user_id', '$board_id')") or die(mysql_error());

/*redirect the user to home page*/
echo"<script type = 'text/javascript'>";
echo"window.location.href = 'http://itechcareers.com/cmpe203/home.php'";
echo"</script>";
?>