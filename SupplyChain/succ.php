<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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
	   

        <div id="wrapper">
        
        
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
                    <li class="fa fa-list-ol"><a href="login2.php"> Sign In</a></li>
                    <li class="active"><a href="register.html"> Register </a></li>           
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> USERNAME<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        
	
        <!-- Top content -->
        <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Sign Up Success</h1>
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
									<?php 
										ini_set('display_errors', 1);
										$servername = "mysql-instance1.cfa3qxsmwzic.us-west-1.rds.amazonaws.com";
										$username = "cmpe281";
										$password = "admin123";
										$dbName = "cmpe281";
										$table = "USER";
										$conn = new mysqli($servername, $username, $password, $dbName); 
										$firstName = $_POST["firstname"];
										$password = $_POST["password"];
										$phone = $_POST["phone"];
										$email = $_POST["emailaddress"];
										$companyname = $_POST["companyname"];
										$contractperiod = $_POST["contractperiod"];
										if ($conn->connect_error)
										{
											die("Connection failed: " . $conn->connect_error . "<br/>");
										} 
										else
										{						
											$selectQuery = "SELECT * FROM USER where EMAIL = '" . $email . "'";
											$result = $conn->query($selectQuery);
											if ($result->num_rows > 0)
											{
												echo "You have already registered!";
											} 
											else
											{
												$insertQuery = "INSERT INTO " . $table . " (User_Name,User_password,Company_Name,Email,Phone,Contract_Period) VALUES ('" . $firstName . "','" . $password . "','" . $companyname . "','" . $email . "','" . $phone . "','" . $contractperiod . "')";
												echo $insertQuery;
												$conn->query($insertQuery);
									?>
											<h3>Success!!</h3>
						<p><?php echo $firstName; ?> .&nbsp You can now sign-in to your account </p>
											<?php	
											}
									                $conn->close();
                                                                                 }
?>

										
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <a href="login2.php"><button type="submit" class="btn">Sign in!</button></a>
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