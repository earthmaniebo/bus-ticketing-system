<html>
	<head>
		<title>Customer's Registration</title>
	</head>
	
	<body>
		<script type="text/javascript" >
			function InputVal() 
			{
				var fName = document.getElementById('firstName');
				var mName = document.getElementById('middleName');
				var lName = document.getElementById('lastName');
				var sex = document.getElementById('sex');
				var address = document.getElementById('address');
				var contactNo = document.getElementById('contactNo');
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
				var result3 = patt.test(mName.value);
				
				if(result1 || result2 || result3)
				{
					alert("Invalid characters! Numbers and specials characters are not allowed in names");
					return false;
				}
				
				if(password.value != cfnPassword.value)
				{
					alert("Password did not match!");
					return false;				
				}
				
				else if(fName.value == "" || lName.value == "" || address.value == "" || contactNo.value == "" || emailAdd.value == "" || uName.value == "" || password.value == "" || cfnPassword.value == "") {
					alert("Please fill in all the required fields.");
					return false;
				}
			}
		</script>
		<center>
		<br>
		<?php
			session_start();
			require_once('connection.php');
			if(isset($_SESSION['adminUsername']))
			{
				echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
				echo "<center><h2>You don't have permission to access this page.<h2>";
				echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";
			}
			
			else if(isset($_SESSION['username'])) 
			{
				echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
				echo "<center><h2>You don't have permission to access this page.<h2>";
				echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";
			}			
			else 
			{
				if(isset($_POST['register'])) 
				{
					$FirstName = $_REQUEST["firstName"];
					$MiddleName = $_REQUEST["middleName"];
					$LastName = $_REQUEST["lastName"];
					$Sex = $_REQUEST["sex"];
					$Address = $_REQUEST["address"];
					$ContactNo = $_REQUEST["contactNo"];	
					$EmailAdd = $_REQUEST["emailAdd"];
					$UserName = mysql_real_escape_string($_REQUEST["userName"]);
					$Password = mysql_real_escape_string($_REQUEST["password"]);
					$EncryptedPass = md5($Password);
					
					$sql = "INSERT INTO customers (customers.FirstName, customers.MiddleName, customers.LastName, customers.Sex, customers.Address, customers.ContactNo, customers.EmailAdd, customers.UserName, customers.Password) VALUES('$FirstName', '$MiddleName', '$LastName', '$Sex', '$Address', '$ContactNo', '$EmailAdd', '$UserName', '$EncryptedPass')";
					
					$test = mysql_query($sql);
					
					if($test)
					{
						echo "<h4>Your registration was successful!</h4>";
						$to = $EmailAdd; 
						$subject = "From: Mishkanet Transit"; 
						$email = "admin@mishkanetworks.com" ; 
						$message = "'Your registration was successful. Thank you for pratronizing Mishkanet Transit\n Here is your login details:\n Username: $UserName \n Password: $Password"; 
						$headers = "From: $email"; 
						$sent = mail($to, $subject, $message, $headers) ; 
						if($sent) 
						{echo "<h4>Please check your email for the login details.</h4>"; }
						else 
						{print "We encountered an error sending your mail"; }			
					}
						
					else 
					{
						echo "<h1>ERROR</h1>";
					}
					mysql_close();
				}
				
				else 
				{
					echo "
						<h2>Customer's Registration</h2>
						<form action='register.php' method='post' name='form1'>
							<table>
							<tr><td><label>First name:</label></td><td><input type='text' name='firstName' id='firstName'></td></tr>
							<tr><td><label>Middle name:</label></td><td><input type='text' name='middleName' id='middleName'></td></tr>
							<tr><td><label>Last name:</label></td><td><input type='text' name='lastName' id='lastName'></td></tr>
							<tr><td><label>Sex:</label></td><td><input type='radio' name='sex' value='Male' CHECKED>Male&nbsp;&nbsp;<input type='radio' name='sex' value='Female'>Female</td></tr>
							<tr><td><label>Address:</label></td><td><input type='text' name='address' id='address'></td></tr>
							<tr><td><label>Contact Number:</label></td><td><input type='text' name='contactNo' id='contactNo'></td></tr>
							<tr><td><label>Email Address:</label></td><td><input type='email' name='emailAdd' id='emailAdd'></td></tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName'></td></tr>
							<tr><td><label>Password:</label></td><td><input type='password' name='password' id='password'></td></tr>
							<tr><td><label>Confirm Password:</label></td><td><input type='password' name='cnfPassword' id='cnfPassword'></td></tr>
							<tr><td>&nbsp;</td><td align='right'><input type='submit' name='register' value='Register' onclick=' return InputVal();'></td></tr>
							</table>
						</form>
						<p>Already have an account? <a href='login.php'><input type='button' value='Login now!'></a></p>					
					
					";				
				}			
			}
		?>
		</center>
		
	</body>
</html>