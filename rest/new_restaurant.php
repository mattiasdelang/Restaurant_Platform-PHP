<?php
	
	session_start();
	include_once("classes/restaurant.class.php");
		if(!isset($_SESSION["login"]))
		{
		
			header("Location:login.php");
		
		}
		
		if(!empty($_POST["aanmaken"]))
		{
		
			try
			{
			
				$r = new Restaurant();
                $r->setRestname($_POST["naam"]);
                $r->setRestadres ($_POST["adres"]);
                $r->setRestgem ($_POST["gemeente"]);
                $r->setRestspec ($_POST["specialiteit"]);
                $r->setRestsite ($_POST["website"]);
                $r->setRestfb ($_POST["facebook"]);
                $r->setRestnr ($_POST["telnr"]);
                $r->setRestmail ($_POST["email"]);

                $r->setRestma ($_POST["maan"]);
                $r->setRestdi ($_POST["dins"]);
                $r->setRestwo ($_POST["woens"]);
                $r->setRestdo ($_POST["dond"]);
                $r->setRestvr ($_POST["vrij"]);
                $r->setRestza ($_POST["zat"]);
                $r->setRestzo ($_POST["zon"]);

                $id=$_SESSION["login"]["id"];
				$r->setRestownerid($id) ;
				$r->Save();

                header('Location: modify.php');
                exit;
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

<form action="" method="post" >
<input type="text" name="naam" placeholder="restaurant naam" required/>
<input type="text" name="adres" placeholder="restaurant adres" required/>
<input type="text" name="gemeente" placeholder="gemeente" required/>
<input type="text" name="specialiteit" placeholder="restaurant specialiteit" required/>
<input type="text" name="website" placeholder="restaurant website" required/>
<input type="text" name="facebook" placeholder="facebook link" required/>
<input type="text" name="telnr" placeholder="telefoonnummer" required/>
<input type="email" name="email" placeholder="e-mailadres" required/>


<input type="text" name="maan" placeholder="openingsuren" required/>
<input type="text" name="dins" placeholder="openingsuren" required/>
<input type="text" name="woens" placeholder="openingsuren" required/>
<input type="text" name="dond" placeholder="openingsuren" required/>
<input type="text" name="vrij" placeholder="openingsuren" required/>
<input type="text" name="zat" placeholder="openingsuren" required/>
<input type="text" name="zon" placeholder="openingsuren" required/>

<input type="submit" name="aanmaken" value="aanmaken" />
</form>
</body>
</html>