<html>
	<head>
		<title>Deleting Customer..</title>
	</head>
	<body>
	<center>
	<br><br><br><br><br><br><br><br><br><br>
		<?php
			session_start();
			require_once('connection.php');
			if (!isset($_SESSION['adminUsername'])) 
			{
	  			echo "<p>You must be an admin to view this page.<br><br>";
	  			echo "<a href='adminLogin.php'><input type='button' value='Login as Admin' /></a>";
			}
			else 
			{	
				$CustomerID = $_REQUEST["customerID"];
				$sql1 = "DELETE FROM customers WHERE customers.CustomerID = '$CustomerID'";
				$test1 = mysql_query($sql1);
				
				if($test1)
				{
					echo "<h1>Customer successfully deleted.</h1>";
				}
					
				else 
				{
					echo "ERROR";
				}
				echo "<h2>You are currently logged in as" . " " . $_SESSION['adminUsername'] . "<h2>";
				echo "<a href='index.php'><input type='button' value='Home' /></a>";
	      	echo "<a href='schedules.php'><input type='button' value='View Schedules' /></a>";
	      	echo "<a href='adminRegister.php'><input type='button' value='Add New Admin' /></a>";
	      	//echo "<a href='routes.php'><input type='button' value='View Routes' /></a>";
	      	echo "<a href='logout.php'><input type='button' value='Logout' /></a>";
				mysql_close();
			}
		?>
		</center>
	</body>
</html>