<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quick Reaction</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />


    <style>
      #map {
        width: 1065px;
        height: 500px;
        margin-left: -10px;
        margin-top: -10px;
        margin-bottom:-10px;
      }     
     
    </style>

    <script src="https://maps.googleapis.com/maps/api/js"></script>
    
     <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/shieldui-all.min.css" />  
        <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" /> 
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://pruthvi-nadunooru.name/QuickReaction/Theme-DeepBlueAdmin/empdata.js"></script>
     <script type="text/javascript" src="http://pruthvi-nadunooru.name/QuickReaction/Theme-DeepBlueAdmin/control.js"></script>
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
                    <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="truck_monitoring.php"><i class="fa fa-truck"></i> Regional Truck Monitoring</a></li>
                    <li><a href="material_tracking.php"><i class="fa fa-globe"></i> Material Tracking</a></li>
                    <li><a href="alerts.php"><i class="fa fa-life-ring"></i> Alerts</a></li>
                    <li><a href="planning_data_research.php"><i class="fa fa-book"></i> Planning Data Research</a></li>
                    <li><a href="truck_rerouting.php"><i class="fa fa-map-marker"></i> Truck Rerouting</a></li>                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">                  
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Steve Miller<b class="caret"></b></a>
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
                    <h1>Dashboard</h1>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Welcome to the Quick Reaction Admin dashboard!
                        <br />                        
                    </div>
                </div>
            </div>
            <div>
                            	<?php 
					ini_set('display_errors', 1);										
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
						$query = "SELECT count(distinct TRUCK_ID) as truckCnt FROM TRUCK_INFO;";
						    $result1 = $conn->query($query);
		                                  		                                
						 $rowt = array();  
						   $i=0;
			                        while($row = $result1->fetch_assoc())
		                                {
		                                $rowt[$i++]= $row['truckCnt'];		                             
		                                }
		                                 
					}					
				?>				
		</div>
		
						
            <div class="row">
                <div class="col-lg-3">
                    <div class="panel panel-default ">
                        <div class="panel-body alert-info">
                            <div class="col-xs-3">
                                <i class="fa fa-truck fa-4x"></i>
                            </div>
                            <div class="col-xs-7 ">                         
                            <p id="kill" class="alerts-heading"></p>
                            <p class="alerts-text">Active Trucks</p>                             
                            </div>
                        </div>
                    </div>
                </div>
                <script "text/javascript">
		var truck_num = <?php echo json_encode($rowt); ?>;						
		document.getElementById("kill").innerHTML =  "&nbsp;&nbsp;" + truck_num;
		</script> 
		 <div>
                            	<?php 
					ini_set('display_errors', 1);									
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
						$query = "SELECT count( distinct SENSOR_ID) as sense_count FROM cmpe281.SENSOR_STATUS;";
						    $result1 = $conn->query($query);
		                                  		                                
						 $row_s = array();  
						   $i=0;
			                        while($row = $result1->fetch_assoc())
		                                {
		                                $row_s[$i++]= $row['sense_count'];		                             
		                                }
		                                 
					}					
				?>				
		</div>
		
                <div class="col-lg-3">
                    <div class="panel panel-default ">
                        <div class="panel-body alert-info">
                            <div class="col-xs-3">
                                <i class="fa fa-eye fa-4x"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                                <p id="act_sense" class="alerts-heading"></p>
                                <p class="alerts-text">Active Sensors</p>
                            </div>
                        </div>
                    </div>
                </div>
                  <script "text/javascript">
		var sense_count = <?php echo json_encode($row_s); ?>;						
		document.getElementById("act_sense").innerHTML =  "&nbsp;&nbsp;" + sense_count;
		</script> 
		<div>
                            	<?php 
					ini_set('display_errors', 1);									
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
						$query = "SELECT count(TYPE) as warehouse_count FROM STORE_DB where TYPE='Main';";
						    $result1 = $conn->query($query);
		                                  		                                
						 $row_s = array();  
						   $i=0;
			                        while($row = $result1->fetch_assoc())
		                                {
		                                $row_s[$i++]= $row['warehouse_count'];		                             
		                                }
		                                 
					}					
				?>				
		</div>
		
                <div class="col-lg-3">
                    <div class="panel panel-default ">
                        <div class="panel-body alert-info">
                            <div class="col-xs-3">
                                <i class="fa fa-bank fa-4x"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                                <p id="warehouse_count" class="alerts-heading"></p>
                                <p class="alerts-text">Warehouses</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <script "text/javascript">
		var warehouse_count = <?php echo json_encode($row_s); ?>;						
		document.getElementById("warehouse_count").innerHTML =  "&nbsp;&nbsp;" + warehouse_count;
		</script> 
		<div>
                            	<?php 
					ini_set('display_errors', 1);									
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
						$query = "SELECT count(TYPE) as warehouse_count FROM STORE_DB where TYPE='Store';";
						    $result1 = $conn->query($query);
		                                  		                                
						 $row_s = array();  
						   $i=0;
			                        while($row = $result1->fetch_assoc())
		                                {
		                                $row_s[$i++]= $row['warehouse_count'];		                             
		                                }
		                                 
					}					
				?>				
		</div>
                <div class="col-lg-3">
                    <div class="panel panel-default ">
                        <div class="panel-body alert-info">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-4x"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                                <p id ="stores_count" class="alerts-heading"></p>
                                <p class="alerts-text">Total Stores</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script "text/javascript">
		var stores_count = <?php echo json_encode($row_s); ?>;						
		document.getElementById("stores_count").innerHTML =  "&nbsp;&nbsp;" + stores_count;
		</script> 

            <div class="row">                            
                <div class="col-lg-12">
                    <div class="panel panel-primary">                       
                        <div class="panel-heading">  
                                <h3 class="panel-title"><i class="fa fa-location-arrow"> Locations</i></h3>                         	                       
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
						$query = "SELECT DISTINCT TRUCK_ID FROM SENSOR_DATA where TYPE=2";
						$query1 = "SELECT LAT_LONG FROM STORE_DB where TYPE = 'Main'";
						$query2 = "SELECT LAT_LONG FROM STORE_DB where TYPE = 'Store'";
						$query3 = "SELECT DISTINCT DESTINATION_LOCATION FROM TRUCK_INFO";
						$query_trucks = "SELECT CURRENT_LOCATION FROM TRUCK_INFO";
						$table = "SELECT SENSOR_ID,SENSOR_NODE_ID,SENSOR_CONTROL_NODE_ID,TRUCK_ID,TYPE,SENSOR_DATA FROM SENSOR_DATA order by TIME_STAMP DESC LIMIT 50000";	
											
		                                $result = $conn->query($query);		                                
						 $rows = array();  
						   $i=0;
			                         while($row = $result->fetch_assoc())
		                                {
		                                $rows[$i++] = $row['TRUCK_ID'];		                             
		                                }
		
						$rows1 = array();
						$i = 0;
		                                foreach($rows as $row)
		                                {		                                    
				                    $query = "SELECT SENSOR_DATA FROM SENSOR_DATA where TYPE=2 and TRUCK_ID='" .$row. "'ORDER BY TIME_STAMP DESC LIMIT 1";
				                    
		                                    $result1 = $conn->query($query);
		                                    $row1 = $result1->fetch_assoc();
		                                    
		                                        $rows1[$i++] = $row1['SENSOR_DATA'];		                                   
		                                }    
		                                $result1 = $conn->query($query2);
		                                $rows2 = array();
		                                $i=0;
		                                while($row = $result1->fetch_assoc())
		                                {
		                                $rows2[$i++] = $row['LAT_LONG'];		                                		                             
		                                } 
		                                
		                                $result2 = $conn->query($query3);
		                                $rows3 = array();
		                                $i=0;
		                                while($row = $result2->fetch_assoc())
		                                {
		                                //$rows3[$i++] = $row['LATITUDE'] .",". $row['LONGITUDE'];
		                                $rows3[$i++] = $row['DESTINATION_LOCATION'];		                                		                             
		                                }
		                                
		                                
		                                $result_trucks = $conn->query($query_trucks);
		                                $rows_trucks = array();
		                                $i_trucks=0;
		                                while($row = $result_trucks->fetch_assoc())
		                                {		                                
		                                $rows_trucks[$i_trucks++] = $row['CURRENT_LOCATION'];		                                		                             
		                                }
		                                
		                                $result_table = $conn->query($table);
		                                $rows_table = array();
		                                $i_table=0;
		                                while($row = $result_table->fetch_assoc())
		                                {		                                
		                                $rows_table[$i_table++] = $row;			                                                               		                             
		                                } 
		                               
					}					
							   
				?>
                       		</div>                                               
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
                	
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-truck"></i> Sensor Data</h3>
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
                          <div class="dropdown" class="col-lg-4">
			    
			    <select class="btn btn-primary dropdown-toggle" id="selected">			
			    <option selected="selected">DA-MI-OA-3324-55</option>
			    <option>GR-CO-OS-1234-01</option>
			    <option>GR-VG-LO-8823-56</option>
			</select>
			
			  </div>
			  			  
                       
                      
			 
			</div>

                        </div>
                        
                      
                        <div class="panel-body">
                            <div>
                            	<?php 
					ini_set('display_errors', 1);									
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
					
						$query_mat1_de = "SELECT DEMAND FROM SOP_Data where MARA_MATNR = 'DA-MI-OA-3324-55'";
						$query_mat1_nd = "SELECT NEW_DEMAND FROM SOP_Data where MARA_MATNR = 'DA-MI-OA-3324-55'";
						
						$query_mat2_de = "SELECT DEMAND FROM SOP_Data where MARA_MATNR = 'GR-CO-OS-1234-01'";
						$query_mat2_nd = "SELECT NEW_DEMAND FROM SOP_Data where MARA_MATNR = 'GR-CO-OS-1234-01'";
						
						$query_mat3_de = "SELECT DEMAND FROM SOP_Data where MARA_MATNR = 'GR-VG-LO-8823-56'";
						$query_mat3_nd = "SELECT NEW_DEMAND FROM SOP_Data where MARA_MATNR = 'GR-VG-LO-8823-56'";						
						
						
						$result_d = $conn->query($query_mat1_de);		                                  		                                
						 $row_mat1_de = array();  
						   $i=0;						 
			                        while($row = $result_d->fetch_assoc())
		                                {
		                                $row_mat1_de[$i++]= $row['DEMAND'];	                          		                             
		                                }
		                                
		                                $result_nd = $conn->query($query_mat1_nd);		                                  		                                
						 $row_mat1_nd = array();  
						   $j=0;
						  
			                        while($row = $result_nd->fetch_assoc())
		                                {		                           
		                                $row_mat1_nd[$j++]=$row['NEW_DEMAND'];		                             
		                                }
		                                
		                                $result_d = $conn->query($query_mat2_de);		                                  		                                
						 $row_mat2_de = array();  
						   $i=0;						 
			                        while($row = $result_d->fetch_assoc())
		                                {
		                                $row_mat2_de[$i++]= $row['DEMAND'];	                          		                             
		                                }
		                                
		                                $result_nd = $conn->query($query_mat2_nd);		                                  		                                
						 $row_mat2_nd = array();  
						   $j=0;
						  
			                        while($row = $result_nd->fetch_assoc())
		                                {		                           
		                                $row_mat2_nd[$j++]=$row['NEW_DEMAND'];		                             
		                                }
		                                
		                                $result_d = $conn->query($query_mat3_de);		                                  		                                
						 $row_mat3_de = array();  
						   $i=0;						 
			                        while($row = $result_d->fetch_assoc())
		                                {
		                                $row_mat3_de[$i++]= $row['DEMAND'];	                          		                             
		                                }
		                                
		                                $result_nd = $conn->query($query_mat3_nd);		                                  		                                
						 $row_mat3_nd = array();  
						   $j=0;
						  
			                        while($row = $result_nd->fetch_assoc())
		                                {		                           
		                                $row_mat3_nd[$j++]=$row['NEW_DEMAND'];		                             
		                                }
		                                
		                           	
		                                                              		                                 
					}					
				?>
                            </div>
                            <div id="shieldui-chart3"></div>
                        </div>
                    </div>
                </div>
            
            
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-truck"></i> Sensor Controller</h3>
                        </div>
                        <div class="panel-body">
                         <div>
                            	<?php 
					ini_set('display_errors', 1);									
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
					
						$query = "SELECT SENSOR_STATUS.SENSOR_ID, SENSOR_NODE_ID,SENSOR_CONTROL_NODE_ID,TRUCK_ID,TYPE,SENSOR_STATUS FROM SENSOR_DATA,SENSOR_STATUS where SENSOR_DATA.SENSOR_ID = SENSOR_STATUS.SENSOR_ID GROUP BY SENSOR_ID ";
						$result = $conn->query($query);		                                  		                                
						 $row_control = array();  
						   $i=0;						 
			                        while($row = $result->fetch_assoc())
		                                {
		                                $row_control[$i++]= $row;	                          		                             
		                                }
                            		                                 
					}					
				?>
                            </div>
                            <div id="sensor_controller_grid"></div>
                        </div>
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
    $fp = fopen('control.js','w+');
    fclose($fp);
     $fp = fopen('control.js','w');
    fwrite($fp,"var control = ");
    fclose($fp);
    $fp = fopen('control.js', 'a');
    fwrite($fp, json_encode($row_control));
    fclose($fp);
   
