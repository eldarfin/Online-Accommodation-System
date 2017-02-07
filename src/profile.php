<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	
	<?php
		$uID = $_SESSION["uID1"];
		
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '12345';
				
		$con = mysql_connect($dbhost, $dbuser, $dbpass);
				
				
		if(!$con){
			die('Could not connect: ' . mysql_error);
		}
				
		mysql_select_db("cs353");
		$sql = "SELECT U.first_name as name, U.last_name as lname, U.tel as pnum,
				U.email as email, C.num_of_travels as tnum, 
				H.num_of_accommodations as anum FROM User U, Client C, Host H
				WHERE U.uID = {$uID} AND C.uID = U.uID AND H.uID = U.uID;";
				
		$result = mysql_query($sql, $con);	
		
		$name = $lname=$email="";
		$pnum=$tnum=$anum=0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$name = $row["name"];
			$lname = $row["lname"];
			$email = $row["email"];
			$pnum = $row["pnum"];
			$tnum = $row["tnum"];
			$anum = $row["anum"];
		}
		echo "<head><title>{$name} {$lname}</title></head>";
		echo'<body>
		<a href="home.php">Home</a>
		<a href="search.php">Search</a>
		<a href="redirect.php">Profile</a>
		<a href="info.html">About</a>
		<a href="logout.php">Logout</a>';
		echo "<div>
					<h1>Welcome to {$name} {$lname}'s profile!</h1>
					<table>
						<tr>
							<td>Name, Lastname: </td>
							<td>{$name} {$lname}</td>
						</tr>
						<tr>
							<td>E-mail: </td>
							<td>{$email}</td>
						</tr>
						<tr>
							<td>Phone Number: </td>
							<td>{$pnum}</td>
						</tr>
						<tr>
							<td>Number of travels: </td>
							<td>{$tnum}</td>
						</tr>
						<tr>
							<td>Number of accommodations: </td>
							<td>{$anum}</td>
						</tr>
					</table>
				</div>
				
				<div>
				<br>
					<table>
						<tr>
							<td>
							<form action='res.php'>
								<input type='submit' value='Reservations'/>
							</form>
							</td>
						</tr>
						<tr>
							<td>
							<form action='offerings.php'>
								<input type='submit' value='Offerings'/>
							</form>
							</td>
						</tr>
						<tr>
							<td>
							<form action='accommodations.php'>
								<input type='submit' value='Accommodations'/>
							</form>
							</td>
						</tr>
						<tr>
							<td>
							<form action='review.php'>
								<input type='submit' value='Reviews'/>
							</form>
							</td>
						</tr>
					</table>					
				</div>
			</body>";
		
		
	?>
		
</html>