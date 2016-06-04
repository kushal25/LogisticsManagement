<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Tracking</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />


    
     <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/shieldui-all.min.css" />
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://pruthvi-nadunooru.name/QuickReaction/SupplyChain/materialData.js"></script>
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
                <a class="navbar-brand" href="index.php">Quick Reaction Admin Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="truck_monitoring.php"><i class="fa fa-truck"></i> Truck Monitoring</a></li>
                    <li><a href="payment.php"><i class="fa fa-money"></i> Payment</a></li>
                    <li class="active"><a href="material_tracking.php"><i class="fa fa-globe"></i> Material Tracking</a></li>
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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Material Tracking</h1>                    
                </div>
            </div>
						
            
                	
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-globe"></i> Material Tracking</h3>
                        </div>
                         <div>
		<?php 
		    ini_set('display_errors', 1);
			$servername = "mysql-instance1.cfa3qxsmwzic.us-west-1.rds.amazonaws.com";
			$username = "cmpe281";
			$password = "admin123";
			$dbName = "cmpe281";
			$table = "SOP_Data";
			$conn = new mysqli($servername, $username, $password, $dbName); 
			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error . "<br/>");
			} 
			else
			{
				$selectQuery = "SELECT DISTINCT SENSOR_DATA.TRUCK_ID, MATERIAL_INTERFACE.MARA_MATNR, TRUCK_INFO.REGION, TRUCK_INFO.DESTINATION_LOCATION, TRUCK_INFO.CURRENT_LOCATION, TRUCK_INFO.DESTINATION_NAME FROM SENSOR_DATA INNER JOIN MATERIAL_INTERFACE ON SENSOR_DATA.Sensor_id = MATERIAL_INTERFACE.sensor_id INNER JOIN TRUCK_INFO ON SENSOR_DATA.truck_id = TRUCK_INFO.truck_id" ;
				
				$result = $conn->query($selectQuery);
				 $rows_table = array();
				$i_table=0;
				while($row = $result->fetch_assoc())
				{		                                
				 $rows_table[$i_table++] = $row;			                                                               		                             
				} 
		
			}			
		?> 
	</div>  
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                        </div>
                    </div>
                </div>
            </div>
	</div>
     
    </div>
    <!-- /#wrapper -->

    <script type="text/javascript">
        jQuery(function ($) {
           
           
            
            
          
	    <?php
    //write to json file
    $fp = fopen('materialData.js','w+');
    fclose($fp);
     $fp = fopen('materialData.js','w');
    fwrite($fp,"var materialdata = ");
    fclose($fp);
    $fp = fopen('materialData.js', 'a');
    fwrite($fp, json_encode($rows_table));
    fclose($fp);
   
?>




            $("#shieldui-grid1").shieldGrid({
                dataSource: {
                    data: materialdata
                },
                sorting: {
                    multiple: true                   
                },
                paging: {
                    pageSize: 13,
                    pageLinksCount: 4
                },
                selection: {
                    type: "row",
                    multiple: true,
                    toggle: false
                },
                columns: [
                    { field: "TRUCK_ID", width: "30px", title: "TRUCK_ID" },
	            { field: "MARA_MATNR" ,title: "MARA_MATNR", width: "50px" },
	            { field: "REGION", title: "REGION",width: "30px" },
	            { field: "DESTINATION_LOCATION", title: "DESTINATION_LOCATION", width: "60px" },
	            { field: "CURRENT_LOCATION",title: "CURRENT_LOCATION", width: "70px"},
	            { field: "DESTINATION_NAME", title: "DESTINATION_NAME", width: "50px" }                ]
            });
        });

			
       
	
	  
	
    
    </script>
</body>
</html>