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
	$id = $_SESSION["login"]["id"];
    $r->setRestownerid($id);
	$mail = $_SESSION["login"]["email"];
	$uitkomst = $u->Checkverif($mail);
	
	
		if(!empty($_POST["klik"]))
		{

				$u->setCode($_POST["code"]);
				$u->Verify($mail);

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


	$restauranten = $r->getByOwnerId($id);

    if ($restauranten->num_rows == 0)
    {
        ?>
        <div>
            Geen restauranten gevonden.
        </div>
        <?php

    }
    else
    {

        while ($restaurant = $restauranten->fetch_array())
        {

    ?>
            <div>
                <strong>restaurant naam:</strong> <?=$restaurant['naam']?><br>
                <strong>adres: </strong> <?=$restaurant['adres']?><br>
                <strong>gemeente: </strong> <?=$restaurant['gemeente']?><br>
                <strong>specialiteit: </strong> <?=$restaurant['specialiteit']?><br>
                <strong>website: </strong> <?=$restaurant['website']?><br>
                <strong>facebook: </strong> <?=$restaurant['facebook']?><br>
                <strong>mail: </strong> <?=$restaurant['mail']?><br>
                <strong>telnr: </strong> <?=$restaurant['telnr']?><br>
                <strong>maandag: </strong> <?=$restaurant['maandag']?><br>
                <strong>dinsdag: </strong> <?=$restaurant['dinsdag']?><br>
                <strong>woensdag: </strong> <?=$restaurant['woensdag']?><br>
                <strong>donderdag: </strong> <?=$restaurant['donderdag']?><br>
                <strong>vrijdag:</strong> <?=$restaurant['vrijdag']?><br>
                <strong>zaterdag: </strong> <?=$restaurant['zaterdag']?><br>
                <strong>zondag: </strong><?=$restaurant['zondag']?><br>
                <a href="remove_restaurant.php?id=<?=$restaurant['id']?>">Verwijder dit restaurant</a>
                <a href="edit_restaurant.php?id=<?=$restaurant['id']?>">Restaurant gegevens aanpassen</a>
                <a href="tafel.php?id=<?=$restaurant['id']?>">Tafels toevoegen</a>
                <a href="edit_tafel.php?id=<?=$restaurant['id']?>">Tafels aanpassen</a>
                <a href="show_menu.php?id=<?=$restaurant['id']?>">Menu tonen</a>
                <a href="create_menu.php?id=<?=$restaurant['id']?>">Menu toevoegen</a>
            </div>
    <?php

        }

    }
	
	if($uitkomst != "ok")
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
