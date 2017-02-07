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
				if(isset($_POST['capacity'])){
					$aID = $_SESSION["aID"];
					$street = $_POST['street'];
					$city = $_POST['city'];
					$state = $_POST['state'];
					$country = $_POST['country'];
					$pcode = $_POST['pcode'];
					$bnum = $_POST['bnum'];
					$wcnum = $_POST['wcnum'];
					$capacity = $_POST['capacity'];
					
					$wifi = $washmac = $dishwasher = "";
					if(isset($_POST['wifi'])){
						$wifi = "Y";
					}else{
						$wifi = "N";
					}
					if(isset($_POST['washmac'])){
						$washmac = "Y";
					}else{
						$washmac = "N";
					}
					if(isset($_POST['dishwasher'])){
						$dishwasher = "Y";
					}else{
						$dishwasher = "N";
					}
				
					
					$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = '12345';
						
					$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
					if(!$con){
						die('Could not connect: ' . mysql_error);
					}
						
					mysql_select_db("cs353");
					
					$sql = "SELECT utilID FROM Utilities
							WHERE aID = {$aID};";
					$return = mysql_query($sql, $con);
			
					$utilID = 0;
					
					while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
						$utilID = $row_["utilID"];
					}
					
					if(strcmp($street, $_SESSION["street"]) != 0){
						$sql = "UPDATE Address SET street='{$street}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($city, $_SESSION["city"]) != 0){
						$sql = "UPDATE Address SET city='{$city}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($state, $_SESSION["state"]) != 0){
						$sql = "UPDATE Address SET state='{$state}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($country, $_SESSION["country"]) != 0){
						$sql = "UPDATE Address SET country='{$country}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($pcode, $_SESSION["pcode"]) != 0){
						$sql = "UPDATE Address SET postcode='{$pcode}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($wifi, $_SESSION["wifi"]) != 0){
						$sql = "UPDATE Utilities SET wifi='{$wifi}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($washmac, $_SESSION["washmac"]) != 0){
						$sql = "UPDATE Utilities SET washmac='{$washmac}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($dishwasher, $_SESSION["dishwasher"]) != 0){
						$sql = "UPDATE Utilities SET dishwasher='{$dishwasher}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if($bnum != $_SESSION["bnum"]){
						$sql = "UPDATE Accommodation SET no_of_bed='{$bnum}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if($wcnum != $_SESSION["wcnum"]){
						$sql = "UPDATE Accommodation SET no_of_wc='{$wcnum}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if($capacity != $_SESSION["capacity"]){
						$sql = "UPDATE Room SET capacity='{$capacity}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					
					}
				}
					
				
					if(isset($_POST['rnum'])){
					$aID = $_SESSION["aID"];	
					$street = $_POST['street'];
					$city = $_POST['city'];
					$state = $_POST['state'];
					$country = $_POST['country'];
					$pcode = $_POST['pcode'];
					$bnum = $_POST['bnum'];
					$wcnum = $_POST['wcnum'];
					$rnum = $_POST['rnum'];
					
				
					
					$wifi = $washmac = $dishwasher = "N";
					if(isset($_POST['utilities'])){
						$utilities = $_POST['utilities'];
						foreach($utilities as $utility){
							if(strcmp($utility, "wifi")){
								$wifi = "Y";
							}
							if(strcmp($utility, "washmac")){
								$washmac = "Y";
							}
							if(strcmp($utility, "dishwasher")){
								$dishwasher = "Y";
							}
						}
					}
					
					$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = '12345';
						
					$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
					if(!$con){
						die('Could not connect: ' . mysql_error);
					}
						
					mysql_select_db("cs353");
					
					
					
					if(strcmp($street, $_SESSION["street"]) != 0){
						$sql = "UPDATE Address SET street='{$street}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($city, $_SESSION["city"]) != 0){
						$sql = "UPDATE Address SET city='{$city}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($state, $_SESSION["state"]) != 0){
						$sql = "UPDATE Address SET state='{$state}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($country, $_SESSION["country"]) != 0){
						$sql = "UPDATE Address SET country='{$country}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($pcode, $_SESSION["pcode"]) != 0){
						$sql = "UPDATE Address SET postcode='{$pcode}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($wifi, $_SESSION["wifi"]) != 0){
						$sql = "UPDATE Utilities SET wifi='{$wifi}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($washmac, $_SESSION["washmac"]) != 0){
						$sql = "UPDATE Utilities SET washmac='{$washmac}';
								WHERE aID={$aID}";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if(strcmp($dishwasher, $_SESSION["dishwasher"]) != 0){
						$sql = "UPDATE Utilities SET dishwasher='{$dishwasher}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if($bnum != $_SESSION["bnum"]){
						$sql = "UPDATE Accommodation SET no_of_bed='{$bnum}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if($wcnum != $_SESSION["wcnum"]){
						$sql = "UPDATE Accommodation SET no_of_wc='{$wcnum}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					if($rnum != $_SESSION["roomnum"]){
						$sql = "UPDATE House SET num_of_rooms='{$rnum}'
								WHERE aID={$aID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
				
			}
			
			if(isset($_POST['accommodation'])){
				$_SESSION["aID"] = $_POST['accommodation'];
				
				
				$sql = "SELECT aID, no_of_bed, no_of_wc, type FROM Accommodation 
						WHERE aID={$_POST['accommodation']};";
					
				$result = mysql_query($sql, $con);
				
				$type = "";
				$aID = $bednum = $wcnum = 0;
				$row;
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$type = $row["type"];
					$aID = $row["aID"];
					$bednum = $row["no_of_bed"];
					$wcnum = $row["no_of_wc"];
				}
				
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
					
					$sql = "SELECT utilID, wifi, washmac, dishwasher FROM Utilities
							WHERE aID = {$aID};";
					$return = mysql_query($sql, $con);
			
					$utilID = 0;
					$wifi = $washmac = $dishwasher = "";
					while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
						$utilID = $row["utilID"];
						$wifi = $row_["wifi"];
						$washmac = $row_["washmac"];
						$dishwasher = $row_["dishwasher"];
					}
					
					$_SESSION["wifi"] = $wifi;
					$_SESSION["washmac"] = $washmac;
					$_SESSION["dishwasher"] = $dishwasher;
					
					if(strcmp($wifi, "Y") == 0){
						$wifi = "checked";
					}else{
						$wifi = "";
					}
					if(strcmp($washmac, "Y") == 0){
						$washmac = "checked";
					}else{
						$washmac = "";
					}
					if(strcmp($dishwasher, "Y") == 0){
						$dishwasher = "checked";
					}else{
						$dishwasher = "";
					}
					
					$_SESSION["street"] = $street;
					$_SESSION["city"] = $city;
					$_SESSION["state"] = $state;
					$_SESSION["country"] = $country;
					$_SESSION["pcode"] = $pcode;
					$_SESSION["bnum"] = $bednum;
					$_SESSION["wcnum"] = $wcnum;
					
					if(strcmp($type, "R") == 0){
						$sql = "SELECT capacity FROM Room
								WHERE aID = {$aID};";
						$return = mysql_query($sql, $con);
				
						$capacity = 0;
						while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
							$capacity = $row_["capacity"];
						}
						
						$_SESSION["capacity"] = $capacity;
						
						echo"
							<form name='register' method='POST' action = 'modifyAcc.php'>
								<table>
								<tr>
									<td><b>Street:</b></td>
									<td><input type='text' placeholder='Street' name='street' value='{$street}' required></td>
								</tr>
								<tr>
									<td><b>City:</b></td>
									<td><input type='text' placeholder='City' name='city' value='{$city}' required></td>
								</tr>
								<tr>
									<td><b>State:</b></td>
									<td><input type='text' placeholder='State' name='state' value='{$state}' ></td>
								</tr>
								<tr>
									<td><b>Country:</b></td>
									<td><input type='text' placeholder='Country' name='country' value='{$country}' required></td>
								</tr>
								<tr>
									<td><b>Postcode:</b></td>
									<td><input type='text' placeholder='Postcode' name='pcode' value='{$pcode}' required></td>
								</tr>
								<tr>
									<td><b>Number of beds:</b></td>
									<td><input type='text' placeholder='Number of beds' name='bnum' value='{$bednum}' required></td>
								</tr>
								<tr>
									<td><b>Number of bathrooms:</b></td>
									<td><input type='text' placeholder='Number of bathrooms' name='wcnum' value='{$wcnum}' required></td>
								</tr>
								<tr>
									<td><b>Capacity:</b></td>
									<td><input type='text' placeholder='Capacity' name='capacity' value='{$capacity}' required></td>
								</tr>
								
							</table>
							<label><input type='checkbox' name='utilities[]' value='wifi' {$wifi}/> Wifi</label><br/>
							<label><input type='checkbox' name='utilities[]' value='washmac' {$washmac}/> Washing Machine</label><br/>
							<label><input type='checkbox' name='utilities[]' value='dishwasher' {$dishwasher}/> Dishwasher</label><br/><br/>
							<input type='submit' name='submit' value='Edit Accommodation'>
						</form>
						";
					}else{
						$sql = "SELECT num_of_rooms FROM House
								WHERE aID = {$aID};";
						$return = mysql_query($sql, $con);
				
						$roomnum = 0;
						while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
							$roomnum = $row_["num_of_rooms"];
						}
						
						$_SESSION["roomnum"] = $roomnum;
						
						echo"
							<form name='register' method='POST' action = 'modifyAcc.php'>
								<table>
								<tr>
									<td><b>Street:</b></td>
									<td><input type='text' placeholder='Street' name='street' value='{$street}' required></td>
								</tr>
								<tr>
									<td><b>City:</b></td>
									<td><input type='text' placeholder='City' name='city' value='{$city}' required></td>
								</tr>
								<tr>
									<td><b>State:</b></td>
									<td><input type='text' placeholder='State' name='state' value='{$state}' ></td>
								</tr>
								<tr>
									<td><b>Country:</b></td>
									<td><input type='text' placeholder='Country' name='country' value='{$country}' required></td>
								</tr>
								<tr>
									<td><b>Postcode:</b></td>
									<td><input type='text' placeholder='Postcode' name='pcode' value='{$pcode}' required></td>
								</tr>
								<tr>
									<td><b>Number of beds:</b></td>
									<td><input type='text' placeholder='Number of beds' name='bnum' value='{$bednum}' required></td>
								</tr>
								<tr>
									<td><b>Number of bathrooms:</b></td>
									<td><input type='text' placeholder='Number of bathrooms' name='wcnum' value='{$wcnum}' required></td>
								</tr>
								<tr>
									<td><b>Number of rooms:</b></td>
									<td><input type='text' placeholder='Number of rooms' name='rnum' value='{$roomnum}' required></td>
								</tr>
								
							</table>
							<label><input type='checkbox' name='utilities[]' value='wifi' {$wifi}/> Wifi</label><br/>
							<label><input type='checkbox' name='utilities[]' value='washmac' {$washmac}/> Washing Machine</label><br/>
							<label><input type='checkbox' name='utilities[]' value='dishwasher' {$dishwasher}/> Dishwasher</label><br/><br/>
							<input type='submit' name='submit' value='Edit Accommodation'>
						</form>
						";
					}
					
					
			}
			
			}
			
			if(	!isset($_POST['accommodation'])){
			$sql = "SELECT aID FROM Accommodation WHERE uID={$uID};";
					
			$result = mysql_query($sql, $con);
			$row;
			$aID;
			echo "<form method='POST' action='modifyAcc.php' name='delete'>";
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
					
			echo "<input type='submit' name='choose' id='choose' value='Edit'>
			</form>
			</br>";	
			}
			
		?>

	</body>
</html>