?>



/*
            $("#sensor_controller_grid").shieldGrid({
                dataSource: {
                    data: empdata
                },
                sorting: {
                    multiple: true                   
                },
                paging: {
                    pageSize: 7,
                    pageLinksCount: 4
                },
                selection: {
                    type: "row",
                    multiple: true,
                    toggle: false
                },
                columns: [
                    { field: "SENSOR_ID", width: "40px", title: "SENSOR_ID" },
                    { field: "SENSOR_NODE_ID", title: "SENSOR_NODE_ID", width: "50px" },
                    { field: "SENSOR_CONTROL_NODE_ID", title: "SENSOR_CONTROL_NODE_ID",width: "75px" },
                    { field: "TRUCK_ID", title: "TRUCK_ID", width: "35px" },
                    { field: "TYPE",title: "TYPE", width: "20px"},
                    { field: "SENSOR_DATA", title: "SENSOR_DATA", width: "100px" },                   
                    {
                    width: 30,
                    title: " ",
                    buttons: [
                        { commandName: "Turn OFF", caption: "TURN OFF" },                       
                    ]
                }
                    
                ]
            }); */
            
            

            
             $("#sensor_controller_grid").shieldGrid({
            
    dataSource: {
     data: control,
    
      schema: {
        fields: {
          SENSOR_ID: {
            path: "SENSOR_ID",
            type: String
          },
          SENSOR_NODE_ID: {
            path: "SENSOR_NODE_ID",
            type: String
          },
          SENSOR_CONTROL_NODE_ID: {
            path: "SENSOR_CONTROL_NODE_ID",
            type: String
          },
          TRUCK_ID: {
            path: "TRUCK_ID",
            type: String
          },
          TYPE: {
            path: "TYPE",
            type: Number
          },
          SENSOR_STATUS: {
            path: "SENSOR_STATUS",
            type: Boolean
          }
        }
      }
    },
        sorting: {
                    multiple: true                   
                },
                paging: {
                    pageSize: 7,
                    pageLinksCount: 4
                },
                selection: {
                    type: "row",
                    multiple: true,
                    toggle: false
                },
    rowHover: false,
    columns: [{
      field: "SENSOR_ID",
      title: "SENSOR_ID",
      width: "40px"
    }, {
      field: "SENSOR_NODE_ID",
      title: "SENSOR_NODE_ID",
      width: "50px"
    }, {
      field: "SENSOR_CONTROL_NODE_ID",
      title: "SENSOR_CONTROL_NODE_ID",
      width: "75px"
    }, {
      field: "TRUCK_ID",
      title: "TRUCK_ID",
      width: "35px"
    }, 
    {
      field: "TYPE",
      title: "TYPE",
      width: "20px"
    },
    {
      field: "SENSOR_STATUS",
      title: "SENSOR_STATUS",
      width: "20px"
    }
     
    ],
   
    selection:{
                type: "cell",
                multiple: false,
                toggle: true
            },
     events: {
                selectionChanged:    function onSelectedChanged(e) {
                
          var grid = $("#sensor_controller_grid").swidget();
	      alert("Edit event is fired" + "//" + grid.toString());
		     $.ajax({
                                type: "POST",
                                url: "statusChange.php",
                                //data: 'SENSOR_ID=' + 
                                success : function(response){}
                               
                            });
  
    }
         
            },
     editing: {
                enabled: true,
                event: "click",
                type: "cell",
                confirmation: {
                    "edit": {
                        enabled: true,
                        template: function (item) {
                            return "Delete row with ID = " + item.Id
                        }
                    }
                }
            },
              
            
});

 


  //Code to Display Bar Charts
		var mat1_de, mat1_nd;
		$(document).ready(function() {

		    $('.dropdown-toggle').on('change', function(){
		    var selected = $(this).find("option:selected").val();
		  		    
		    if(selected == "DA-MI-OA-3324-55")
		    {
		    	mat1_de = <?php echo json_encode($row_mat1_de); ?>;
	  		 mat1_nd = <?php echo json_encode($row_mat1_nd); ?>;
		    }
		    else if(selected == "GR-CO-OS-1234-01" )
		    {
		    	 mat1_de = <?php echo json_encode($row_mat2_de); ?>;
	  		 mat1_nd = <?php echo json_encode($row_mat2_nd); ?>;
		    }
		    else if(selected == "GR-VG-LO-8823-56")
		    {
		    	 mat1_de = <?php echo json_encode($row_mat3_de); ?>;
	  		 mat1_nd = <?php echo json_encode($row_mat3_nd); ?>;
		    }
		    
		    // var mat1_de = <?php echo json_encode($row_mat1_de); ?>;
	  	 //var mat1_nd = <?php echo json_encode($row_mat1_nd); ?>;
	  		  	 	  	
	  	 
	  	 for(var i=0;i<mat1_de.length;i++)
	  	 {
	  	 	mat1_de[i] = parseInt(mat1_de[i]);
	  	 }
	  	 
	  	 for(var i=0;i<mat1_nd.length;i++)
	  	 {
	  	 	mat1_nd[i] = parseInt(mat1_nd[i]);
	  	 }
	  	 
	  	$("#shieldui-chart3").shieldChart({
                theme: "light",
                primaryHeader: {
                    text: "Demand Change Statistics"
                },
                exportOptions: {
                    image: false,
                    print: false
                },
                axisX: {
                    categoricalValues: ["Mid West", "North East", "South", "West"]
                },
                axisY: {
                    title: {
                        text: "Demand Value"
                    }
                },
                dataSeries: [{
                    seriesType: "bar",
                    collectionAlias: "Demand",
                    data: [mat1_de[0],mat1_de[1],mat1_de[2],mat1_de[3]]
                 }, {
                    seriesType: "bar",
                    collectionAlias: "New Demand",
                    data: [mat1_nd[0],mat1_nd[1],mat1_nd[2],mat1_nd[3]]
                    }
                    ]
                  
            });
	});
        
 });
          
	    <?php
    //write to json file
    $fp = fopen('empdata.js','w+');
    fclose($fp);
     $fp = fopen('empdata.js','w');
    fwrite($fp,"var empdata = ");
    fclose($fp);
    $fp = fopen('empdata.js', 'a');
    fwrite($fp, json_encode($rows_table));
    fclose($fp);
   
