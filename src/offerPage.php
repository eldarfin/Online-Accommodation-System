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
	
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '12345';
						
		$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
		if(!$con){
			die('Could not connect: ' . mysql_error);
		}
					
		mysql_select_db("cs353");
	
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			if(isset($_POST["submit"])){
				
				$sql = 'SELECT MAX(resID) as resID FROM Reservation;';
				
				$result = mysql_query($sql, $con);
				$resID = 0;
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$resID = $row['resID']+1;
				}
				
				$sql = "INSERT INTO Reservation VALUES({$resID}, STR_TO_DATE('{$_SESSION['entry']}','%Y-%m-%d'), 
				STR_TO_DATE('{$_SESSION['checkout']}','%Y-%m-%d'), {$_SESSION['uID']}, {$_SESSION['oID']});";
				$result = mysql_query($sql, $con);
				
				if(! $result ) {
					die('Could not enter data: ' . mysql_error());
				}
				
				$sql = "UPDATE Client SET num_of_travels = num_of_travels+1 WHERE uID={$_SESSION['uID']}";
				$result = mysql_query($sql, $con);
				
				if(! $result ) {
					die('Could not enter data: ' . mysql_error());
				}
				
				header("Location: search.php");
			}else{
				$_SESSION["uID1"] = $_SESSION["hID"];
				header("Location: profile.php");
			}
		}
		
		$_SESSION["oID"] = $_GET["oID"];
						
		if(strcmp("Room", $_GET["type"]) == 0){
			$sql = "SELECT O.title as title, O.price as price, A.no_of_bed as bnum, 
				A.no_of_wc as wcnum, U.wifi as wifi, U.washmac as washmac,
				Us.uID as hID, Us.first_name as hName, Us.last_name as lName,
				U.dishwasher as dishwasher,R.capacity as capacity, Ad.city as city,
				Ad.country as country, Ad.state as state, Ad.street as street,
				Ad.postcode as pcode FROM Offer O, Accommodation A, Address Ad,
				Room R, Utilities U, User Us WHERE O.oID = {$_GET['oID']} AND O.aID = A.aID
				AND U.aID = A.aID AND R.aID = A.aID AND Ad.aID = A.aID AND A.uID = Us.uID;
				";
		}else{
			$sql = "SELECT O.title as title, O.price as price, A.no_of_bed as bnum, 
				A.no_of_wc as wcnum, U.wifi as wifi, U.washmac as washmac,
				Us.uID as hID, Us.first_name as hName, Us.last_name as lName,
				U.dishwasher as dishwasher,H.num_of_rooms as rnum, Ad.city as city,
				Ad.country as country, Ad.state as state, Ad.street as street,
				Ad.postcode as pcode FROM Offer O, Accommodation A, Address Ad,
				House H, Utilities U, User Us WHERE O.oID = {$_GET['oID']} AND O.aID = A.aID
				AND U.aID = A.aID AND H.aID = A.aID AND Ad.aID = A.aID AND A.uID = Us.uID;
				";
		}
						
		$result = mysql_query($sql, $con);
		
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			
			$title=$wifi=$washmac=$dishwasher=$hName=$lName=$country=$state="";
			$street=$city=$pcode="";
			$price=$bnum=$wcnum=$hID=$capacity=$rnum=0;
			if(strcmp("Room", $_GET["type"]) == 0){
				$title=$row["title"];
				$wifi=$row["wifi"];
				$washmac=$row["washmac"];
				$dishwasher=$row["dishwasher"];
				$hName=$row["hName"];
				$lName=$row["lName"];
				$country=$row["country"];
				$state=$row["state"];
				$street=$row["street"];
				$city=$row["city"];
				$pcode=$row["pcode"];
				$price=$row["price"];
				$bnum=$row["bnum"];
				$wcnum=$row["wcnum"];
				$hID=$row["hID"];
				$capacity=$row["capacity"];
				$_SESSION["hID"] = $hID;
				
				if(strcmp($wifi, "Y")==0){
					$wifi = "Yes";
				}else{
					$wifi = "No";
				}
				if(strcmp($washmac, "Y")==0){
					$washmac = "Yes";
				}else{
					$washmac = "No";
				}
				if(strcmp($dishwasher, "Y")==0){
					$dishwasher = "Yes";
				}else{
					$dishwasher = "No";
				}
				
				echo "<table>
					<tr>
						<td>{$title}</td>
					</tr>
					<tr>
						<td>Price:</td>
						<td>{$price}</td>
					</tr>
					<tr>
						<td>Host:</td>
						<td>
							<form method='POST' name='hostprofile' action='offerPage.php'>
								<a href='#' onclick='document.forms[\"hostprofile\"].submit();'>{$hName} {$lName}</a>
							</form>
						</td>
					</tr>
					<tr>
						<td>Address:</td>
						<td>{$street} {$city} {$state} {$country} {$pcode}</td>
					</tr>
					<tr>
						<td>Number of beds:</td>
						<td>{$bnum}</td>
					</tr>
					<tr>
						<td>Number of bathrooms:</td>
						<td>{$wcnum}</td>
					</tr>
					<tr>
						<td>Capacity:</td>
						<td>{$capacity}</td>
					</tr>
					<tr>
						<td>Wifi:</td>
						<td>{$wifi}</td>
					</tr>
					<tr>
						<td>Washing Machine:</td>
						<td>{$washmac}</td>
					</tr>
					<tr>
						<td>Dishwasher:</td>
						<td>{$dishwasher}</td>
					</tr>
				</table>
				<form name='reserve' method='POST' action='offerPage.php'>
					<input type='submit' name='submit' value='Reserve'>
				</form>";
			}else{
				$title=$row["title"];
				$wifi=$row["wifi"];
				$washmac=$row["washmac"];
				$dishwasher=$row["dishwasher"];
				$hName=$row["hName"];
				$lName=$row["lName"];
				$country=$row["country"];
				$state=$row["state"];
				$street=$row["street"];
				$city=$row["city"];
				$pcode=$row["pcode"];
				$price=$row["price"];
				$bnum=$row["bnum"];
				$wcnum=$row["wcnum"];
				$hID=$row["hID"];
				$rnum=$row["rnum"];
				$_SESSION["hID"] = $hID;
				
				if(strcmp($wifi, "Y")==0){
					$wifi = "Yes";
				}else{
					$wifi = "No";
				}
				if(strcmp($washmac, "Y")==0){
					$washmac = "Yes";
				}else{
					$washmac = "No";
				}
				if(strcmp($dishwasher, "Y")==0){
					$dishwasher = "Yes";
				}else{
					$dishwasher = "No";
					
				}
				
				echo "<table>
					<tr>
						<td>{$title}</td>
					</tr>
					<tr>
						<td>Price:</td>
						<td>{$price}</td>
					</tr>
					<tr>
						<td>Host:</td>
						<td>
							<form method='POST' name='hostprofile' action='offerPage.php' >
								<a href='#' onclick='document.forms[\"hostprofile\"].submit();'>{$hName} {$lName}</a>
							</form>
						</td>
					</tr>
					<tr>
						<td>Address:</td>
						<td>{$street} {$city} {$state} {$country} {$pcode}</td>
					</tr>
					<tr>
						<td>Number of beds:</td>
						<td>{$bnum}</td>
					</tr>
					<tr>
						<td>Number of bathrooms:</td>
						<td>{$wcnum}</td>
					</tr>
					<tr>
						<td>Number of rooms:</td>
						<td>{$rnum}</td>
					</tr>
					<tr>
						<td>Wifi:</td>
						<td>{$wifi}</td>
					</tr>
					<tr>
						<td>Washing Machine:</td>
						<td>{$washmac}</td>
					</tr>
					<tr>
						<td>Dishwasher:</td>
						<td>{$dishwasher}</td>
					</tr>
				</table>
				<form name='reserve' method='POST' action='offerPage.php'>
					<input type='submit' name='submit' value='Reserve'>
				</form>";
			}
			
			
		}
		
	?>
		

	</body>
</html>
