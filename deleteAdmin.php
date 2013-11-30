<html>
	<head>
		<title>Delete Admin</title>
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
				$AdminID = $_REQUEST["adminID"];
				$sql1 = "UPDATE admin SET admin.isDeleted='yes' WHERE admin.AdminID = '$AdminID'";
				$test1 = mysql_query($sql1);
				
				if($test1)
				{
					echo "<br><br><br><br><br><br><br><br><br><br>";
					echo "<h1>Admin successfully deleted.</h1>";
					$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, 					transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Delete Admin', Now(), '$FirstName', 						null, '$LastName')";
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