?>




            $("#shieldui-grid1").shieldGrid({
                dataSource: {
                    data: empdata
                },
                sorting: {
                    multiple: true                   
                },
                paging: {
                    pageSize: 7,
                    pageLinksCount: 4
                },
                selection: {
                    type: "row",
                    multiple: true,
                    toggle: false
                },
                columns: [
                    { field: "SENSOR_ID", width: "40px", title: "SENSOR_ID" },
                    { field: "SENSOR_NODE_ID", title: "SENSOR_NODE_ID", width: "50px" },
                    { field: "SENSOR_CONTROL_NODE_ID", title: "SENSOR_CONTROL_NODE_ID",width: "75px" },
                    { field: "TRUCK_ID", title: "TRUCK_ID", width: "35px" },
                    { field: "TYPE",title: "TYPE", width: "20px"},
                    { field: "SENSOR_DATA", title: "SENSOR_DATA", width: "100px" }
                ]
            });
        });

			
       
	
	  var stores = <?php echo json_encode($rows2); ?>;
	  var main = stores.toString().split(",");
	  
	  var locations= <?php echo json_encode($rows3); ?>;
	var loc = locations.toString().split(",");
	
	var trucks= <?php echo json_encode($rows_trucks); ?>;
	var truck = trucks.toString().split(",");	
	
		
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: new google.maps.LatLng(37.548270, -121.988572),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker,truckMarker,mainMarker,storeMarker, i,j,k;

    for (i = 0; i < loc.length; i+=2) {    
      marker = new google.maps.Marker({      
        position: new google.maps.LatLng(loc[i], loc[i+1]),
        //animation:google.maps.Animation.BOUNCE,
        icon: 'images/warehouses.png',	
        map: map         
      });
      }    
      
	  
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function(){	  	
         	 infowindow.open(map, marker);               
          }
        
      })(marker, i));
      
       for (i = 0; i < truck.length; i+=2) {    
      	truckMarker = new google.maps.Marker({      
        position: new google.maps.LatLng(truck[i], truck[i+1]),
        //animation:google.maps.Animation.BOUNCE,
        icon: 'images/truck.png',
        map: map         
      });
      }    
      
	  
      google.maps.event.addListener(truckMarker, 'click', (function(truckMarker, i) {
            return function(){	  	
         	 infowindow.open(map, truckMarker);               
          }
        
      })(marker, i));
	
	for (j = 0; j < main.length; j+=2) {  
	  mainMarker = new google.maps.Marker({
	  position: new google.maps.LatLng(main[j], main[j+1]),
	  map: map,
	  icon: 'images/stores.png'	
      });
      } 
      /*
      for (k = 0; k < store.length; k++) {  
	  storeMarker = new google.maps.Marker({
	  position: new google.maps.LatLng(store[k][0], store[k][1]),
	  map: map,
	  icon: 'images/stores.png'	
      });
      }*/
      
	
      
     google.maps.event.addListener(mainMarker, 'click', (function(mainMarker, j) {
        return function() {
     
          infowindow.open(map, mainMarker);         
        }
      })(mainMarker, j)); 
      
    /*  google.maps.event.addListener(storeMarker,'click',(function(storeMarker,k){
      	return function(){
      		infowindow.open(map,storeMarker);
      	}
      	})(storeMarker,k));*/
      

	
    
    </script>
</body>
</html>