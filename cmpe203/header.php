<?php
session_start();

$user_id = $_SESSION['id'];
if($user_id == NULL)
{
	echo"<script type = 'text/javascript'>";
	echo"window.location = 'index.php';";
	echo"</script>";
}
?>
<head>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container" style="background-color:#48649F; padding:7px; width:100%;">
		  <div>
			<a class="brand" href="home.php"><img src="images/logo.jpg" alt="Code Trenders!!!" style = "max-width:30px; display:block; margin-left:12%; float:left;"></a>
			<form action="search.php" method="post">
			<input type="text" name="search_bar" id="search_bar" placeholder="Search for Friends, Boards, Tacks">
			<div>
				<input type="image" src="images/search.png" alt="Search" style="width: 28px;float: left;">
			</div>
			</form>
			<div>
				<a href="addboard.php"><img src="images/plus.png" alt="ADD" style = "width: 38px;position: relative;align: left;float: left;margin-top: -7px;margin-left: 5%;"></a>
			</div>
			<div>
				<a href="home.php" id="header_link"><b>Home</b></a>
			</div>
			<div>
				<a href="profile.php" id="header_link"><b>Profile</b></a>
			</div>
			<div>
				<a href="logout.php" id="header_link"><b>Logout</b></a>
			</div>
			<div>
				<a href="settings.php"><img src="images/settings.png" alt="Setting" style = "width: 22px;position: relative;float: left;margin-left: 2%;"></a>
			</div>
		  </div>
          
        </div>
    </div>
</div>
