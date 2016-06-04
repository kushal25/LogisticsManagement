<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>   

      <style>

       

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
                    <li class="active"><a href="login2.php"> Sign In</a></li>
                    <li class="fa fa-list-ol"><a href="register.html"> Register </a></li>
                </ul>
            </div>
        </nav>

       <div>
        <div>
        <div class="row text-center">
            <h2></h2>
        </div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 form-box">
				<div class="form-top">
					<div class="form-top-left">
						<h3>Login to our site</h3>
						
					</div>
				</div>
				<div class="form-bottom">
				<p>Enter your username and password to log on:</p>
					<form role="form" action="login-validation.php" method="post" class="login-form">
						
									<div class="form-group">
							<label class="sr-only" for="form-username">Username [email address]</label>
							<input type="email" name="emailaddress" placeholder="Username [email address]" class="form-username form-control" id="form-username" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-password">Password</label>
							<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
						</div>
						<button type="submit" class="btn">Sign in!</button>
					</form>
					<br/>
					<form role="form" action="register.html" method="post" class="login-form">
					<button type="submit" class="btn">New User</button>
					</form>
					<br/>
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