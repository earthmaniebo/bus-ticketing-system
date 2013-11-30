<html>
	<head>
		<title>Edit Admin Details</title>
	</head>
	
	<body>
		<script type="text/javascript" >
			function InputVal() 
			{
				var fName = document.getElementById('firstName');
				var lName = document.getElementById('lastName');
				var emailAdd = document.getElementById('emailAdd');
				var uName = document.getElementById('userName');
				
				var newPassword = document.getElementById('newPassword');
				var cfnPassword = document.getElementById('cnfPassword');
				
				if(newPassword.value != cfnPassword.value)
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
		if(!isset($_SESSION['adminUsername'])) 
		{
			echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
			echo "<center><h2>You don't have permission to access this page.<h2>";
			echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";		
		}	
		
		else
		{	
			include_once('navAdmin.php');
			if(isset($_POST['edit']))
			{
				$AdminID = $_REQUEST["adminID"];
				$FirstName = $_REQUEST["firstName"];
				$LastName = $_REQUEST["lastName"];	
				$EmailAdd = $_REQUEST["emailAdd"];
				$UserName = mysql_real_escape_string($_REQUEST["userName"]);
				$OldPassword = mysql_real_escape_string($_REQUEST["oldPassword"]);
				$Password = mysql_real_escape_string($_REQUEST["newPassword"]);
				$OldEncryptedPass = md5($OldPassword);
				$EncryptedPass = md5($Password);
				
				$sql1 = "SELECT * FROM admin WHERE admin.AdminID = '$AdminID'";
				
				$test1 = mysql_query($sql1);
				
				while($row = mysql_fetch_array($test1))
				{
					$adminID = $row['AdminID'];
					$firstName = $row['FirstName'];
					$lastName = $row['LastName'];
					$emailAdd = $row['EmailAdd'];
					$userName = $row['UserName'];
					$password = $row['Password'];
					
					if($OldEncryptedPass == $password)
					{
						$sql2 = "UPDATE admin SET admin.FirstName = '$FirstName', admin.LastName = '$LastName', admin.EmailAdd = '$EmailAdd', admin.Password = '$EncryptedPass' WHERE admin.AdminID = '$AdminID'";
						$test2 = mysql_query($sql2);
						if($test2)
						{
							echo "<center><br><br><br><br><br><br><h2>Admin details was successfully edited.</h2>";
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
						}	
						
						$sql3 = "INSERT INTO transrecords (transrecords.TransType, transrecords.TransDate, transrecords.FirstName, transrecords.MiddleName, transrecords.LastName) VALUES('Edit Admin', Now(), '$FirstName', null, '$LastName')";
						$test3 = mysql_query($sql3);
					}
					
					else 
					{
						echo "ERROR";
					}
				}
				mysql_close();		
			}
			
			else 
			{
				//sql query to produced the desired result 
				$adminID = $_REQUEST['adminID'];
				$firstName = $_REQUEST['firstName'];
				$lastName = $_REQUEST['lastName'];
				$emailAdd = $_REQUEST['emailAdd'];
				$userName = $_REQUEST['userName'];
				
						
				
				echo "<center>";
				echo	"<br><br><br><br>";
				echo	"<h2>Edit Admin Details</h2>";
				echo	"<form action='editAdmin.php' method='post' name='form1'>";
				echo	"<table>";
				echo  "<tr><td><input type='hidden' name='adminID' value='$adminID'></td></tr>";
				echo		"<tr><td><label>First name:</label></td><td><input type='text' name='firstName' id='firstName' value='" . $firstName . "'></td></tr>";
				echo		"<tr><td><label>Last name:</label></td><td><input type='text' name='lastName' id='lastName' value='". $lastName . "'></td></tr>";
				echo		"<tr><td><label>Email Address:</label></td><td><input type='email' name='emailAdd' id='emailAdd' value='". $emailAdd . "'></td></tr>";
				echo		"<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo		"<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo		"<tr><td><label>Username:</label></td><td><input type='text' name='userName' id='userName' value='". $userName . "'></td></tr>";
				echo		"<tr><td><label>Old Password:</label></td><td><input type='password' name='oldPassword' id='password'></td></tr>";
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