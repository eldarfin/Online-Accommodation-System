<?php
	session_start();
?>
<html>
	<head>
		<title>Welcome!</title>
	</head>
	
	<body>
	<a href="home.php">Home</a>
		<a href="search.php">Search</a>
		<a href="redirect.php">Profile</a>
		<a href="info.html">About</a>
		<a href="logout.php">Logout</a>
		<br/>
	
		<?php
			$uID = $_SESSION["uID"];
			
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = '12345';
						
			$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
			if(!$con){
				die('Could not connect: ' . mysql_error);
			}
						
			mysql_select_db("cs353");
			
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				if(isset($_POST["accommodation"])){
					$_SESSION["aID"] = $_POST["accommodation"];
					echo"<form name='register' method='POST' action = 'addOff.php'>
							<table>
							<tr>
								<td><b>Title:</b></td>
								<td><input type='text' placeholder='Title' name='title' required></td>
							</tr>
							<tr>
								<td><b>Price:</b></td>
								<td><input type='text' placeholder='Price' name='price' required></td>
							</tr>
							</table>
							<input type='submit' name='submit' value='Create Offer'>
						</form>
						";
				}
				
				if(isset($_POST["title"])){
					$title = $_POST["title"];
					$price = $_POST["price"];
					$price = floatval(str_replace(',', '.', $price));
					$sql = 'SELECT MAX(oID) as oID FROM Offer;';
				
					$result = mysql_query($sql, $con);
					$oID = 0;
					
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$oID = $row["oID"] + 1;
					}
					
					
					$sql = "INSERT INTO Offer VALUES({$oID}, 'A', '{$title}', {$price}, {$_SESSION['aID']});";
					$result = mysql_query($sql, $con);
				
				
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					header("Location: offerings.php");
				}
			}
			
			$sql = "SELECT aID FROM Accommodation WHERE uID={$uID};";
					
			if(!isset($_POST["accommodation"])){
				$result = mysql_query($sql, $con);
				$row;
				$aID;
				echo "<form method='POST' action='addOff.php' name='delete'>";
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$aID = $row['aID'];
							
					$sql = "SELECT postcode, country, state, city, street FROM Address
									WHERE aID = {$aID};";
					$return = mysql_query($sql, $con);
						
					$pcode = $country = $state = $city = $street = "";
					while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
						$pcode = $row_["postcode"];
						$country = $row_["country"];
						$state = $row_["state"];
						$city = $row_["city"];
						$street = $row_["street"];
					}
							
					echo "<input type='radio' name='accommodation' value='{$aID}'>{$street} 
						{$city} {$state} {$country} {$pcode}<br><br>";
				}	
						
				echo "<input type='submit' name='choose' id='choose' value='Add'>
				</form>
				</br>";
			}
			
		?>
	
	
		
	</body>
</html>	