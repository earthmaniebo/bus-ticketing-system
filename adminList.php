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
				display: inline;			
			}
		</style>
	</head>
	<body>
		<center>
			<?php
				//connection details
				session_start();
				require_once('connection.php');
				if(isset($_SESSION['adminUsername']))
				{
									
					echo "<h2>Admin List</h2>";
					include_once('navAdmin.php');
					echo "<a href='addAdmin.php'><input type='button' value='Add Admin'></a>";	
					echo "<table border='1px'><tr>
						<th>Admin ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email Address</th>
						<th>Username</th>
						<!-- <th>Reservation</th> -->
						<th>Action</th>	
					</tr>";
					
					//sql query to produced the desired result 
					$result = mysql_query("SELECT * FROM admin WHERE admin.isDeleted='no'");
					
					//iteration for the table	
					while($row = mysql_fetch_array($result))
					{
						$adminID = $row['AdminID'];
						$firstName = $row['FirstName'];
						$lastName = $row['LastName'];
						$emailAdd = $row['EmailAdd'];
						$userName = $row['UserName'];
						
						echo "<tr>";
						echo "<td>" . " " . $row['AdminID'] . " " . "</td>" . " " ."<td>" . $row['FirstName'] . "</td>" . "<td>" . $row
						['LastName'] . "</td>" . "<td>" . $row['EmailAdd'] . "<td>" . 
						$row['UserName'] . "</td>" . /*"<td><form action='reserve.php' method='post'>
						<input type='hidden' name='busNo' value='$busNo'>
						<input type='hidden' name='destination' value='$destination'>
						<input type='hidden' name='dateOfTrip' value='$dateOfTrip'>
						<input type='hidden' name='departureTime' value='$departureTime'>
						<input type='hidden' name='fee' value='$fee'><input type='submit' value='Add a Reservation'></form></td>" .*/ 
						"<td> <form action='editAdmin.php' method='post' id='btnBuy'>
						<input type='hidden' name='adminID' value='$adminID'>
						<input type='hidden' name='firstName' value='$firstName'>
						<input type='hidden' name='lastName' value='$lastName'>
						<input type='hidden' name='emailAdd' value='$emailAdd'>
						<input type='hidden' name='userName' value='$userName'>
						<input type='submit' value='Edit'></form>
						<form action='deleteAdmin.php' method='post' id='btnBuy'>
						<input type='hidden' name='adminID' value='$adminID'>
						<input type='hidden' name='firstName' value='$firstName'>
						<input type='hidden' name='lastName' value='$lastName'>
						<input type='hidden' name='emailAdd' value='$emailAdd'>
						<input type='hidden' name='userName' value='$userName'>
						<input type='submit' value='Delete'></form>							
						
						</td>";
						echo "</tr>";
					}
					mysql_close($con);
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