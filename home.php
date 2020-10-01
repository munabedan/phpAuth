<?php
//start sessions
session_start();

//check if user is logged in if not redirect to login page
if (!isset($_SESSION['logged_in'])){
    header('location:index.html');
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<title>Home Page</title>
		
	</head>

    <body>
		<nav>
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"></i>Profile</a>
				<a href="logout.php"></i>Logout</a>
			</div>
		</nav>
		<div>
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>