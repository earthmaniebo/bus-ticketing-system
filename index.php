<html>
	<head>
		<title>Mishkanet Transit</title>
	</head>
	<body>
		<center>
		<h1>Welcome To Mishkanet Transit Online Bus Ticketing System</h1>
		<?php
		session_start();
		if (isset($_SESSION['username'])) 
		{
      		include_once('navCustomer.php');
		}
		
		else if (isset($_SESSION['adminUsername'])) 
		{
      		include_once('navAdmin.php');
		}	
		else 
		{
			echo "<a href='register.php'><input type='button' value='Register' /></a>";
			echo "<a href='schedules.php'><input type='button' value='Schedules' /></a>";
			echo "<a href='login.php'><input type='button' value='Customer&rsquo;s Login' style='width:130px;'/></a>";
			echo "<a href='adminLogin.php'><input type='button' value='Admin Login' /></a>";
		}		
		?>
		<br><br><br><img src="bus.gif" alt="" height="400px" width="700px">
		</center>
	</body>
	
</html>