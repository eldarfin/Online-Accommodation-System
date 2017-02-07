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
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = '12345';
					
			$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
					
			if(!$con){
				die('Could not connect: ' . mysql_error);
			}
					
			mysql_select_db("cs353");
			$sql = "Select R.res_date_begin as res_date_begin, R.res_date_end as res_date_end,
							R.resID as resID, A.type as type, Ad.country as country, A.aID as aID,
							Ad.city as city, Ad.street as street, A.uID as hID, 
							R.res_date_begin as entry
					From	Reservation R, Offer O,Accommodation A,Address Ad
					Where	R.uID={$uID_search} and R.oID= O.oID and O.aID=A.aID and Ad.aID= A.aID;";
			

			$result = mysql_query($sql, $con);	
			
			
			if(!$result){
				echo "<h1>There is no reservation from this client.</h1>";
			}else{
				$count = 1;
				$res_date_begin = "";
				$res_date_end="";
				$type="";
				$city="";
				$country="";
				$street="";
				$resID = 0;
				$row;
				$empty = true;
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$empty = false;
					$res_date_begin = $row["res_date_begin"];
					$res_date_end = $row["res_date_end"];
					$type = $row["type"];
					$city = $row["city"];
					$country = $row["country"];
					$street = $row["street"];
					$resID = $row["resID"];
					$aID = $row["aID"];
					$hID = $row["hID"];
					$entry = $row['entry'];
					if(strcmp($type, "R")){
						$type = "Room";
					}else{
						$type = "House";
					}
					echo "<table><tr>
									<td><h2>Reservation Number {$count}</h2></td>
								</tr>
								<tr>
									<td>Reservation ID:</td>
									<td>{$resID}</td>
								</tr>
								<tr>
									<td>Reservation date begin/end: {$res_date_begin}/{$res_date_end}  </td>
								</tr>
								<tr>
									<td>Type: {$type}</td>
								</tr>
								<tr>
									<td>Address: {$country} - {$city} - {$street} </td>
								</tr>
								
								</tr></table>
								";
								$count = $count+1;
						$curDate = date('Y-m-d');
						echo "<table><tr>";
						if($entry > $curDate && $_SESSION['uID'] == $_SESSION['uID1']){
							echo "
								<td><form>
									<input type='button' value='Cancel' onclick='window.location.href=\"cancelRes.php?resID={$resID}\"' />
								</form></td>";
						}
						
						mysql_select_db("cs353");
						$sql = "SELECT rID FROM Reviews
								WHERE uID_1={$_SESSION['uID']} AND uID_2 = {$hID}
								AND aID={$aID};";
			

						$r = mysql_query($sql, $con);
						$empty_ = true;
						while($row_ = mysql_fetch_array($r, MYSQL_ASSOC)) {
							$empty_ = false;
						}
						if($entry < $curDate && $empty_ && $_SESSION['uID'] == $_SESSION['uID1']){
							echo "<td><form>
									<input type='button' value='Write Review' onclick='window.location.href=\"writeRev.php?aID={$aID}&resID={$resID}&hID={$hID}\"' />
								</form></td>";
						}
						
						echo "</tr></table>";
					}
					if($empty){
						echo "<h1>There is no reservation from this client.</h1>";
					}
					
			} 

		?>
	</body>
</html>