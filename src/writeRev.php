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
		
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$post = $_POST["review"];
				$rating = $_POST["rating"];
				$aID = $_SESSION["aID"];
				$hID = $_SESSION["hID"];
				
				$dbhost = 'localhost';
				$dbuser = 'root';
				$dbpass = '12345';
						
				$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
				if(!$con){
					die('Could not connect: ' . mysql_error);
				}
						
				mysql_select_db("cs353");
				
				
				$sql = "SELECT MAX(rID) as rID FROM Reviews;";
				
				$return = mysql_query($sql, $con);
						
				$rID = 0;
				while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
					$rID = $row_["rID"]+1;
				}
				
				$sql = "INSERT INTO Reviews VALUES({$rID}, {$rating}, '{$post}', {$_SESSION['uID']}, {$hID}, {$aID}, 0);";
				
				$result = mysql_query($sql, $con);
				
				
				if(! $result ) {
					die('Could not enter data: ' . mysql_error());
				}
				
				header("Location: review.php");
			}
		
			if($_SERVER["REQUEST_METHOD"] == "GET"){
				$aID = $_GET["aID"];
				$resID = $_GET["resID"];
				$hID = $_GET["hID"];
				
				$dbhost = 'localhost';
				$dbuser = 'root';
				$dbpass = '12345';
						
				$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
				if(!$con){
					die('Could not connect: ' . mysql_error);
				}
						
				mysql_select_db("cs353");
				
				
				$sql = "SELECT res_date_end FROM Reservation
						WHERE resID = {$resID};";
				
				$return = mysql_query($sql, $con);
						
				$checkout = "";
				while($row_ = mysql_fetch_array($return, MYSQL_ASSOC)){
					$checkout = $row_["res_date_end"];
				}
				
				$curDate = date("Y-m-d");
				if($curDate > $checkout){
					$_SESSION["aID"] = $aID;
					$_SESSION["hID"] = $hID;
					
					
					echo"<form name='review' method='POST' action='writeRev.php'>
							<br>Rating: <input type='number' name='rating' min = '0' max='5' placeholder='0-5'><br><br>
							Write your review:
							<br>
							<textarea name='review' rows='10' cols='80'></textarea>
							<input type='submit' name='choose' id='choose' value='Submit'>
						</form>
					";
				}else{
					header("Location: res.php");
				}
			}
			
		?>
	
	
		
	</body>
</html>	