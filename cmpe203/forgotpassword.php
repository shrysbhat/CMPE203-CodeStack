<?php
session_start();
include('db.php');

/*On button press*/
if(isset($_POST['send_email']))
{
	/*Store textfield value in variable*/
	$email = $_POST['email'];
	
	/*query to check the entered email id is valid or not*/
	$result = mysql_query("SELECT * FROM login WHERE email ='$email'") or die(mysql_error());
	$row = mysql_fetch_array($result);
	$password = $row['password'];
	
	/*send email to user*/
	if(mysql_num_rows($result)==1){
			$subject='Your Password';
			$message ="
			<html>
			<body>
			<center>
  
			<table border='0' align='center'><tr><td style=' font-family:arial; font-size:40px;'><b>Code Trenders</b></td></tr>
			</table>
		  
			<table>
  
			<tr><td>Email: </td>
			<td>$email</td>
			</tr>
			
			<tr><td>Password: </td>
			<td>$password</td>
			</tr>
 
			</table>
			</center>
			</body>
			</html>";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			mail($email, $subject, $message, $headers);
			
			echo "<script type = 'text/javascript'>";
			echo "alert('An email with your password has been sent to you. Please check.')";
			echo "</script>";
	}
	
	/*error message*/
	else
	{
	echo "<script type = 'text/javascript'>";
	echo "alert('Please enter valid email.')";
	echo "</script>";
	}

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome to MyTacks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            <form class="form login-form" action = "" method = "post">
                <legend>Forgot Password</span></legend>
            
                <div class="body">
                    <label>Enter your registered Email :</label>
                    <input type="text" name = "email" id = "email">
                </div>
            
                <div class="footer">            
                    <button type="submit" name = "send_email" id = "send_email" class="btn btn-success">Send Email</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="white navbar-fixed-bottom">
      Don't have an account yet? <a href="register.php" class="btn btn-black">Register</a>
    </footer>
	
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/backstretch.min.js"></script>
    <script src="js/login.js"></script>

  </body>
</html>
