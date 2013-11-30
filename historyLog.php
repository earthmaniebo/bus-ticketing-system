<html>
	<head>
		<title>History Log</title>
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
			else 
			{
				echo "<h2>History Log</h2>";
				include_once('navAdmin.php');
				echo "<table border='1px' align='center'>
					<tr>
						<th>Transaction Type</th>
						<th>Transaction Date</th>
						<th>First Name</th>
						<th>Last Name</th>
					</tr>";
				$sql1 = "SELECT * FROM transrecords";
				$result = mysql_query($sql1);
				
				while($row = mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>" . $row['TransType'] . "</td>" . " " . "<td>" . $row['TransDate'] . "</td>" . " " . "<td>" . $row['FirstName'] . "</td><td>" . " " . $row['LastName'] . "</td>";	
											
						echo "</tr>";	
				}
				echo "</table>";
				mysql_close();
			}
		?>
		</center>
	</body>
</html>	