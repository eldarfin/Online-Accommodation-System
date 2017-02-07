<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Accommodations</title>
	</head>
	<body>
		<a href="home.php">Home</a>
		<a href="search.php">Search</a>
		<a href="redirect.php">Profile</a>
		<a href="info.html">About</a>
		<a href="logout.php">Logout</a>
		<br>
		<br>
		
		
		
		
		
		<?php
			$uID = $_SESSION["uID1"];
			
			if($_SESSION['uID'] == $_SESSION['uID1']){
				echo "<table>
			<tr>
				<td><form action='addAcc.php'>
			<input type='submit' value='Add Accommodation'/>
			</form></td>
				<td><form action='deleteAcc.php'>
			<input type='submit' value='Delete Accommodation'/>
			</form></td>
			<td><form action='modifyAcc.php'>
			<input type='submit' value='Modify Accommodation'/>
			</form></td>
			</tr>
		</table>";
			}		
			
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = '12345';
					
			$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
					
			if(!$con){
				die('Could not connect: ' . mysql_error);
			}
					
			mysql_select_db("cs353");
			$sql = "SELECT aID, no_of_bed, no_of_wc, type FROM Accommodation WHERE uID={$uID};";
					
			$result = mysql_query($sql, $con);	
			
			
			if(!$result){
				echo "<h1>There is no accommodation available</h1>";
			}else{
				$type = "";
				$aID = $bednum = $wcnum = 0;
				$row;
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$type = $row["type"];
					$aID = $row["aID"];
					$bednum = $row["no_of_bed"];
					$wcnum = $row["no_of_wc"];
					
				
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
					
					$sql = "SELECT wifi, washmac, dishwasher FROM Utilities
							WHERE aID = {$aID};";
					$return = mysql_query($sql, $con);
			
					$wifi = $washmac = $dishwasher = "";
					while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
						$wifi = $row_["wifi"];
						$washmac = $row_["washmac"];
						$dishwasher = $row_["dishwasher"];
					}
					if(strcmp($wifi, "Y") == 0){
						$wifi = "Yes";
					}else{
						$wifi = "No";
					}
					
					if(strcmp($washmac, "Y") == 0){
						$washmac = "Yes";
					}else{
						$washmac = "No";
					}
					
					if(strcmp($dishwasher, "Y") == 0){
						$dishwasher = "Yes";
					}else{
						$dishwasher = "No";
					}
					
					if(strcmp($type, "R") == 0){
						$sql = "SELECT capacity FROM Room
								WHERE aID = {$aID};";
						$return = mysql_query($sql, $con);
				
						$capacity = 0;
						while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
							$capacity = $row_["capacity"];
						}
						
						echo "<table>
								<tr>
									<td><h2>Room</h2></td>
								</tr>
								<tr>
									<td>Address:</td>
									<td>{$street} {$city} {$state} {$country}</td>
								</tr>
								<tr>
									<td>Postcode: {$pcode}</td>
								</tr>
								<tr>
									<td>Number of beds: {$bednum}</td>
								</tr>
								<tr>
									<td>Number of WC: {$wcnum}</td>
								</tr>
								<tr>
									<td>Capacity: {$capacity}</td>
								</tr>
								<tr>
									<td>Wifi: {$wifi}</td>
								</tr>
								<tr>
									<td>Washing Machine: {$washmac}</td>
								</tr>
								<tr>
									<td>Dishwasher: {$dishwasher}</td>
								</tr>
								
							</table>
							<br>";
					} else {
						$sql = "SELECT num_of_rooms FROM House
								WHERE aID = {$aID};";
						$return = mysql_query($sql, $con);
				
						$roomnum = 0;
						while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
							$roomnum = $row_["num_of_rooms"];
						}
						
						echo "<table>
								<tr>
									<td><h2>House</h2></td>
								</tr>
								<tr>
									<td>Address:</td>
									<td>{$street} {$city} {$state} {$country}</td>
								</tr>
								<tr>
									<td>Postcode: {$pcode}</td>
								</tr>
								<tr>
									<td>Number of beds: {$bednum}</td>
								</tr>
								<tr>
									<td>Number of WC: {$wcnum}</td>
								</tr>
								<tr>
									<td>Number of rooms: {$roomnum}</td>
								</tr>
								<tr>
									<td>Wifi: {$wifi}</td>
								</tr>
								<tr>
									<td>Washing Machine: {$washmac}</td>
								</tr>
								<tr>
									<td>Dishwasher: {$dishwasher}</td>
								</tr>
								
							</table>
							<br>";
					}
					
				}
				if(!$row){
					//echo "<h1>There is no accommodation available for this user</h1>";
				}
			}
			
			
			
		
			
			
		?>
	</body>
</html>