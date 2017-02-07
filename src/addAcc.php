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
		<div>
			<h1>Please enter the required information</h1>
			<form name="selectType" method="POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<table>
					<tr>
						<td><input type="radio" name="type" value="R">Room&emsp;</td>
						<td><input type="radio" name="type" value="H">House</td>
					</tr>
					
				</table>
				<input type="submit" name="submit" value="Select Type">
			</form>
			<br>
		</div>
	
		<?php
			$uID = $_SESSION["uID"];
			
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				
				if(isset($_POST['capacity'])){
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
					$sql = 'SELECT MAX(aID) as aID FROM Accommodation;';
				
					$result = mysql_query($sql, $con);
					$aID = 0;
					
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$aID = $row['aID']+1;
					}
					
					$sql = 'SELECT MAX(utilID) as utilID FROM Utilities;';
				
					$result = mysql_query($sql, $con);
					$utilID = 0;
					
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$utilID = $row['utilID']+1;
					}
					
					$sql = "INSERT INTO Accommodation VALUES({$aID},{$bnum},{$wcnum}, 'R',{$uID});";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "INSERT INTO Utilities VALUES({$utilID},'{$wifi}','{$washmac}', '{$dishwasher}', {$aID});";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "INSERT INTO Address VALUES({$aID},'{$pcode}', '{$country}', '{$state}', '{$city}', '{$street}');";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "INSERT INTO Room VALUES({$aID}, {$capacity});";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "UPDATE Host SET num_of_accommodations=num_of_accommodations+1
							WHERE uID={$uID}";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
				}
				
				if(isset($_POST['rnum'])){
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
					$sql = 'SELECT MAX(aID) as aID FROM Accommodation;';
				
					$result = mysql_query($sql, $con);
					$aID = 0;
					
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$aID = $row['aID']+1;
					}
					
					$sql = 'SELECT MAX(utilID) as utilID FROM Utilities;';
				
					$result = mysql_query($sql, $con);
					$utilID = 0;
					
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$utilID = $row['utilID']+1;
					}
					
					$sql = "INSERT INTO Accommodation VALUES({$aID},{$bnum},{$wcnum}, 'H',{$uID});";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "INSERT INTO Utilities VALUES({$utilID},'{$wifi}','{$washmac}', '{$dishwasher}', {$aID});";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "INSERT INTO Address VALUES({$aID},'{$pcode}', '{$country}', '{$state}', '{$city}', '{$street}');";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "INSERT INTO House VALUES({$aID}, {$rnum});";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					$sql = "UPDATE Host SET num_of_accommodations=num_of_accommodations+1
							WHERE uID={$uID}";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
				}
				
				if(isset($_POST['type'])){
					if(strcmp("R",$_POST['type']) == 0){
						echo"
							<form name='register' method='POST' action = 'addAcc.php'>
								<table>
								<tr>
									<td><b>Street:</b></td>
									<td><input type='text' placeholder='Street' name='street' required></td>
								</tr>
								<tr>
									<td><b>City:</b></td>
									<td><input type='text' placeholder='City' name='city' required></td>
								</tr>
								<tr>
									<td><b>State:</b></td>
									<td><input type='text' placeholder='State' name='state' ></td>
								</tr>
								<tr>
									<td><b>Country:</b></td>
									<td><input type='text' placeholder='Country' name='country' required></td>
								</tr>
								<tr>
									<td><b>Postcode:</b></td>
									<td><input type='text' placeholder='Postcode' name='pcode' required></td>
								</tr>
								<tr>
									<td><b>Number of beds:</b></td>
									<td><input type='text' placeholder='Number of beds' name='bnum' required></td>
								</tr>
								<tr>
									<td><b>Number of bathrooms:</b></td>
									<td><input type='text' placeholder='Number of bathrooms' name='wcnum' required></td>
								</tr>
								<tr>
									<td><b>Capacity:</b></td>
									<td><input type='text' placeholder='Capacity' name='capacity' required></td>
								</tr>
								
							</table>
							<label><input type='checkbox' name='utilities[]' value='wifi'/> Wifi</label><br/>
							<label><input type='checkbox' name='utilities[]' value='washmac'/> Washing Machine</label><br/>
							<label><input type='checkbox' name='utilities[]' value='dishwasher'/> Dishwasher</label><br/><br/>
							<input type='submit' name='submit' value='Create Accommodation'>
						</form>
						";
					}else{
						echo"
							<form name='register' method='POST' action = 'addAcc.php'>
								<table>
								<tr>
									<td><b>Street:</b></td>
									<td><input type='text' placeholder='Street' name='street' required></td>
								</tr>
								<tr>
									<td><b>City:</b></td>
									<td><input type='text' placeholder='City' name='city' required></td>
								</tr>
								<tr>
									<td><b>State:</b></td>
									<td><input type='text' placeholder='State' name='state' ></td>
								</tr>
								<tr>
									<td><b>Country:</b></td>
									<td><input type='text' placeholder='Country' name='country' required></td>
								</tr>
								<tr>
									<td><b>Postcode:</b></td>
									<td><input type='text' placeholder='Postcode' name='pcode' required></td>
								</tr>
								<tr>
									<td><b>Number of beds:</b></td>
									<td><input type='text' placeholder='Number of beds' name='bnum' required></td>
								</tr>
								<tr>
									<td><b>Number of bathrooms:</b></td>
									<td><input type='text' placeholder='Number of bathrooms' name='wcnum' required></td>
								</tr>
								<tr>
									<td><b>Number of rooms:</b></td>
									<td><input type='text' placeholder='Number of rooms' name='rnum' required></td>
								</tr>
								
							</table>
							<label><input type='checkbox' name='utilities[]' value='wifi'/> Wifi</label><br/>
							<label><input type='checkbox' name='utilities[]' value='washmac'/> Washing Machine</label><br/>
							<label><input type='checkbox' name='utilities[]' value='dishwasher'/> Dishwasher</label><br/><br/>
							<input type='submit' name='submit' value='Create Accommodation'>
						</form>
						";
					}
				}
			}
			
			
		?>
	
	
		
	</body>
</html>