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
				if(isset($_POST['title'])){
					$oID = $_SESSION["oID"];
					$title = $_POST["title"];
					$price = $_POST["price"];
					
					$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = '12345';
						
					$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
					if(!$con){
						die('Could not connect: ' . mysql_error);
					}
						
					mysql_select_db("cs353");
					
				
					
					if(strcmp($title, $_SESSION["title"]) != 0){
						$sql = "UPDATE Offer SET title='{$title}'
								WHERE oID={$oID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					}
					
					
					
					if($price != $_SESSION["price"]){
						$sql = "UPDATE Offer SET price='{$price}'
								WHERE oID={$oID};";
						$result = mysql_query($sql, $con);
				
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
					
					}
				}
					
				
			
			if(isset($_POST['offer'])){
				$_SESSION["oID"] = $_POST['offer'];
				
				
				$sql = "SELECT title, price FROM Offer 
						WHERE oID={$_POST['offer']};";
					
				$result = mysql_query($sql, $con);
				
				$title = "";
				$price = 0;
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$title = $row["title"];
					$price = $row["price"];
					
				}
					
			
					
					$_SESSION["title"] = $title;
					$_SESSION["price"] = $price;
					
					
					echo"
							<form name='register' method='POST' action = 'modifyOff.php'>
								<table>
								<tr>
									<td><b>Street:</b></td>
									<td><input type='text' placeholder='Title' name='title' value='{$title}' required></td>
								</tr>
								<tr>
									<td><b>City:</b></td>
									<td><input type='text' placeholder='Price' name='price' value='{$price}' required></td>
								</tr>
								</table>
							<input type='submit' name='submit' value='Edit Offer'>
						</form>
						";
					
					
			}
			
			}
			
			if(	!isset($_POST['offer'])){
				$sql = "SELECT O.oID as oID, A.aID as aID,
						O.price as price, O.title as title
						FROM Offer O, Accommodation A 
						WHERE A.uID={$uID} AND O.aID = A.aID;";
						
				$result = mysql_query($sql, $con);
				$row;
			
				echo "<form method='POST' action='modifyOff.php' name='modify'>";
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$oID = $row['oID'];
					$aID = $row['aID'];
					$price = $row['price'];
					$title = $row['title'];
						
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
						
					echo "<input type='radio' name='offer' value='{$oID}'>{$street} 
						{$city} {$state} {$country} {$pcode} {$title} {$price}$<br><br>";
				}	
					
				echo "<input type='submit' name='choose' id='choose' value='Edit'>
				</form>
				</br>";
			}
			
		?>

	</body>
</html>
