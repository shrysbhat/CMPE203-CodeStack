<?php
session_start();
include('db.php');

/**
  * @author  (Archit Agarwal)
  * @version  v1.0
  * @date     (1-May-2014)
  * @Description  On login button press
  */
if(isset($_POST['login']))
{
	/*get values of textfields in variables*/
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
     
	/*check for user with given credentials*/
	$result = mysql_query("SELECT * FROM login WHERE email ='$email'") or die(mysql_error());
	$row = mysql_fetch_array($result);
	
	/*giving value to session name*/
	if(($email == $row['email']) && ($password == $row['password']) && ($email != null) && ($password != null))
	{
		$_SESSION['id'] = $row['id'];
		header( 'Location: home.php' );
	}
	
	/*error message*/
	else
	{
	echo "<script type = 'text/javascript'>";
	echo "alert('Wrong Credentials! Please try again.')";
	echo "</script>";
	}
	}
	else{
		echo "<script type = 'text/javascript'>";
		echo "alert('Invalid Email.')";
		echo "</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<!--
  * @author  (Pratik Gaglani)
  * @version  v2.0
  * @date     (21-April-2014)
  * @Description  change password page UI
  -->
  <head>
    <meta charset="utf-8">
    <title>Welcome to CodeStack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--including css files-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="images/favicon.ico">

  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php" style = "max-width:5%"><img src="images/logo.jpg" alt="Code Trenders!!!"></a>
        </div>
      </div>
    </div>

    <div class="container">

        <div id="login-wraper">
            <form class="form login-form" action = "index.php" method = "post">
                <legend>Sign in to <span class="blue"><b>CodeStack</b></span></legend>
            
                <div class="body">
                    <label>Email</label>
                    <input type="text" name = "email" id = "email">
                    
                    <label>Password</label>
                    <input type="password" name = "password" id = "password">
					
					<label><p align="right"><a href="forgotpassword.php" style="text-decoration:none; color:blue; font-size:12px;">Forgot Password?</a></p></label>
                </div>
            
                <div class="footer">
                    <label class="checkbox inline">
                        <input type="checkbox" id="inlineCheckbox1" value="option1"> Remember me
                    </label>
                                
                    <button type="submit" name = "login" id = "login" class="btn btn-success">Login</button>
                </div>
            
            </form>
        </div>

    </div>

    <footer class="white navbar-fixed-bottom">
      Don't have an account yet? <a href="register.php" class="btn btn-black">Register</a>
    </footer>
	
	<!--including js files in the end so the page loads faster-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/backstretch.min.js"></script>
    <script src="js/login.js"></script>

  </body>
</html>
