<html>
	<head>
		<title>Add New Schedule</title>
		<style type="text/css">
			table
			{
				margin-top: -20px;
			}
		</style>
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
			if (isset($_SESSION['adminUsername'])) 
			{
				include_once('navAdmin.php');
	  			if(isset($_POST['addSched']))
				{
					$FirstName = $_SESSION['AdminFirstName'];
					$LastName = $_SESSION['AdminLastName'];
					$RouteID = $_REQUEST["RouteID"];				
					$BusID = $_REQUEST["BusID"];	
					$DateOfTrip = $_REQUEST["DateOfTrip"];
					$DepartureTime = $_REQUEST["DepartureTime"];			
					
					$sql1 = "UPDATE buses SET buses.RouteID='$RouteID' WHERE buses.BusID = '$BusID'";
					$test = mysql_query($sql1);
					
					if($test)
					{
						$sql2 = "INSERT INTO schedules (schedules.BusID, schedules.DateOfTrip, schedules.DepartureTime) VALUES ('$BusID', '$DateOfTrip', '$DepartureTime')";		
						$test2 = mysql_query($sql2);
						if($test2) 
						{
							echo "<br><br><br><br><br><br><br><br><br><br><h1>Schedule was successfully added!</h1>";
							$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, 					transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Add Schedule', Now(), '$FirstName', 						null, '$LastName')";
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
					$result1 = mysql_query("SELECT * FROM routes ORDER BY routes.Destination ASC");
					$result2 = mysql_query("SELECT * FROM buses WHERE buses.RouteID IS NULL ORDER BY buses.BusNo");
					
					echo "<br><br><br><br><br><br><br><h2>Add new schedule</h2>";
					
					echo "<table>";
					echo "<tr><td><form action='addSchedule.php' method='post' name='form1'></td></tr>";
					echo "<tr><td>Bus Number:</td> <td><select name='BusID'>";
					while($row2 = mysql_fetch_array($result2))
					{
						$BusID = $row2['BusID'];
						$BusNo = $row2['BusNo'];
						$PlateNumber = $row2['PlateNumber'];
						
						echo "<option value='" . $BusID . "'>" . $BusNo . "</option>";
					}
					
					echo "<tr><td>Destination:</td> <td><select name='RouteID'>";
					while($row1 = mysql_fetch_array($result1))
					{
						$RouteID = $row1['RouteID'];
						$Destination = $row1['Destination'];
						$Fee = $row1['Fee'];
						
						echo "<option value='" . $RouteID . "'>" . $Destination . "</option>";
					}
					echo "</select></td></tr>";
					
					
					echo "</select></td></tr>";
					echo "<tr><td>Date of Trip:</td> <td><input type='date' name='DateOfTrip' id='dateOfTrip'></td></tr>";
					echo "<tr><td>Departure Time:</td> <td><input type='text' name='DepartureTime' id='departureTime' placeholder='HH:MM:SS'></td></tr>";
					echo "<tr><td>&nbsp;</td><td align='right'><input type='submit' name='addSched' value='Add Schedule' onClick='return InputVal()'></form></td></tr></table>";
				}
			}
			
			else 
			{
				echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
				echo "<center><h2>You don't have permission to access this page.<h2>";
				echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";		
			}
		?>
		</center>
	</body>
</html>