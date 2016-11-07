<?php
	session_start();
	include("header.php");
	
	if(!isset($_SESSION['uid'])) {
		//Not login
		message("Please login!");
	}
	else {
		//Logged in
		if(isset($_POST['trade'])) {
			$sword = protect($_POST['sword']);
			$shield = protect($_POST['shield']);
			
			$buy = ($sword>0?$sword:0) + ($shield>0?$shield:0);
			$sell = ($sword<0?$sword:0) + ($shield<0?$shield:0);
			$neededGold = 10 * $buy + 8 * $sell;
			
			if(($weapon['weapon_sword'] + $sword) < 0 || ($weapon['weapon_shield'] + $shield) < 0) {
				message("You do not have enough weapons to sell!");
			}
			elseif($stats['stats_gold'] < $neededGold) {
				message("You do not have enough gold!");
			}
			else {
				//Update units value
				$weapon['weapon_sword'] += $sword;
				$weapon['weapon_shield'] += $shield;
				
				$update_weapon = mysql_query("UPDATE `weapon` SET 
											`weapon_sword` ='". $weapon['weapon_sword'] ."',
											`weapon_shield` ='". $weapon['weapon_shield'] ."'
											WHERE `foreign_user_id` ='" . $_SESSION['uid'] . "'") or die(mysql_error);
											
				//Update food value
				$stats['stats_gold'] -= $neededGold;
				$update_gold = mysql_query("UPDATE `stats` SET `stats_gold`='" . $stats['stats_gold'] . "'
											WHERE `foreign_user_id` ='" . $_SESSION['uid'] . "'") or die(mysql_error);
				
				message("Weapons traded!");
			}
			
		}
?>
		<center><h3>Your Weapons</h3></center>
		<br/>
		You can trade your weapons here.
		<br />
		<br />
		<form action="weapons.php" method="post">
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><b>Weapon Type</b></td>
					<td><b>Number of Weapons</b></td>
					<td><b>Cost/Refund</b></td>
					<td><b>Buy or Sell</b></td>
				</tr>
				<tr>
					<td>Sword</td>
					<td><?php echo $weapon['weapon_sword']; ?></td>
					<td>10/8 gold</td>
					<td><input type="number" name="sword" value="0"/></td>
				</tr>
				<tr>
					<td>Shield</td>
					<td><?php echo $weapon['weapon_shield']; ?></td>
					<td>10/8 gold</td>
					<td><input type="number" name="shield" value="0"/></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><input type="submit" name="trade" value="Trade" /></td>
				</tr>
			</table>
		</form>
		<hr />
		
<?php
	}
	include("footer.php");
	
?>