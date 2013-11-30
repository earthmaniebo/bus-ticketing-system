<html>
	<head>
		<title>Add New Bus</title>
	</head>
	
	<body>
		<script type="text/javascript" >
			function InputVal() 
			{
				var busNo = document.getElementById('busNo');
				var plateNo = document.getElementById('plateNo');
				
				if(busNo.value == "" || plateNo.value == "") {
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
				if(isset($_POST['addBus']))
				{
					$FirstName = $_SESSION['AdminFirstName'];
					$LastName = $_SESSION['AdminLastName'];
					include_once('navAdmin.php');
					$BusNo = $_REQUEST["busNo"];				
					$PlateNumber = $_REQUEST["plateNo"];			
					
					$sql = "INSERT INTO buses (buses.BusNo, buses.RouteID, buses.PlateNumber) VALUES ('$BusNo', null, '$PlateNumber')";		
					$test = mysql_query($sql);
					if($test) 
					{
						echo "<br><br><br><br><br><br><br><br><br><br><h2>Bus was successfully added!</h2>";
						$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, 					transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Add Bus', Now(), '$FirstName', 						null, '$LastName')";
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
					include_once('navAdmin.php');
					echo "<br><br><br><br><br><br><br><br><br><br><h2>Add new bus</h2>";
					echo "<table><form action='addBus.php' method='post'>";
					echo "<tr><td>Bus Number:</td><td><input type='text' name='busNo' id='busNo'/></td></tr>";
					echo "<tr><td>Plate Number:</td><td><input type='text' name='plateNo' id='plateNo'/></td></tr>";
					echo "<tr><td>&nbsp;</td><td align='right'><input type='submit' name='addBus' value='Add Bus' onclick='return InputVal()' /></td></tr>";
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