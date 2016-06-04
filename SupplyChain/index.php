<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quick Reaction</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />
    
     <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/shieldui-all.min.css" />  
        <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" /> 
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://pruthvi-nadunooru.name/QuickReaction/SupplyChain/empdata.js"></script>
     <script type="text/javascript" src="http://pruthvi-nadunooru.name/QuickReaction/SupplyChain/control.js"></script>
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
                    <li><a href="truck_monitoring.php"><i class="fa fa-truck"></i> Truck Monitoring</a></li>
                    <li><a href="payment.php"><i class="fa fa-money"></i> Payment</a></li>
                    <li><a href="material_tracking.php"><i class="fa fa-globe"></i> Material Tracking</a></li>
                    <li><a href="alerts.php"><i class="fa fa-life-ring"></i> Alerts</a></li>
                    <li><a href="planning_data_research.php"><i class="fa fa-book"></i> Planning Data Research</a></li>
                    <                   
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
						$query = "SELECT count(*) as sense_count FROM SENSOR_STATUS WHERE SENSOR_STATUS=1";
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
                        <div class="panel-heading" display="inline-block">
                            <h3 class="panel-title"><i class="fa fa-truck"></i> Sensor Data</h3>
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
						
						$table = "SELECT SENSOR_ID,SENSOR_NODE_ID,SENSOR_CONTROL_NODE_ID,TRUCK_ID,t.TYPE_NAME,SENSOR_DATA,TIME_STAMP FROM SENSOR_DATA AS m, SENSOR_TYPES AS t where t.TYPE=m.TYPE order by TIME_STAMP DESC LIMIT 50000";	
											
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
                            <div id="shieldui-grid1"><meta http-equiv="refresh" content="10"></div>
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
			    <option>Select Material</option>			
			    <option>DA-MI-OA-3324-55</option>
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
					
						$query = "SELECT SENSOR_STATUS.SENSOR_ID, SENSOR_NODE_ID,SENSOR_CONTROL_NODE_ID,TRUCK_ID,t.TYPE_NAME, SENSOR_STATUS FROM SENSOR_DATA AS m,SENSOR_STATUS,SENSOR_TYPES AS t where t.TYPE=m.TYPE AND m.SENSOR_ID = SENSOR_STATUS.SENSOR_ID GROUP BY SENSOR_ID";
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
                          <aside>
			    <p style="text-align: center;"><b>Control Sensor Status</b></p>
			    
			    <label for="SENSOR_ID">Sensor Id</label>
			    <input id="SENSOR_ID" type="text">
			    <br><br>
			    <label for="SENSOR_NODE_ID">Node Id</label>
			    <input id="SENSOR_NODE_ID" type="text">
			    <br><br>
			    <label for="SENSOR_CONTROL_NODE_ID">Control Node Id</label>
			    <input id="SENSOR_CONTROL_NODE_ID" type="text">
			    <br><br>
			    <label for="TRUCK_ID">Truck Id</label>
			    <input id="TRUCK_ID" type="text">
			    <br><br>
			    <label for="TYPE_NAME">Type</label>
			    <input id="TYPE_NAME" type="text">
			    <br><br>
			    <label for="SENSOR_STATUS">Status</label>
			    <input id="SENSOR_STATUS" type="checkbox">
			    <br>
			    <div style="text-align: center;">
			        <button id="save">
			        Save</button>
			    </div>
			</aside>
                            <div id="grid"></div>
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
	//echo $row_control;
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

