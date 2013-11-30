<html>
	<head>
		<title>Transaction Summary</title>
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
					echo "<h2>Today's Transaction Summary</h2>";
					include_once('navAdmin.php');
					echo "<table border='1px'><tr>
						<th>Transaction ID</th>
						<th>Customer ID</th>
						<th>Customer Name</th>
						<th>Bus Number</th>
						<th>Destination</th>
						<th>Date</th>
					</tr>";
					
					//sql query to produced the desired result 
					$result = mysql_query("SELECT transactions.TransactionID, customers.CustomerID, customers.FirstName, customers.MiddleName, customers.LastName, buses.BusNo, routes.Destination, transactions.TransactionDate FROM transactions, customers, buses, routes, schedules WHERE transactions.CustomerID = customers.CustomerID AND transactions.SchedID = schedules.SchedID AND schedules.BusID = buses.BusID AND buses.RouteID = routes.RouteID AND Date(transactions.TransactionDate) = Date(Now())");
					
					//iteration for the table	
					while($row = mysql_fetch_array($result))
					{
						$transID = $row['TransactionID'];
						$customerID = $row['CustomerID'];
						$fNAme = $row['FirstName'];
						$mNAme = $row['MiddleName'];
						$lNAme = $row['LastName'];
						$busNo = $row['BusNo'];
						$destination = $row['Destination'];
						$date = $row['TransactionDate'];
						
						echo "<tr>";
						echo "<td>" . " " . $row['TransactionID'] . " " . "</td>" . " " ."<td>" . $row['CustomerID'] . "</td>" . "<td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>" . "<td>" . $row['BusNo'] . "<td>" . 
						$row['Destination'] . "</td>" . "<td>" . $row['TransactionDate'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
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