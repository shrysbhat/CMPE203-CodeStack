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

/**
  * @author  (Amod Rege)
  * @version  v1.0
  * @date     (23-April-2014)
  * @Description  delete board row containing specific board id
  */
mysql_query("DELETE FROM boards WHERE id=$board_id") or die(mysql_error());

/*delete tacks associated with the board*/
mysql_query("DELETE FROM tacks WHERE bid=$board_id") or die(mysql_error());

/**
  * @author  (Archit Agarwal)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  redirect user to profile page
  */
echo"<script type = 'text/javascript'>";
echo"window.location.href = 'http://itechcareers.com/cmpe203/profile.php'";
echo"</script>";
?>