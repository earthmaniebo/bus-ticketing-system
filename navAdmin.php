<?php
	echo "<center>";	
	echo "<h3>You are currently logged in as" . " " . $_SESSION['adminUsername'] . "<h3>";
	echo "<a href='index.php'><input type='button' value='Home' /></a>";
	echo "<a href='adminList.php'><input type='button' value='Admin List' /></a>";
	echo "<a href='schedules.php'><input type='button' value='Schedules' /></a>";
	echo "<a href='routes.php'><input type='button' value='Routes' /></a>";
	echo "<a href='buses.php'><input type='button' value='Buses' /></a>";
	echo "<a href='transactions.php'><input type='button' value='Transactions' /></a>";
	echo "<a href='historyLog.php'><input type='button' value='History Log' /></a>";
	echo "<a href='logout.php'><input type='button' value='Logout' /></a>";
	echo "</center>";
?>