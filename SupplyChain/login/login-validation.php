<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quick Park</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="/MarketPlace/Shield Theme/sangam.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

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
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
                            		<?php
					    	ini_set('display_errors', 1);
					    	
					    	$servername = "localhost";
						$username = "pruthvin_0702";
						$password = "ASDF;lkj123";
						$dbName = "pruthvin_market";
						$servername = "localhost";					
						$conn = new mysqli($servername, $username, $password, $dbName); 
						
						if ($conn->connect_error)
						{
							die("Connection failed: " . $conn->connect_error . "<br/>");
						} 
						else
						{		
							$email = $_POST["email"];
							$password = $_POST["password"];
										
							$selectQuery = "SELECT * FROM USER where EMAIL = '" . $email . "'";
	
							$result = $conn->query($selectQuery);
	
							if ($result->num_rows > 0)
							{
								$row = $result->fetch_assoc();
								
								$userName = $row["USER_NAME"];
							        
								  // Convert the password from UTF8 to UTF16 (little endian)
								  $password = iconv('UTF-8', 'UTF-16LE', $password);
								
								  // Encrypt it with the MD4 hash
								  $MD4Hash = bin2hex(mhash(MHASH_MD4, $password));
								
								  // You could use this instead, but mhash works on PHP 4 and 5 or above
								  // The hash function only works on 5 or above
								  //$MD4Hash=hash('md4', $Input);
								
								  // Make it uppercase, not necessary, but it's common to do so with NTLM hashes
								  $hash = strtoupper($MD4Hash);
							        
								if ($hash == $row["PASSWORD"])
								{
									$cookieName = 'UserName';
									setcookie($cookieName, $userName, time() + 15 * 24 * 60 * 60, "/");
									
									$cookieName = 'Picture_Link';
									setcookie($cookieName, '', time() - 15 * 24 * 60 * 60, "/");
									
									$cookieName = 'USER_ID';
									setcookie($cookieName, $row["USER_ID"], time() + 15 * 24 * 60 * 60, "/");
									
									header('Location: http://pruthvi-nadunooru.name/MarketPlace/Shield%20Theme/index.php');
								}
							}
							
							$conn->close();
						}
				?>
			                    <form role="form" action="login-validation.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<p style = "color : white">Incorrect UserName or Password!</p>
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="email" placeholder="Username..." class="form-username form-control" id="form-username" required>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
			                        <button type="submit" class="btn">Sign in!</button>
			                        <a style = "color: white" href = "password-reset.php">Forgot Password? </a>
			                    </form>
                                <br/>
                                <form role="form" action="new.php" method="post" class="login-form">
                                <button type="submit" class="btn">New User</button>
                                </form>
                                <br/>
				
				<form role=form action="facebook_login.php" method="post" class="login-form">
				<button type="submit" class="btn" style="background : #3b5998"> <i class="fa fa-facebook-square">Login</i></button>
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