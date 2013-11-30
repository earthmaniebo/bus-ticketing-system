<html>
	<head>
		<title>Edit Personal Details</title>
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
				
				var oldPassword = document.getElementById('oldPassword');
				var newPassword = document.getElementById('newPassword');
				var cfnPassword = document.getElementById('cnfPassword');
				
				var passwordVal = newPassword.value;
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
				
				if(newPassword.value != cfnPassword.value)
				{
					alert("Password did not match!");	
					return false;			
				}
				
				else if(fName.value == "" || lName.value == "" || address.value == "" || contactNo.value == "" || emailAdd.value == "" || uName.value == "" || oldPassword.value == "" || newPassword.value == "" || cfnPassword.value == "") {
					alert("Please fill in all the required fields.");
					return false;
				}
			}
		</script>
		<?php
		session_start();
		require_once('connection.php');
		if(!isset($_SESSION['username']))
		{
			echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
			echo "<center><h2>You don't have permission to access this page.<h2>";
			echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";		
		}
		
		else 
		{
			include_once('navCustomer.php');
			if(isset($_POST['edit']))
			{
				$CustomerID = $_REQUEST['customerID'];
				$FirstName = $_REQUEST["firstName"];
				$MiddleName = $_REQUEST["middleName"];
				$LastName = $_REQUEST["lastName"];
				$ContactNo = $_REQUEST["contactNo"];	
				$Address = $_REQUEST["address"];	
				$EmailAdd = $_REQUEST["emailAdd"];
				$UserName = mysql_real_escape_string($_REQUEST["userName"]);
				$OldPassword = mysql_real_escape_string($_REQUEST["oldPassword"]);
				$Password = mysql_real_escape_string($_REQUEST["newPassword"]);
				$OldEncryptedPass = md5($OldPassword);
				$EncryptedPass = md5($Password);
				
				$sql1 = "SELECT * FROM customers WHERE customers.CustomerID = '$CustomerID'";
				
				$test1 = mysql_query($sql1);
				
				while($row = mysql_fetch_array($test1))
				{
					$customerID = $row['CustomerID'];
					$password = $row['Password'];
					
					if($OldEncryptedPass == $password)
					{
						$sql2 = "UPDATE customers SET customers.FirstName = '$FirstName', customers.MiddleName = '$MiddleName', customers.LastName = '$LastName', customers.Address = '$Address', customers.ContactNo = '$ContactNo', customers.EmailAdd = '$EmailAdd', customers.UserName = '$UserName', customers.Password = '$EncryptedPass' WHERE customers.CustomerID = '$CustomerID'";
						$test2 = mysql_query($sql2);
						if($test2)
						{
							echo "<center><br><br><br><br><br><br><br><br><br><br><br><h1>Your personal details was successfully edited.</h1>";					
							$sql4 = "SELECT * FROM customers WHERE customers.CustomerID = '$CustomerID'";
							$test4 = mysql_query($sql4);
							$to = $EmailAdd; 
							$subject = "From: Mishkanet Transit"; 
							$email = "admin@mishkanetworks.com" ; 
							$message = "You edited your account details."; 
							$headers = "From: $email"; 
							$sent = mail($to, $subject, $message, $headers) ; 
							if($sent) 
							{print "Please check your email for details."; }
							else 
							{print "We encountered an error sending your mail"; }
							while($row2 = mysql_fetch_array($test4))
							{
								$_SESSION['username'] = $row2['UserName'];
								$_SESSION['FirstName'] = $row2['FirstName'];
								$_SESSION['MiddleName'] = $row2['MiddleName'];
								$_SESSION['LastName'] = $row2['LastName'];
								$_SESSION['Sex'] = $row2['Sex'];
								$_SESSION['Address'] = $row2['Address'];
								$_SESSION['ContactNo'] = $row2['ContactNo'];
								$_SESSION['EmailAdd'] = $row2['EmailAdd'];
								$_SESSION['CustomerID'] = $row2['CustomerID'];
							}	
						}
						
						else {
							echo "ERROR1";	
						}
						
						$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Edit Customer', Now(), '$FirstName', '$MiddleName', '$LastName')";
						$test3 = mysql_query($sql3);
					}
					
					else 
					{
						echo "ERROR2";
					}
				}
				mysql_close();
			}
			
			else 
			{
				$customerID = $_SESSION['CustomerID'];
				echo "<center>";
				echo	"<br>";
				echo	"<h2>Edit Your Personal Details</h2>";
				echo	"<form action='editCustomer.php' method='post' name='form1'>";
				echo	"<table>";
				echo 	"<tr><td><input type='hidden' name='customerID' value='$customerID'></td></tr>";
				echo		"<tr><td><label>First name:</label></td><td><input type='text' name='firstName' id='firstName' value='" . $_SESSION['FirstName'] . "'></td></tr>";
				echo		"<tr><td><label>Middle name:</label></td><td><input type='text' name='middleName' id='middleName' value='". $_SESSION['MiddleName'] . "'></td></tr>";
				echo		"<tr><td><label>Last Name:</label></td><td><input type='text' name='lastName' id='lastName' value='". $_SESSION['LastName'] . "'></td></tr>";
				echo		"<tr><td><label>Address:</label></td><td><input type='text' name='address' id='address' value='". $_SESSION['Address'] . "'></td></tr>";
				echo		"<tr><td><label>Contact Number:</label></td><td><input type='text' name='contactNo' id='contactNo' value='". $_SESSION['ContactNo'] . "'></td></tr>";
				echo		"<tr><td><label>Email Address:</label></td><td><input type='text' name='emailAdd' id='emailAdd' value='". $_SESSION['EmailAdd'] . "'></td></tr>";
				echo		"<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo		"<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo		"<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName' value='". $_SESSION['username'] . "'></td></tr>";
				echo		"<tr><td><label>Old Password:</label></td><td><input type='password' name='oldPassword' id='oldPassword'></td></tr>";
				echo		"<tr><td><label>New Password:</label></td><td><input type='password' name='newPassword' id='newPassword'></td></tr>";
				echo		"<tr><td><label>Confirm Password:</label></td><td><input type='password' name='cnfPassword' id='cnfPassword'></td></tr>";
				echo		"<tr><td>&nbsp;</td><td align='right'><input type='submit' name='edit' value='Edit' onclick='return InputVal();'></td></tr>";
				echo		"</table>";
				echo "</form>";
			}
		}
		?>
		
	</body>
</html>