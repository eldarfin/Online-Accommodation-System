<?php
	session_start();
?>
<html>
	<head>
		<title>Welcome!</title>
	</head>
	
	<body>
		
	
		<?php
					
			if($_SERVER["REQUEST_METHOD"] == "GET"){
				$resID = $_GET["resID"];
				
				$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = '12345';
						
					$con = mysql_connect($dbhost, $dbuser, $dbpass);
					
					if(!$con){
						die('Could not connect: ' . mysql_error);
					}
						
					mysql_select_db("cs353");
					
					$sql = "DELETE FROM Reservation WHERE resID={$resID};";
					$result = mysql_query($sql, $con);
				
				
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					header("Location: res.php");
					
				$sql = "UPDATE Client SET num_of_travels = num_of_travels - 1 WHERE uID={$_SESSION['uID']};";
					$result = mysql_query($sql, $con);
				
				
				
					if(! $result ) {
						die('Could not enter data: ' . mysql_error());
					}
					header("Location: res.php");
				
			}
					
				
			
			
		?>
	
	
		
	</body>
</html>