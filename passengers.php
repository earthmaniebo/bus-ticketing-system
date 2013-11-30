<html>
	<head>
		<title>Passenger List</title>
	</head>
	<body>
	<center>
	
		<?php
			session_start();
			require_once('connection.php');
			if (isset($_SESSION['adminUsername'])) 
			{
	  			if(isset($_POST['passengers']))
	  			{	
	  				
	  				$BusID = $_REQUEST["busID"];
					$SchedID = $_REQUEST["schedID"];
					$BusNo = $_REQUEST["busNo"];
					$Destination = $_REQUEST["destination"];
					$DateOfTrip = $_REQUEST["dateOfTrip"];
					$DepartureTime = $_REQUEST["departureTime"];
					$Fee = $_REQUEST["fee"];
					
					include_once('navAdmin.php');
					echo "<br><h3>Bus number: " . $BusNo . " | Destination: " . $Destination . "</h3>";
	  				echo "<table border='1px'><tr>
	  						<th>Ticket No.</th>
							<th>First Name</th>
							<th>Last Name</th>
						</tr>";
					
	  				$result = mysql_query("SELECT customers.CustomerID, customers.FirstName, customers.LastName, transactions.TransactionID, transactions.SchedID, transactions.BusID FROM transactions, customers	 WHERE transactions.SchedID = '$SchedID' AND transactions.BusID ='$BusID' AND transactions.CustomerID = customers.CustomerID");
					
					while($row = mysql_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>". " " . $row['TransactionID'] . " " . "</td><td>" . $row['FirstName']  . " " ."</td><td>" . $row['LastName'] . "</td></tr>";
					}					
					echo "</table>";
					mysql_close();	
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