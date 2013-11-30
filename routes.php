<html>
	<head>
		<title>Route Lists</title>
		<style type="text/css">
			table td
			{
				text-align: center;
				padding-left: 20px;
				padding-right: 20px;
			}
			.btnBuy
			{
				margin-bottom: 1px;	
				display: inline;			
			}
		</style>
	</head>
	<body>
		<center>
			<?php
				session_start();
				require_once('connection.php');
				if(isset($_SESSION['username']))
				{
					echo "<h2>Route Lists</h2>";
					include_once('navCustomer.php');
					echo "<table border='1px' align='center'>
						<tr>
							<th>Destination</th>
							<th>Fee</th>
						</tr>";
					$result = mysql_query("SELECT * FROM routes WHERE routes.isDeleted='no' ORDER BY Destination ");
						
					while($row = mysql_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $row['Destination'] . "</td>" . " " . "<td>" . $row['Fee'] . "</td>";							echo "</tr>";
					}
					echo "</table>";
					mysql_close();	
				}
				
				else if(isset($_SESSION['adminUsername'])) 
				{
					echo "<h2>Route Lists</h2>";
					include_once('navAdmin.php');
					echo "<a href='addRoute.php'><input type='button' value='Add Route'></a>";
					echo "<table border='1px' align='center'>
						<tr>
							<th>Route ID</th>
							<th>Destination</th>
							<th>Fee</th>
							<th>Action</th>
						</tr>";
				
					$result = mysql_query("SELECT * FROM routes WHERE routes.isDeleted='no' ORDER BY Destination");
						
					while($row = mysql_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $row['RouteID'] . "</td>" . " " . "<td>" . $row['Destination'] . "</td>" . " " . "<td>" . $row['Fee'] . "</td>";				
						
						echo "<td>";
						echo "<form action='editRoute.php' method='post' class='btnBuy'>";
						echo "<input type='hidden' name='routeID' value='" . $row['RouteID'] . "'>";
						echo "<input type='hidden' name='destination' value='" . $row['Destination'] . "'>";
						echo "<input type='hidden' name='fee' value='" . $row['Fee'] . "'>";
						echo "<input type='submit' value='Edit'>";
						echo "</form>";
						
						echo "<form action='deleteRoute.php' method='post' class='btnBuy'>";
						echo "<input type='hidden' name='routeID' value='" . $row['RouteID'] . "'>";
						echo "<input type='hidden' name='destination' value='" . $row['Destination'] . "'>";
						echo "<input type='hidden' name='fee' value='" . $row['Fee'] . "'>";
						echo "<input type='submit' name='delete' value='Delete'>";
						echo "</form>";
						echo "</td>";
						
						
						echo "</tr>";
					}
					echo "</table>";
					mysql_close();					
				}
				
				else
				{
					echo "<table border='1px' align='center'>";
				
					$result = mysql_query("SELECT * FROM Routes WHERE routes.isDeleted='no'");
						
					while($row = mysql_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $row['RouteID'] . "</td>" . " " . "<td>" . $row['Destination'] . "</td>" . " " . "<td>" . $row['Fee'] . "</td>";							echo "</tr>";
					}
					echo "</table>";
			      	echo "<a href='index.php'><input type='button' value='Home' /></a>";
			      	echo "<a href='login.php'><input type='button' value='Login' /></a>";
					mysql_close();	
				}
			?>
		</center>
	</body>
	
</html>