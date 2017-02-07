<?php
	session_start();
?>
<html>
	<head>
		<title>Welcome!</title>
	</head>
	
	<body>
		<?php
			$name=$lname=$user=$pass=$pnum=$email="";
			
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$user = htmlspecialchars($_POST["user"]);
				$pass = htmlspecialchars($_POST["pass"]);
				$name = htmlspecialchars($_POST["name"]);
				$lname = htmlspecialchars($_POST["lname"]);
				$pnum = htmlspecialchars($_POST["pnum"]);
				$email = htmlspecialchars($_POST["email"]);
			
			
				$dbhost = 'localhost';
				$dbuser = 'root';
				$dbpass = '12345';
					
				$con = mysql_connect($dbhost, $dbuser, $dbpass);
				
				if(!$con){
					die('Could not connect: ' . mysql_error);
				}
					
				mysql_select_db("cs353");
				$sql = 'SELECT MAX(uID) as uID FROM User;';
				
				$result = mysql_query($sql, $con);
				$uID = 0;
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$uID = $row['uID']+1;
				}
				
				$sql = "INSERT INTO User VALUES({$uID},'{$name}','{$lname}', '{$pnum}','{$email}');";
				$result = mysql_query($sql, $con);
				
				
				
				if(! $result ) {
					die('Could not enter data: ' . mysql_error());
				}
				
				$sql = "INSERT INTO Login VALUES({$uID}, '{$user}', '{$pass}');";
				$result = mysql_query($sql, $con);
				
				if(! $result ) {
					die('Could not enter data: ' . mysql_error());
					/*$sql = "DELETE FROM User WHERE uID = {$uID};";
					$result = mysql_query($sql, $con);
					while(!$result){
						$sql = "DELETE FROM User WHERE uID = {$uID};";
						$result = mysql_query($sql, $con);
					}*/
				}
				
				$sql = "INSERT INTO Client VALUES({$uID},0);";
				$result = mysql_query($sql, $con);
				
				
				
				if(! $result ) {
					die('Could not enter data: ' . mysql_error());
				}
				
				$sql = "INSERT INTO Host VALUES({$uID},0);";
				$result = mysql_query($sql, $con);
				
				
				
				if(! $result ) {
					die('Could not enter data: ' . mysql_error());
				}
				header("Location: login.php");
			}
			
			
		?>
	
	
		<div>
			<h1>Please enter the required information</h1>
			<form name="register" method="POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<table>
					<tr>
						<td><b>Username:</b></td>
						<td><input type="text" placeholder="Username" name="user" required></td>
					</tr>
					<tr>
						<td><b>Name:</b></td>
						<td><input type="text" placeholder="Name" name="name" required></td>
					</tr>
					<tr>
						<td><b>Lastname:</b></td>
						<td><input type="text" placeholder="Lastname" name="lname" required></td>
					</tr>
					<tr>
						<td><b>Phone Number:</b></td>
						<td><input type="text" placeholder="Phone Number" name="pnum" required></td>
					</tr>
					<tr>
						<td><b>Password:</b></td>
						<td><input type="password" placeholder="Password" name="pass" required></td>
					</tr>
					<tr>
						<td><b>E-mail:</b></td>
						<td><input type="text" placeholder="E-mail" name="email" required></td>
					</tr>
				</table>
				<input type="submit" name="submit" value="Create Account">
			</form>
		</div>
	</body>
</html>