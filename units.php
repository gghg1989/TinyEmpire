<?php
	session_start();
	include("header.php");
	
	if(!isset($_SESSION['uid'])) {
		//Not login
		message("Please login!");
	}
	else {
		//Logged in
		if(isset($_POST['train'])) {
			$worker = protect($_POST['worker']);
			$farmer = protect($_POST['farmer']);
			$warrior = protect($_POST['warrior']);
			$defender = protect($_POST['defender']);
			
			$trained = ($worker>0?$worker:0) + ($farmer>0?$farmer:0) + ($warrior>0?$warrior:0) + ($defender>0?$defender:0);
			$untrained = ($worker<0?$worker:0) + ($farmer<0?$farmer:0) + ($warrior<0?$warrior:0) + ($defender<0?$defender:0);
			$neededFood = 10 * $trained + 8 * $untrained;
			if(($unit['unit_worker'] + $worker) < 0 || ($unit['unit_farmer'] + $farmer) < 0 || ($unit['unit_warrior'] + $warrior) < 0 || ($unit['unit_defender'] + $defender) < 0) {
				message("You do not have enough units to untrain!");
			}
			elseif($stats['stats_food'] < $neededFood) {
				message("You do not have enough food!");
			}
			else {
				//Update units value
				$unit['unit_worker'] += $worker;
				$unit['unit_farmer'] += $farmer;
				$unit['unit_warrior'] += $warrior;
				$unit['unit_defender'] += $defender;
				$update_unit = mysql_query("UPDATE `unit` SET 
											`unit_worker` ='". $unit['unit_worker'] ."',
											`unit_farmer` ='". $unit['unit_farmer'] ."',
											`unit_warrior` ='". $unit['unit_warrior'] ."',
											`unit_defender` ='". $unit['unit_defender'] ."'
											WHERE `foreign_user_id` ='" . $_SESSION['uid'] . "'") or die(mysql_error);
											
				//Update food value
				$stats['stats_food'] -= $neededFood;
				$update_food = mysql_query("UPDATE `stats` SET `stats_food`='" . $stats['stats_food'] . "'
											WHERE `foreign_user_id` ='" . $_SESSION['uid'] . "'") or die(mysql_error);
											
			}
			
		}
?>
		<center><h3>Your Units</h3></center>
		<br/>
		You can train and untrain your units here.
		<br />
		<br />
		<form action="units.php" method="post">
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><b>Unit Type</b></td>
					<td><b>Number of Units</b></td>
					<td><b>Cost/Refund</b></td>
					<td><b>Train or Untrain</b></td>
				</tr>
				<tr>
					<td>Worker</td>
					<td><?php echo $unit['unit_worker']; ?></td>
					<td>10/8 food</td>
					<td><input type="number" name="worker" value="0"/></td>
				</tr>
				<tr>
					<td>Farmer</td>
					<td><?php echo $unit['unit_farmer']; ?></td>
					<td>10/8 food</td>
					<td><input type="number" name="farmer" value="0"/></td>
				</tr>
				<tr>
					<td>Warrior</td>
					<td><?php echo $unit['unit_warrior']; ?></td>
					<td>10/8 food</td>
					<td><input type="number" name="warrior" value="0"/></td>
				</tr>
				<tr>
					<td>Defender</td>
					<td><?php echo $unit['unit_defender']; ?></td>
					<td>10/8 food</td>
					<td><input type="number" name="defender" value="0"/></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><input type="submit" name="train" value="Train" /></td>
				</tr>
			</table>
		</form>
		<hr />
		
<?php
	}
	include("footer.php");
?>