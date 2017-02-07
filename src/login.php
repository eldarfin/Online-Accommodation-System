<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome!</title>
	</head>
	
	<body>
		<?php
			$user=$pass="";
			
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$user = htmlspecialchars($_POST["user"]);
				$pass = htmlspecialchars($_POST["pass"]);
			
			
				$dbhost = 'localhost';
				$dbuser = 'root';
				$dbpass = '12345';
					
				$con = mysql_connect($dbhost, $dbuser, $dbpass);
				
				if(!$con){
					die('Could not connect: ' . mysql_error);
				}
				
				mysql_select_db("cs353");
					
				mysql_select_db("berkay_gulcan");
				$sql = 'SELECT username, uID, password FROM Login;';
					
				$result = mysql_query($sql, $con);
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($user == $row['username']){
						if(strcmp($pass, $row['password']) == 0){
							$url = "/home.php";
							$_SESSION['uID'] = $row['uID'];
							$_SESSION['uID1'] = $row['uID'];
							header("Location: profile.php");
						}
					}
				}
				echo '<script type="text/javascript">';
				echo 'alert("Wrong username or password!")';
				echo '</script>';
			}
			
			
		?>
	
	
		<div>
			<h1>Welcome, please login</h1>
			<form name="login" method="POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<table>
					</tr>
						<td><b>Username:</b></td>
						<td><input type="text" placeholder="Username" name="user" required></td>
						<td> &emsp; <b>Password:</b></td>
						<td><input type="password" placeholder="Enter password" name="pass" required></td>
						<td> &emsp; </td>
						<td><input type="submit" name="submit" value="Login"></td>
					</tr>
				</table>
		</div>
		
		<div>
			<h3>Don't have an account? Click <a href="http://localhost/cs353/register.php">here</a>!</h3>
		</div>
	</body>
</html>