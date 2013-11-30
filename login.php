<html>
	<head>
		<title>Customer's Login</title>
	</head>
	
	<body>
		<script type="text/javascript" >
			function InputVal() 
			{
				var uName = document.getElementById('userName');
				var password = document.getElementById('password');
				
				if(uName.value == "" || password.value == "") {
					alert("Please fill in all the required fields.");
					return false;
				}
			}
			function submitNow() 
			{
				form1.submit();
			}
		</script>
		<?php
			session_start();
			require_once('connection.php');
			if (isset($_SESSION['username'])) 
			{
	      	header('Location: index.php');
			}
			
			else if (isset($_SESSION['adminUsername'])) 
			{
	      	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><center>You are logged in as admin.<br>";
	      	echo "<a href='index.php'><input type='button' value='Go to Homepage'></a></center>";
			}
			
			else if(isset($_POST['guestBuy'])) 
			{	
				echo "<center>";
				echo "<br><br><br><br><br><br><br><br><br>";
				echo "<h2>Customer's Login</h2>";
				echo "<form action='login.php' method='post' name='form1'>";
				$slot = $_REQUEST["availableSlot"];
				echo "<input type='hidden' name='availableSlot'" . "value='" . $slot . "' readonly='readonly'>";
				echo "<input type='hidden' name='busID'" . "value='" . $_REQUEST["busID"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='schedID'" . "value='" . $_REQUEST["schedID"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='busNo'" . "value='" . $_REQUEST["busNo"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='destination'" . "value='" . $_REQUEST["destination"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='dateOfTrip'" . "value='" . $_REQUEST["dateOfTrip"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='departureTime'" . "value='" . $_REQUEST["departureTime"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='fee'" . "value='" . $_REQUEST["fee"] . "' readonly='readonly'>";
				echo "<table>";
				echo "<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName'></td></tr>";
				echo "<tr><td><label>Password:</label></td><td><input type='password' name='password' id='password'></td></tr>";
				echo "<tr><td>&nbsp;</td><td align='right'><input type='submit' value='Login' name='login2' onclick='return InputVal()'></td></tr>";
				echo "</table>";
				echo "</form>";
				echo "<p>Doesn't have an account yet? <a href='register.php'><input type='button' value='Register now!'></a></p>";
				echo "</center>";
			}			
			
			else if(isset($_POST['login2']))
			{
				$login = mysql_query("SELECT * FROM customers WHERE (customers.UserName = '" . mysql_real_escape_string($_POST['userName']) . "') and (Password = '" . mysql_real_escape_string(md5($_POST['password'])) . "')");
			

				while($row = mysql_fetch_array($login))
				{
					if(mysql_real_escape_string(md5($_POST['password'])) == $row['Password'])
					{
						
						$testLogin = true;
						$_SESSION['username'] = $row['UserName'];
						$_SESSION['FirstName'] = $row['FirstName'];
						$_SESSION['MiddleName'] = $row['MiddleName'];
						$_SESSION['LastName'] = $row['LastName'];
						$_SESSION['Sex'] = $row['Sex'];
						$_SESSION['Address'] = $row['Address'];
						$_SESSION['ContactNo'] = $row['ContactNo'];
						$_SESSION['EmailAdd'] = $row['EmailAdd'];
						$_SESSION['CustomerID'] = $row['CustomerID'];
						$slot = $_REQUEST["availableSlot"];
			  			echo "<form action='buy.php' method='post' name='form1'>";
			  			echo "<input type='hidden' name='availableSlot'" . "value='" . $slot . "' readonly='readonly'>";
						echo "<input type='hidden' name='busID'" . "value='" . $_REQUEST["busID"] . "' readonly='readonly'>";
						echo "<input type='hidden' name='schedID'" . "value='" . $_REQUEST["schedID"] . "' readonly='readonly'>";
						echo "<input type='hidden' name='busNo'" . "value='" . $_REQUEST["busNo"] . "' readonly='readonly'>";
						echo "<input type='hidden' name='destination'" . "value='" . $_REQUEST["destination"] . "' readonly='readonly'>";
						echo "<input type='hidden' name='dateOfTrip'" . "value='" . $_REQUEST["dateOfTrip"] . "' readonly='readonly'>";
						echo "<input type='hidden' name='departureTime'" . "value='" . $_REQUEST["departureTime"] . "' readonly='readonly'>";
						echo "<input type='hidden' name='fee'" . "value='" . $_REQUEST["fee"] . "' readonly='readonly'>";		
						echo "<script type='text/javascript'> form1.submit();</script>";
						//header('Location: buy.php');
					}
				}
				
				if($testLogin == false)
				{
					echo "<center>";
				echo "<br><br><br><br><br><br><br><br><br>";
				echo "<h2>Customer's Login</h2>";
				echo "<form action='login.php' method='post' name='form1'>";
				$slot = $_REQUEST["availableSlot"];
				echo "<input type='hidden' name='availableSlot'" . "value='" . $slot . "' readonly='readonly'>";
				echo "<input type='hidden' name='busID'" . "value='" . $_REQUEST["busID"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='schedID'" . "value='" . $_REQUEST["schedID"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='busNo'" . "value='" . $_REQUEST["busNo"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='destination'" . "value='" . $_REQUEST["destination"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='dateOfTrip'" . "value='" . $_REQUEST["dateOfTrip"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='departureTime'" . "value='" . $_REQUEST["departureTime"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='fee'" . "value='" . $_REQUEST["fee"] . "' readonly='readonly'>";
				echo "<table>";
				echo "<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName'></td></tr>";
				echo "<tr><td><label>Password:</label></td><td><input type='password' name='password' id='password'></td></tr>";
				echo "<tr><td>&nbsp;</td><td align='right'><input type='submit' value='Login' name='login2' onclick='return InputVal()'></td></tr>";
				echo "</table>";
				echo "</form>";
				echo "<p>Doesn't have an account yet? <a href='register.php'><input type='button' value='Register now!'></a></p>";
				echo "<h4 style='color: red;'>Wrong username or password</h4>";
				echo "</center>";
				}
				mysql_close();
			}	
			
			else if(isset($_POST['login'])) 
			{
				require_once('connection.php');				
				
				$login = mysql_query("SELECT * FROM customers WHERE (customers.UserName = '" . mysql_real_escape_string($_POST['userName']) . "') and (Password = '" . mysql_real_escape_string(md5($_POST['password'])) . "')");
				
				while($row = mysql_fetch_array($login))
				{
					if(mysql_real_escape_string(md5($_POST['password'])) == $row['Password'])
					{
						echo "<h1>Login Successful! </h1>";
						$testLogin = true;
						$_SESSION['username'] = $row['UserName'];
						$_SESSION['FirstName'] = $row['FirstName'];
						$_SESSION['MiddleName'] = $row['MiddleName'];
						$_SESSION['LastName'] = $row['LastName'];
						$_SESSION['Sex'] = $row['Sex'];
						$_SESSION['Address'] = $row['Address'];
						$_SESSION['ContactNo'] = $row['ContactNo'];
						$_SESSION['EmailAdd'] = $row['EmailAdd'];
						$_SESSION['CustomerID'] = $row['CustomerID'];
						header('Location: index.php');
					}
				}
				
				if($testLogin == false)
				{
					echo "<center>
					<br><br><br><br><br><br><br><br><br>
					<h2>Customer's Login</h2>
					<form action='login.php' method='post' name='form1'>
						<table>
						<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName'></td></tr>
						<tr><td><label>Password:</label></td><td><input type='password' name='password' id='password'></td></tr>
						<tr><td>&nbsp;</td><td align='right'><input type='submit' value='Login' name='login' onclick='return InputVal()'></td></tr>
						</table>
					</form>
					<p>Doesn't have an account yet? <a href='register.php'><input type='button' value='Register now!'></a></p>
					<h4 style='color: red;'>Wrong username or password</h4>
					</center>";	
				}
				
			}
			
			else 
			{
				echo "<center>
					<br><br><br><br><br><br><br><br><br>
					<h2>Customer's Login</h2>
					<form action='login.php' method='post' name='form1'>
						<table>
						<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName'></td></tr>
						<tr><td><label>Password:</label></td><td><input type='password' name='password' id='password'></td></tr>
						<tr><td>&nbsp;</td><td align='right'><input type='submit' value='Login' name='login' onclick='return InputVal()'></td></tr>
						</table>
					</form>
					<p>Doesn't have an account yet? <a href='register.php'><input type='button' value='Register now!'></a></p>
					</center>";	
			}
		?>
	</body>
</html>