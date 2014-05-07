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

/*get user id to be followed from query string*/
$user=$_GET['user_id'];

/*insert user and followed user info in follow_user table*/
mysql_query("INSERT INTO follow_user(uid, following_uid) VALUES('$user_id', '$user')") or die(mysql_error());

/*redirect the user to profile page of user it is following*/
echo"<script type = 'text/javascript'>";
echo"window.location.href = 'http://itechcareers.com/cmpe203/userprofile.php?user_id=".$user."'";
echo"</script>";
?>