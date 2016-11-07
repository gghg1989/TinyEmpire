<?php
	$worker_productivity = 4;
	$farmer_productivity = 5;
	
	$swordATK = 10;
	$shieldDEF = 10;
	

	//Get user's last timestamp
	$recordTimestamp = date($user['user_timestamp']);
	$lastTimestamp = new DateTime($recordTimestamp);
	//Get current timestamp
	$currentTimestamp = new DateTime();
	//Update user's current timestamp to database
	$update_timestamp = mysql_query("UPDATE `user` SET `user_timestamp`='" . $currentTimestamp->format("Y-m-d H:i:s") . "'WHERE `user_id` ='" . $_SESSION['uid'] . "'") or die(mysql_error);
	//Get time interval
	$interval = $currentTimestamp->diff($lastTimestamp);
	$diffInSeconds = ((($interval->d * 24 + $interval->h) * 60 + $interval->i) * 60) + $interval->s;
	
	$diffInMinutes = $diffInSeconds / 60;
	
	/*Update gold and food of user*/
	$gold_growth = floor( $diffInMinutes * $worker_productivity * $unit['unit_worker'] );
	$stats['stats_gold'] += $gold_growth;
	if($stats['stats_gold'] >= 4294967295){
		$stats['stats_gold'] = 4294967295;
	}
	$update_food = mysql_query("UPDATE `stats` SET `stats_gold`='" . $stats['stats_gold'] . "'WHERE `foreign_user_id` ='" . $_SESSION['uid'] . "'") or die(mysql_error);
	
	$food_growth = floor( $diffInMinutes * $farmer_productivity * pow($unit['unit_farmer'], 0.5) );
	$stats['stats_food'] += $food_growth;
	if($stats['stats_food'] >= 4294967295){
		$stats['stats_food'] = 4294967295;
	}
	$update_gold = mysql_query("UPDATE `stats` SET `stats_food`='" . $stats['stats_food'] . "'WHERE `foreign_user_id` ='" . $_SESSION['uid'] . "'") or die(mysql_error);
	
	
	/*Update attack and defence of user*/
	if($weapon['weapon_sword'] >= $unit['unit_warrior']) {
		$ATK = $swordATK * $unit['unit_warrior'];
	}
	else {
		$ATK = ($swordATK * $weapon['weapon_sword']) + $unit['unit_warrior'];
	}
	$stats['stats_attack'] = $ATK;
	if($stats['stats_attack'] >= 4294967295){
		$stats['stats_attack'] = 4294967295;
	}
	$update_attack = mysql_query("UPDATE `stats` SET `stats_attack`='" . $stats['stats_attack'] . "'WHERE `foreign_user_id` ='" . $_SESSION['uid'] . "'") or die(mysql_error);
	
	if($weapon['weapon_shield'] >= $unit['unit_defender']) {
		$DEF = $swordATK * $unit['unit_defender'];
	}
	else {
		$DEF = ($swordATK * $weapon['weapon_shield']) + $unit['unit_defender'];
	}
	$stats['stats_defense'] = $DEF;
	if($stats['stats_defense'] >= 4294967295){
		$stats['stats_defense'] = 4294967295;
	}
	$update_defense = mysql_query("UPDATE `stats` SET `stats_defense`='" . $stats['stats_defense'] . "'WHERE `foreign_user_id` ='" . $_SESSION['uid'] . "'") or die(mysql_error);
	
?>