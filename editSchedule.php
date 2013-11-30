<html>
	<head>
		<title>Edit Schedule</title>
	</head>
	
	<body>
		<script type="text/javascript" >
			function InputVal() 
			{
				var dateOfTrip = document.getElementById('dateOfTrip');
				var departureTime = document.getElementById('departureTime');
				
				if(dateOfTrip.value == "" || departureTime.value == "") {
					alert("Please fill in all the required fields.");
					return false;
				}
			}
		</script>
		<center>
			<?php
			session_start();
			require_once('connection.php');
			if(!isset($_SESSION['adminUsername'])) 
			{
				echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
				echo "<center><h2>You don't have permission to access this page.<h2>";
				echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";		
			}	
			
			else
			{	
				include_once('navAdmin.php');
				if(isset($_POST['edit']))
				{
					$RouteID = $_REQUEST["routeID"];
					$SchedID = $_REQUEST["schedID"];
					$BusID = $_REQUEST["busID"];
					$DateOfTrip = $_REQUEST["DateOfTrip"];
					$DepartureTime = $_REQUEST["DepartureTime"];
					$FirstName = $_SESSION['AdminFirstName'];
					$LastName = $_SESSION['AdminLastName'];
					
					$sql1 = "UPDATE buses SET buses.RouteID='$RouteID' WHERE buses.BusID = '$BusID'";
					$test = mysql_query($sql1);
					
					if($test)
					{
						$sql2 = "UPDATE schedules SET schedules.BusID='$BusID', schedules.DateOfTrip='$DateOfTrip', schedules.DepartureTime='$DepartureTime' WHERE schedules.SchedID='$SchedID'";		
						$test2 = mysql_query($sql2);
						if($test2) 
						{
							echo "<br><br><br><br><br><br><br><br><br><br><h1>Schedule was successfully edited!</h1>";
							$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, 					transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Edit Schedule', Now(), '$FirstName', 						null, '$LastName')";
							$test3 = mysql_query($sql3);
						}
					}
					
					else
					{
						echo "Error";	
					}
		      		mysql_close();		
				}
				
				else 
				{
					//sql query to produced the desired result 
					$routeID = $_REQUEST['routeID'];
					$busID = $_REQUEST['busID'];
					$schedID = $_REQUEST['schedID'];
					$busNo = $_REQUEST['busNo'];
					$dateOfTrip = $_REQUEST['dateOfTrip'];
					$departureTime = $_REQUEST['departureTime'];
					$fee = $_REQUEST['fee'];
					
					$result1 = mysql_query("SELECT * FROM routes ORDER BY routes.Destination ASC");
					$result2 = mysql_query("SELECT * FROM buses WHERE buses.RouteID IS NULL ORDER BY buses.BusNo");
						
					echo "<br><br><br><br><br><br><br><h2>Edit schedule</h2>";
					
					echo "<table>";
					echo "<tr><td><form action='editSchedule.php' method='post' name='form1'><input type='hidden' name='schedID' value='" . $schedID . "'></td></tr>";
					echo "<tr><td>Bus Number:</td> <td><select name='busID'>";
					while($row2 = mysql_fetch_array($result2))
					{
						$BusID = $row2['BusID'];
						$BusNo = $row2['BusNo'];
						$PlateNumber = $row2['PlateNumber'];
						
						echo "<option value='" . $BusID . "'>" . $BusNo . "</option>";
					}
					
					echo "<tr><td>Destination:</td> <td><select name='routeID'>";
					while($row1 = mysql_fetch_array($result1))
					{
						$RouteID = $row1['RouteID'];
						$Destination = $row1['Destination'];
						$Fee = $row1['Fee'];
						
						echo "<option value='" . $RouteID . "'>" . $Destination . "</option>";
					}
					echo "</select></td></tr>";

					echo "</select></td></tr>";
					echo "<tr><td>Date of Trip:</td> <td><input type='date' name='DateOfTrip' id='dateOfTrip' value='" . $dateOfTrip . "'></td></tr>";
					
					echo "<tr><td>Departure Time:</td> <td><input type='text' name='DepartureTime' id='departureTime' placeholder='HH:MM:SS' value='" . $departureTime . "'></td></tr>";
					echo "<tr><td>&nbsp;</td><td align='right'><input type='submit' name='edit' value='Edit Schedule' onClick='return InputVal()'></form></td></tr></table>";
				}
			}
			?>
		</center>
	</body>
</html>