<?php
	session_start();
	include("header.php");
	if(isset($_POST['login'])) {
		if(isset($_SESSION['uid'])) {
			echo "You are already logged in!";
		}
		else {
			$userName = protect($_POST['user_name']);
			$userPwd = protect($_POST['user_pwd']);
			
			$login_check = mysql_query("SELECT `user_id` FROM `user` WHERE `user_name`='$userName' AND `user_pwd`='" . md5($userPwd) . "'") or die(mysql_error());
			
			if(mysql_num_rows($login_check) < 1) {
				echo "Invalid Username Password combination.";
			}
			else {
				$get_id = mysql_fetch_assoc($login_check);
				$_SESSION['uid'] = $get_id['user_id'];
				
				header("Location: main.php");
			}
		}
	}
	else {
		echo "You have visited this page incorrectly.";
	}
	
	include("footer.php");
?>