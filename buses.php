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
				if(isset($_SESSION['username']))
				{
					echo "<h2>Bus Lists</h2>";
					include_once('navCustomer.php');
					echo "<table border='1px' align='center'>
					<tr>
						<th>Bus ID</th>
						<th>Bus Number</th>
						<th>Plate Number</th>
					</tr>";
					$result = mysql_query("SELECT * FROM buses WHERE buses.RouteID is null");
						
					while($row = mysql_fetch_array($result))
					{
						
						echo "<tr>";
						echo "<td>" . $row['BusID'] . "</td>" . " " . "<td>" . $row['BusNo'] . "</td>" . " " . "<td>" . $row['PlateNumber'] . "</td>";	
											
						echo "</tr>";
					}
					echo "</table>";
					mysql_close();	
				}
				
				else if(isset($_SESSION['adminUsername'])) 
				{					
					echo "<h2>Bus Lists</h2>";
					include_once('navAdmin.php');
					echo "<a href='addBus.php'><input type='button' value='Add Bus'></a>";
					echo "<table border='1px' align='center'>
					<tr>
						<th>Bus ID</th>
						<th>Bus Number</th>
						<th>Plate Number</th>
						<th>Action</th>
					</tr>";
				
					$result = mysql_query("SELECT * FROM buses WHERE buses.RouteID is null");
						
					while($row = mysql_fetch_array($result))
					{
						$busID = $row['BusID'];
						echo "<td>" . $row['BusID'] . "</td>" . " " . "<td>" . $row['BusNo'] . "</td>" . " " . "<td>" . $row['PlateNumber'] . "</td>";	
						echo "<td> <form action='deleteBus.php' method='post' id='btnBuy'>
								   <input type='hidden' name='busID' value='$busID'>
								   <input type='submit' name='delete' value='Delete Bus'></form>";
					
						echo "</tr>";
						
					}
					echo "</table>";
					mysql_close();					
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