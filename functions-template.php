<?php
	//Connect to game database
	function connect() {
		mysql_connect("database_server_URL","username","password");
		mysql_select_db("database_name");
	}
	
	//Protect string, anti-hacking via forms
	function protect($str) {
		return mysql_real_escape_string(strip_tags(addslashes($str)));
	}
	
	//Show up a message box
	function message($string) {
		echo "<div id=\"messageBox\">" . $string . "</div>";
	}
?>