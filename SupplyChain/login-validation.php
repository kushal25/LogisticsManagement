<!DOCTYPE html>
<html lang="en">

    <head>

       <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Deep Blue Admin</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>   

      <style>

        div {
            padding-bottom:20px;
        }

    </style>

    </head>

    <body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="row text-center">
            		<h2 style="color:white">Quick Reaction - Supply Chain Inventory Management</h2>
        	</div>
            <div class="navbar-header">       
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active"><a href="login2.php"> Sign In</a></li>
                    <li class="fa fa-list-ol"><a href="register.html"> Register </a></li>
                </ul>
            </div>
        </nav>


        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-bottom">
                            		<?php
					    	ini_set('display_errors', 1);
					    	
							$servername = "mysql-instance1.cfa3qxsmwzic.us-west-1.rds.amazonaws.com";
							$username = "cmpe281";
							$password = "admin123";
							$dbName = "cmpe281";
							$table = "USER";	
						$conn = new mysqli($servername, $username, $password, $dbName); 
						
						if ($conn->connect_error)
						{
							die("Connection failed: " . $conn->connect_error . "<br/>");
						} 
						else
						{		
							$email = $_POST["emailaddress"];
							$password = $_POST["password"];
								
							$selectQuery = "SELECT * FROM USER where Email='" . $email . "'";

							$result = $conn->query($selectQuery);

							if ($result->num_rows > 0)
							{
								$row = $result->fetch_assoc();

								
								$userName = $row["User_Name"];
								
								if ($password == $row["User_password"])
								{
//									$cookieName = 'UserName';
//									setcookie($cookieName, $userName, time() + 15 * 24 * 60 * 60, "/");
									
//									$cookieName = 'Picture_Link';
//									setcookie($cookieName, '', time() - 15 * 24 * 60 * 60, "/");
									
//									$cookieName = 'USER_ID';
//									setcookie($cookieName, $row["USER_ID"], time() + 15 * 24 * 60 * 60, "/");
									
									echo "coming here...";
									header('Location: http://pruthvi-nadunooru.name/QuickReaction/SupplyChain/index.php');
								}
							}
							
							$conn->close();
							
						}
				?>
			                    <form role="form" action="login-validation.php" method="post" class="login-form">
							
			                    	<div class="form-group">
			                    		<p style = "color: Blue" >Incorrect UserName or Password!</p>
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="emailaddress" placeholder="Username [email Address].." class="form-username form-control" id="form-username" required>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
			                        <button type="submit" class="btn">Sign in!</button>
			                        <a style = "color: White" href = "password-reset.php">Forgot Password? </a>
			                    </form>
                                <br/>
                                <form role="form" action="register.html" method="post" class="login-form">
                                <button type="submit" class="btn">New User</button>
                                </form>
                          </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>