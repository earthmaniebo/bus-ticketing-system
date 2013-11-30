<html>
	<head>
		<title>Edit Route</title>
	</head>
	
	<body>
		<script type="text/javascript" >
			function InputVal() 
			{
				var destination = document.getElementById('firstName');
				var fee = document.getElementById('lastName');
				if(destination.value == "" || fee.value == "") {
					alert("Please fill in all the required fields.");
					return false;
				}
			}
		</script>
		<?php
		session_start();
		require_once('connection.php');
		if(!isset($_SESSION['adminUsername'])) 
		{
			echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
			echo "<center><h2>You don't have permission to access this page.<h2>";
			echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";		
		}	
		
		else
		{	
			include_once('navAdmin.php');
			if(isset($_POST['edit']))
			{
				$RouteID = $_REQUEST["routeID"];
				$Destination = $_REQUEST["destination"];
				$Fee = $_REQUEST["fee"];	
				$FirstName = $_SESSION['AdminFirstName'];
				$LastName = $_SESSION['AdminLastName'];
				
				$sql2 = "UPDATE routes SET routes.Destination = '$Destination', routes.Fee = '$Fee' WHERE routes.RouteID = '$RouteID'";
				$test2 = mysql_query($sql2);
				if($test2)
				{
					echo "<center><br><br><br><br><br><br><br><br><br><br><h2>Routes successfully edited.</h2></center>";
					$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Edit Route', Now(), '$FirstName', null, '$LastName')";
					$test3 = mysql_query($sql3);
				}
				mysql_close();		
			}
			
			else 
			{
				//sql query to produced the desired result 
				$routeID = $_REQUEST['routeID'];
				$destination = $_REQUEST['destination'];
				$fee = $_REQUEST['fee'];
				
				echo "<center>";
				echo	"<br><br><br><br><br><br><br>";
				echo	"<h2>Edit Route Details</h2>";
				echo	"<form action='editRoute.php' method='post' name='form1'>";
				echo	"<table>";
				echo  "<tr><td><input type='hidden' name='routeID' value='" . $routeID ."'></td></tr>";
				echo		"<tr><td><label>Destination:</label></td><td><input type='text' name='destination' id='firstName' value='" . $destination . "'></td></tr>";
				echo		"<tr><td><label>Fee:</label></td><td><input type='text' name='fee' id='lastName' value='". $fee . "'></td></tr>";
				echo		"<tr><td>&nbsp;</td><td align='right'><input type='submit' name='edit' value='Edit' onclick='return InputVal();'></td></tr>";
				echo		"</table>";
				echo "</form>";
			}
		}
		?>
		
	</body>
</html>