$(document).ready(function () {
        $("#grid").shieldGrid({
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
	            path: "TYPE_NAME",
	            type: String
	          },
	          SENSOR_STATUS: {
	            path: "SENSOR_STATUS",
	            type: Boolean
	          }    
                    }
                }
            },
            selection:true,
            sorting: {
                    multiple: true                   
                },
                paging: {
                    pageSize: 7,
                    pageLinksCount: 4
                },
            rowHover: false,
            columns:  [{
      field: "SENSOR_ID",
      title: "Sensor Id",
      width: "40px"
    }, {
      field: "SENSOR_NODE_ID",
      title: "Sensor Node Id",
      width: "40px"
    }, {
      field: "SENSOR_CONTROL_NODE_ID",
      title: "Control Node Id",
      width: "50px"
    }, {
      field: "TRUCK_ID",
      title: "Truck Id",
      width: "35px"
    }, 
    {
      field: "TYPE",
      title: "Type",
      width: "40px"
    },
    {
      field: "SENSOR_STATUS",
      title: "Status",
      width: "30px"
    }
     
    ],
            events: {
                selectionChanged: function (e) {
                    var grid = $("#grid").swidget(),
                        index = grid.contentTable.find(".sui-selected").get(0).rowIndex,
                        item = grid.dataItem(index);
                    $("#SENSOR_ID").swidget().value(item.SENSOR_ID);
                    $("#SENSOR_NODE_ID").swidget().value(item.SENSOR_NODE_ID);
                    $("#SENSOR_CONTROL_NODE_ID").swidget().value(item.SENSOR_CONTROL_NODE_ID);
                    $("#TRUCK_ID").swidget().value(item.TRUCK_ID);
                    $("#TYPE_NAME").swidget().value(item.TYPE);
                    $("#SENSOR_STATUS").swidget().checked(item.SENSOR_STATUS);
                    
                    $("#SENSOR_ID").swidget().enabled(false);
                    $("#SENSOR_NODE_ID").swidget().enabled(false);
                    $("#SENSOR_CONTROL_NODE_ID").swidget().enabled(false);
                    $("#TRUCK_ID").swidget().enabled(false);
                    $("#TYPE_NAME").swidget().enabled(false);
                    $("#SENSOR_STATUS").swidget().enabled(true);
                    $("#save").swidget().enabled(true);
                    
                }
            }
        });
        $("#SENSOR_ID").shieldTextBox({
            enabled: false
        });
        $("#SENSOR_NODE_ID").shieldTextBox({
            enabled: false
        });
        $("#SENSOR_CONTROL_NODE_ID").shieldTextBox({
            enabled: false
        });
         $("#TRUCK_ID").shieldTextBox({
            enabled: false
        });
         $("#TYPE_NAME").shieldTextBox({
            enabled: false
        });
        $("#SENSOR_STATUS").shieldCheckBox({
            enabled: false
        });
        $("#save").shieldButton({
            enabled: false,
            events: {
                click: function (e) {
               
                    var grid = $("#grid").swidget(),
                        row = grid.contentTable.find(".sui-selected").get(0),
                        index = row.rowIndex,
                        editedItem = grid.dataSource.edit(index).data;
                    editedItem.SENSOR_ID = $("#SENSOR_ID").swidget().value();
                    editedItem.SENSOR_NODE_ID = $("#SENSOR_NODE_ID").swidget().value();
                    editedItem.SENSOR_CONTROL_NODE_ID = $("#SENSOR_CONTROL_NODE_ID").swidget().value();
                    editedItem.TRUCK_ID = $("#TRUCK_ID").swidget().value();
                    editedItem.TYPE = $("#TYPE_NAME").swidget().value();
                    editedItem.SENSOR_STATUS = $("#SENSOR_STATUS").swidget().checked();
                    
       
                     
                       $.ajax({
                                type: 'POST',
                                url: 'statusChange.php',
                                data: 'SENSOR_ID=' + editedItem.SENSOR_ID + '&SENSOR_STATUS=' + (editedItem.SENSOR_STATUS?1:0),
                                success: function(response){
                                	<!-- alert(response); -->
                                }
                                                                                                                            
				                               
                            });
                    grid.saveChanges();                    
                    grid.select("tr:eq(" + (index + 2) + ")");
                   
                }
            }
        });
    });

 


  //Code to Display Bar Charts
		var mat1_de, mat1_nd,selected;
		$(document).ready(function() {

		    $('.dropdown-toggle').on('change', function(){
		   
		     selected = $(this).find("option:selected").val();
		      
		  		    
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
                	title:{
                		text: "Regions in USA"
                		},
                    categoricalValues: ["Mid West", "North East", "South", "West"]
                },
                axisY: {
                    title: {
                        text: "Demand Value(in K)"
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
                    { field: "SENSOR_ID", width: "45px", title: "Sensor Id" },
                    { field: "SENSOR_NODE_ID", title: "Sensor Node Id", width: "45px" },
                    { field: "SENSOR_CONTROL_NODE_ID", title: "Control Node Id",width: "60px" },
                    { field: "TRUCK_ID", title: "Truck Id", width: "35px" },
                    { field: "TYPE_NAME",title: "Type", width: "60px"},
                    { field: "SENSOR_DATA", title: "Sensor Data", width: "80px" },
                    { field: "TIME_STAMP", title: "Timestamp", width: "80px" }
                ]
            });
        });

  
    </script>
    <style type="text/css">
   
    .sui-button-cell {
        text-align: center;
        background: #ffffff;
    }
    #grid {
        width: 67%;
        min-height: 229px;
    }
    aside {
        margin: 0;
        float: right;
        width: 30%;
        padding: 15px;
        background: #ffffff;
        border: 2px solid #dfdfdf;
        border-radius: 5px;
        overflow: auto;
        min-height: 180px;
    }
    .example-content input {
        margin-bottom: 10px;             
    }
    label {
        display: inline-block;
        width: 40%;      
       
    }    
    .sui-numeric-textbox{
    	border: 2px solid #000000;    	
    }
  
    .sui-checkbox {
        width: 10.7em;
        margin-bottom: 10px;  
        
    }
    
</style>
</body>
</html>