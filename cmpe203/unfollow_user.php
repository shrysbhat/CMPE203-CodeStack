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

/*get user id to be unfollowed from query string*/
$user=$_GET['user_id'];

/*delete row from follow_user table if the user has unfollowed a specific user*/
mysql_query("DELETE FROM follow_user WHERE uid=$user_id AND following_uid=$user") or die(mysql_error());

/*redirect user to profile page of user it has unfollowed page*/
echo"<script type = 'text/javascript'>";
echo"window.location.href = 'http://itechcareers.com/cmpe203/userprofile.php?user_id=".$user."'";
echo"</script>";
?>