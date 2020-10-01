<?php

session_start();

if(!isset($_SESSION['logged_in'])){
    header('Location:index.html');
    exit;
}

$DATABASE_HOST='localhost';
$DATABASE_USER='root';
$DATABASE_PASS='';
$DATABASE_NAME='phpauth';
$con=mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

if(mysqli_connect_errno()){
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt=$con->prepare('SELECT  password , email FROM accounts WHERE id=?');
$stmt->bind_param('i',$_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		
	</head>
	<body >
		<nav >
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"></i>Profile</a>
				<a href="logout.php"></i>Logout</a>
			</div>
		</nav>
        <div>
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>