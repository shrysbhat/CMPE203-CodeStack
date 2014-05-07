<?php
/**
  * @author  (Amod Rege)
  * @version  v1.0
  * @date     (23-April-2014)
  * @Description  Database connection
  */
$dbhost = 'localhost'; 			//host name
$dbuser = 'itech_cmpe203'; 		//username
$dbpass = '#mp+TPGZe.KK'; 		//password
$dbname = 'itech_cmpe203'; 		//databse name

// query to connect with the database
mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());
?>