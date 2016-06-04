<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="http://pruthvi-nadunooru.name/QuickReaction/SupplyChain/billingdata.js"></script>
    
        <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/shieldui-all.min.css" />  
        <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" /> 
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>


</head>
<body>

    <div id="wrapper">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Back to Admin</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                     <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                     <li><a href="truck_monitoring.php"><i class="fa fa-truck"></i> Truck Monitoring</a></li>
                    <li class="active"><a href="payment.php"><i class="fa fa-money"></i> Payment</a></li>
                    <li><a href="material_tracking.php"><i class="fa fa-globe"></i> Material Tracking</a></li>
                    <li><a href="alerts.php"><i class="fa fa-life-ring"></i> Alerts</a></li>
                    <li><a href="planning_data_research.php"><i class="fa fa-book"></i> Planning Data Research</a></li>
                   
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Swati<b class="caret"></b></a>
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


        <div class="container">
            <div class="row">
                <div class="text-center">
                    <h1>Payment History</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" display="inline-block">
                            <h3 class="panel-title"><i class="fa fa-money"></i> Billing Infomation</h3>
                        </div>
                        <div class="panel-body">
                        <div>
                            	<?php 
					ini_set('display_errors', 1);
					ini_set('memory_limit', '-1');
					$servername = "mysql-instance1.cfa3qxsmwzic.us-west-1.rds.amazonaws.com";
					$username = "cmpe281";
					$password = "admin123";
					$dbName = "cmpe281";					
					$conn = new mysqli($servername, $username, $password, $dbName);									
					if ($conn->connect_error)
					{
						die("Connection failed: " . $conn->connect_error . "<br/>");
					} 
					else
					{
						$query = "SELECT PayerAccountId,BillingPeriodStartDate,BillingPeriodEndDate,InvoiceDate,PayerAccountName,UsageStartDate,UsageEndDate,CostBeforeTax,Credits,TaxAmount,TotalCost FROM BILLING_INFORMATION;";
																						
		                                $result = $conn->query($query);		                                
						 $rows = array();  
						   $i=0;
			                         while($row = $result->fetch_assoc())
		                                {
		                                $rows[$i++] = $row;		                             
		                                }		                               
					}					
							   
				?>
                       		</div>                                               
                            <div id="shieldui-grid1"></div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <script>
    
        jQuery(function ($) {
        
     <?php
    //write to json file
    $fp = fopen('billingdata.js','w+');
    fclose($fp);
     $fp = fopen('billingdata.js','w');
    fwrite($fp,"var billingdata = ");
    fclose($fp);
    $fp = fopen('billingdata.js', 'a');
    fwrite($fp, json_encode($rows));
    fclose($fp);
   
?>




            $("#shieldui-grid1").shieldGrid({
                dataSource: {
                    data: billingdata
                },                              
                selection: {
                    type: "row",
                    multiple: true,
                    toggle: false
                },
                columns: [
                    { field: "PayerAccountId",title: "PayerAccountId" },
                    { field: "BillingPeriodStartDate", title: "BillingPeriodStartDate"},
                    { field: "BillingPeriodEndDate", title: "BillingPeriodEndDate"},
                    { field: "InvoiceDate", title: "InvoiceDate"},
                    { field: "PayerAccountName",title: "PayerAccountName"},
                    { field: "UsageStartDate", title: "UsageStartDate"},
                    { field: "UsageEndDate", title: "UsageEndDate"},
                    { field: "CostBeforeTax", title: "CostBeforeTax"},
                    { field: "Credits", title: "Credits" },
                    { field: "TaxAmount", title: "TaxAmount"},  
                    { field: "TotalCost", title: "TotalCost" }                      
                ]
            });
     });

  
    </script>

</body>
</html>