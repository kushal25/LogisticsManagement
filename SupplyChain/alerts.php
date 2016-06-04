<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerts</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />


    
     <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/shieldui-all.min.css" />
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://pruthvi-nadunooru.name/QuickReaction/SupplyChain/alertData.js"></script>
    <script type="text/javascript" src="http://pruthvi-nadunooru.name/QuickReaction/SupplyChain/alertInventory.js"></script>
    <script type="text/javascript" src="http://pruthvi-nadunooru.name/QuickReaction/SupplyChain/alertsWeight.js"></script>
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
                    <li><a href="material_tracking.php"><i class="fa fa-globe"></i> Material Tracking</a></li>
                    <li class="active"><a href="alerts.php"><i class="fa fa-life-ring"></i> Alerts</a></li>
                    <li><a href="planning_data_research.php"><i class="fa fa-book"></i> Planning Data Research</a></li>
                                      
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">                  
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Swati <b class="caret"></b></a>
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
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-life-ring"></i> Alerts!!! Temperature Change Alerts : Reroute Trucks to Nearest Store</h3>
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
					$selectQuery = "SELECT DISTINCT TRUCK_ID SD FROM SENSOR_DATA SD JOIN MATERIAL_INTERFACE M ON SD.SENSOR_ID = M.SENSOR_ID  WHERE (SD.TYPE = 1 AND M.MARA_TEMPB = 'Y' AND ((SD.SENSOR_DATA > (M.EXPECTED_VALUE + 5)) OR (SD.SENSOR_DATA < (M.EXPECTED_VALUE - 5))))";
					$result = $conn->query($selectQuery);
					 $rows = array();  
						   $i=0;
						  while($row = $result->fetch_assoc())
		                                {
		                               
		                                $rows[$i] = $row['SD'];	
		                                $i++;
		                                }
						
						$rows1 = array();
						$i = 0;
						
		                                foreach($rows as $row)
		                                {	                                    
				                    $query = "SELECT M.EXPECTED_VALUE, SD.SENSOR_DATA  FROM MATERIAL_INTERFACE M JOIN SENSOR_DATA SD ON SD.SENSOR_ID = M.SENSOR_ID  WHERE  (SD.TRUCK_ID='" .$row. "' AND SD.TYPE = 1 )ORDER BY SENSOR_DATA DESC LIMIT 1";
				                    
				                   	$result1 = $conn->query($query);
							$dataRow = $result1->fetch_assoc();
									                                
		                                	$rows[$i++]= '{TRUCK_ID:' . $row  . ',EXPECTED_VALUE:' . $dataRow['EXPECTED_VALUE'] . ',SENSOR_DATA:' . $dataRow['SENSOR_DATA'] . '}';
		                                		                             
		                                }	
		                             
    						
    

					 	                                
?>
	</div>  
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                        </div>
                    </div>
                </div>
            </div>


    

    
  	
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-life-ring"></i> Alerts!!! Weight Change Alerts : Reroute Trucks to Nearest Store</h3>
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
					$selectQuery = "SELECT DISTINCT TRUCK_ID SD FROM SENSOR_DATA SD JOIN MATERIAL_INTERFACE M ON SD.SENSOR_ID = M.SENSOR_ID  WHERE (SD.TYPE = 0 AND M.MARA_TEMPB = 'Y' AND ((SD.SENSOR_DATA > (M.EXPECTED_VALUE + 5)) OR (SD.SENSOR_DATA < (M.EXPECTED_VALUE - 5))))";
					$result = $conn->query($selectQuery);
					 $rows = array();  
						   $i=0;
						  while($row = $result->fetch_assoc())
		                                {
		                               
		                                $rows[$i] = $row['SD'];	
		                                $i++;
		                                }
						
						$rows1 = array();
						$i = 0;
						
		                                foreach($rows as $row)
		                                {	                                    
				                    $query = "SELECT M.EXPECTED_VALUE, SD.SENSOR_DATA  FROM MATERIAL_INTERFACE M JOIN SENSOR_DATA SD ON SD.SENSOR_ID = M.SENSOR_ID  WHERE  (SD.TRUCK_ID='" .$row. "' AND SD.TYPE = 0 )ORDER BY SENSOR_DATA DESC LIMIT 1";
				                    
				                   	$result1 = $conn->query($query);
							$dataRow = $result1->fetch_assoc();
									                                
		                                	$rows[$i++]= '{TRUCK_ID:' . $row  . ',EXPECTED_VALUE:' . $dataRow['EXPECTED_VALUE'] . ',SENSOR_DATA:' . $dataRow['SENSOR_DATA'] . '}';
		                                		                             
		                                }	
		                               
    						
    

					 	                                
