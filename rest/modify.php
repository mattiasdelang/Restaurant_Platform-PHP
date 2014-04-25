<?php
	
	session_start();
	include_once("classes/restaurant.class.php");
		if(!isset($_SESSION["login"]))
		{
		
			header("Location:login.php");
		
		}
		$r = new Restaurant();
		$form = $r->Modifyres($_GET['id']);
		if(!empty($_POST["modify"]))
		{
		
			try
			{
			
				
				$r->Restname = $_POST["naam"];
				$r->Restadres = $_POST["adres"];
				$r->Restgem = $_POST["gemeente"];
				$r->Restspec = $_POST["specialiteit"];
				$r->Restsite = $_POST["website"];
				$r->Restfb = $_POST["facebook"];
				$r->Restnr = $_POST["telnr"];
				$r->Restmail = $_POST["email"];
				
				$r->Restma = $_POST["maan"];
				$r->Restdi = $_POST["dins"];
				$r->Restwo = $_POST["woens"];
				$r->Restdo = $_POST["dond"];
				$r->Restvr = $_POST["vrij"];
				$r->Restza = $_POST["zat"];
				$r->Restzo = $_POST["zon"];
				$r->Update($_GET['id']);
				
				
			}
			catch (Exception $e)
			{
			
				$error = $e->getMessage();
			
			}
		
		}
	
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css.css">
	<title>Register here</title>
	
</head>
<body>

<h1>Register restaurant bitches</h1>

<?php

	echo serialize($form);

?>

</form>
</body>
</html>