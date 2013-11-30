<html>
	<head>
		<title>Delete Bus</title>
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
				include_once('navAdmin.php');
				$FirstName = $_SESSION['AdminFirstName'];
				$LastName = $_SESSION['AdminLastName'];
				$BusID = $_REQUEST["busID"];
				$sql1 = "UPDATE buses SET buses.isDeleted='yes' WHERE buses.BusID = '$BusID'";
				$test1 = mysql_query($sql1);
				
				if($test1)
				{
					echo "<br><br><br><br><br><br><br><br><br><br>";
					echo "<h1>Bus successfully deleted.</h1>";
					$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, 					transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Delete Bus', Now(), '$FirstName', 						null, '$LastName')";
					$test3 = mysql_query($sql3);
				}
					
				else 
				{
					echo "ERROR";
				}
				
				mysql_close();
			}
		?>
		</center>
	</body>
</html>