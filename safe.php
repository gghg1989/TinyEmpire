<?php

	$get_stats = mysql_query("SELECT * FROM `stats` WHERE `foreign_user_id` = '" . $_SESSION['uid'] . "'") or die(mysql_error());
	$stats = mysql_fetch_assoc($get_stats);
	
	$get_unit = mysql_query("SELECT * FROM `unit` WHERE `foreign_user_id` = '" . $_SESSION['uid'] . "'") or die(mysql_error());
	$unit = mysql_fetch_assoc($get_unit);
	
	$get_user = mysql_query("SELECT * FROM `user` WHERE `user_id` = '" . $_SESSION['uid'] . "'") or die(mysql_error());
	$user = mysql_fetch_assoc($get_user);
	
	$get_weapon = mysql_query("SELECT * FROM `weapon` WHERE `foreign_user_id` = '" . $_SESSION['uid'] . "'") or die(mysql_error());
	$weapon = mysql_fetch_assoc($get_weapon);
	
?>