?>
	</div>  
                        <div class="panel-body">
                            <div id="shieldui-grid2"></div>
                        </div>
                    </div>
                </div>
            </div>

   
    
   
    
              	
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-life-ring"></i>Alert!! Inventory Change Alerts : Reroute Trucks to New Location</h3>
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
					$selectQuery = "SELECT DISTINCT TRUCK_ID SD FROM SENSOR_DATA SD JOIN MATERIAL_INTERFACE M ON SD.SENSOR_ID = M.SENSOR_ID  WHERE (SD.TYPE = 0 AND M.MARA_TEMPB = 'Y' AND ((SD.SENSOR_DATA > (M.EXPECTED_VALUE + 5)) OR (SD.SENSOR_DATA < (M.EXPECTED_VALUE - 5))))";
					$result = $conn->query($selectQuery);
					 $rows = array();  
						   $i=0;
						  while($row = $result->fetch_assoc())
		                                {
		                               
		                                $rows[$i] = $row['SD'];	
		                                $i++;
		                                }
						
						$rows1 = array();
						$i = 0;
						
		                                foreach($rows as $row)
		                                {	                                    
				                    $query = "SELECT M.EXPECTED_VALUE, SD.SENSOR_DATA  FROM MATERIAL_INTERFACE M JOIN SENSOR_DATA SD ON SD.SENSOR_ID = M.SENSOR_ID  WHERE  (SD.TRUCK_ID='" .$row. "' AND SD.TYPE = 0 )ORDER BY SENSOR_DATA DESC LIMIT 1";
				                    
				                   	$result1 = $conn->query($query);
							$dataRow = $result1->fetch_assoc();
									                                
		                                	$rows[$i++]= '{TRUCK_ID:' . $row  . ',EXPECTED_VALUE:' . $dataRow['EXPECTED_VALUE'] . ',SENSOR_DATA:' . $dataRow['SENSOR_DATA'] . '}';
		                                		                             
		                                }	
		                               
    						
    

					 	                                
?>
	</div>  
                        <div class="panel-body">
                            <div id="shieldui-grid3"></div>
                        </div>
                    </div>
                </div>
            </div>
	</div>
   </div>  

    <script type="text/javascript">
        jQuery(function ($) {
           
           
            
            
          
	    <?php
    //write to json file
  //  $fp = fopen('alertInventory.js','w+');
  //  fclose($fp);
  //   $fp = fopen('alertInventory.js','w');
  //  fwrite($fp,"var alertdata = ");
  //  fclose($fp);
    //$fp = fopen('alertsWeight.js', 'a');
    //fwrite($fp, json_encode($rows));
    //fclose($fp);
   
?>

$("#shieldui-grid1").shieldGrid({
                dataSource: {
                    data: alertData
                },
                sorting: {
                    multiple: true                   
                },
                paging: {
                    pageSize: 3,
                    pageLinksCount: 2
                },
                selection: {
                    type: "row",
                    multiple: true,
                    toggle: false
                },
                columns: [
                    {field: "TRUCK_ID" ,title: "TRUCK ID", width: "50px" },
	            { field: "EXPECTED_VALUE" ,title: "EXPECTED_VALUE", width: "50px" },
	            { field: "SENSOR_DATA", title: "SENSOR DATA",width: "30px" }
	            ]
            });

        
           $("#shieldui-grid2").shieldGrid({
                dataSource: {
                    data: alertsWeight
                },
                sorting: {
                    multiple: true                   
                },
                paging: {
                    pageSize: 2,
                    pageLinksCount: 4
                },
                selection: {
                    type: "row",
                    multiple: true,
                    toggle: false
                },
                columns: [
                	{field: "TRUCK_ID" ,title: "TRUCK ID", width: "50px" },
	            { field: "EXPECTED_VALUE" ,title: "EXPECTED_VALUE", width: "50px" },
	            { field: "SENSOR_DATA", title: "SENSOR DATA",width: "30px" }
                    
	            ]
            });
       

  





            $("#shieldui-grid3").shieldGrid({
                dataSource: {
                    data: alertInventory
                },
                sorting: {
                    multiple: true                   
                },
                paging: {
                    pageSize: 2,
                    pageLinksCount: 4
                },
                selection: {
                    type: "row",
                    multiple: true,
                    toggle: false
                },
                columns: [
                	{field: "TRUCK_ID" ,title: "TRUCK ID", width: "30px" },
	            { field: "Old_Demand" ,title: "OLD DEMAND", width: "30px" },
	            { field: "New_Demand", title: "NEW DEMAND", width: "30px" },
	            { field: "Old_Destination", title: "OLD DESTINATION",width: "30px" },
	            { field: "New_Destination", title: "NEW DESTINATION",width: "30px" }
                    ]
            });
        });

  
    </script>
</body>
</html>