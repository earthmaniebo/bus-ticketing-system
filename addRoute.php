<html>
	<head>
		<title>Add New Route</title>
		<style type="text/css">
			table
			{
				
			}
		</style>
	</head>
	
	<body>
		<script type="text/javascript" >
			function InputVal() 
			{
				var destination = document.getElementById('destination');
				var fee = document.getElementById('fee');
				
				if(destination.value == "" || fee.value == "") {
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
				if(isset($_POST['addRoute']))
				{
					$FirstName = $_SESSION['AdminFirstName'];
					$LastName = $_SESSION['AdminLastName'];
					$Destination = $_REQUEST["destination"];				
					$Fee = $_REQUEST["fee"];			
					
					$sql = "INSERT INTO routes (routes.Destination, routes.Fee) VALUES ('$Destination', '$Fee')";		
					$test = mysql_query($sql);
					if($test) 
					{
						
						echo "<br><br><br><br><br><br><br><br><br><br><h2>Route was successfully added!</h2>";
						$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, 					transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Add Route', Now(), '$FirstName', 						null, '$LastName')";
						$test3 = mysql_query($sql3);
					}
					
					else
					{
						echo "Error";	
					}			
		      		mysql_close();
				}
				
				else 
				{
		  			echo "<br><br><br><br><br><br><br><br><br><br><h2>Add new route</h2>";
					echo "<table><form action='addRoute.php' method='post'>";
					echo "<tr><td>Destination:</td><td><input type='text' name='destination' id='destination'/></td></tr>";
					echo "<tr><td>Fee:</td><td><input type='text' name='fee' placeholder='0.00' id='fee'/></td></tr>";
					echo "<tr><td>&nbsp;</td><td align='right'><input type='submit' name='addRoute' value='Add Route' onclick='return InputVal()' /></td></tr>";
					echo "</form></table>";
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