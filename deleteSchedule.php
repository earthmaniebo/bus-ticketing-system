<html>
	<head>
		<title>Delete Schedule</title>
		<style type="text/css">
			table td
			{
				padding-left: 30px;
				padding-right: 30px;
			}
			
			#btnBuy
			{
				margin-bottom: 1px;				
			}
			
</style>
	</head>
	<body>
	<center>		
		<?php
			session_start();
			require_once('connection.php');
			if (!isset($_SESSION['adminUsername'])) 
			{
	  			echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
				echo "<center><h2>You don't have permission to access this page.<h2>";
				echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";
			}
			
			else if(isset($_SESSION['adminUsername'])) 
			{
				if(isset($_POST['delete']))
				{
					include_once('navAdmin.php');
					$FirstName = $_SESSION['AdminFirstName'];
					$LastName = $_SESSION['AdminLastName'];
					$SchedID = $_REQUEST["schedID"];
					$BusID = $_REQUEST["busID"];
					$RouteID = $_REQUEST["routeID"];
					$sql1 = "UPDATE schedules SET schedules.isDeleted='yes' WHERE schedules.SchedID = '$SchedID'";	
					$sql2 = "UPDATE buses SET buses.RouteID=null WHERE buses.RouteID = '$RouteID' AND buses.BusID = $BusID";	
					$test1 = mysql_query($sql1);
					$test2 = mysql_query($sql2);
					
					if($test1)
					{
						echo "<br><br><br><br><br><br><br><br><br><br>";
						echo "<h1>Schedule successfully deleted.</h1>";
						$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, 					transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Delete Schedule', Now(), '$FirstName', 						null, '$LastName')";
						$test3 = mysql_query($sql3);
					}
						
					else 
					{
						echo "ERROR";
					}
					mysql_close();
				}
				
				else 
				{
					echo "<h2>Delete this Schedule</h2>";
					include_once('navAdmin.php');
					$slot = $_REQUEST["availableSlot"];
					$updatedSlot = $slot - 1;
					echo "<form action='deleteSchedule.php' method='post' name='form1'>";
					echo "<br><br><br><br><h3>Trip Details</h3>";
					echo "<input type='hidden' name='routeID'" . "value='" . $_REQUEST["routeID"] . "' readonly='readonly'>";
					echo "<input type='hidden' name='availableSlot'" . "value='" . $updatedSlot . "' readonly='readonly'>";
					echo "<input type='hidden' name='busID'" . "value='" . $_REQUEST["busID"] . "' readonly='readonly'>";
					echo "<input type='hidden' name='schedID'" . "value='" . $_REQUEST["schedID"] . "' readonly='readonly'>";
					echo "<table><tr><td><strong>Bus Number</strong>:</td> <td><input type='text' name='busNo'" . "value='" . $_REQUEST["busNo"] . "' readonly='readonly'></td></tr>";
					echo "<tr><td><strong>Destination:</strong></td> <td><input type='text' name='destination'" . "value='" . $_REQUEST["destination"] . "' readonly='readonly'></td></tr>";
					echo "<tr><td><strong>Date of Trip:</strong></td> <td><input type='text' name='dateOfTrip'" . "value='" . $_REQUEST["dateOfTrip"] . "' readonly='readonly'></td></tr>";
					echo "<tr><td><strong>Departure Time:</strong></td> <td><input type='text' name='departureTime'" . "value='" . $_REQUEST["departureTime"] . "' readonly='readonly'></td></tr>";
					echo "<tr><td><strong>Fee:</strong></td> <td><input type='text' name='fee'" . "value='" . $_REQUEST["fee"] . "' readonly='readonly'></td></tr></table>";
					
					echo "<p>Are you sure you want to delete this schedule? All transactions under this schedule will be null and void.</p>";
					echo "<input type='submit' value='Delete' name='delete'> <a href='schedules.php'><input type='button' value='Cancel'></a>";
				}
			}
		?>
		</center>
	</body>
</html>