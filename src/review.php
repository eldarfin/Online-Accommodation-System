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
			$sql = "Select U.first_name as first_name, U.last_name as last_name,
					R.uID_2 as uID_2, R.rating as rating, r.review as review   
					From User U,Host H, Reviews R 
					Where U.uID= H.uID and H.uID =R.uID_2 
					and H.uID ={$uID_search};";
					
			$result = mysql_query($sql, $con);	
			
			
			
				$first_name = "";$last_name = "";
				$review = "";
				$uID_2 = $rating =  0;
				$row;
				$empty = true;
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$empty = false;
					$first_name = $row["first_name"];
					$last_name = $row["last_name"];
					$review = $row["review"];
					$uID_2 = $row["uID_2"];
					$rating = $row["rating"];
					echo "<table><tr>
									<td><h2>Host Review</h2></td>
								</tr>
								<tr>
									<td>Name:</td>
									<td>{$first_name} {$last_name}</td>
								</tr>
								<tr>
									<td>Rating:</td>
									<td>{$rating}</td>
								</tr>
								<tr>
									<td>Review: {$review}</td>
								</tr>
								</tr></table>";
					}
					if($empty){
						echo "<h1>There is no information about this user's host services.</h1>";
					}
			 
					
				
			$sql = "Select U.first_name as first_name, U.last_name as last_name,
					R.uID_2 as uID_2, R.rating as rating, R.review as review, R.aID as aID   
					From User U,Client C, Reviews R
					Where U.uID= C.uID and U.uID = R.uID_1 
					and U.uID ={$uID_search};";
					
			$result = mysql_query($sql, $con);	
			
			
			
				$first_name = "";$last_name = "";
				$review = "";
				$uID_2 = $rating =  0;
				$row;
				$empty = true;
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$empty = false;
					$first_name = $row["first_name"];
					$last_name = $row["last_name"];
					$review = $row["review"];
					$uID_2 = $row["uID_2"];
					$rating = $row["rating"];
					$aID = $row["aID"];
					echo "<table><tr>
									<td><h2>Client Review</h2></td>
								</tr>
								<tr>
									<td>Name:</td>
									<td>{$first_name} {$last_name}</td>
								</tr>
								<tr>
									<td>Rating:</td>
									<td>{$rating}</td>
								</tr>
								<tr>
									<td>Review: {$review}</td>
								</tr>
								</tr></table>";
					}
					if($empty){
						echo "<h1>There is no information about this user's client services.</h1>";
					}
			 
			
		?>
	</body>
</html>