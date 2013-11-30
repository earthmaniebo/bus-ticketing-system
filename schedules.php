<html>
	<head>
		<title>Schedule Lists</title>
		<style type="text/css">
			table td
			{
				padding-left: 35px;
				padding-right: 35px;
				text-align: center;
			}
			
			#btnBuy
			{
				margin-bottom: 1px;	
				display: inline;			
			}
			
		</style>
	</head>
	<body>
		<center>
		<h2>Schedule Lists</h2>
				<?php
					//connection details
					session_start();
					require_once('connection.php');
					if (isset($_SESSION['username'])) 
					{
						include_once('navCustomer.php');
						echo "<table border='1px'><tr>
							<th>Bus Number</th>
							<th>Destination</th>
							<th>Date of Trip</th>
							<th>Departure Time</th>
							<th>Available Seat</th>
							<th>Fee</th>	
							<!-- <th>Reservation</th> -->
							<th>Buy Ticket</th>	
						</tr>";
						
						$result = mysql_query("SELECT buses.BusID, schedules.SchedID, buses.BusNo, routes.Destination, schedules.DateOfTrip, schedules.DepartureTime, routes.Fee, schedules.AvailableSlot  FROM buses, routes, schedules WHERE buses.BusID = schedules.BusID AND buses.RouteID = routes.RouteID AND schedules.isDeleted='no'");
						
						//iteration for the table	
						while($row = mysql_fetch_array($result))
						{
							$busID = $row['BusID'];
							$schedID = $row['SchedID'];
							$busNo = $row['BusNo'];
							$destination = $row['Destination'];
							$dateOfTrip = $row['DateOfTrip'];
							$departureTime = $row['DepartureTime'];
							$fee = $row['Fee'];
							$availableSlot = $row['AvailableSlot'];
							
							echo "<tr>";
							echo "<td>" . " " . $row['BusNo'] . " " . "</td>" . " " ."<td>" . $row['Destination'] . "</td>" . "<td>" . $row
							['DateOfTrip'] . "</td>" . "<td>" . $row['DepartureTime'] . "<td>" . 
							$row['AvailableSlot'] . "</td>" . "<td>" . $row['Fee'] . "</td>" . /*"<td><form action='reserve.php' method='post'>
							<input type='hidden' name='busNo' value='$busNo'>
							<input type='hidden' name='destination' value='$destination'>
							<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
							<input type='hidden' name='departureTime' value='$departureTime'>
							<input type='hidden' name='fee' value='$fee'><input type='submit' value='Add a Reservation'></form></td>" .*/ 
							"<td> <form action='buy.php' method='post' id='btnBuy'>
							<input type='hidden' name='busID' value='$busID'>
							<input type='hidden' name='schedID' value='$schedID'>
							<input type='hidden' name='busNo' value='$busNo'>
							<input type='hidden' name='destination' value='$destination'>
							<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
							<input type='hidden' name='departureTime' value='$departureTime'>
							<input type='hidden' name='fee' value='$fee'>
							<input type='hidden' name='availableSlot' value='$availableSlot'>
							<input type='submit' value='Buy Now'></form></td>";
							echo "</tr>";
						}
						echo "</table>";
						mysql_close($con);
					}
					
					else if(isset($_SESSION['adminUsername']))
					{			
						include_once('navAdmin.php');
						echo "<a href='addSchedule.php'><input type='button' value='Add Schedule'></a>";	
						echo "<table border='1px'><tr>
							<th>Bus Number</th>
							<th>Destination</th>
							<th>Date of Trip</th>
							<th>Departure Time</th>
							<th>Available Seat</th>
							<th>Fee</th>	
							<!-- <th>Reservation</th> -->
							<th>Action</th>	
						</tr>";
						$result = mysql_query("SELECT routes.RouteID, buses.BusID, schedules.SchedID, buses.BusNo, routes.Destination, schedules.DateOfTrip, schedules.DepartureTime, routes.Fee, schedules.AvailableSlot  FROM buses, routes, schedules WHERE buses.BusID = schedules.BusID AND buses.RouteID = routes.RouteID AND schedules.isDeleted='no'");
						//iteration for the table	
						while($row = mysql_fetch_array($result))
						{
							$routeID = $row['RouteID'];
							$busID = $row['BusID'];
							$schedID = $row['SchedID'];
							$busNo = $row['BusNo'];
							$destination = $row['Destination'];
							$dateOfTrip = $row['DateOfTrip'];
							$departureTime = $row['DepartureTime'];
							$fee = $row['Fee'];
							$availableSlot = $row['AvailableSlot'];
							
							echo "<tr>";
							echo "<td>" . " " . $row['BusNo'] . " " . "</td>" . " " ."<td>" . $row['Destination'] . "</td>" . "<td>" . $row
							['DateOfTrip'] . "</td>" . "<td>" . $row['DepartureTime'] . "<td>" . 
							$row['AvailableSlot'] . "</td>" . "<td>" . $row['Fee'] . "</td>" . /*"<td><form action='reserve.php' method='post'>
							<input type='hidden' name='busNo' value='$busNo'>
							<input type='hidden' name='destination' value='$destination'>
							<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
							<input type='hidden' name='departureTime' value='$departureTime'>
							<input type='hidden' name='fee' value='$fee'><input type='submit' value='Add a Reservation'></form></td>" .*/ 
							"<td> 
							<form action='editSchedule.php' method='post' id='btnBuy'>
							<input type='hidden' name='routeID' value='$routeID'>
							<input type='hidden' name='busID' value='$busID'>
							<input type='hidden' name='schedID' value='$schedID'>
							<input type='hidden' name='busNo' value='$busNo'>
							<input type='hidden' name='destination' value='$destination'>
							<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
							<input type='hidden' name='departureTime' value='$departureTime'>
							<input type='hidden' name='fee' value='$fee'>
							<input type='hidden' name='availableSlot' value='$availableSlot'>
							<input type='submit' value='Edit'></form>						
							
							<form action='deleteSchedule.php' method='post' id='btnBuy'>
							<input type='hidden' name='routeID' value='$routeID'>
							<input type='hidden' name='busID' value='$busID'>
							<input type='hidden' name='schedID' value='$schedID'>
							<input type='hidden' name='busNo' value='$busNo'>
							<input type='hidden' name='destination' value='$destination'>
							<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
							<input type='hidden' name='departureTime' value='$departureTime'>
							<input type='hidden' name='fee' value='$fee'>
							<input type='hidden' name='availableSlot' value='$availableSlot'>
							<input type='submit' name='delete' value='Delete'></form>
							
							<form action='passengers.php' method='post' id='btnBuy'>
							<input type='hidden' name='routeID' value='$routeID'>
							<input type='hidden' name='busID' value='$busID'>
							<input type='hidden' name='schedID' value='$schedID'>
							<input type='hidden' name='busNo' value='$busNo'>
							<input type='hidden' name='destination' value='$destination'>
							<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
							<input type='hidden' name='departureTime' value='$departureTime'>
							<input type='hidden' name='fee' value='$fee'>
							<input type='hidden' name='availableSlot' value='$availableSlot'>
							<input type='submit' name='passengers' value='View Passengers'></form></td>";
							echo "</tr>";
						}
						echo "</table>";
						mysql_close($con);
					}
					
					else
					{
						echo "<a href='index.php'><input type='button' value='Home'/></a>";
			      		//echo "<a href='routes.php'><input type='button' value='View Routes' /></a>";
			      		echo "<a href='login.php'><input type='button' value='Login' /></a><br><br>";
						echo "<table border='1px'><tr>
							<th>Bus Number</th>
							<th>Destination</th>
							<th>Date of Trip</th>
							<th>Departure Time</th>
							<th>Available Seat</th>
							<th>Fee</th>	
							<!-- <th>Reservation</th> -->
							<th>Buy Ticket</th>	
						</tr>";
						
						//sql query to produced the desired result 
						$result = mysql_query("SELECT buses.BusID, schedules.SchedID, buses.BusNo, routes.Destination, schedules.DateOfTrip, schedules.DepartureTime, routes.Fee, schedules.AvailableSlot  FROM buses, routes, schedules WHERE buses.BusID = schedules.BusID AND buses.RouteID = routes.RouteID AND schedules.isDeleted='no'");
						
						//iteration for the table	
						while($row = mysql_fetch_array($result))
						{
							$busID = $row['BusID'];
							$schedID = $row['SchedID'];
							$busNo = $row['BusNo'];
							$destination = $row['Destination'];
							$dateOfTrip = $row['DateOfTrip'];
							$departureTime = $row['DepartureTime'];
							$fee = $row['Fee'];
							$availableSlot = $row['AvailableSlot'];
							
							echo "<tr>";
							echo "<td>" . " " . $row['BusNo'] . " " . "</td>" . " " ."<td>" . $row['Destination'] . "</td>" . "<td>" . $row
							['DateOfTrip'] . "</td>" . "<td>" . $row['DepartureTime'] . "<td>" . 
							$row['AvailableSlot'] . "</td>" . "<td>" . $row['Fee'] . "</td>" . /*"<td><form action='reserve.php' method='post'>
							<input type='hidden' name='busNo' value='$busNo'>
							<input type='hidden' name='destination' value='$destination'>
							<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
							<input type='hidden' name='departureTime' value='$departureTime'>
							<input type='hidden' name='fee' value='$fee'><input type='submit' value='Add a Reservation'></form></td>" .*/ 
							"<td> <form action='buy.php' method='post' id='btnBuy'>
							<input type='hidden' name='busID' value='$busID'>
							<input type='hidden' name='schedID' value='$schedID'>
							<input type='hidden' name='busNo' value='$busNo'>
							<input type='hidden' name='destination' value='$destination'>
							<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
							<input type='hidden' name='departureTime' value='$departureTime'>
							<input type='hidden' name='fee' value='$fee'>
							<input type='hidden' name='availableSlot' value='$availableSlot'>
							<input type='submit' name='buyLogin' value='Buy Now'></form></td>";
							echo "</tr>";
						}
						echo "</table>";
						mysql_close($con);
					}
				?>
		</center>
	</body>	
</html>