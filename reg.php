<?php
	include("header.php");
?>
<h3>Register</h3>

<?php
	if(isset($_POST['register'])) {
		$userName = protect($_POST['user_name']);
		$pwd = protect($_POST['user_pwd']);
		$email = protect($_POST['user_email']);
		
		if(strlen($userName) > 20) {
			echo 'User name must be less than 20 charactors.';
		}
		elseif(strlen($pwd) < 6) {
			echo 'Password must be more than 6 charactors.';
		}
		elseif(strlen($email) > 100 && strlen($email) < 3) {
			echo 'Invalid Email address.';
		}
		else {
			$register_name = mysql_query("SELECT `user_id` FROM `user` WHERE `user_name` = '$userName'") or die(mysql_error());
			$register_email = mysql_query("SELECT `user_id` FROM `user` WHERE `user_email` = '$email'") or die(mysql_error());
			if(mysql_num_rows($register_name) > 0) {
				echo 'User name is already in use.';
			}
			elseif(mysql_num_rows($register_email) > 0) {
				echo 'The email is already in use.';
			}
			else {
				$insertUser = mysql_query("INSERT INTO `user` (`user_name`, `user_pwd`, `user_email`) VALUES ('$userName', '" . md5($pwd) . "', '$email')") or die(mysql_error());
				
				$lastInsertId = mysql_insert_id();
				
				$insertStats = mysql_query("INSERT INTO `stats` (`stats_gold`, `stats_attack`, `stats_defense`, `stats_food`, `foreign_user_id`) VALUES (100, 10, 10, 100, $lastInsertId)") or die(mysql_error());
				$insertUnit = mysql_query("INSERT INTO `unit` (`unit_worker`, `unit_farmer`, `unit_warrior`, `unit_defender`, `foreign_user_id`) VALUES (5, 5, 0, 0, $lastInsertId)") or die(mysql_error());
				$insertWeapon = mysql_query("INSERT INTO `weapon` (`weapon_sword`, `weapon_shield`, `foreign_user_id`) VALUES (0, 0, $lastInsertId)") or die(mysql_error());
				
				echo 'You have registered!';
			}
		}
	}
?>
<br />
<form action="reg.php" method="POST">
	<lable>User Name</lable>
	<input type="text" name="user_name" />
	<br />
	<lable>Password</lable>
	<input type="password" name="user_pwd" />
	<br />
	<lable>Email</lable>
	<input type="text" name="user_email" />
	<br />
	<input type="submit" name="register" value="Register"/>
</form>
<?php
	include("footer.php");
?>