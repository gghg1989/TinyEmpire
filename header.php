<?php
	include("functions.php");
	connect();
?>
<html>
<head>
	<title>Tiny Empire</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<header>
		<h1>Tiny Empire</h1>
	</header>
	<div id="conatiner">
		<nav>
			<?php
				if(isset($_SESSION['uid'])) {
					include("safe.php");
			?>
			
			&raquo; <a href="main.php" class="btn_nav">Stats</a>
			<br />
			<br />
			&raquo; <a href="rankings.php" class="btn_nav">Battle</a>
			<br />
			<br />
			&raquo; <a href="units.php" class="btn_nav">Units</a>
			<br />
			<br />
			&raquo; <a href="weapons.php" class="btn_nav">Weapons</a>
			<br />
			<br />
			&raquo; <a href="logout.php" class="btn_nav">Logout</a>
			<br />
			<br />
			
			<?php
				}
				else {
			?>
			<form action="login.php" method="post">
				<lable>User Name</lable>
				<input type="text" name="user_name" />
				<br />
				<lable>Password</lable>
				<input type="password" name="user_pwd" />
				<br />
				<input type="submit" name="login" value="login" />
			</form>
			<?php
				}
			?>
		</nav>
		<content>