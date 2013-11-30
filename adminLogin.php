<html>
	<head>
		<title>Admin's Login</title>
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
		</script>
		<?php
			session_start();
			require_once('connection.php');
			if (isset($_SESSION['adminUsername'])) 
			{
	      	header('Location: index.php');
			}
			
			else if(isset($_POST['adminLogin']))
			{
				$login = mysql_query("SELECT * FROM admin WHERE (admin.UserName = '" . mysql_real_escape_string($_POST['userName']) . "') and (Password = '" . mysql_real_escape_string(md5($_POST['password'])) . "')");
			

				while($row = mysql_fetch_array($login))
				{
					if(mysql_real_escape_string(md5($_POST['password'])) == $row['Password'])
					{
						echo "<h1>Login Successful! </h1>";
						$testLogin = true;
						$_SESSION['adminUsername'] = $row['UserName'];
						$_SESSION['AdminFirstName'] = $row['FirstName'];
						$_SESSION['AdminLastName'] = $row['LastName'];
						$_SESSION['AdminEmailAdd'] = $row['EmailAdd'];
						$_SESSION['AdminID'] = $row['AdminID'];
						header('Location: index.php');
					}
				}
				
				if($testLogin == false)
				{
					echo "<center>
					<br><br><br><br><br><br><br><br><br>
					<h2>Admin's Login</h2>
					<form action='adminLogin.php' method='post' name='form1'>
						<table>
						<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName'></td></tr>
						<tr><td><label>Password:</label></td><td><input type='password' name='password' id='password'></td></tr>
						<tr><td>&nbsp;</td><td align='right'><input type='submit' name='adminLogin' value='Login' onclick='return InputVal()'></td></tr>
						</table>
					</form>
					<h4 style='color:red;'>Wrong username or password</h4>
					</center>";	
				}
				mysql_close();	
			}
			
			else 
			{
				echo "<center>
					<br><br><br><br><br><br><br><br><br>
					<h2>Admin's Login</h2>
					<form action='adminLogin.php' method='post' name='form1'>
						<table>
						<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName'></td></tr>
						<tr><td><label>Password:</label></td><td><input type='password' name='password' id='password'></td></tr>
						<tr><td>&nbsp;</td><td align='right'><input type='submit' name='adminLogin' value='Login' onclick='return InputVal()'></td></tr>
						</table>
					</form>
					</center>";	
			}
		?>
	</body>
</html>