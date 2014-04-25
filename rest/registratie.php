<?php
	session_start();
	include_once("classes/restaurantowner.class.php");
	if(!isset($_SESSION["login"]))
		{
		
			header("Location:login.php");
		
		}
	if(!empty($_POST["register"]))
	{
		try
		{
			$u = new Restaurantowner();
			$u->Lastname = $_POST["lastname"];
			$u->Firstname = $_POST["firstname"];
			$u->Email = $_POST["email"];
			$u->Checkmail();
			$u->Password = $_POST["password"];
			$u->Passcheck = $_POST["passcheck"];
			$u->Random = substr( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
			$u->Sendmail($_POST["email"]);
			$u->Save();
			$result="Account succesvol aangemaakt.";
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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css.css">
	<title>Register here</title>
	<script>

	function myFunction() {
		var pass1 = document.getElementById("password").value;
		var pass2 = document.getElementById("passcheck").value;
		var ok = true;
		if (pass1 != pass2) {
			
			document.getElementById("password").style.borderColor = "#E34234";
			document.getElementById("passcheck").style.borderColor = "#E34234";
			ok = false;
		}
		else {
			document.getElementById("password").style.borderColor = "green";
			document.getElementById("passcheck").style.borderColor = "green";
		}
		return ok;
	}


	</script>
</head>
<body>

<h1>Register here bitches</h1>
<?php
	if(isset($result))
	{
	
		echo "<div id='result'>" . $result . "</div>";
	
	}
	
	if(isset($error))
	{
	
		echo "<div id='error'>" . $error . "</div>";
	
	}
	
?>
<form action="" method="post" onsubmit="return myFunction();">
<input type="text" name="firstname" placeholder="firstname" required/>
<input type="text" name="lastname" placeholder="lastname" required/>
<input type="email" name="email" placeholder="e-mailadres" required/>
<input type="password" id="password" name="password" placeholder="password" required/>

<input type="password" id="passcheck" name="passcheck" placeholder="password confirmation" required/>
<input type="submit" name="register" value="register" />
</form>
</body>
</html>