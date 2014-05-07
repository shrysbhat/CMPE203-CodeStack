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

$tack_id=$_GET['tack_id'];

/**
  * @author  (Amod Rege)
  * @version  v1.0
  * @date     (23-April-2014)
  * @Description  delete tack row containing specific tack id
  */
mysql_query("DELETE FROM tacks WHERE id=$tack_id") or die(mysql_error());

/**
  * @author  (Archit Agarwal)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  redirect user to board page
  */
echo"<script type = 'text/javascript'>";
echo"window.location.href = 'http://itechcareers.com/cmpe203/board.php?board_id=".$board_id."'";
echo"</script>";
?>