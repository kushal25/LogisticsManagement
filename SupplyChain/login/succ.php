<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sangam</title>

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
                            <h1>Login Form</h1>
                           
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
						} else
						{
							$insertQuery = "INSERT INTO " . $table . " VALUES ('" . $firstName . "','" . $password . "','" . $phone . "','" . $email . "','" . $companyname . "','" . contractperiod . "')";
							echo $insertQuery;
							$conn->query($insertQuery);
							
							?>
							<h3>Success!!</h3>
							<p><?php echo $firstName; ?> you can now login with you account</p>
						<?php	
						}
						$conn->close();

						if ($result->num_rows > 0)
						{
							echo "You have already registered!";
						} else
						{
							$insertQuery = "INSERT INTO USER(USER_NAME, EMAIL, PASSWORD) VALUES ('" . $firstName . "','" . $email. "','" . $hash . "')"; 
							
							$conn->query($insertQuery);
						  ?>
							<h3>Success!!</h3>
							<p><?php echo $firstName; ?> you can now login with you account</p>
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