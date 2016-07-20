<?php
	session_start();
	include("header.php");
	
	if(!isset($_SESSION['uid'])) {
		//Not login
		echo "Please login!";
	}
	else {
		//Logged in
		?>
		<center><h3>Your stats</h3></center>
		<table cellpadding="5" cellspacing="5">
			<tr>
				<td>Username:</td>
				<td><i><?php echo $user['user_name']; ?></i></td>
			</tr>
			<tr>
				<td>Gold:</td>
				<td><i><?php echo $stats['stats_gold']; ?></i></td>
			</tr>
			<tr>
				<td>Food:</td>
				<td><i><?php echo $stats['stats_food']; ?></i></td>
			</tr>
			<tr>
				<td>Attack:</td>
				<td><i><?php echo $stats['stats_attack']; ?></i></td>
			</tr>
			<tr>
				<td>Defense:</td>
				<td><i><?php echo $stats['stats_defense']; ?></i></td>
			</tr>
			<tr>
				<td> </td>
			</tr>
			<tr>
				<td>Worker:</td>
				<td><i><?php echo $unit['unit_worker']; ?></i></td>
			</tr>
			<tr>
				<td>Farmer:</td>
				<td><i><?php echo $unit['unit_farmer']; ?></i></td>
			</tr>
			<tr>
				<td>Warriors:</td>
				<td><i><?php echo $unit['unit_warrior']; ?></i></td>
			</tr>
			<tr>
				<td>Defenders:</td>
				<td><i><?php echo $unit['unit_defender']; ?></i></td>
			</tr>
		</table>
		<?php
	}

	include("footer.php");
?>