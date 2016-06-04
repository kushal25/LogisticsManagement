<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Monitoring </title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />


    <style>
      #map {
        width: 1065px;
        height: 700px;
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
                    <li class="active"><a href="truck_monitoring.php"><i class="fa fa-truck"></i> Truck Monitoring</a></li>
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
                    <h1>Truck Monitoring</h1>
                    
                </div>
            </div>
            
            
            <div class="row">                            
                <div class="col-lg-12">
                    <div class="panel panel-primary">                       
                        <div class="panel-heading">  
                                <h3 class="panel-title"><i class="fa fa-location-arrow"> Truck Locations</i></h3>                         	                       
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
						
						$query1 = "SELECT LAT_LONG FROM STORE_DB where TYPE = 'Main'";
						$query2 = "SELECT LAT_LONG FROM STORE_DB where TYPE = 'Store'";
						$query3 = "SELECT DISTINCT DESTINATION_LOCATION FROM TRUCK_INFO";
						$query_trucks = "SELECT CURRENT_LOCATION FROM TRUCK_INFO";
						
											
		                                  
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
		                                
		                                
		                               
					}					
							   
				?>
                       		</div>                                               
                            <div id="map">                            	
                            </div>
                        </div>
                    </div>
                </div>
            
 
            
            
            
            
            
           
		
						
            

        </div> <!-- page wrapper -->
        </div> <!-- wrapper -->  
        
        
        <script type="text/javascript">
  

	
	  var stores = <?php echo json_encode($rows2); ?>;
	  var main = stores.toString().split(",");
	  
	  var locations= <?php echo json_encode($rows3); ?>;
	var loc = locations.toString().split(",");
	
	var trucks= <?php echo json_encode($rows_trucks); ?>;
	var truck = trucks.toString().split(",");	
	
		
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: new google.maps.LatLng(39.8097343, -98.55561990000001),
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
        animation:google.maps.Animation.BOUNCE,
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