<html>
	<head>
		<title>Admin List</title>
		<style type="text/css">
			table td
			{
				padding-left: 50px;
				padding-right: 50px;
				text-align: center;
			}
			
			#btnBuy
			{
				margin-bottom: 1px;				
			}
			
		</style>
	</head>
	<body>
		<center>
		<h2>Customer List</h2>
			<?php
					//connection details
					session_start();
					require_once('connection.php');
					if (isset($_SESSION['username'])) 
					{
						echo "You can't access this page.";
					}
					
					else if(isset($_SESSION['adminUsername']))
					{					
						echo "<table border='1px'><tr>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last Name</th>
							<th>Contact Number</th>
							<th>Email Address</th>
							<th>Username</th>
							<!-- <th>Reservation</th> -->
							<th>Action</th>	
						</tr>";
						
						//sql query to produced the desired result 
						$result = mysql_query("SELECT * FROM mishkanettransit.customers");
						
						//iteration for the table	
						while($row = mysql_fetch_array($result))
						{
							$customerID = $row['CustomerID'];
							$firstName = $row['FirstName'];
							$middleName = $row['MiddleName'];
							$lastName = $row['LastName'];
							$contactNo = $row['ContactNo'];
							$emailAdd = $row['EmailAdd'];
							$userName = $row['UserName'];
							
							echo "<tr>";
							echo "<td>" . " " . $row['FirstName'] . " " . "</td>" . " " ."<td>" . $row['MiddleName'] . "</td>" . "<td>" . $row
							['LastName'] . "</td>" . "<td>" . $row['ContactNo'] . "<td>" . 
							$row['EmailAdd'] . "</td>" . "<td>" . $row['UserName'] . "</td>" . /*"<td><form action='reserve.php' method='post'>
							<input type='hidden' name='busNo' value='$busNo'>
							<input type='hidden' name='destination' value='$destination'>
							<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
							<input type='hidden' name='departureTime' value='$departureTime'>
							<input type='hidden' name='fee' value='$fee'><input type='submit' value='Add a Reservation'></form></td>" .*/ 
							"<td> 
							<form action='deleteCustomer.php' method='post' id='btnBuy'>
							<input type='hidden' name='customerID' value='$customerID'>
							<input type='hidden' name='firstName' value='$firstName'>
							<input type='hidden' name='lastName' value='$lastName'>
							<input type='hidden' name='emailAdd' value='$emailAdd'>
							<input type='hidden' name='userName' value='$userName'>
							<input type='submit' value='Delete'></form>							
							
							</td>";
							echo "</tr>";
						}
						echo "</table>";
						echo "<h2>You are currently logged in as" . " " . $_SESSION['adminUsername'] . "<h2>";
						echo "<a href='index.php'><input type='button' value='Home'/></a>";
			      	echo "<a href='logout.php'><input type='button' value='Logout' /></a>";
						mysql_close($con);
					}
					
					else
					{
						echo "Access Denied.";
					}
				?>
		</center>
	</body>
</html>