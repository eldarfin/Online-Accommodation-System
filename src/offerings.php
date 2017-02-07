<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Review</title>
	</head>
	<body>
		<a href="home.php">Home</a>
		<a href="search.php">Search</a>
		<a href="redirect.php">Profile</a>
		<a href="info.html">About</a>
		<a href="logout.php">Logout</a>
		<br>
		<br>
		
		<br>
		<?php
			$uID_this = $_SESSION["uID"];
			$uID_search = $_SESSION["uID1"];
			if($_SESSION['uID'] == $_SESSION['uID1']){
				echo "<table>
			<tr>
				<td><form action='addOff.php'>
				<input type='submit' value='Add Offering'/>
				</form></td>
					<td><form action='deleteOff.php'>
				<input type='submit' value='Delete Offering'/>
				</form></td>
				<td><form action='modifyOff.php'>
				<input type='submit' value='Modify Offering'/>
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
			$sql = "Select O.title as title, O.price as price, A.type as type,
						Ad.country as country, Ad.city as city
					From	Offer O, Accommodation A, Address Ad
					Where	O.aID=A.aID and A.uID={$uID_search} and Ad.aID=A.aID;";
			

			$result = mysql_query($sql, $con);	

			
			
			if(!$result){
				echo "<h1>There is no offering from this host.</h1>";
			}else{
				$count = 1;
				$title = "";
				$type="";
				$country="";
				$city="";
				$price = 0;
				$row;
				$empty=true;
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$empty = false;
					$title = $row["title"];
					$type = $row["type"];
					$country = $row["country"];
					$city = $row["city"];
					$price = $row["price"];
					if(strcmp($type, "R")){
						$type="Room";
					}else{
						$type="House";
					}
					echo "<table><tr>
									<td><h2>Offering Number {$count}</h2></td>
								</tr>
								<tr>
									<td>Title:</td>
									<td>{$title}</td>
								</tr>
								<tr>
									<td>Type:{$type}</td>
								</tr>
								<tr>
									<td>Address: {$country} - {$city}</td>
								</tr>
								<tr>
									<td>Price: {$price} </td>
								</tr>
								</tr></table>";
								$count = $count+1;
					}
					if($empty){
						echo "<h1>There is no offering from this host.</h1>";
					}
					
			} 

		?>
	</body>
</html>