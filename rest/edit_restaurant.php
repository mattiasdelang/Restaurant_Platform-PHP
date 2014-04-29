<?php
	
	session_start();
	include_once("classes/restaurant.class.php");
		if(!isset($_SESSION["login"]))
		{
		
			header("Location:login.php");
		
		}
		$r = new Restaurant();

        $restaurantId = $_GET['id'];
        $restaurant = $r->getById($restaurantId);

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
                $r->Restid = $restaurantId;
				$r->Update();
				
				
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

<form action='' method='post' >
    <input type='text' name='naam' value='<?=$restaurant['naam']?>' required/>
    <input type='text' name='adres' value='<?=$restaurant['adres']?>' required/>
    <input type='text' name='gemeente' value='<?=$restaurant['gemeente']?>' required/>
    <input type='text' name='specialiteit' value='<?=$restaurant['specialiteit']?>' required/>
    <input type='text' name='website' value='<?=$restaurant['website']?>' required/>
    <input type='text' name='facebook' value='<?=$restaurant['facebook']?>' required/>
    <input type='text' name='telnr' value='<?=$restaurant['telnr']?>' required/>
    <input type='email' name='email' value='<?=$restaurant['mail']?>' required/>

    <input type='text' name='maan' value='<?=$restaurant['maandag']?>' required/>
    <input type='text' name='dins' value='<?=$restaurant['dinsdag']?>' required/>
    <input type='text' name='woens' value='<?=$restaurant['woensdag']?>' required/>
    <input type='text' name='dond' value='<?=$restaurant['donderdag']?>' required/>
    <input type='text' name='vrij' value='<?=$restaurant['vrijdag']?>' required/>
    <input type='text' name='zat' value='<?=$restaurant['zaterdag']?>' required/>
    <input type='text' name='zon' value='<?=$restaurant['zondag']?>' required/>
    <input type='submit' name='modify' value='Pas aan' />
</form>

</form>
</body>
</html>