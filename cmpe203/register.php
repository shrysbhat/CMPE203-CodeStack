<?php
session_start();
include('db.php');

/*on button press*/
if(isset($_POST['register']))
{
	/*get values of textfields in variables*/
	$firstName = $_POST["first_name"];
	$lastName = $_POST["last_name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	/*check if email is already registered by querying login table*/
	$result = mysql_query("SELECT * FROM login WHERE email ='$email'") or die(mysql_error());
	$row = mysql_fetch_array($result);
	
	/*error message*/
	if($email == $row['email'] && $email != null)
	{
		echo "<script type = 'text/javascript'>";
		echo "alert('Email is already registered.')";
		echo "</script>";
	}
	
	/*enter info of new user in database*/
	else if(($firstName != null) && ($lastName != null) && ($email != null) && ($password != null))
	{
		mysql_query("INSERT INTO login(first_name, last_name, email, user_image, password) VALUES('$firstName', '$lastName', '$email', 'images/user_images/default.jpg', '$password')") or die(mysql_error());
		
		/*redirect user to login page*/
		echo"<script type = 'text/javascript'>";
		echo"window.location.href = 'http://itechcareers.com/cmpe203/index.php";
		echo"</script>";
	}
	
	/*error message if any textfield is left blank*/
	else
	{
		echo "<script type = 'text/javascript'>";
		echo "alert('Wrong Credentials! Please try again.')";
		echo "</script>";
	}

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Register to MyTacks</title>
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
            <form class="form login-form" action="register.php" method="post">
                <legend>Sign up to <span class="blue"><b>MyTacks</b></span></legend>
            
                <div class="body" style="padding-bottom:10px;">
					<table>
						<tr>
							<td style="width:150px;">
								<label>First Name</label>
							</td>
							<td>
								<input type="text" id="first_name" name="first_name">
							</td>
						</tr>
						<tr>
							<td>
								<label>Last Name</label>
							</td>
							<td>
								<input type="text" id="last_name" name="last_name">
							</td>
						</tr>
						<tr>
							<td>
								<label>Email</label>
							</td>
							<td>
								<input type="text" id="email" name="email">
							</td>
						</tr>
						<tr>
							<td>
								<label>Password</label>
							</td>
							<td>
								<input type="password" id="password" name="password">
							</td>
						</tr>
					</table>
                </div>
            
                <div class="footer">
                    <button type="submit" name = "register" id = "register" class="btn btn-success">Register</button>
                </div>
            
            </form>
        </div>

    </div>
	
	<!--including js files in the end so the page loads faster-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/backstretch.min.js"></script>
    <script src="js/login.js"></script>

  </body>
</html>
