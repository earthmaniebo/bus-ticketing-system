<?php	
	$hostname = "mysql17.000webhost.com";
	$username = "a4361616_earth";
	$password = "qwerty123";
	$testLogin = false;
	
	//connection to the database
	$con = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");								
	
	//selects the database a4361616_bus	
	mysql_select_db("a4361616_bus", $con);
?>