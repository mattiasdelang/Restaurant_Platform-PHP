<?php
	include_once("classes/restaurantowner.class.php");
	include_once("classes/restaurant.class.php");
	session_start();
	
		if(!isset($_SESSION["login"]))
		{
		
			header("Location:login.php");
		
		}
	
	$u = new Restaurantowner();
	$r = new Restaurant();
	$r->Restownerid = $_SESSION["login"]["id"];
	$rests=$r->Printres();
	$mail = $_SESSION["login"]["email"];
	$uitkomst = $u->Checkverif($mail);
	
	
		if(!empty($_POST["klik"]))
		{
			try
			{
			
				$u->Code = $_POST["code"];
				$u->Verify($mail);
			
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
	<title>index page</title>
</head>
<body>
<?php 

	echo serialize($rests);
	
	if($uitkomst == "ok")
	{
	
	
	
	}
	else
	{
		echo	"<form action='' method='post'>
				<input type='text' name='code'/>
				<input type='submit' name='klik' value='validate'/>
				</form>";
		

	}

?>
<a href="logout.php">log out</a>	
<a href="restaurant.php">restaurant aanmaken</a>	
</body>
</html>
