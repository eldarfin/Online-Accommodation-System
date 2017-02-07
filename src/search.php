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
	
	<form name="pick" method="POST" action="search.php">
		<table>
			<tr>
				<td><b>Country:</b></td>
				<td><input type="text" placeholder="Country" name="country" required>&emsp;</td>
				<td><b>City:</b></td>
				<td><input type="text" placeholder="City" name="city" required>&emsp;</td>
			</tr>	
			<tr>
				<td><b>Entry:</b></td>
				<td><input type="date" placeholder="YYYY-MM-DD" name="entry" required>&emsp;</td>
				<td><b>Checkout:</b></td>
				<td><input type="date" placeholder="YYYY-MM-DD" name="checkout" required>&emsp;</td>
			</tr>
			<tr>
				<td><b>Number of guests:</b></td>
				<td><input type="text" placeholder="Number of guests" name="gnum" required></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Search"/>
	</form>
	<br>
	<br>
	
	<?php
	
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$country = $_POST["country"];
			$city = $_POST["city"];
			$entry = $_POST["entry"];
			$checkout = $_POST["checkout"];
			$gnum = $_POST["gnum"];
			$_SESSION["checkout"] = $checkout;
			$_SESSION["entry"] = $entry;
			
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = '12345';
						
			$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
			if(!$con){
				die('Could not connect: ' . mysql_error);
			}
					
			mysql_select_db("cs353");
						
			$sql = "SELECT O.title as title, O.price as price, Ad.country as country,
					Ad.city as city, A.type as type, A.no_of_bed, O.oID as oID
					FROM Accommodation A, Address Ad, Offer O
					WHERE A.aID = Ad.aID AND O.aID = A.aID
					AND Ad.country='{$country}' AND Ad.city = '{$city}' 
					AND A.no_of_bed >= {$gnum} AND A.uID <> {$_SESSION['uID']}	
					AND NOT EXISTS(
						SELECT R.resID FROM Reservation R
						WHERE R.oID = O.oID AND ((STR_TO_DATE('{$entry}','%Y-%m-%d') BETWEEN
						R.res_date_begin AND R.res_date_end) OR 
						(STR_TO_DATE('{$checkout}','%Y-%m-%d') BETWEEN R.res_date_begin AND R.res_date_end) OR
						(R.res_date_begin BETWEEN STR_TO_DATE('{$entry}','%Y-%m-%d') 
						AND STR_TO_DATE('{$checkout}','%Y-%m-%d')) OR
						(R.res_date_end BETWEEN STR_TO_DATE('{$entry}','%Y-%m-%d') AND STR_TO_DATE('{$checkout}','%Y-%m-%d')))
					);";
						//AND A.uID <> {$_SESSION['uID']}
			$result = mysql_query($sql, $con);
			
			$empty = true;
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$empty = false;
				$oID = $row["oID"];
				$title = $row["title"];
				$price = $row["price"];
				$country = $row["country"];
				$city = $row["city"];
				$type = $row["type"];
				$no_of_bed = $row["no_of_bed"];
				
				if(strcmp($type, "R") == 0){
					$type = "Room";
				}else{
					$type = "House";
				}
				echo "<table>
						<tr>
							<td><a href='offerPage.php?oID={$oID}&type={$type}'>{$title}</a></td>
						</tr>
						<tr>
							<td>Price:</td>
							<td>{$price} $</td>
						</tr>
						<tr>
							<td>Place:</td>
							<td>{$city} {$country}</td>
						</tr>
						<tr>
							<td>Type:</td>
							<td>{$type}</td>
						</tr>
						<tr>
							<td>Number of beds:</td>
							<td>{$no_of_bed}</td>
						</tr>
					</table>
					<br>
					<br>";
			}
			if($empty){
				echo "<h1>There are no matching results</h1>";
			}
		}
		
	?>
		

	</body>
</html>
