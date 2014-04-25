<?php 
	session_start();
	include_once("classes/restaurantowner.class.php");
	if(isset($_SESSION['login']))
	{

		header("Location:index.php");

	}
	

	if(!empty($_POST["login"]))
	{
		
		try
		{
			$u = new Restaurantowner();
			$u->Email = $_POST["email"];
			$u->Password =$_POST["password"];
			$u->Checklogin();
		}
		catch (Exception $e)
		{
		
			$error = $e->getMessage();
		
		}
		
	}

	

	if(!empty($_POST["register"]))
	{
	
		header("Location:registratie.php");
	
	}


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log in Restaurant Owner</title>
	<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<h1>login</h1>
	<?php
	
	if(isset($error))
	{
	
		echo "<div id='error'>" . $error . "</div>";
	
	}
	
	?>
	<form action="" method="post">
	<input type="text" name="email" placeholder="e-mailadres"/>
	<input type="password" name="password" placeholder="password"/>
	<input type="submit" name="login" value="log in"/>
	<input type="submit" name="register" value="Register"/>
	</form>
	
</body>
</html>