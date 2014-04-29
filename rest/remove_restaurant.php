<?php
	
	if(!isset($_SESSION["login"]))
		{
		
			header("Location:login.php");
		
		}
		
	include_once("classes/restaurant.class.php");
	$r = new restaurant();
	
	$r->Removeres($_GET['id']);

?>
