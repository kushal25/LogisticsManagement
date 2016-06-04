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
					
						//$query = "update SENSOR_STATUS set SENSOR_STATUS = 1 where SENSOR_ID = 'SID_10015201'";
						$query = "update SENSOR_STATUS set SENSOR_STATUS=" . $_POST['SENSOR_STATUS'] . " WHERE SENSOR_ID='" . $_POST['SENSOR_ID'] . "'";
						echo $query;
						$result = $conn->query($query);		                                  		                                
						$row_control = array();  
						$i=0;						 
			                        while($row = $result->fetch_assoc())
		                                {
		                                	$row_control[$i++]= $row;	                          		                             
		                                }
                            		                                 
					}					
				?>





