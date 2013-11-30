<html>
	<head>
		<title>Add New Admin</title>
	</head>
	<body>
		<script type="text/javascript" >
			function InputVal() 
			{
				var fName = document.getElementById('firstName');
				var lName = document.getElementById('lastName');
				var emailAdd = document.getElementById('emailAdd');
				var uName = document.getElementById('userName');
				
				var password = document.getElementById('password');
				var cfnPassword = document.getElementById('cnfPassword');
				
				var passwordVal = password.value;
				var passwordLength = passwordVal.length;
				
				if(passwordLength < 6)
				{
					alert("Password must at least contains 6 characters");
					return false;
				}

				var uNameVal = uName.value;
				var uNameLength = uNameVal.length;
				
				if(uNameLength < 6)
				{
					alert("Username must at least contains 6 characters");
					return false;
				}

				var patt = /[^\w]|[0-9]/g;
				var result1 = patt.test(fName.value);
				var result2 = patt.test(lName.value);
				
				if(result1 || result2)
				{
					alert("Invalid characters! Numbers and specials characters are not allowed in names");
					return false;
				}				
				
				
				
				if(password.value != cfnPassword.value)
				{
					alert("Password did not match!");
					return false;		
				}
				
				else if(fName.value == "" || lName.value == "" || emailAdd.value == "" || uName.value == "" || password.value == "" || cfnPassword.value == "") {
					alert("Please fill in all the required fields.");
					return false;
				}
			}
		</script>
		<?php
		session_start();
		require_once('connection.php');
		if(isset($_SESSION['adminUsername'])) 
		{
			if(isset($_POST['add'])) 
			{
				$FirstName = $_REQUEST['firstName'];
				$LastName = $_REQUEST['lastName'];	
				
				$FirstName2 = $_SESSION['AdminFirstName'];
				$LastName2 = $_SESSION['AdminLastName'];
					
				$EmailAdd = $_REQUEST["emailAdd"];
				$UserName = mysql_real_escape_string($_REQUEST["userName"]);
				$Password = mysql_real_escape_string($_REQUEST["password"]);
				$EncryptedPass = md5($Password);
				
				$sql = "INSERT INTO admin (admin.FirstName, admin.LastName, admin.EmailAdd, admin.UserName, 					admin.Password) VALUES('$FirstName', '$LastName', '$EmailAdd', '$UserName', '$EncryptedPass')";
				
				$test = mysql_query($sql);
				
				if($test)
				{
					include_once('navAdmin.php');
					echo "<br><br><br><br><br><br><br><br><br><center><h1>Admin registration was successful!</h1>";
					$to = $EmailAdd; 
					$subject = "From: Mishkanet Transit"; 
					$email = "admin@mishkanetworks.com" ; 
					$message = "Your admin registration was successful. Thank you for pratronizing Mishkanet Transit\n Here is your login details:\n Username: $UserName \n Password: $Password"; 
					$headers = "From: $email"; 
					$sent = mail($to, $subject, $message, $headers) ; 
					if($sent) 
					{print "Please check the entered email for the login details."; }
					else 
					{print "We encountered an error sending your mail"; }
						
			      	
			      	$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, 					transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Add Admin', Now(), '$FirstName2', 						null, '$LastName2')";
					$test3 = mysql_query($sql3);
				}
				
				else 
				{
					echo "<center><h1>ERROR</h1></center>";
				}
				mysql_close();
			}
			
			else 
			{
				include_once('navAdmin.php');
				echo "<center>
				<br><br><br><br><br><br>
				<h2>Add a new Admin</h2>
				<form action='addAdmin.php' method='post' name='form1'>
					<table>
					<tr><td><label>First name:</label></td><td><input type='text' name='firstName' id='firstName'></td></tr>
					<tr><td><label>Last name:</label></td><td><input type='text' name='lastName' id='lastName'></td></tr>
					<tr><td><label>Email Address:</label></td><td><input type='email' name='emailAdd' id='emailAdd'></td></tr>
					<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName'></td></tr>
					<tr><td><label>Password:</label></td><td><input type='password' name='password' id='password'></td></tr>
					<tr><td><label>Confirm Password:</label></td><td><input type='password' name='cnfPassword' id='cnfPassword'></td></tr>
					<tr><td>&nbsp;</td><td align='right'><input type='submit' name='add' value='Register' onclick='return InputVal();'d></td></tr>
					</table>
				</form>
				
			";	
			}
		}
		
		else 
		{
			echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
			echo "<center><h2>You don't have permission to access this page.<h2>";
			echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";	
		}
		?>
	</body>
</html>