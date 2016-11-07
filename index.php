<?php
	session_start();
	include("header.php");
	
	echo $lastTimestamp->format("Y-m-d H:i:s") . "<br />";
	echo $currentTimestamp->format("Y-m-d H:i:s") . "<br />";
	echo $diffInSeconds . "<br />";
	

	
	include("footer.php");
?>