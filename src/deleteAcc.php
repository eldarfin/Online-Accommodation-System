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
						
						
						$sql = "DELETE FROM Utilities WHERE aID={$_POST['accommodation']};";
					
						$result = mysql_query($sql, $con);
						
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
						
						$sql = "DELETE FROM Room WHERE aID={$_POST['accommodation']};";
					
						$result = mysql_query($sql, $con);
						
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
						
						$sql = "DELETE FROM Address WHERE aID={$_POST['accommodation']};";
					
						$result = mysql_query($sql, $con);
						
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
						
						
						$sql = "DELETE FROM House WHERE aID={$_POST['accommodation']};";
					
						$result = mysql_query($sql, $con);
						
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}	
					
						$sql = "DELETE FROM Accommodation WHERE aID={$_POST['accommodation']};";
				
						$result = mysql_query($sql, $con);
						
						if(! $result ) {
							die('Could not enter data: ' . mysql_error());
						}
						
						$sql = "UPDATE Host SET num_of_accommodations=num_of_accommodations-1
							WHERE uID={$uID}";
					$result = mysql_query($sql, $con);
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
						header("Location: deleteAcc.php");
					}
					
					
					$sql = "SELECT aID FROM Accommodation WHERE uID={$uID};";
					
					$result = mysql_query($sql, $con);
					$row;
					$aID;
					echo "<form method='POST' action='deleteAcc.php' name='delete'>";
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
					
					echo "<input type='submit' name='choose' id='choose' value='Delete'>
					</form>
					</br>";
					
					
					/*
					$sql = "DELETE FROM Accommodation WHERE aID={$aID};";
				
					$result = mysql_query($sql, $con);
					
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "DELETE FROM Utilities WHERE aID={$aID};";
				
					$result = mysql_query($sql, $con);
					
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "DELETE FROM Room WHERE aID={$aID};";
				
					$result = mysql_query($sql, $con);
					
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					$sql = "DELETE FROM Address WHERE aID={$aID};";
				
					$result = mysql_query($sql, $con);
					
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					
					$sql = "DELETE FROM House WHERE aID={$aID};";
				
					$result = mysql_query($sql, $con);
					
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					
					
					header("Location: Accommodations.php");*/
				
			
			
		?>
	
	
		
	</body>
</html>