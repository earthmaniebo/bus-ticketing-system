<html>
	<head>
		<title>Buy a Ticket</title>
		<style type="text/css">
			table td
			{
				padding-left: 30px;
				padding-right: 30px;
			}
			
			#btnBuy
			{
				margin-bottom: 1px;				
			}
			
</style>
	</head>
	<script type="text/javascript" >
		function InputVal() 
		{
			var fName = document.getElementById('fName');
			var mName = document.getElementById('mName');
			var lName = document.getElementById('lName');
			var sex = document.getElementsByName('sex');
			var address = document.getElementById('address');
			var contactNo = document.getElementById('contactNo');
			var emailAdd = document.getElementById('emailAdd');
			
			if(fName.value == "" || lName.value == "" || address.value == "" || contactNo.value == "" || emailAdd.value == "") {
				alert("Please fill in all the required fields.");
				return false;
			}
		}
		
		function submitNow() 
		{
			document.form1.submit();
		}
	</script>
	<body>
	<center>
		
		<?php
			session_start();
			require_once('connection.php');
			
			if(isset($_POST['buyLogin']))
			{
				echo "<center>";
				echo	"<br><br><br><br><br><br><br><br><br>";
				echo	"<form action='login.php' method='post' name='form1'>";
	  			$slot = $_REQUEST["availableSlot"];
				echo "<input type='hidden' name='availableSlot'" . "value='" . $slot . "' readonly='readonly'>";
				echo "<input type='hidden' name='busID'" . "value='" . $_REQUEST["busID"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='schedID'" . "value='" . $_REQUEST["schedID"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='busNo'" . "value='" . $_REQUEST["busNo"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='destination'" . "value='" . $_REQUEST["destination"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='dateOfTrip'" . "value='" . $_REQUEST["dateOfTrip"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='departureTime'" . "value='" . $_REQUEST["departureTime"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='fee'" . "value='" . $_REQUEST["fee"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='guestBuy' value='yes' readonly='readonly'>";					
				echo	"</form>";
				echo "<script type='text/javascript'> form1.submit();</script>";
				echo	"</center>";		
			}	
			
			
			else if(isset($_POST['buy']))
			{
				include_once('navCustomer.php');
				$CustomerID = $_SESSION['CustomerID'];	
				$BusID = $_REQUEST["busID"];
				$SchedID = $_REQUEST["schedID"];
				$SlotLeft = $_REQUEST["availableSlot"];
				
				$BusNo = $_REQUEST["busNo"];
				$Destination = $_REQUEST["destination"];
				$DateOfTrip = $_REQUEST["dateOfTrip"];
				$DepartureTime = $_REQUEST["departureTime"];
				$Fee = $_REQUEST["fee"];
				$EmailAdd = $_REQUEST["emailAdd"];
				
				$sql = "INSERT INTO transactions (transactions.CustomerID, transactions.BusID, transactions.SchedID, transactions.TransactionDate) VALUES('$CustomerID', '$BusID', '$SchedID', Now())";
				
				$test = mysql_query($sql);
				
				if($test)
				{
					echo "<center><br><br><br><br><br><br><br><br><br><br><h1>You have successfully bought a ticket!</h1>";
										
					$sql2 = "UPDATE schedules SET AvailableSlot='$SlotLeft' WHERE $SchedID = schedules.SchedID";		
					$test2 = mysql_query($sql2);
					
					$to = $EmailAdd; 
					$subject = "From: Mishkanet Transit"; 
					$email = "admin@mishkanetworks.com" ; 
					$message = "'Your transaction was successful. Thank you for pratronizing Mishkanet Transit\n Here is your transaction details:\n Bus Number: $BusNo \n Destination: $Destination \n Date of Trip: $DateOfTrip \n Departure Time: $DepartureTime \n Fee: $Fee"; 
					$headers = "From: $email"; 
					$sent = mail($to, $subject, $message, $headers) ; 
					if($sent) 
					{print "Please check the your email for the trip details."; }
					else 
					{print "We encountered an error sending your mail"; }
				}
					
				else 
				{
					echo "<center>ERROR</center>";
				}
				mysql_close();
			}
			
			else if(isset($_SESSION['username'])) 	
			{
				echo "<h2>Buy a Ticket</h2>";
				include_once('navCustomer.php');
				$slot = $_REQUEST["availableSlot"];
				$updatedSlot = $slot - 1;
				echo "<form action='buy.php' method='post' name='form1'>";
				echo "<h3>Your Trip Details</h3>";
				echo "<input type='hidden' name='availableSlot'" . "value='" . $updatedSlot . "' readonly='readonly'>";
				echo "<input type='hidden' name='busID'" . "value='" . $_REQUEST["busID"] . "' readonly='readonly'>";
				echo "<input type='hidden' name='schedID'" . "value='" . $_REQUEST["schedID"] . "' readonly='readonly'>";
				echo "<table><tr><td><strong>Bus Number</strong>:</td> <td><input type='text' name='busNo'" . "value='" . $_REQUEST["busNo"] . "' readonly='readonly'></td></tr>";
				echo "<tr><td><strong>Destination:</strong></td> <td><input type='text' name='destination'" . "value='" . $_REQUEST["destination"] . "' readonly='readonly'></td></tr>";
				echo "<tr><td><strong>Date of Trip:</strong></td> <td><input type='text' name='dateOfTrip'" . "value='" . $_REQUEST["dateOfTrip"] . "' readonly='readonly'></td></tr>";
				echo "<tr><td><strong>Departure Time:</strong></td> <td><input type='text' name='departureTime'" . "value='" . $_REQUEST["departureTime"] . "' readonly='readonly'></td></tr>";
				echo "<tr><td><strong>Fee:</strong></td> <td><input type='text' name='fee'" . "value='" . $_REQUEST["fee"] . "' readonly='readonly'></td></tr></table>";
				
				echo "<br><h3>Your Personal Details</h3>";
				echo "<table><tr><td><strong>First name:</strong></td> <td><input type='text' id='fName' name='fName' value='". $_SESSION['FirstName'] ."'></td></tr>";
				echo "<tr><td><strong>Middle name:</strong></td> <td> <input type='text' id='mName' name='mName' value='". $_SESSION['MiddleName'] ."'></td></tr>";
				echo "<tr><td><strong>Last name:</strong></td><td> <input type='text' id='lName' name='lName' value='". $_SESSION['LastName'] ."'></td></tr>";
				
				if($_SESSION['Sex'] == "Male")
				{
					echo "<tr><td><strong>Sex:</strong></td> <td><input type='radio' name='sex' value='Male' CHECKED>Male <input type='radio' name='sex' value='Female'>Female</td></tr>";
				}
				
				else if($_SESSION['Sex'] == "Female")
				{
					echo "<tr><td><strong>Sex:</strong></td> <td><input type='radio' name='sex' value='Male'>Male <input type='radio' name='sex' value='Female' CHECKED>Female</td></tr>";
				}
				
				echo "<tr><td><strong>Address:</strong></td> <td><input type='text' id='address' name='address' value='". $_SESSION['Address'] ."'></td></tr>";
				echo "<tr><td><strong>Contact number:</strong></td> <td><input type='text' id='contactNo' name='contactNo' value='". $_SESSION['ContactNo'] ."'></td></tr>";
				echo "<tr><td><strong>Email address:</strong></td> <td><input type='text' id='emailAdd' name='emailAdd' value='". $_SESSION['EmailAdd'] ."'></td></tr></table>";
				echo "<input type='submit' name='buy' value='Buy Ticket' onclick='return InputVal()'> <a href='schedules.php'><input type='button' value='Cancel'></a>";
			}
			
			else 
			{
				echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
				echo "<center><h2>You don't have permission to access this page.<h2>";
				echo "<a href='index.php'><input type='button' value='Go Home'></a></center>";	
			}
		?>
		</center>
	</body>
</html>